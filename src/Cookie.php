<?php

namespace Volkish\Cookie;

final class Cookie
{
    /**
     * Default domain
     *
     * @var ?string
     */
    private static $defaultDomain = '';

    /**
     * Default path
     *
     * @var ?string
     */
    private static $defaultPath = '';

    /**
     * HttpOnly option
     *
     * @var ?bool
     */
    private static $defaultHttpOnly = false;

    /**
     * Secure option
     *
     * @var ?bool
     */
    private static $defaultSecure = false;

    /**
     * Set default domain for all cookies
     *
     * @param string $domain
     */
    public static function setDefaultDomain(string $domain)
    {
        static::$defaultDomain = $domain;
    }

    /**
     * Set default path for all cookies
     *
     * @param string $path
     */
    public static function setDefaultPath(string $path)
    {
        static::$defaultPath = $path;
    }

    /**
     * Set HttpOnly option for all cookies
     *
     * @param bool $httpOnly
     */
    public static function setDefaultHttpOnly(bool $httpOnly)
    {
        static::$defaultHttpOnly = $httpOnly;
    }

    /**
     * Set Secure option for all cookies
     *
     * @param bool $secure
     */
    public static function setDefaultSecure(bool $secure)
    {
        static::$defaultSecure = $secure;
    }

    /**
     * The name of the cookie.
     *
     * @var string
     */
    private $name;

    /**
     * The value of the cookie. This value is stored on the clients computer; do not store sensitive information.
     *
     * @var string
     */
    private $value = '';

    /**
     * The time the cookie expires. This is a Unix timestamp so is in number of seconds since the epoch.
     *
     * @var int
     */
    private $expire = 0;

    /**
     * The path on the server in which the cookie will be available on.
     *
     * @var string
     */
    private $path;

    /**
     * The (sub)domain that the cookie is available to
     *
     * @var string
     */
    private $domain;

    /**
     * Indicates that the cookie should only be transmitted over a secure HTTPS connection from the client.
     *
     * @var bool
     */
    private $secure;

    /**
     * When TRUE the cookie will be made accessible only through the HTTP protocol.
     * This means that the cookie won't be accessible by scripting languages, such as JavaScript.
     * @var bool
     */
    private $httpOnly;

    /**
     * Cookie constructor
     */
    public function __construct()
    {
        $this->domain   = static::$defaultDomain;
        $this->path     = static::$defaultPath;
        $this->secure   = static::$defaultSecure;
        $this->httpOnly = static::$defaultHttpOnly;
    }

    /**
     * Set cookie
     *
     * @return void
     */
    public function set()
    {
        if (headers_sent()) {
            return;
        }

        setcookie(
          $this->name,
          $this->value,
          $this->expire,
          $this->path,
          $this->domain,
          $this->secure,
          $this->httpOnly
        );
    }

    public function __toString()
    {
        $string = "Set-Cookie: {$this->name}={$this->value}";

        if ($this->expire) {
            $string .= "; Expires=" . date(DATE_COOKIE, $this->expire);
        }

        return $string;
    }

    /**
     * Set cookie name
     *
     * @param string $name
     * @return Cookie
     */
    public function setName(string $name): Cookie
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Set cookie value
     *
     * @param string $value
     * @return Cookie
     */
    public function setValue(string $value): Cookie
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @param int $expire
     * @return Cookie
     */
    public function setExpire(int $expire): Cookie
    {
        $this->expire = $expire;
        return $this;
    }

    /**
     * @param string $path
     * @return Cookie
     */
    public function setPath(string $path): Cookie
    {
        $this->path = $path;
        return $this;
    }

    /**
     * @param string $domain
     * @return Cookie
     */
    public function setDomain(string $domain): Cookie
    {
        $this->domain = $domain;
        return $this;
    }

    /**
     * @param bool $secure
     * @return Cookie
     */
    public function setSecure(bool $secure): Cookie
    {
        $this->secure = $secure;
        return $this;
    }

    /**
     * @param bool $httpOnly
     * @return Cookie
     */
    public function setHttpOnly(bool $httpOnly): Cookie
    {
        $this->httpOnly = $httpOnly;
        return $this;
    }

}