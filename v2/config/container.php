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

use Befree\ConfigProvider;
use Befree\Database\DatabaseInterface;
use Befree\Database\MysqlDatabase;
use Befree\Renderer\RendererInterface;
use Befree\Renderer\TwigRenderer;
use Befree\Repository;
use Befree\Services\ErrorHandlerService;
use function DI\factory;
use function DI\get;
use function DI\object;

$config = new ConfigProvider(ROOT."/config.php");

/**
 * dependencies injector container
 */
return [
    /**
     * database configuration
     */
    'database.prefix' =>  $config->get('database.prefix'),
    'database.name' => $config->get('database.name'),
    'database.host' => $config->get('database.host'),
    'database.user' => $config->get('database.user'),
    'database.password' => $config->get('database.password'),
    
    DatabaseInterface::class => object(MysqlDatabase::class)->constructor(
        get('database.name'),
        get('database.host'),
        get('database.user'),
        get('database.password')
    ),
    \PDO::class => factory([MysqlDatabase::class, 'getPDO']),
    Repository::class => object(Repository::class)->constructor(DatabaseInterface::class),

    /**
     * Renderer view configuration and other configuration
     */
    RendererInterface::class => object(TwigRenderer::class),
    ErrorHandlerService::class => object(ErrorHandlerService::class)->constructor(LOGFILES_PATH),
];
