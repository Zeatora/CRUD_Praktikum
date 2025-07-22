<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'MahasiswaController::index');
$routes->setAutoRoute(true); 