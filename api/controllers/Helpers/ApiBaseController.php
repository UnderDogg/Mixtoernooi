<?php

namespace Helpers;

use \Phalcon\Http\Response as PhResponse;

class ApiBaseController extends \BaseController
{
    private $statusCode = 200;
   	private $headers    = array();
    private $payload    = '';
    private $format     = 'json';

    /**
     * Setters
     */
    protected function setStatusCode($code) {
        $this->statusCode = $code;
    }

    protected function setHeaders($key, $value) {
        $this->headers[$key] = $value;
    }

    protected function setPayload($payload) {
        $this->payload = $payload;
    }

    protected function setFormat($format) {
        $this->format = $format;
    }
	
	protected function render() {
        switch ($this->format)
        {
            case 'json':
                $contentType = 'application/json';
                $content     = json_encode($this->payload);
            break;
            
            default:
                $contentType = 'text/plain';
                $content     = $this->payload;
            break;
        }

        $response = new PhResponse();

        $response->setStatusCode($this->statusCode, $this->getResponseDescription($this->statusCode));
        $response->setContentType($contentType, 'UTF-8');
        $response->setHeader('Access-Control-Allow-Origin', '*');
        $response->setHeader('Access-Control-Allow-Headers', 'X-Requested-With');
        $response->setContent($content);

        // Set the additional headers
        foreach ($this->headers as $key => $value) {
            $response->setHeader($key, $value);
        }

        $this->view->disable();

        return $response;
    }

    protected function sendError($code) {
        $this->statusCode = $code;
        $this->payload = array('error' => $this->getResponseDescription($code));

        return $this->render();
    }

	protected function getResponseDescription($code) {
        $codes = array(

            // Informational 1xx
            100 => 'Continue',
            101 => 'Switching Protocols',

            // Success 2xx
            200 => 'OK',
            201 => 'Created',
            202 => 'Accepted',
            203 => 'Non-Authoritative Information',
            204 => 'No Content',
            205 => 'Reset Content',
            206 => 'Partial Content',

            // Redirection 3xx
            300 => 'Multiple Choices',
            301 => 'Moved Permanently',
            302 => 'Found',  // 1.1
            303 => 'See Other',
            304 => 'Not Modified',
            305 => 'Use Proxy',
            // 306 is deprecated but reserved
            307 => 'Temporary Redirect',

            // Client Error 4xx
            400 => 'Bad Request',
            401 => 'Unauthorized',
            402 => 'Payment Required',
            403 => 'Forbidden',
            404 => 'Not Found',
            405 => 'Method Not Allowed',
            406 => 'Not Acceptable',
            407 => 'Proxy Authentication Required',
            408 => 'Request Timeout',
            409 => 'Conflict',
            410 => 'Gone',
            411 => 'Length Required',
            412 => 'Precondition Failed',
            413 => 'Request Entity Too Large',
            414 => 'Request-URI Too Long',
            415 => 'Unsupported Media Type',
            416 => 'Requested Range Not Satisfiable',
            417 => 'Expectation Failed',

            // Server Error 5xx
            500 => 'Internal Server Error',
            501 => 'Not Implemented',
            502 => 'Bad Gateway',
            503 => 'Service Unavailable',
            504 => 'Gateway Timeout',
            505 => 'HTTP Version Not Supported',
            509 => 'Bandwidth Limit Exceeded'
        );

        $result = (isset($codes[$code])) ? $codes[$code] : 'Unknown Status Code';

        return $result;
    }
}
