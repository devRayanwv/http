<?php
/**
 * User: Rayan Alamer
 * Date: 08/02/16
 * Time: 5:46 PM
 */

namespace Http;


class Request implements RequestInterface
{
    protected $queries;
    protected $requests;
    protected $server;
    protected $cookies;
    protected $files;

    /**
     * Request constructor.
     * @param $queries
     * @param $requests
     * @param $server
     * @param $cookies
     * @param $files
     */
    public function __construct(
        array $queries, array $requests, array $server, array $cookies, array $files)
    {
        $this->queries = $queries;
        $this->requests = $requests;
        $this->server = $server;
        $this->cookies = $cookies;
        $this->files = $files;
    }

    public function query($key)
    {
        if (array_key_exists($key, $this->queries))
            return $this->queries[$key];

        return null;
    }

    public function request($key)
    {
        if (array_key_exists($key, $this->requests))
            return $this->requests[$key];

        return null;
    }

    public function file($key)
    {
        if (array_key_exists($key, $this->files))
            return $this->files[$key];

        return null;
    }

    public function cookie($key)
    {
        if (array_key_exists($key, $this->cookies))
            return $this->cookies[$key];

        return null;
    }

    public function only($keys)
    {
        $input = $this->all();
        $keys = is_array($keys) ? $keys : func_get_args();
        $results = [];

        foreach ($keys as $key)
        {
            if (!array_key_exists($key, $input))
                continue;
            $results[$key] = $input[$key];
        }

        return $results;
    }

    public function except($keys)
    {
        $input = $this->all();
        $keys = is_array($keys) ? $keys : func_get_args();

        foreach ($keys as $key)
        {
            if (!array_key_exists($key, $input))
                continue;
            if (array_key_exists($key, $input))
                unset($input[$key]);
        }

        return $input;
    }

    public function parameters()
    {
        return array_merge($this->queries, $this->requests);
    }

    public function allQueries()
    {
        return $this->queries;
    }

    public function allRequests()
    {
        return $this->requests;
    }

    public function files()
    {
        return $this->files;
    }

    public function cookies()
    {
        return $this->cookies;
    }

    public function method()
    {
        return $this->serverVar('REQUEST_METHOD');
    }

    public function uri()
    {
        return $this->serverVar('REQUEST_URI');
    }

    public function path()
    {
        return strtok($this->serverVar('REQUEST_URI'), '?');
    }

    public function ip()
    {
        return $this->serverVar('REMOTE_ADDR');
    }

    public function userAgent()
    {
        return $this->serverVar('HTTP_USER_AGENT');
    }

    public function isHTTPS()
    {
        return (array_key_exists('HTTPS', $this->server)) && $this->server['HTTPS'] !== 'off';
    }

    public function queryStr()
    {
        return $this->serverVar('QUERY_STRING');
    }

    public function isAjax()
    {
        $key = 'HTTP_X_REQUESTED_WITH';
        if (!array_key_exists($key, $this->server))
            return false;

        return 'XMLHttpRequest' == $this->server[$key];
    }

    public function isPjax()
    {
        $key = 'HTTP_X_PJAX';
        if (!array_key_exists($key, $this->server))
            return false;

        return true;
    }

    public function isJson()
    {
        $key = 'CONTENT_TYPE';
        if (!array_key_exists($key, $this->server))
            return false;

        return preg_match('/\bjson\b/i', $this->server[$key]);
    }

    private function serverVar($key)
    {
        if (!array_key_exists($key, $this->server))
            throw new RequestException($key);

        return $this->server[$key];
    }

    private function all()
    {
        return array_merge($this->parameters(), $this->files());
    }
}