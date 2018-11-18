<?php

namespace Befree\Http;

use Befree\Helpers\Collection;

/**
 * Class Request
 * @package Befree\Http
 */
class Request
{
    /**
     * get $_POST data
     * @var array
     */
    private $post;

    /**
     * get $_GET data
     * @var array
     */
    private $get;

    /**
     * get $_SERVER data
     * @var array
     */
    private $server;

    /**
     * HttpRequest constructor.
     */
    public function __construct()
    {
        $this->post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $this->get = filter_input_array(INPUT_GET, FILTER_SANITIZE_STRING);
        $this->server = filter_input_array(INPUT_SERVER, FILTER_SANITIZE_STRING);
        $this->files = $_FILES;
    }


    /**
     * which request method it is ?
     * @param string $method
     * @throws \InvalidArgumentException
     * @return bool
     */
    public function is(string $method)
    {
        $method = strtoupper($method);
        $expectedMethods = [
            'POST', 'GET', 'PUT', 'DELETE', 'PATCH'
        ];

        if (isset($this->server['REQUEST_METHOD']) && !empty($this->server['REQUEST_METHOD'])) {
            if (in_array($method, $expectedMethods)) {
                return strtoupper($this->server['REQUEST_METHOD']) === $method;
            } else {
                throw new \OutOfRangeException(sprintf('the method "%s" not if expected request method', $method));
            }
        } else {
            throw new \RuntimeException('undefined request method');
        }
    }


    /**
     * @param string $method
     * @return bool
     */
    public function methodAllowed(string $method)
    {
        $method = strtoupper($method);
        if ($this->is('post') && $this->input('_method') == $method) {
            return true;
        } elseif ($this->is($method)) {
            return true;
        } else {
            return false;
        }
    }


    /**
     * check the csrf token
     * @param string $token
     * @return bool
     */
    public function validToken(string $token)
    {
        return $this->input('_token') == $token;
    }


    /**
     * recupere les donnees du $_POST
     * @param string $key
     * @return Collection|null|mixed
     */
    public function input($key = null)
    {
        if ($key === null) {
            return new Collection($this->post);
        }
        $data = new Collection($this->post);
        return $data->get($key);
    }


    /**
     * recupere les donnees du $_GET
     * @param string|null $key
     * @return Collection|null
     */
    public function query($key = null)
    {
        if ($key === null) {
            return new Collection($this->get);
        }
        $data = new Collection($this->get);
        return $data->get($key);
    }


    /**
     * recupere les donnees du $_FILES
     * @param string $key
     * @return Collection|null
     */
    public function files($key = null)
    {
        if ($key === null) {
            return new Collection($this->files);
        }
        $data = new Collection($this->files);
        return $data->get($key);
    }


    /**
     * recupere les donnees du $_SERVER
     * @param string $key
     * @return null
     */
    public function get(string $key)
    {
        $key = strtoupper(str_replace('.', '_', $key));
        $data = new Collection($this->server);
        return $data->get($key);
    }


    /**
     * renseigne si la request est en ajax.
     * @return bool
     */
    public function ajax()
    {
        return ($this->get('http.x.requested.with') &&
            strtolower($this->get('http.x.requested.with')) == 'xmlhttprequest') ? true : false;
    }
}