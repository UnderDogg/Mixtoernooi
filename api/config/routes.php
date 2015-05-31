<?php

// Create the router
$router = new \Phalcon\Mvc\Router(false);

// Add all router files
foreach(glob('routes/*.php') as $file) {
    $controller = explode('/', $file)[1];
    $controller = explode('.', $controller)[0];
    $router->mount( new $controller());
}

//Set 404 paths
$router->notFound(array(
    'namespace'     => 'Helpers',
    'controller'	=> 'not_found',
    'action'		=> 'notFound'
));

return $router;