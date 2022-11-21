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
        $messageData = $request->getParsedBodyParam('message');
        $repo->create($messageData);
        $url = 'http://localhost:8080/message';
        $arr = array('message' =>$messageData['text']);
        $msgJson = json_encode($arr);
        $options = array(
            'http' => array(
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => $msgJson,
            )
        );
        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        if ($result === FALSE) { /* Handle error */ }

        var_dump($result);
        return $response->withRedirect('/');
    }
}