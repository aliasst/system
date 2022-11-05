<?php

use core\Router;


Router::add('^page/(?P<slug>[a-z0-9-]+)/?$', ['controller' => 'Page', 'action' => 'view']);
Router::add('^product/(?P<slug>[a-z0-9-]+)/?$', ['controller' => 'Product', 'action' => 'view']);



Router::add('^(?P<controller>[a-z-]+)/(?P<action>[a-z-]+)/?$');

Router::add('^$', ['controller' => 'Main', 'action' => 'index']);