<?php

namespace Befree\Renderer;

/**
 * Class TwigRenderer
 * @package Befree\Renderer
 */
class TwigRenderer implements RendererInterface
{

    /**
     * @var \Twig_Environment
     */
    private $twig;


    /**
     * TwigRenderer constructor.
     */
    public function __construct()
    {
        $loader = new \Twig_Loader_Filesystem(ROOT . '/Views', ROOT);
        $this->twig = new \Twig_Environment($loader, [
            'cache' => (ENV === 'production') ? RENDERER_CACHE_PATH : false,
            'debug' =>  ENV === 'development'
        ]);

        if (ENV === 'development') {
            $this->twig->addExtension(new \Twig_Extension_Debug());
        }
    }


    /**
     * @param string $view
     * @param array $params
     * @return mixed|void
     */
    public function render(string $view, array $params)
    {
        echo $this->twig->render("{$view}.twig", $params);
    }


    /**
     * @param string $key
     * @param $value
     * @return mixed|void
     */
    public function addGlobal(string $key, $value)
    {
        $this->twig->addGlobal($key, $value);
    }
}
