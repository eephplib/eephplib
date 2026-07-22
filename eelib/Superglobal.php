<?php

namespace eelib {

    use \Exception;

    use eelib\Support\Guard;

    /**
     * Class Superglobal
     * https://www.php.net/manual/en/reserved.variables.server.php
     *
     * @package eelib
     * @version 2025.xx.xx
     */
    class Superglobal
    {
        // @TODO: Do not leave these with NULL
        public mixed $RequestMethod;
        public mixed $RequestUri;
        public mixed $HttpHost;
        public mixed $Https;
        public mixed $RemoteAddress;

        /**
         * @throws Exception
         */
        public function __construct()
        {
            $this->RequestMethod = self::getRequestMethod();
            $this->RequestUri    = self::getRequestUri();
            $this->HttpHost      = self::getHttpHost();
            $this->Https         = self::getHttps();
            $this->RemoteAddress = self::getRemoteAddress();
        }

        /**
         * @throws Exception
         */
        final public static function getServer()
        {
            return (object) [
                'REQUEST_METHOD' => self::getRequestMethod(),
                'REQUEST_URI'    => self::getRequestUri(),
                'HTTP_HOST'      => self::getHttpHost(),
                'HTTPS'          => self::getHttps(),
                'REMOTE_ADDR'    => self::getRemoteAddress(),
            ];
        }

        // Contains the HTTP method used for the request (GET, POST, PUT, DELETE, etc.).
        // Essential for handling different types of HTTP requests properly.
        final public static function getRequestMethod()
        {
            return Guard::arrayKey($_SERVER, 'REQUEST_METHOD', '$_SERVER');
        }

        // The URI (path and query string) that was requested.
        // Useful for routing, URL parsing, and determining what resource was requested.
        final public static function getRequestUri()
        {
            return Guard::arrayKey($_SERVER, 'REQUEST_URI', '$_SERVER');
        }

        // The value of the Host header, typically containing the domain name.
        //Important for multi-domain applications and generating absolute URLs.
        final public static function getHttpHost()
        {
            return Guard::arrayKey($_SERVER, 'HTTP_HOST', '$_SERVER');
        }

        // Indicates whether the request was made over HTTPS.
        // Returns 'on' if HTTPS is being used, otherwise it's not set or empty.
        // Critical for security checks and protocol-aware redirects.
        final public static function getHttps()
        {
            return Guard::arrayKey($_SERVER, 'HTTPS', '$_SERVER');
        }

        // The IP address of the client making the request.
        // Commonly used for logging, security checks, geolocation, and rate limiting.
        final public static function getRemoteAddress()
        {
            return Guard::arrayKey($_SERVER, 'REMOTE_ADDR', '$_SERVER');
        }
    }
}
