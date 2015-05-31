<?php

namespace Models;

class Permissies extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $permissie_id;

    /**
     *
     * @var string
     */
    public $naam;

    /**
     *
     * @var string
     */
    public $prefix;

    /**
     *
     * @var string
     */
    public $info;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->hasMany('permissie_id', 'Groep_permissies', 'permissie_id', array('alias' => 'Groep_permissies'));
        $this->hasMany('permissie_id', 'Permissie_middelen', 'permissie_id', array('alias' => 'Permissie_middelen'));
    }

}
