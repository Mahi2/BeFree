<?php

namespace Befree;

use Befree\Repositories\UsersRepository;

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