<?php
use Befree\ConfigProvider;
use Befree\Database\DatabaseInterface;
use Befree\Database\MysqlDatabase;
use Befree\Renderer\RendererInterface;
use Befree\Renderer\TwigRenderer;
use Befree\Repository;
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
    Repository::class => object(Repository::class)->constructor(DatabaseInterface::class, get('database.prefix')),

    /**
     * Renderer view configuration
     */
    RendererInterface::class => object(TwigRenderer::class),
];