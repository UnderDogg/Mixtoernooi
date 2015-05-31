<?php

error_reporting(E_ALL);

try {

    /**
     * Read the configuration
     */
    $config = include __DIR__ . "/config/config.php";

    /**
     * Read auto-loader
     */
    include __DIR__ . "/config/loader.php";

	/**
	 * Read the routes
	 */
	$routes = include __DIR__ . "/config/routes.php";

    /**
     * Read services
     */
    include __DIR__ . "/config/services.php";

    /**
     * Handle the request
     */
    $application = new \Phalcon\Mvc\Application($di);

    echo $application->handle()->getContent();

} catch (\Exception $e) {
    echo $e->getMessage();
}
