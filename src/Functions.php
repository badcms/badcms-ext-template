<?php

namespace BadCMS\ExtensionTemplate;

use function BadCMS\Application\app;
use function BadCMS\View\render;

/**
 * Хак для автозагрузки функций после установки плагина
 */
class Functions
{
    const load = 1;
    static $PLUGIN_CONFIG = [];

    public static function init($config)
    {
        return register($config);
    }
}

/**
 * Обязательная функция для регистрации плагина в ядре BadCMS
 */
function register($config)
{
    return Functions::$PLUGIN_CONFIG = $config + [
            "class" => __NAMESPACE__,
            "provides" => provides(),
        ];
}

/**
 * Обязательная функция, сообщает BadCMS какие возможности расширяет, и методы которые это делают
 */
function provides()
{
    return [
        'routes' => function () { return routes(); },
        'menu' => function () { return menu(); },
    ];
}

/**
 * Пример предоставления новых пунктов меню
 */
function menu()
{
    return [
        [
            "label" => "ExtensionTemplate",
            "action" => \BadCMS\Router\route('plugins.ext-template'),
        ],
    ];
}

/**
 * Пример предоставления добавления маршрутов
 */
function routes()
{
    return include "routes.php";
}
