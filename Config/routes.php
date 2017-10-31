<?php

Router::connect('/', array('controller' => 'eventos', 'action' => 'index'));
Router::connect('/categorias/actualizar_orden_categorias', array('controller' => 'categorias', 'action' => 'actualizar_orden_categorias'));

Router::connect('/categorias/:slug', array('controller' => 'categorias', 'action' => 'view'), array('pass' => array('slug')) );
Router::connect('/productos/:slug', array('controller' => 'productos', 'action' => 'view'), array('pass' => array('slug')) );

Router::connect('/admin', array('controller' => 'administradores', 'action' => 'index', 'admin' => true));
Router::connect('/admin/login', array('controller' => 'administradores', 'action' => 'login', 'admin' => true));

Router::connect('/seccion/*', array('controller' => 'pages', 'action' => 'display'));

CakePlugin::routes();
require CAKE . 'Config' . DS . 'routes.php';
