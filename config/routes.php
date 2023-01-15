<?php

use core\Router;


Router::add('^page/(?P<slug>[a-z0-9-]+)/?$', ['controller' => 'Page', 'action' => 'view']);
Router::add('^product/(?P<slug>[a-z0-9-]+)/?$', ['controller' => 'Product', 'action' => 'view']);

Router::add('^user/edit/(?P<id>[0-9]+)/?$', ['controller' => 'User', 'action' => 'edit']);
Router::add('^user/delete/(?P<id>[0-9]+)/?$', ['controller' => 'User', 'action' => 'delete']);
Router::add('^users$', ['controller' => 'User', 'action' => 'index']);

Router::add('^currency/add/?$', ['controller' => 'Currency', 'action' => 'add']);
Router::add('^currency/delete/(?P<id>[0-9]+)/?$', ['controller' => 'Currency', 'action' => 'delete']);
Router::add('^currency$', ['controller' => 'Currency', 'action' => 'index']);

Router::add('^category/add/?$', ['controller' => 'Category', 'action' => 'add']);
Router::add('^category/delete/(?P<id>[0-9]+)/?$', ['controller' => 'Category', 'action' => 'delete']);
Router::add('^category$', ['controller' => 'Category', 'action' => 'index']);

Router::add('^pdfweek', ['controller' => 'Entity', 'action' => 'pdfweek']);
Router::add('^pdf$', ['controller' => 'Entity', 'action' => 'pdf']);
Router::add('^addexpenses/(?P<id>[0-9]+)/?$', ['controller' => 'Entity', 'action' => 'addexpenses']);
Router::add('^viewexpenses/(?P<id>[0-9]+)/?$', ['controller' => 'Entity', 'action' => 'viewexpenses']);
Router::add('^deleteexpenses/(?P<id>[0-9]+)/?$', ['controller' => 'Entity', 'action' => 'deleteexpenses']);
Router::add('^entity/delete/(?P<id>[0-9]+)/?$', ['controller' => 'Entity', 'action' => 'delete']);
Router::add('^legal-entities$', ['controller' => 'Entity', 'action' => 'legalView']);
Router::add('^physical-entities$', ['controller' => 'Entity', 'action' => 'physicalView']);

Router::add('^(?P<controller>[a-z-]+)/(?P<action>[a-z-]+)/?$');

Router::add('^$', ['controller' => 'Main', 'action' => 'index']);