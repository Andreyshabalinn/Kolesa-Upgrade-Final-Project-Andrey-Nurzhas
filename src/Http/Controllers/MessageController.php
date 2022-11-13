<?php

namespace App\Http\Controllers;

use Slim\Http\Response;
use Slim\Http\ServerRequest;
use Slim\Views\Twig;

class MessageController
{
    public function viewMessage(ServerRequest $request, Response $response)
    {
        $view = Twig::fromRequest($request);
        return $view->render($response, 'newMessage.twig');
    }

    //public function newMessage()
}