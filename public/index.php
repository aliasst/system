<?php
require_once dirname(__DIR__) .'/config/init.php';
require_once HELPERS .'/functions.php';
require_once CONFIG .'/routes.php';

new \core\App();



$db = \core\Db::getInstance();

/*$articles = $db->query('SELECT * FROM `user`;');
debug($articles);


$result = $db->query(
    'SELECT * FROM `user` WHERE id = :id;',
    [':id' => 1]
);
var_dump($result);
*/