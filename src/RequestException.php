<?php
/**
 * User: Rayan Alamer
 * Date: 08/02/16
 * Time: 5:57 PM
 */

namespace Http;


class RequestException extends \Exception
{

    /**
     * RequestException constructor.
     */
    public function __construct($var, $code = 0, \Exception $pre = null)
    {
        $msg = 'Request meta-variable'. $var .'was not set';
        parent::__construct($msg, $code, $pre);
    }
}