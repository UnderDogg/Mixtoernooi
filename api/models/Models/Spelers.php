<?php

namespace Models;

class Spelers extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $speler_id;

    /**
     *
     * @var string
     */
    public $naam;

    /**
     *
     * @var string
     */
    public $tussenvoegsel;

    /**
     *
     * @var string
     */
    public $achternaam;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->hasMany('speler_id', 'Team_spelers', 'speler_id', array('alias' => 'Team_spelers'));
    }

}
