<?php

/**
 * Mobiforte Api docs url: https://api.mobiforte.com/sms?client_id=?&client_secret=?&recipient=?&sender_id=?&message=?
 */

namespace Nanadjei\Mobiforte;

use GuzzleHttp\Client as Guzzle;

class Mobiforte
{
    /** Package version @return string */
    const VERSION = "0.1.0";

    /** Url for sending sms */
    const SMS_ENDPOINT = "https://api.mobiforte.com/sms/";

    /** Then name of the sender */
    public $sender_id;

    public $client_id;

    public $client_secret;

    public $to;

    public $message;

    /** For the purpose of scheduling the messsage */
    public $date_time;

    public $client;

    /** Guzzle query params */
    public $guzzleQuery;


    public function __construct($sender_id = null, $client_id = null, $client_secret = null)
    {
        $this->sender_id = $sender_id ?: config('mobiforte.sender_id');

        $this->client_id =  $client_id ?: config('mobiforte.client_id');

        $this->client_secret =  $client_secret ?: config('mobiforte.client_secret');

        $this->client = new Guzzle(['base_uri' => static::SMS_ENDPOINT, 'timeout' => 5]);

        $this->guzzleQuery = ['client_id' => $this->client_id, 'client_secret' => $this->client_secret];
    }

    /** 
     * $sender_id is the name that will oppear on the receiver's phone.
     * This can be overwritten.
     */
    public function from($senderId)
    {
        $this->sender_id = $senderId;

        return $this;
    }

    /** 
     * Get the api key of the 
     * @return string
     */
    public function getClientId(): string
    {
        return $this->client_id;
    }

    /**
     * You can send sms with different api client id and secrete
     * @param $clientId is the fresh client id;
     * @param $clientSecret is the fresh client secret;
     */
    public function withFreshApiKeys(string $clientId, string $clientSecret)
    {
        $this->client_id = $clientId;

        $this->client_secret = $clientSecret;

        return $this;
    }

    /**
     * Send Sms to Phone number
     * @param  int $to recepient phone number.
     * @param  string $message    messge to be sent.
     * @param  string $dateTime 	schedule.
     */
    public function send($to = null, $message = null, $dateTime = null)
    {
        /** Construct URL */
        $this->guzzleQuery["recipient"] = $to;
        $this->guzzleQuery["sender_id"] = substr($this->sender_id, 0, 11);
        $this->guzzleQuery["message"] = $message ?: $this->message;

        if (!is_null($dateTime)) $this->guzzleQuery["date_time"] = $dateTime;

        return $this->sendRequest()->getBody();
    }

    /**
     * Check sms balance.
     */
    public function balance()
    {
        return $this->sendRequest('balance')->getBody();
    }

    /** 
     * Schedule sms to be sent in future.
     * @param $to is the destination number to deliver the message.
     * @param $message is the kind of message ot deliver.
     * @param $dateTime is the timestamp to send the message.
     */
    public function schedule($to = null, $message = null, $dateTime)
    {
        return $this->send($to, $message, $dateTime)->getBody();
    }

    /** THis is where the request actually get sent to mobiforte api */
    public function sendRequest(string $path = null)
    {
        return $this->getClient()->get($path, ['query' => $this->guzzleQuery]);
    }


    public function getClient()
    {
        return $this->client;
    }

    public function setClient($client)
    {
        $this->client = $client;

        return $this;
    }
}
