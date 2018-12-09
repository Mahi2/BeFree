<?php
namespace Befree\Applications\Controllers;

use Psr\Container\ContainerInterface;


/**
 * Class DashboardController
 * @package Befree\Applications\Controllers
 */
class DashboardController
{

    /**
     * DashboardController constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        //parent::__construct($container);
    }


    public function index()
    {
        echo "hello world";
    }
}