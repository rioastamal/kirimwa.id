<?php namespace App;
use PDO;

/**
 * All functions are wrapped into this class
 */
class KirimWA
{
    const ERR_DB_NONE = 0;
    const ERR_DB_URL_EXISTS = 1;
    const ERR_DB_FAILED_TO_SAVE = 2;

    /**
     * @var PDO
     */
    public static $connection = null;

    /**
     * @var array
     */
    public static $config = [];

    /**
     * Init function to prepare the config
     *
     * @param array $config
     * @return void
     */
    public static function init(array $config)
    {
        static::$config = $config;
    }

    /**
     * @param string $requestUri
     * @param string $scriptName
     * @param int $countryCode
     * @return string
     */
    public static function getPhoneNumberFromUrl($requestUri, $scriptName, $countryCode)
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
            return $countryCode . static::removeCountryCode($phoneNumber);
        }

        return '';
    }

    /**
     * @param string $requestUri
     * @return string
     */
    public static function getTextFromUrl($requestUri)
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
    public static function removeCountryCode($phoneNumber)
    {
        return preg_replace('/^620|^62|^0/', '', $phoneNumber);
    }

    /**
     * Handler for short URL. e.g https://hostname/fancy-url
     *
     * @param array $list - List of URL to handle
     * @param string $requestUri
     * @param string $userAgent
     * @return string WhatsApp URL
     */
    public static function aliasHandler($requestUri, $userAgent)
    {
        $requestUri = explode('?', ltrim($requestUri, '/'))[0];
        if (! $requestUri || ! $row = static::dbGetByUrl($requestUri)) {
            return false;
        }

        $phone = static::getPhoneNumberFromUrl('/' . $row['phone'], '/', static::$config['countryCode']);
        return static::getWhatsAppUrl([
            'phone' => $phone,
            'text' => $row['message']
        ], $userAgent);
    }

    /**
     * Generate WhatsApp URL based on device
     *
     * @param array $data
     * @return string
     */
    public static function getWhatsAppUrl(array $data, $userAgent)
    {
        $urlParams = http_build_query($data, '', '&', PHP_QUERY_RFC3986);

        if (static::isMobileDevice($userAgent)) {
            return 'whatsapp://send?' . $urlParams;
        }

        return 'https://web.whatsapp.com/send?' . $urlParams;
    }

    /**
     * Detect user device based on User Agent string
     *
     * @credit https://stackoverflow.com/a/23874239/2566677
     * @param string $userAgent
     * @return boolean
     */
    public static function isMobileDevice($userAgent)
    {
        $mobileUA = [
            '/iphone/i',
            '/ipod/i',
            '/ipad/i',
            '/android/i',
            '/blackberry/i',
            '/webos/i',
            '/mobile/i',
            '/bb10/i'
        ];

        // return true if Mobile User Agent is detected
        foreach ($mobileUA as $device) {
            if (preg_match($device, $userAgent)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Send redirect Location header based on some parameter.
     *
     * @param string $location
     * @param boolean $redirect (default: true)
     * @return void
     */
    public static function addLocationHeader($location, $redirect = true)
    {
        if (!$redirect) {
            return;
        }

        header('Location: ' . $location);
    }

    /**
     * Open PDO connection to SQlite database
     *
     * @param string $dbFile
     * @return void
     */
    public static function dbOpenConnection()
    {
        static::$connection = new PDO(static::$config['dsnConn']);
        static::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    /**
     * @param string $url URL to find.
     * @return object
     */
    public static function dbGetByUrl($url)
    {
        $stmt = static::$connection->prepare('SELECT id, phone, message FROM urls WHERE url = :url');
        $stmt->execute([':url' => $url]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * @param array $data
     * @return void
     */
    public static function dbInsertUrl($data)
    {
        // To prevent undefined index
        $default = [
            'phone' => '',
            'message' => '',
            'url' => '_',
            'created' => '',
            'ip_address' => '',
            'user_agent' => ''
        ];
        $data = $data + $default;

        $required = ['phone', 'url'];
        foreach ($required as $req) {
            if (trim($data[$req]) === '') {
                return static::ERR_DB_FAILED_TO_SAVE;
            }
        }

        // Make sure the URL did not exists
        if (static::dbGetByUrl($data['url'])) {
            return static::ERR_DB_URL_EXISTS;
        }

        $stmt = static::$connection->prepare('INSERT INTO urls
                        (phone, message, url, created, ip_address, user_agent)
                        VALUES (:phone, :message, :url, :created, :ip_address, :user_agent)');

        foreach ($default as $key => $value) {
            // We use key from $default to prevent binding unnecessary value
            // because data may contains keys that we do not want
            $stmt->bindValue(':' . $key, $data[$key]);
        }

        if ($stmt->execute()) {
            return static::ERR_DB_NONE;
        }

        return static::ERR_DB_FAILED_TO_SAVE;
    }

    /**
     * @param array $serverVars
     * @return string
     */
    public static function getOriginIp($serverVars)
    {
        $proxyHeaders = [
            'HTTP_CF_CONNECTING_IP', // CloudFlare
            'HTTP_X_FORWARDED_FOR',
            'HTTP_CLIENT_IP'
        ];

        foreach ($proxyHeaders as $header) {
            if (isset($serverVars[$header])) {
                return $serverVars[$header];
            }
        }

        // No proxy
        return $serverVars['REMOTE_ADDR'];
    }

    /**
     * @return string
     */
    public static function getBaseUrl()
    {
        return static::$config['protocol'] . static::$config['hostname'];
    }
}