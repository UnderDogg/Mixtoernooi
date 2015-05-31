<?php

$loader = new \Phalcon\Loader();

/**
 * We're a registering a set of directories taken from the configuration file
 */
$loader->registerDirs(
    array(
        $config->application->controllersDir,
        $config->application->modelsDir,
        $config->application->routesDir,
        $config->application->pluginsDir
    )
);

$loader->registerNamespaces(
    array(
        'Helpers'    => "../app/controllers/Helpers"
    )
);

$loader->register();
