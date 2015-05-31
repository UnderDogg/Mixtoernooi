<?php

namespace Models;

class Middelen extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $middel_id;

    /**
     *
     * @var string
     */
    public $namespace;

    /**
     *
     * @var string
     */
    public $controller;

    /**
     *
     * @var string
     */
    public $action;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->hasMany('middel_id', 'Permissie_middelen', 'middel_id', array('alias' => 'Permissie_middelen'));
    }

}
