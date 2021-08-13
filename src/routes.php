<?php

use BadCMS\ExtensionTemplate\Functions;

// Используем функцию отрисовки шаблона
use function \BadCMS\View\render;

/**
 * Пример описанияы маршрута:
 *       `/plugins/ext-template` - uri для маршрута и его имя
 *       Для маршрута будет задан псевдоним 'plugins.ext-template'
 *       для обращения к нему в коде `route('plugins.ext-template')`
 * 
 *       Значение - анонимная функция которая вызывается для обработки действия
 *       при обращении к uri `/plugins/ext-template`.
 * 
 *       Результат функции будет отрисован в теле страницы, в шаблоне `content`
 * 
 *       '/plugins/ext-template' => function ($request) {
 *          return render("content", ["content" => $html]);
 *      },
 *
 * Альтернативный вариант описания маршрута:
 * [
 *      'route.name' => [
 *            'action' => function(array $request){ 
 *                // some code
 *            },
 *            'name' => 'route.name',
 *            'uri' => '/path/to/route',
 *      ]
 * ]
 * 
 * 
 * Альтернативный вариант добавления маршрута, в рантайме:
 *
 * \BadCMS\Router\addRoute('route.name', function (array $request) {
 *     //TODO: add your code
 *     return 'OK";
 * });
 * 
 */

return
    [
        '/plugins/ext-template' => function ($request) {
            // Первым аргументом всегда приходит $request

            // Отрисовываем в контейнер $html
            $html =
                render(
                    // Указываем шаблон
                    __DIR__."/../resources/views/about.php",
                    // Передаем параметры для view
                    ['title' => 'About ExtensionTemplate', 'config' => Functions::$PLUGIN_CONFIG]
                );

            // выводим всё в основной шаблон, который лежит в приложении в /views/content.php
            // у плагина могут быть свои шаблоны в директории plugin_root/resources/views
            return render("content", ["content" => $html]);
        },
    ];
