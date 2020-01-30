<?php

return [
    // Sender id must be of length at most 11 characters.
    "sender_id" => env("MOBIFORTE_SMS_SENDER_ID", env('APP_NAME')),
    "client_id" => env("MOBIFORTE_SMS_CLIENT_ID", "***************"),
    "client_secret" => env("MOBIFORTE_SMS_CLIENT_SECRET", "***************"),
];
