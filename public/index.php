<?php
// This is simple app, no need autoloader lets require the files directly.
require __DIR__ . '/../src/functions.php';
use App\KirimWA;

$config = require(__DIR__ . '/../config/config.php');
$viewData = [];
KirimWA::init($config);
KirimWA::dbOpenConnection();

$viewData = [
    'showModal' => false,
    'response-message' => '',
    'custom-url-checked' => '',
    'text-checked' => '',
    'phone' => '',
    'text' => '',
    'custom-url' => ''
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $urlData = [
        'phone' => $_POST['phone'] ?: '',
        'message' => $_POST['text'] ?: '',
        'url' => $_POST['custom-url'] ?: '',
        'created' => time(),
        'ip_address' => KirimWA::getOriginIp($_SERVER),
        'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?: ''
    ];
    $status = KirimWA::dbInsertUrl($urlData);
    $sanitizedUrl = htmlentities($urlData['url']);
    $viewData = [
        'showModal' => true,
        'response-message' => <<<MSG
URL pendek berhasil disimpan:<br>
<a href="{$config['protocol']}{$config['hostname']}/{$sanitizedUrl}">{$config['hostname']}/{$sanitizedUrl}</a>
MSG
,
        'custom-url-checked' => 'checked',
        'text-checked' => $urlData['message'] ? 'checked' : '',
        'phone' => $urlData['phone'],
        'text' => $urlData['message'],
        'custom-url' => $urlData['url']
    ];

    if ($status === KirimWA::ERR_DB_FAILED_TO_SAVE) {
        $viewData['response-message'] = '<strong>Error</strong>: tidak dapat menyimpan custom URL.';
    }
    if ($status === KirimWA::ERR_DB_URL_EXISTS) {
        $viewData['response-message'] = '<strong>Error</strong>: URL pendek tersebut sudah terpakai, silahkan pilih yang lain.';
    }
}

if ($whatsAppUrl = KirimWA::aliasHandler($_SERVER['REQUEST_URI'], $_SERVER['HTTP_USER_AGENT'])) {
    KirimWA::addLocationHeader($whatsAppUrl);
    exit(0);
}

$phone = KirimWA::getPhoneNumberFromUrl($_SERVER['REQUEST_URI'], $_SERVER['SCRIPT_NAME'], $config['countryCode']);

$countryCode = $config['countryCode'];
if (strlen($phone) > 3 && $_SERVER['REQUEST_METHOD'] === 'GET') {
    $phone = substr($phone, 0, 20);
    $text = KirimWA::getTextFromUrl($_SERVER['REQUEST_URI']);
    $redirectUrl = KirimWA::getWhatsAppUrl(['phone' => $phone, 'text' => $text], $_SERVER['HTTP_USER_AGENT']);
    KirimWA::addLocationheader($redirectUrl);
    exit(0);
}

require __DIR__ . '/../src/view/index.php';