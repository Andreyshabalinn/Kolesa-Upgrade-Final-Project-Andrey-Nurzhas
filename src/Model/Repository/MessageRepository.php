<?php

namespace App\Model\Repository;
use App\Model\Entity\Message;
use \PDO;
//include(__DIR__ .'\..\config\config.php');
class MessageRepository extends PDO
{
    public function __construct()
    {
        $host = 'localhost';
        $db = 'Services';
        $user = 'root';
        $pass = '2001';
        $charset = 'utf8';
        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $opt = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
        parent::__construct($dsn,$user,$pass, $opt);
        return new PDO($dsn, $user, $pass, $opt);;
    }

    public function create(array $messageData): Message
    {
        $db = $this->getDB();
        $increment = array_key_last($db) + 1;
        $messageData['id'] = $increment;
        $db[$increment] = $messageData;
        $this->saveDB($db, $increment);

        return new Message($messageData);
    }
    public function getDB(): array
    {
        $stmt = $this->query('SELECT * FROM messages');
        $result = $stmt->fetchall();
        return $result;
    }

    public function saveDB(array $data, $increment): void
    {
        $stmt = $this->prepare('insert into messages (message) values (?)');
        $stmt->execute(array($data[$increment]['text']));
    }
}

