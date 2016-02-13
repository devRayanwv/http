<?php
/**
 * User: Rayan Alamer
 * Date: 10/02/16
 * Time: 11:00 AM
 */

namespace Http;


class Cookie implements CookieInterface
{
    private $name;
    private $value;
    private $domain;
    private $path;
    private $expire;
    private $httpOnly;
    private $secure;

    /**
     * Cookie constructor.
     * @param $name
     * @param $value
     * @param $domain
     * @param $path
     * @param $expire
     * @param $httpOnly
     * @param $secure
     */

    public function __construct($name, $value = null, $expire = 0)
    {
        // from PHP source code
        if (preg_match("/[=,; \t\r\n\013\014]/", $name)) {
            throw new \InvalidArgumentException(sprintf('The cookie name "%s" contains invalid characters.', $name));
        }

        if (empty($name)) {
            throw new \InvalidArgumentException('The cookie name cannot be empty.');
        }

        // convert expiration time to a Unix timestamp
        if ($expire instanceof \DateTime) {
            $expire = $expire->format('U');
        } elseif (!is_numeric($expire)) {
            $expire = strtotime($expire);

            if (false === $expire || -1 === $expire) {
                throw new \InvalidArgumentException('The cookie expiration time is not valid.');
            }
        }

        $this->name = (string) $name;
        $this->value = $value;
        $this->domain = null;
        $this->path = (string) '/';
        $this->expire = $expire;
        $this->httpOnly = (bool) true;
        $this->secure = (bool) false;
    }


    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return null
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param $value
     */
    public function setValue($value)
    {
        $this->value = (string) $value;
    }

    /**
     * @param $domain
     */
    public function setDomain($domain)
    {
        $this->domain = (string) $domain;
    }

    /**
     * @return null
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * @param $path
     */
    public function setPath($path)
    {
        $this->path = (string) $path;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @return bool
     */
    public function isSecure()
    {
        return $this->secure;
    }

    /**
     * @param $secure
     */
    public function setSecure($secure)
    {
        $this->secure = (bool) $secure;
    }

    /**
     * @return bool
     */
    public function isHttpOnly()
    {
        return $this->httpOnly;
    }

    /**
     * @param $httpOnly
     */
    public function setHttpOnly($httpOnly)
    {
        $this->httpOnly = (bool) $httpOnly;
    }

    /**
     * @return int|string
     */
    public function getExpiresTime()
    {
        return $this->expire;
    }

    /**
     * @return bool
     */
    public function isExpired()
    {
        return $this->expire < time();
    }

    /**
     * @param $minutes
     */
    public function setExpiresTime($minutes)
    {
        $this->expire = time() + (60 * $minutes);
    }

}