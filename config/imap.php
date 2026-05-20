<?php

return [

    /*
    |--------------------------------------------------------------------------
    | IMAP Server Configuration
    |--------------------------------------------------------------------------
    |
    | Configuration for connecting to the IMAP server to fetch emails
    | for the reservation application ticketing system.
    |
    */

    'host' => env('IMAP_HOST', 'mail.thebengal.club'),

    'port' => env('IMAP_PORT', 993),

    'encryption' => env('IMAP_ENCRYPTION', 'ssl'),

    'validate_cert' => env('IMAP_VALIDATE_CERT', true),

    'username' => env('IMAP_USERNAME'),

    'password' => env('IMAP_PASSWORD'),

    'protocol' => env('IMAP_PROTOCOL', 'imap'),

    /*
    |--------------------------------------------------------------------------
    | Email Threading Secret
    |--------------------------------------------------------------------------
    |
    | Secret key used for generating application tokens in email headers.
    | This helps verify that incoming emails are legitimate replies.
    |
    */

    'thread_secret' => env('APP_EMAIL_THREAD_SECRET'),

];
