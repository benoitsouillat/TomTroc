<?php

declare(strict_types=1);

class MessageRepository extends AbstractRepository
{
    public function getAllOfConversation(int $conversationID): array
    {
        $stmt = $this->db->prepare("SELECT * FROM messages WHERE conversation = :conversationID");
        $stmt->bindValue('conversationID', $conversationID);
        $stmt->execute();
        $results = $stmt->fetchAll();
        $messages = [];
        foreach ($results as $result)
        {
            $messages[] = $this->stdClassToEntity($result);
        }
        return $messages;
    }

    public function sendMessage(Message $message): int 
    {
        $stmt = $this->db->prepare("INSERT INTO messages (send_date, message, user_from, user_to, conversation) VALUES (:send_date, :message, :user_from, :user_to, :conversation)");
        $stmt->bindValue(':send_date', $message->getDate()->format('Y-m-d H:i:s'));
        $stmt->bindValue(':message', $message->getMessage());
        $stmt->bindValue(':user_from', $message->getUserFromID());
        $stmt->bindValue(':user_to', $message->getUserToID());
        $stmt->bindValue(':conversation', $message->getConversationID());
        $stmt->execute();
        return (int)$this->db->lastInsertId();
    }
    public function getMessageByID(?int $messageID = null): ?Message
    {
        if (!empty($messageID))
        {
            $stmt = $this->db->prepare('SELECT M.* FROM messages M WHERE M.id = :id');
            $stmt->bindValue(':id', $messageID);
            $stmt->execute();
            $result = $stmt->fetch();
            return $this->stdClassToEntity($result);
        }
        return null;
    }

    
    private function stdClassToEntity(stdClass $messageStd): Message
    {
        return (new Message($messageStd->conversation))->setId($messageStd->id)
                        ->setUserFromID($messageStd->user_from)
                        ->setUserToID($messageStd->user_to)
                        ->setMessage(htmlspecialchars_decode($messageStd->message))
                        ->setDate($messageStd->send_date);
    }
}
