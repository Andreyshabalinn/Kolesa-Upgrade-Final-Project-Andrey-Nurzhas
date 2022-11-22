<?php

namespace App\Model\Repository;

use App\Model\Entity\Message;
use App\Repository\Database\Database;
use PDO;
class MessageRepository
{

    private \PDO $connection;


    public function __construct()
    {
        $this->connection =  Database::getConnection()->getPdo();
    }

    public function create(array $messageData): Message
    {
        $stat = $this->connection->prepare('INSERT INTO messages(message) VALUES (:message)');
        $stat->bindParam('message',$messageData['text']);
        $stat->execute();

        return new Message($messageData);
    }
//    public function getDB(): array
//    {
//        $stmt = $this->query('SELECT * FROM messages');
//        $result = $stmt->fetchall();
//        return $result;
//    }
//
//    public function saveDB([] $data, $increment): void
//    {
//        $stmt = $this->prepare('insert into messages (message) values (?)');
//        $stmt->execute([$data[$increment]['text']]);
//    }
}

