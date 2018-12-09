<?php

namespace Befree\Applications\Repositories;

use Befree\Applications\Entities\UsersEntity;
use Befree\Repository;

/**
 * Class UsersRepository
 * @package Befree\Applications\Repositories
 */
class UsersRepository extends Repository
{

    /**
     * @var string
     */
    protected $table = 'users';


    /**
     * @var UsersEntity
     */
    protected $entity = UsersEntity::class;
}
