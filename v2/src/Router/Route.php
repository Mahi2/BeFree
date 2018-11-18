<?php
/**
 * Created by PhpStorm.
 * User: Bernard-ng
 * Date: 11/18/2018
 * Time: 5:33 PM
 */

namespace Befree\Router;


class Route
{
    /**
     * l'url ou chemin a l'entree
     * @var string
     */
    private $path;

    /**
     * le callback
     * @var callable
     */
    private $controller;

    /**
     * les parametres matches
     * pour les url particulières
     * @var array
     */
    private $matches = [];

    /**
     * les params avec la method "with"
     * @var array
     */
    private $params = [];


    /**
     * Route constructor
     * @param string $path
     * @param callable
     */
    public function __construct(string $path, $controller)
    {
        $this->path = trim($path, "/");
        $this->controller = $controller;
    }


    /**
     * match des param particulier
     * @param string $param
     * @param string $regex
     * @return Route
     */
    public function with(string $param, string $regex): Route
    {
        $this->params[$param] = str_replace("(", "(?:", $regex);
        return $this;
    }


    /**
     * verifie si une url correspond a une route
     *
     * @param string $url
     * @return bool
     */
    public function match(string $url)
    {
        $url = trim($url, "/");
        $path = preg_replace_callback("#:([\w]+)#", [$this, 'paramMatch'], $this->path);
        $regex = "#^{$path}$#i";

        if (!preg_match($regex, $url, $matches)) {
            return false;
        }

        array_shift($matches);
        $this->matches = $matches;
        return true;
    }


    /**
     * les param matcher avec la method "with"
     * @param mixed $match
     * @return string
     */
    private function paramMatch($match): string
    {
        if (isset($this->params[$match[1]])) {
            return "(" . $this->params[$match[1]] . ")";
        }
        return '([^/]+)';
    }


    /**
     * genere une url
     * @param array $params
     * @return string
     */
    public function getUrl(array $params): string
    {
        $path = $this->path;
        foreach ($params as $k => $v) {
            $path = str_replace(":$k", "$v", $path);
        }
        return $path;
    }

    /**
     * Get le callback
     *
     * @return  callable
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * Get pour les url particulières
     *
     * @return  array
     */
    public function getMatches()
    {
        return $this->matches;
    }

    /**
     * Get les params avec la method "with"
     *
     * @return  array
     */
    public function getParams()
    {
        return $this->params;
    }
}