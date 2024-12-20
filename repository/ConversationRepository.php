<?php

declare(strict_types=1);

class ConversationRepository extends AbstractRepository
{

    public function getConversationByID(int $conversationID): stdClass
    {
        $stmt = $this->db->prepare("SELECT C.* FROM conversations C WHERE C.id = :id");
        $stmt->bindParam(':id', $conversationID);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function getAllConversationsFromUser(int $userID): array
    {

        $stmt = $this->db->prepare("SELECT C.* FROM conversations C WHERE C.user_from = :userID OR C.user_to = :userID");
        $stmt->bindParam(':userID', $userID);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
