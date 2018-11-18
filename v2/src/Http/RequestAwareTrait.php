<?php
/**
 * Created by PhpStorm.
 * User: Bernard-ng
 * Date: 11/18/2018
 * Time: 6:53 PM
 */

namespace Befree\Http;


trait RequestAwareTrait
{
    /**
     * @var Request;
     */
    private $currentRequest;


    /**
     * allow to have access to the request everywhere
     * @return Request
     */
    public function getRequest()
    {
        $this->currentRequest = new Request();
        return $this->currentRequest;
    }
}