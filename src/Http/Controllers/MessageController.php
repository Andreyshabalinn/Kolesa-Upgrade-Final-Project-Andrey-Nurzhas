<?php

namespace App\Http\Controllers;
use App\Model\Repository\MessageRepository;
use Slim\Http\Response;
use Slim\Http\ServerRequest;
use Slim\Views\Twig;
use PDO;

class MessageController
{
    public function viewMessage(ServerRequest $request, Response $response)
    {
        $view = Twig::fromRequest($request);
        print_r("hello");
        return $view->render($response, 'newMessage.twig');
    }

    public function newMessage(ServerRequest $request,Response $response)
    {
        $repo = new MessageRepository();
        $messageData = $request->getParsedBody();
        print_r($messageData);
        $repo->create($messageData);
        print_r($messageData);
        die();
        return $response->withRedirect('/');
    }
}