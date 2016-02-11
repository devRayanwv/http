<?php
/**
 * User: Rayan Alamer
 * Date: 08/02/16
 * Time: 4:54 PM
 */

namespace Http;


interface RequestInterface
{
    public function query($key);
    public function request($key);
    public function file($key);
    public function cookie($key);
    public function parameters();
    public function allQueries();
    public function allRequests();
    public function files();
    public function cookies();
    public function method();
    public function uri();
    public function path();
    public function ip();
    public function userAgent();
    public function isHTTPS();
    public function queryStr();
    public function isAjax();
    public function isPjax();
    public function isJson();

}