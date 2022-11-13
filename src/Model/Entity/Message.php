<?php

namespace App\Model\Entity;

class Message
{
    private ?int $id;
    private ?string $message;

    public function __construct($data=[])
    {
        $this->id=$data['id'] ?? null;
        $this->message=$data['text'] ?? null;
    }

    public function getId():?int
    {
        return $this->id;
    }

    public function getMessage():string
    {
        return $this->title ?? '';
    }

    public function toArray():array
    {
        return [
            'id'=>$this->getId(),
            'message'=>$this->getMessage(),
        ];
    }
}