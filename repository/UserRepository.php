<?php

declare(strict_types=1);

class UserRepository extends AbstractRepository
{

    public function getUserById(int $id): array
    {
        $sql = "SELECT * FROM users where id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
