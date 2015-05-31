<?php

namespace Models;

class Groepen extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $groep_id;

    /**
     *
     * @var string
     */
    public $naam;

    /**
     *
     * @var integer
     */
    public $type;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->hasMany('groep_id', 'Gebruikers', 'groep_id', array('alias' => 'Gebruikers'));
        $this->hasMany('groep_id', 'Groep_permissies', 'groep_id', array('alias' => 'Groep_permissies'));
    }

}
