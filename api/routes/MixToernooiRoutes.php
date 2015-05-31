<?php

use Phalcon\Mvc\Router\Group;

class MixToernooiRoutes extends Group
{
    private $namespace = 'MixToernooi';

    public function initialize()
    {
        //All the routes start with /blog
        $this->setPrefix('/' . strtolower($this->namespace));

        $this->addGet('/teams', array(
            'namespace'		=> $this->namespace,
            'controller'	=> 'teams',
            'action'		=> 'get'
        ));

        $this->addGet('/wedstrijden', array(
            'namespace'		=> $this->namespace,
            'controller'	=> 'wedstrijden',
            'action'		=> 'get'
        ));
    }
}