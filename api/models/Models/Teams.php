<?php

namespace Models;

class Teams extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $team_id;

    /**
     *
     * @var string
     */
    public $naam;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->hasManytoMany('team_id', 'Models\TeamSpelers', 'team_id', 'speler_id', 'Models\Spelers', 'speler_id', array('alias' => 'Team_spelers'));
        $this->hasMany('team_id', 'Models\Wedstrijden', 'team1', array('alias' => 'Wedstrijden_team1'));
        $this->hasMany('team_id', 'Models\Wedstrijden', 'team2', array('alias' => 'Wedstrijden_team2'));
    }

}
