<?php

namespace Helpers;

class NotFoundController extends ApiBaseController {
	public function notFoundAction() {
		$this->setStatusCode(404);
		$this->setPayLoad(array('error' => '404'));
		$this->setFormat('json');
		return $this->render();
	}

    public function notAllowedAction() {
        $this->setStatusCode(401);
        $this->setPayLoad(array('error' => '401'));
        $this->setFormat('json');
        return $this->render();
    }
}