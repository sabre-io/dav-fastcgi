<?php

namespace Sabre\DAV\FastCGI;

use PHPFastCGI\FastCGIDaemon\ApplicationFactory;
use PHPFastCGI\FastCGIDaemon\Http\RequestInterface;
use Zend\Diactoros\Response as ZendResponse;
use Zend\Diactoros\Response\HtmlResponse;

/**
 * The sabre/dav FastCGI daemon
 *
 * @copyright Copyright (C) fruux GmbH (https://fruux.com/)
 * @author Evert Pot (http://evertpot.com/)
 * @license http://sabre.io/license/
 */
class Daemon {

    protected $server;

    function __construct(\Sabre\DAV\Server $server) {

        $this->server = $server;
        $this->server->sapi = new Sapi();

    }

    function start() {

        $application = (new ApplicationFactory)->createApplication([$this, 'handleRequest']);
        $application->run();

    }

    function handleRequest(RequestInterface $request) {

        $sabreRequest = \Sabre\HTTP\Sapi::createFromServerArray($request->getParams());

        $sabreRequest->setBody(
            $request->getStdin()
        );

        if ($sabreRequest->getMethod()==='POST' && $sabreRequest->getHeader('Content-Type')==='application/x-www-form-urlencoded') {
            parse_str($sabreRequest->getBodyAsString(), $postData); 
            $sabreRequest->setPostData($postData); 
        }

        $sabreResponse = new \Sabre\HTTP\Response();
        $this->server->httpRequest = $sabreRequest;
        $this->server->httpResponse = $sabreResponse;
        $this->server->exec();

        $body = $sabreResponse->getBody();
        if (is_scalar($body) || is_null($body)) {
            $newBody = fopen('php://memory','r+');
            fwrite($newBody, (string)$body);
            rewind($newBody);
            $body = $newBody;
        } 

        // Turning sabre into psr-7 response.
        $psr7Response = new ZendResponse(
            $body,
            $sabreResponse->getStatus(),
            $sabreResponse->getHeaders()
        );

        return $psr7Response;

    }

}

