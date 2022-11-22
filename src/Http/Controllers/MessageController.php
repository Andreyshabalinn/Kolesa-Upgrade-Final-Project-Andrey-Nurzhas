<?php

namespace App\Http\Controllers;
use App\Model\Repository\MessageRepository;
use Slim\Http\Response;
use Slim\Http\ServerRequest;
use Slim\Views\Twig;

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
        $messageData = $request->getParsedBodyParam('message');
        $repo->create($messageData);
        $url = 'http://localhost:8080/';
        $data = $messageData;
        $options = [
            'http' => [
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data)
            ]
        ];
        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        if ($result === FALSE) { /* Handle error */ }

        var_dump($result);
        return $response->withRedirect('/');
    }
}