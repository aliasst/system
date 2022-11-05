<?php
define("DEBUG", 1);
define("ROOT", dirname(__DIR__));
define("WWW", ROOT . '/public');
define("APP", ROOT . '/app');
define("CORE", ROOT . '/core');
define("HELPERS", ROOT . '/core/helpers');
define("CACHE", ROOT . '/tmp/cache');
define("LOGS", ROOT . '/tmp/logs');
define("CONFIG", ROOT . '/config');
define("LAYOUT", 'system');
define("PATH", 'http://system.ru');
define("NO_IMAGE", '/public/uploads/no_image.jpg');


require_once ROOT . '/vendor/autoload.php';
