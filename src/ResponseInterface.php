<?php
/**
 * User: Rayan Alamer
 * Date: 09/02/16
 * Time: 3:23 PM
 */

namespace Http;


interface ResponseInterface
{
    //Todo: Complete remaining functions
    public function setContent($content);
    public function getContent();
    public function getStatusCode();
    public function setStatusCode($code, $text = null);
    public function setVersion($version);
    public function getVersion();
    public function setCharset($charset);
    public function getCharset();
    public function redirect($url);
    public function toJson($content);
    public function isOK();
    public function isNotFound();
    public function isClientError();
    public function isServerError();
    public function isForbidden();
    public function send();
    public function sendHeader();
    public function sendContent();
    public function addCookie(Cookie $cookie);
    public function removeCookie(Cookie $cookie);


}