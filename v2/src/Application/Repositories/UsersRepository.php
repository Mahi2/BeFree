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
