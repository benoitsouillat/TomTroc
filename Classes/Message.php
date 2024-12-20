<?php

declare(strict_types=1);
class Message
{
    private DateTime $send_date;
    private string $message;
    private int $user_from;
    private int $user_to;
    private ?int $conversationID = null;

    public function __construct(string $message, int $conversationID)
    {
        $this->send_date = new DateTime();
        $this->message = htmlspecialchars($message);
        $this->user_from = (int)$_SESSION['user']['id'];
        $this->conversationID = $conversationID;
    }

    public function getDate(): DateTime
    {
        return $this->send_date;
    }
    public function getMessageBody(): string
    {
        return $this->message;
    }
    public function getUserFromID(): int
    {
        return $this->user_from;
    }

    public function getUserToID(): int
    {
        return $this->user_to;
    }

    public function getConversationID()
    {
        return $this->conversationID;
    }

    public function setConversationID($conversationID)
    {
        $this->conversationID = $conversationID;

        return $this;
    }
}
