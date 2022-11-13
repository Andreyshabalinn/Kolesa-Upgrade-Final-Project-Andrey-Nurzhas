<?php
require __DIR__ . '/../vendor/autoload.php';
include(__DIR__ .'\..\config\config.php');
use App\Http\Controllers;
use Slim\Factory\AppFactory;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;
//$dbh  = new PDO($dir) or die("cannot open the database");
//$query =  "SELECT * FROM users;";
//foreach ($dbh->query($query) as $row)
//{
//    echo $row[0];
//}
//$dbh = null;

$twig = Twig::create(__DIR__ . '/../templates', ['cache' => false]);
$app  = AppFactory::create();
$app->addErrorMiddleware(true, true, true);
$app->add(TwigMiddleware::create($app, $twig));

$app->get('/', Controllers\MessageController::class . ':home');

$app->run();
