<?php
/**
 * User: Rayan Alamer
 * Date: 09/02/16
 * Time: 10:04 PM
 */

namespace Http;


class Header
{
    private $headers = array();

    /**
     * Header constructor.
     * @param array $headers
     */
    public function __construct(array $headers = array())
    {
        foreach($headers as $key => $value)
        {
            $this->set($key, $value);
        }
    }

    public function set($key, $values)
    {
        $values = array_values((array) $values);
        if (isset($this->headers[$key]))
            $this->headers[$key] = array_merge($this->headers[$key], $values);
        else
            $this->headers[$key] = $values;
    }

    public function get($key)
    {
        if (array_key_exists($key, $this->headers))
            return $this->headers[$key];

        return null;
    }

    public function add(array $headers)
    {
        foreach ($headers as $key => $value)
        {
            $this->set($key, $value);
        }
    }

    public function all()
    {
        return $this->headers;
    }

    public function keys()
    {
        return array_keys($this->headers);
    }

    public function has($key)
    {
        return array_key_exists($key, $this->headers);
    }

    public function contains($key, $value)
    {
        return in_array($value, $this->get($key));
    }

    public function remove($key)
    {
        unset($this->headers[$key]);
    }

    public function count()
    {
        return count($this->headers);
    }

}