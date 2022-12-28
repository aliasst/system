<?php

use core\Router;


Router::add('^page/(?P<slug>[a-z0-9-]+)/?$', ['controller' => 'Page', 'action' => 'view']);
Router::add('^product/(?P<slug>[a-z0-9-]+)/?$', ['controller' => 'Product', 'action' => 'view']);

Router::add('^category/add/?$', ['controller' => 'Category', 'action' => 'add']);
Router::add('^category/delete/(?P<id>[0-9]+)/?$', ['controller' => 'Category', 'action' => 'delete']);
Router::add('^category$', ['controller' => 'Category', 'action' => 'index']);

Router::add('^addexpenses/(?P<id>[0-9]+)/?$', ['controller' => 'Entity', 'action' => 'addexpenses']);
Router::add('^viewexpenses/(?P<id>[0-9]+)/?$', ['controller' => 'Entity', 'action' => 'viewexpenses']);
Router::add('^deleteexpenses/(?P<id>[0-9]+)/?$', ['controller' => 'Entity', 'action' => 'deleteexpenses']);
Router::add('^entity/delete/(?P<id>[0-9]+)/?$', ['controller' => 'Entity', 'action' => 'delete']);
Router::add('^legal-entities$', ['controller' => 'Entity', 'action' => 'legalView']);
Router::add('^physical-entities$', ['controller' => 'Entity', 'action' => 'physicalView']);

Router::add('^(?P<controller>[a-z-]+)/(?P<action>[a-z-]+)/?$');

Router::add('^$', ['controller' => 'Main', 'action' => 'index']);