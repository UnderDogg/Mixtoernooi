<?php

use Phalcon\Mvc\Controller as Controller;
use Phalcon\Mvc\Model\Query;

class BaseController extends Controller {
	protected $cache;
	
	public function initialize()
    {
		// Cache the files for 2 days using a Data frontend
		$frontCache = new \Phalcon\Cache\Frontend\Data(array(
		    "lifetime" => 3600
		));
		
		// Create the component that will cache "Data" to a "File" backend
		// Set the cache file directory - important to keep the "/" at the end of
		// of the value for the folder
		$this->cache = new \Phalcon\Cache\Backend\File($frontCache, array(
		    "cacheDir" => __DIR__  . "/../cache/"
		));
    }

    protected function save($subject) {
        $response = array();

        if($subject->save() == false) {
            $response['errors'] = $this->getMessages($subject);
        }
        else {
            foreach($subject->toArray() as $key => $value) {
                $response[$key] = $value;
            }

            $response['msg'] = 'ok';
        }

        return $response;
    }

    protected function delete($subject) {
        $response = array();

        if($subject->delete() == false) {
            $response['errors'] = $this->getMessages($subject);
        }
        else {
            $response['msg'] = 'ok';
        }

        return $response;
    }

    protected function assignValues($subject, $obj = null) {
        if(is_null($obj)) {
            // Fill object with Json we got from the request if no obj was given
            $obj = $this->request->getJsonRawBody();
        }

        foreach($obj as $key => $value) {
            if(property_exists($subject, $key)) {
                $subject->$key = $value;
            }
        }

        return $subject;
    }

    private function getMessages($subject) {
        $errors = array();

        foreach($subject->getMessages() as $message) {
            echo $errors[] = (String)$message;
        }

        return $errors;
    }
}
