<?php
/**
 * Created by PhpStorm.
 * User: wybing
 * Date: 2019/7/24
 * Time: 9:30
 */
namespace think;

// [ 入口文件 ]

// 调试模式开关
define('APP_DEBUG', false);

// 定义CMF根目录,可更改此目录
define('CMF_ROOT', dirname(__DIR__) . '/');

// 定义应用目录
define('APP_PATH', CMF_ROOT . 'app/');

// 定义网站入口目录
define('WEB_ROOT', __DIR__ . '/');

// 加载基础文件
require CMF_ROOT . 'vendor/thinkphp/base.php';

// 执行应用并响应
Container::get('app', [APP_PATH])->run()->send();