<?php

namespace Models;

class TeamSpelers extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $speler_id;

    /**
     *
     * @var integer
     */
    public $team_id;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->belongsTo('speler_id', 'Spelers', 'speler_id', array('alias' => 'Spelers'));
        $this->belongsTo('team_id', 'Teams', 'team_id', array('alias' => 'Teams'));
    }

}
