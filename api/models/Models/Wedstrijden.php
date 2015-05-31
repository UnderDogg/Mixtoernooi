<?php

namespace Models;

class Wedstrijden extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $wedstrijd_id;

    /**
     *
     * @var string
     */
    public $soort;

    /**
     *
     * @var integer
     */
    public $team1;

    /**
     *
     * @var integer
     */
    public $team2;

    /**
     *
     * @var integer
     */
    public $team1_score;

    /**
     *
     * @var integer
     */
    public $team2_score;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->belongsTo('soort', 'Soorten', 'soort', array('alias' => 'Soorten'));
        $this->belongsTo('team1', 'Teams', 'team_id', array('alias' => 'Teams'));
        $this->belongsTo('team2', 'Teams', 'team_id', array('alias' => 'Teams'));
    }

}
