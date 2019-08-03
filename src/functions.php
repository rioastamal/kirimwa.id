<?php namespace KirimWA;

/**
 * @param string $requestUri
 * @param string $scriptName
 * @param int $countryCode
 * @return string
 */
function getPhoneNumberFromUrl($requestUri, $scriptName, $countryCode)
{
    $removeCountryCode = true;

    $phoneNumber = str_replace($scriptName, '', $requestUri);
    $phoneNumber = explode('?', $phoneNumber);

    if (strpos($phoneNumber[0], '+') !== FALSE) {
        $removeCountryCode = false;
    }
    $phoneNumber = preg_replace('/[^0-9]+/', '', $phoneNumber[0]);

    if (!$removeCountryCode) {
        return $phoneNumber;
    }

    if (!empty($phoneNumber)) {
        return $countryCode . removeCountryCode($phoneNumber);
    }

    return '';
}

/**
 * @param string $requestUri
 * @return string
 */
function getTextFromUrl($requestUri)
{
    $source = explode(':', $requestUri, 2);

    if (count($source) < 2) {
        return null;
    }

    // "_" to space
    // "--" to new line
    return str_replace(['_', '--'], [' ',  "\n"], $source[1]);
}

/**
 * @param string $phoneNumber
 * @return string
 */
function removeCountryCode($phoneNumber)
{
    return preg_replace('/^620|^62|^0/', '', $phoneNumber);
}

/**
 * Handler for short URL. e.g https://hostname/fancy-url
 *
 * @param array $list - List of URL to handle
 * @param string $requestUri
 * @return string WhatsApp URL
 */
function aliasHandler(array $list, $requestUri)
{
    if (!array_key_exists($requestUri, $list)) {
        return false;
    }

    $phone = $list[$requestUri]['phone'];
    $text = $list[$requestUri]['text'];

    if (!$list[$requestUri['encoded']]) {
        $text = urlencode($text);
    }

    return 'whatsapp://send?phone=' . $phone . '&text=' . $text;
}