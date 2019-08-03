<?php
/**
 * Configuration for KirimWA.id
 */
return [
    // Indonesia country code is 62
    'countryCode' => '62',

    // Handler or alias for each URL. e.g https://domain/xstore
    // "/xstore" is the array key
    'handler' => [
        '/xstore' => [
            // International phone number format
            // e.g:
            'phone' => '62812012345689',

            // Text to be displayed at chat
            'text' => <<<TEXT
Hello X-Store,
I want to order.
TEXT
,
            // false => Value of text above is not encoded, so you have encode
            //          it first before sending to WhatsApp protocol.
            // true => Value of text above is encoded, it will be send as
            //         it is.
            'encoded' => false,
        ]
    ]
];
