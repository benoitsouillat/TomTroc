<?php

declare(strict_types=1);

class Conversation
{

    private ?int $id = null;
    private int $userFrom;
    private ?int $userTo = null;
    private ?int $lastMessage = null;

    public function __construct(?int $partnerID = null)
    {
        $this->userFrom = (int)$_SESSION['user']['id'];
        $this->userTo = $partnerID;
    }

    public function getId(): int 
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;
        return $this;
    }

    public function getUserFrom(): int
    {
        return $this->userFrom;
    }

    public function setUserFrom($userFrom): static
    {
        $this->userFrom = $userFrom;
        return $this;
    }

    public function getUserTo(): int
    {
        return $this->userTo;
    }

    public function setUserTo($userTo): static
    {
        $this->userTo = $userTo;
        return $this;
    }

    public function getLastMessage(): ?int
    {
        return $this->lastMessage;
    }
    public function setLastMessage($lastMessage): static
    {
        $this->lastMessage = $lastMessage;
        return $this;
    }
}
