<?php

declare(strict_types=1);

class MessageRepository extends AbstractRepository
{
    public function getAllMessages()
    {
        $stmt = $this->db->prepare("SELECT * FROM messages");
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
