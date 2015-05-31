<?php

namespace Models;

class Soorten extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var string
     */
    public $soort;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->hasMany('soort', 'Wedstrijden', 'soort', array('alias' => 'Wedstrijden'));
    }

}
