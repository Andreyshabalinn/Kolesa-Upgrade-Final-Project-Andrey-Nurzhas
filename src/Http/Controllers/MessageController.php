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
        return $view->render($response, 'newMessage.twig');
    }

    public function newMessage(ServerRequest $request,Response $response)
    {
        $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__);
        $dotenv->load();

        $dbhost = $_ENV['DBHOST'];
        $dbname = $_ENV['DBNAME'];
        $dbuser = $_ENV['DBUSER'];
        $dbpassword = $_ENV['DBPASSWORD'];

        $dsn = sprintf('mysql:host=%s;dbname=%s',$dbhost,$dbname);
        $connection = new \PDO($dsn,$dbuser,$dbpassword);


        $repo = new MessageRepository($connection);
        $messageData = $request->getParsedBodyParam('message');
        $repo->create($messageData);
        $url = $_ENV['URL'];
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
        return $response->withRedirect('/message');
    }
}
