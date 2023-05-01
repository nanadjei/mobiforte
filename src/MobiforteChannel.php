<?php

namespace Nanadjei\Mobiforte;

use Illuminate\Notifications\Notification;
use Nanadjei\Mobiforte\MobiforteMessage;

class MobiforteChannel
{
    /**
     * @var Mobiforte 
     */
    protected $sms;

    public function __construct(Mobiforte $sms)
    {
        $this->sms = $sms;
    }

    /**
     * Send the given notification.
     *
     * @param  mixed  $notifiable
     * @param  \Illuminate\Notifications\Notification  $notification
     * @return \Nanadjei\Mobiforte\MNotifyMessage
     */
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toMobiforte($notifiable);

        if (is_string($message)) {
            $message = new MobiforteMessage($message);
        }

        if ($message->from) {
            $this->sms->from($message->from);
        }

        if ($message->to) {
            $this->sms->to($message->to);
        }

        return $this->sms->send(($message->to ?: $notifiable->phone), trim($message->content));
    }
}
