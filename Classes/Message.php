<?php

declare(strict_types=1);
class Message
{
    private ?int $id = null;
    private ?DateTime $sendDate = null;
    private ?string $message = null;
    private ?int $userFrom = null;
    private ?int $userTo = null;
    private ?int $conversationID = null;

    public function __construct(int $conversationID)
    {
        $this->sendDate = new DateTime();
        $this->userFrom = (int)$_SESSION['user']['id'];
        $this->conversationID = $conversationID;
    }
    public function getId(): int
    {
        return $this->id;
    }
    public function setId($id): static
    {
        $this->id = $id;
        return $this;
    }
    public function getDate(): DateTime
    {
        return $this->sendDate;
    }
    public function setDate(string $date): static
    {
        $this->sendDate = new DateTime($date);
        return $this;
    }
    public function getUserFromID(): int
    {
        return $this->userFrom;
    }
    public function setUserFromID(int $userFrom): static
    {
        $this->userFrom = $userFrom;
        return $this;
    }
    public function getUserToID(): ?int
    {
        return $this->userTo;
    }
    public function setUserToID(int $userTo): static
    {
        $this->userTo = $userTo;
        return $this;
    }
    public function getConversationID(): int
    {
        return $this->conversationID;
    }
    public function setConversationID(int $conversationID): static
    {
        $this->conversationID = $conversationID;
        return $this;
    }
    public function getMessage(): string
    {
        return $this->message;
    }
    public function setMessage(string $message): static
    {
        $this->message = htmlspecialchars($message);
        return $this;
    }
}
