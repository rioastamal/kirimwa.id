<?php
// This is simple app, no need autoloader lets require the files directly.
require __DIR__ . '/../src/functions.php';
$config = require(__DIR__ . '/../config/config.php');

if ($whatsAppUrl = KirimWA\aliasHandler($config['handler'], $_SERVER['REQUEST_URI'])) {
    header('Location: ' . $whatsAppUrl);
    exit(0);
}

$phone = KirimWA\getPhoneNumberFromUrl($_SERVER['REQUEST_URI'], $_SERVER['SCRIPT_NAME'], $config['countryCode']);

if (strlen($phone) > 3):
    $phone = substr($phone, 0, 20);
    $countryCode = $config['countryCode'];
    header('Location: whatsapp://send?phone=' . $phone);
    exit(0);
endif;

require __DIR__ . '/../src/view/index.php';