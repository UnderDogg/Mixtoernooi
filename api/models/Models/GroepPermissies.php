<?php

namespace Models;

class GroepPermissies extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    public $groep_id;

    /**
     *
     * @var integer
     */
    public $permissie_id;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->belongsTo('groep_id', 'Groepen', 'groep_id', array('alias' => 'Groepen'));
        $this->belongsTo('permissie_id', 'Permissies', 'permissie_id', array('alias' => 'Permissies'));
    }

}
