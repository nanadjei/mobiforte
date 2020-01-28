<?php

return [
    "mobiforte_sms_api_key" => env("MOBIFORTE_SMS_API_KEY", "***************"),
    // Sender id must be of length at most 11 characters.
    "mobiforte_sms_sender_id" => env("MOBIFORTE_SMS_SENDER_ID", env('APP_NAME'))
];
