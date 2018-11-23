<?php

namespace Befree;

use Befree\Helpers\Collection;

class ConfigProvider
{

    /**
     * @var Collection
     */
    private $config;


    /**
     * ConfigProvider constructor.
     * @param string $filename
     */
    public function __construct(string $filename)
    {
        if (file_exists($filename)) {
            $this->config = new Collection(require($filename));
            return $this;
        } else {
            throw new \InvalidArgumentException(sprintf("the %s file doesn't exists", $filename));
        }
    }


    /**
     * @param string $key
     * @return bool
     */
    public function has(string $key): bool
    {
        return $this->config->has($key);
    }


    /**
     * @param string $key
     * @return mixed
     */
    public function get(string $key)
    {
        return $this->config->get($key);
    }
}
