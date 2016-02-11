<?php
/**
 * User: Rayan Alamer
 * Date: 21/01/16
 * Time: 11:06 AM
 */

namespace Http;


class Session
{
    public static function start()
    {
        if (session_id() == '')
            session_start();
    }

    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public static function get($key)
    {
        if (isset($_SESSION[$key]))
        {
            $value = $_SESSION[$key];
            return Filter::XSSFilter($value);
        }

        return false;
    }

    public static function add($key, $value)
    {
        $_SESSION[$key][] = $value;
    }

    public static function end()
    {
        session_destroy();
    }

    public static function loggedIn()
    {
        return (self::get('logged_in') ? true : false);
    }
}