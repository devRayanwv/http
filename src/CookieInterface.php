<?php
/**
 * User: Rayan Alamer
 * Date: 10/02/16
 * Time: 10:49 AM
 */

namespace Http;


interface CookieInterface
{
    public function getName();
    public function getValue();
    public function setValue($value);
    public function setDomain($domain);
    public function getDomain();
    public function setPath($path);
    public function getPath();
    public function isSecure();
    public function setSecure($secure);
    public function isHttpOnly();
    public function setHttpOnly($httpOnly);
    public function getExpiresTime();
    public function setExpiresTime($minutes);
    public function isExpired();
}