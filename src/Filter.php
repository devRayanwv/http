<?php
/**
 * User: Rayan Alamer
 * Date: 21/01/16
 * Time: 11:59 AM
 */

namespace Http;


class Filter
{
    public static function XSSFilter($value)
    {
        if (is_string($value))
            $value = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');

        return $value;
    }
}