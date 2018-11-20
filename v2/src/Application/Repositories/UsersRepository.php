<?php

namespace Befree\Repositories;


use Befree\Entities\UsersEntity;
use Befree\Repository;

/**
 * Class UsersRepository
 * @package Befree\Repositories
 */
class UsersRepository extends Repository
{

    /**
     * @var string
     */
    protected  $table = 'users';


    /**
     * @var UsersEntity
     */
    protected  $entity = UsersEntity::class;
}