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

use Befree\Application\Repositories\UsersRepository;

/**
 * Class Auth
 * @package Befree
 */
class Auth
{

    /**
     * the key of the auth in the session
     * @var string
     */
    public const AUTH_KEY = 'sec-username';

    /**
     * @var Session
     */
    private $session;

    /**
     * @var UsersRepository
     */
    private $users;


    /**
     * Auth constructor.
     * @param Session $session
     * @param UsersRepository $users
     */
    public function __construct(Session $session, UsersRepository $users)
    {
        $this->session = $session;
        $this->users = $users;
    }


    /**
     * whether the user is logged
     * @return bool
     */
    public function isLogged(): bool
    {
        return $this->session->has(self::AUTH_KEY);
    }


    /**
     * login a user
     */
    public function login($user): void
    {
        $this->session->set(self::AUTH_KEY, $user);
    }


    /**
     * logout a logged user
     */
    public function logout(): void
    {
        $this->session->destroy(self::AUTH_KEY);
    }
}
