<?php
// This is simple app, no need autoloader lets require the files directly.
require __DIR__ . '/../src/functions.php';
$config = require(__DIR__ . '/../config/config.php');
$redirect = isset($_GET['no-redirect']) ? false : true;

if ($whatsAppUrl = KirimWA\aliasHandler($config['handler'], $_SERVER['REQUEST_URI'])) {
    KirimWA\addLocationHeader($whatsAppUrl, $redirect);
}

$phone = KirimWA\getPhoneNumberFromUrl($_SERVER['REQUEST_URI'], $_SERVER['SCRIPT_NAME'], $config['countryCode']);

$countryCode = $config['countryCode'];
if (strlen($phone) > 3):
    $phone = substr($phone, 0, 20);
    $text = KirimWA\getTextFromUrl($_SERVER['REQUEST_URI']);
    addLocationheader('whatsapp://send?' . http_build_query(['phone' => $phone, 'text' => $text], '', '&', PHP_QUERY_RFC3986, $redirect));
endif;

require __DIR__ . '/../src/view/index.php';