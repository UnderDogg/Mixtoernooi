<?php

namespace Models;

class PermissieMiddelen extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $permissie_id;

    /**
     *
     * @var integer
     */
    public $middel_id;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->belongsTo('middel_id', 'Middelen', 'middel_id', array('alias' => 'Middelen'));
        $this->belongsTo('permissie_id', 'Permissies', 'permissie_id', array('alias' => 'Permissies'));
    }

}
