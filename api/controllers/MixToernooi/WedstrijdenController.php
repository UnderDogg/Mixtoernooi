<?php

namespace MixToernooi;

use Helpers\ApiBaseController;
use Models\Wedstrijden;

class WedstrijdenController extends ApiBaseController{
    public function getAction() {
        $wedstrijden = Wedstrijden::find();

        $response = array();

        foreach($wedstrijden as $wedstrijd) {
            $tmp = $wedstrijd->toArray();
            $tmp['team1_name'] = $wedstrijd->Team1->naam;
            $tmp['team2_name'] = $wedstrijd->Team2->naam;

            $response[] = $tmp;
        }

        $this->setPayload($response);

        return $this->render();
    }
}