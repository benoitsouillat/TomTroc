<?php

declare(strict_types=1);

class MessageRepository extends AbstractRepository
{
    public function getAllMyMessages()
    {
        $stmt = $this->db->prepare("SELECT M.id as message_id, U.id as user_id, U.pseudo, U.thumbnail, M.* 
                                    FROM messages M 
                                    LEFT JOIN users U ON U.id = M.user_to 
                                    WHERE M.user_from = :user_from
                                    ORDER BY M.send_date DESC");

        $stmt->bindParam(':user_from', $_SESSION['user']['id']);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function sendMessage(Message $message): void
    {
        $stmt = $this->db->prepare("INSERT INTO messages (send_date, message, user_from, user_to, conversation) VALUES (:send_date, :message, :user_from, :user_to, :conversationID)");
        $stmt->bindValue(':send_date', $message->getDate()->format('Y-m-d H:i:s'));
        $stmt->bindValue(':message', $message->getMessageBody());
        $stmt->bindValue(':user_from', $message->getUserFromID());
        $stmt->bindValue(':user_to', $message->getUserToID());
        $stmt->bindValue(':conversation', $message->getConversationID());
        $stmt->execute();
    }
    public function getMessageByID(int $messageID): stdClass // Est-ce mieux de retourner un Message ou une stdClass ???
    {
        $stmt = $this->db->prepare('SELECT M.* FROM messages M WHERE M.id = :id');
        $stmt->bindValue(':id', $messageID);
        $stmt->execute();
        return $stmt->fetch();
    }
}
