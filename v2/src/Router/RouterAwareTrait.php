<?php
/**
 *   This file is part of the Befree.
 *
 *   @copyright   Henrique Mukanda <mahi2hm@outlook.fr>
 *   @copyright   Bernard ngandu <ngandubernard@gmail.com>
 *   @link    https://github.com/Mahi2/BeFree
 *   @link    https://github.com/bernard-ng/Befree
 *   @license   http://framework.zend.com/license/new-bsd New BSD License
 *
 *   For the full copyright and license information, please view the LICENSE
 *   file that was distributed with this source code.
 */

namespace Befree\Router;

use Befree\Http\RequestAwareTrait;

trait RouterAwareTrait
{
    /**
     * la request server actuelle.
     */
    use RequestAwareTrait;


    /**
     * recupere une instance du router et on definit les routes.
     * @return Router
     */
    private function getRouter()
    {
        $router = new Router();
        require(ROOT . "/config/routes.php");
        return $router;
    }


    /**
     * genere une erreur 404
     */
    public function redirect404()
    {
        $request = $this->getRequest();

        if ($request->ajax()) {
            http_response_code(404);
            exit();
        } else {
            http_response_code(404);
            echo "<h1>Not Found with redirect 404</h1>";
            exit();
        }
    }


    /**
     * redirige vers une url, si l'url est vide on redirige vers la page precedente
     * @param string $url
     * @param int|string $status
     */
    public function redirect(string $url = '', int $status = 200)
    {
        $request = $this->getRequest();

        if (empty($url)) {
            if ($request->get('http.referer')) {
                http_response_code($status);
                header("Location: {$request->get('http.referer')}");
                exit();
            } else {
                $url = BEFREE_URL;
                http_response_code(301);
                header("Location: {$url}");
                exit();
            }
        } else {
            $url = BEFREE_URL . "/{$url}";
            http_response_code($status);
            header("Location: {$url}");
            exit();
        }
    }


    /**
     * genere une route pour une route donnee et redirige vers celle-ci
     * @param string $route
     * @param array $param
     * @param int $status
     * @return mixed
     */
    public function route(string $route, array $param = [], int $status = 200)
    {
        $url = $this->getRouter()->url($route, $param);
        $this->redirect($url, $status);
    }
}
