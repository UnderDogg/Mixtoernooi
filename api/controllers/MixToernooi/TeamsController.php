<?php

namespace MixToernooi;

use Helpers\ApiBaseController;
use Models\Teams;

class TeamsController extends ApiBaseController {
    public function getAction() {
        $teams = Teams::find();

        foreach($teams as $team) {
            $response[] = array(
                'teamNaam' => $team->naam,
                'spelers' => $team->Team_spelers->toArray()
            );
        }

        $this->setPayload($response);

        return $this->render();
    }
}