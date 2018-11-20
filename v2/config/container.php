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

/**
 * dependencies injector container
 */
return [

    ConfigProvider::class => object(ConfigProvider::class)->constructor(ROOT."/config.php"),


    /**
     * database configuration
     */
    'database.prefix' => call_user_func_array([ConfigProvider::class, 'get'], ['database.prefix']),
    DatabaseInterface::class => object(MysqlDatabase::class)->constructor(
        call_user_func_array([ConfigProvider::class, 'get'], ['database.name']),
        call_user_func_array([ConfigProvider::class, 'get'], ['database.host']),
        call_user_func_array([ConfigProvider::class, 'get'], ['database.user']),
        call_user_func_array([ConfigProvider::class, 'get'], ['database.password'])
    ),
    \PDO::class => factory([MysqlDatabase::class, 'getPDO']),
    Repository::class => object(Repository::class)->constructor(DatabaseInterface::class, get('database.prefix')),

    /**
     * Renderer view configuration
     */
    RendererInterface::class => object(TwigRenderer::class),
];