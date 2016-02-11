<?php
/**
 * User: Rayan Alamer
 * Date: 19/01/16
 * Time: 9:44 PM
 */

namespace Http;


class Token
{
    public static function generate()
    {
        Session::set('token', base64_encode(openssl_random_pseudo_bytes(32)));
        return Session::get('token');
    }

    public static function check($request_token)
    {
        $token = Session::get('token');
        if ($token && $token === $request_token)
            return true;

        return false;
    }
}