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

namespace Befree;

/**
 * Class Session
 * @package Befree
 */
class Session
{

    /**
     * Session constructor.
     * strats a session if there isn't one
     */
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_name('befree-session');
            session_start();
        }
    }


    /**
     * sets a value in the current session
     * @param string $name
     * @param $value
     */
    public function set(string $name, $value): void
    {
        $_SESSION[$name] = $value;
    }

    /**
     * retrieve a session value
     * @param string $name
     * @return mixed|null
     */
    public function get(string $name)
    {
        if ($this->has($name)) {
            return $_SESSION[$name];
        }
        return null;
    }


    /**
     * destroy a session value
     * @param string $name
     */
    public function destroy(string $name)
    {
        if ($this->has($name)) {
            unset($_SESSION[$name]);
        }
    }

    /**
     * Whether a offset exists
     * @param string $name
     * @return bool
     */
    public function has(string $name): bool
    {
        return array_key_exists($name, $_SESSION);
    }
}
