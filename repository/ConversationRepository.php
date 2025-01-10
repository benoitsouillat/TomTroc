<?php

declare(strict_types=1);

class ConversationRepository extends AbstractRepository
{

    public function getByID(int $conversationID): Conversation
    {
        $stmt = $this->db->prepare("SELECT C.* FROM conversations C WHERE C.id = :id");
        $stmt->bindParam(':id', $conversationID);
        $stmt->execute();
        $result = $stmt->fetch();
        return $this->stdClassToEntity($result);

    }
    public function getAllFromUser(int $userID): array
    {
        $stmt = $this->db->prepare("SELECT C.* FROM conversations C WHERE C.user_from = :userID OR C.user_to = :userID");
        $stmt->bindParam(':userID', $userID);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $conversations = [];
        foreach($result as $value)
        {
            $conversations[] = $this->stdClassToEntity($value);
        }
        return $conversations;
    }
    public function getFromUsers(int $userTo, int $userFrom)
    {
        $stmt = $this->db->prepare("SELECT C.* FROM conversations C WHERE (C.user_to = :userTo AND C.user_from = :userFrom) OR (C.user_to = :userFrom AND C.user_from = :userTo)");
        $stmt->bindParam(':userTo', $userTo);
        $stmt->bindParam(':userFrom', $userFrom);
        $stmt->execute();
        $result = $stmt->fetch();
        return $this->stdClassToEntity($result);

    }

    public function create(Conversation $conversation): static
    {
        $stmt = $this->db->prepare("INSERT INTO conversations (user_from, user_to, last_message) VALUES (:user_from, :user_to, :last_message)");
        $stmt->bindValue(':user_from', $conversation->getUserFrom());
        $stmt->bindValue(':user_to', $conversation->getUserTo());
        $stmt->bindValue(':last_message', $conversation->getLastMessage());
        $stmt->execute();
        return $this;
    }

    public function updateLastMessage(int $conversationID, int $lastMessageID): void
    {
        $stmt = $this->db->prepare("UPDATE conversations SET last_message = :last_message WHERE id = :conversationID");
        $stmt->bindValue('last_message', $lastMessageID);
        $stmt->bindValue('conversationID', $conversationID);
        $stmt->execute();
    }


    private function stdClassToEntity(stdClass $conversationStd): Conversation
    {
        return (new Conversation())->setId($conversationStd->id)
                        ->setUserFrom($conversationStd->user_from)
                        ->setUserTo($conversationStd->user_to)
                        ->setLastMessage($conversationStd->last_message);
    }
}
