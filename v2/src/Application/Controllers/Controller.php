<?php
namespace Befree\Application\Controllers;


use Psr\Container\ContainerInterface;

/**
 * Class Controller
 * @package Befree\Applications\Controllers
 */
class Controller
{

    /**
     * @var ContainerInterface
     */
    protected $container;


    /**
     * Controller constructor.
     * @param ContainerInterface $container
     */
    public  function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }
}