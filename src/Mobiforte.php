<?php

/**
 * Mobiforte Api docs url: https://api.mobiforte.com/sms?client_id=?&client_secret=?&recipient=?&sender_id=?&message=?
 */

namespace Nanadjei2\Mobiforte;

class Mobiforte
{
    /** Package version @return string */
    const VERSION = "0.1.0";

    /** Url for sending sms */
    const SMS_ENDPOINT = "https://api.mobiforte.com/sms";

    /** Then name of the sender */
    public $sender_id;

    protected $client_id;

    protected $client_secret;

    public $to;

    public $message;

    /** For the purpose of scheduling the messsage */
    public $date_time;


    public function __construct($sender_id = null, $client_id = null, $client_secret = null)
    {
        $this->sender_id = $sender_id ?: config('mobiforte.sender_id');

        $this->client_id =  $client_id ?: config('mobiforte.client_id');

        $this->client_secret =  $client_secret ?: config('mobiforte.client_secret');
    }

    /** 
     * $sender_id is the name that will oppear on the receiver's phone.
     * This can be overwritten.
     */
    public function from($sender_id)
    {
        return $this->sender_id = $sender_id;

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
     * Send Sms to Phone number
     * @param  int $to recepient phone number
     * @param  string $message    messge to be sent
     * @param  string $date_time 	schedule
     */
    public function send($to = null, $message = null, $date_time = null)
    {
        $this->to = $to ?: $this->to;
        $this->message = $message ?: $this->message;
        $this->date_time = $date_time ?: $this->date_time;

        /** Construct URL */
        $url = static::SMS_ENDPOINT . "?"
            . "client_id=" . $this->client_id .
            "&client_secret=" . $this->client_secret .
            "&recipient=" . $this->to .
            "&sender_id=" .  substr($this->sender_id, 0, 11) .
            "&message=" . urlencode($this->message);

        if (!is_null($date_time)) $url .= "&date_time" . $date_time;

        return $this->sendRequest("GET", $url);
    }

    /**
     * Check sms balance.
     */
    public function balance()
    {
        $url = static::SMS_ENDPOINT . "/balance?"
            . "client_id=" . $this->client_id .
            "&client_secret=" . $this->client_secret;

        return $this->sendRequest("GET", $url);
    }

    /** 
     * Schedule sms to be sent in future.
     */
    public function schedule($date_time, $to = null, $message = null)
    {
        return $this->send($to, $message, $date_time);
    }

    protected function sendRequest(string $type, $url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $type);
        $result = curl_exec($ch);
        return $result = json_decode($result, TRUE);
    }
}
