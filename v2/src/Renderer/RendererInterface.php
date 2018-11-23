<?php

namespace Befree\Renderer;

/**
 * Interface RendererInterface
 * @package Befree\Renderer
 */
interface RendererInterface
{
    /**
     * render a view
     * @param string $view
     * @param array $param
     * @return mixed
     */
    public function render(string $view, array $param);


    /**
     * define a global variable, accessible to any view
     * @param string $key
     * @param $value
     * @return mixed
     */
    public function addGlobal(string $key, $value);
}
