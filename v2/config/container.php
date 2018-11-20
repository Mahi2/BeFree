<?php
use Befree\ConfigProvider;
use Befree\Database\DatabaseInterface;
use Befree\Database\MysqlDatabase;
use Befree\Renderer\RendererInterface;
use Befree\Renderer\TwigRenderer;

/**
 * dependencies injector container
 */
return [

    ConfigProvider::class => \DI\object(ConfigProvider::class)->constructor(ROOT."/config.php"),

    /**
     * database configuration
     */
    DatabaseInterface::class => \DI\object(MysqlDatabase::class)->constructor(
        call_user_func_array([ConfigProvider::class, 'get'], ['database.name']),
        call_user_func_array([ConfigProvider::class, 'get'], ['database.host']),
        call_user_func_array([ConfigProvider::class, 'get'], ['database.user']),
        call_user_func_array([ConfigProvider::class, 'get'], ['database.password'])
    ),
    \PDO::class => \DI\factory([MysqlDatabase::class, 'getPDO']),

    /**
     *
     */
    RendererInterface::class => \DI\object(TwigRenderer::class),
];