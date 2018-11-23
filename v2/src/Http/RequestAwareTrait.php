<?php

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
