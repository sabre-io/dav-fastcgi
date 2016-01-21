<?php

namespace Sabre\DAV\FastCGI;

use Sabre\HTTP\RequestInterface;
use Sabre\HTTP\ResponseInterface;

/**
 * A Sapi that ensures nothing actually gets sent back automatically.
 *
 * @copyright Copyright (C) fruux GmbH (https://fruux.com/)
 * @author Evert Pot (http://evertpot.com/)
 * @license http://sabre.io/license/
 */
class Sapi extends \Sabre\HTTP\Sapi {

    static private $request;
    static private $response;

    static function setRequest(RequestInterface $request) {

        self::$request = $request;

    }

    static function getRequest() {

        return self::$request; 

    }
    
    static function sendResponse(ResponseInterface $response) {

        self::$response = $response;

    }

    static function getResponse() {

        return self::$response; 

    }

}
