<?php

namespace Models;

class Gebruikers extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $gebruiker_id;

    /**
     *
     * @var string
     */
    public $gebruikersnaam;

    /**
     *
     * @var string
     */
    public $wachtwoord;

    /**
     *
     * @var integer
     */
    public $groep_id;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->belongsTo('groep_id', 'Groepen', 'groep_id', array('alias' => 'Groepen'));
    }

}
