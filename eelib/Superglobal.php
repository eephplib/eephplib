<?php

namespace eelib {

    use \Exception;

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
            return $_SERVER['REQUEST_METHOD'] ?? throw new \Exception('$_SERVER[\'REQUEST_METHOD\'] does not exist');
        }

        // The URI (path and query string) that was requested.
        // Useful for routing, URL parsing, and determining what resource was requested.
        final public static function getRequestUri()
        {
            return $_SERVER['REQUEST_URI'] ?? throw new \Exception('$_SERVER[\'REQUEST_URI\'] does not exist');
        }

        // The value of the Host header, typically containing the domain name.
        //Important for multi-domain applications and generating absolute URLs.
        final public static function getHttpHost()
        {
            return $_SERVER['HTTP_HOST'] ?? throw new \Exception('$_SERVER[\'HTTP_HOST\'] does not exist');
        }

        // Indicates whether the request was made over HTTPS.
        // Returns 'on' if HTTPS is being used, otherwise it's not set or empty.
        // Critical for security checks and protocol-aware redirects.
        final public static function getHttps()
        {
            return $_SERVER['HTTPS'] ?? throw new \Exception('$_SERVER[\'HTTPS\'] does not exist');
        }

        // The IP address of the client making the request.
        // Commonly used for logging, security checks, geolocation, and rate limiting.
        final public static function getRemoteAddress()
        {
            return $_SERVER['REMOTE_ADDR'] ?? throw new \Exception('$_SERVER[\'REMOTE_ADDR\'] does not exist');
        }
    }
}
