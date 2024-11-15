<?php

declare(strict_types=1);

class UserRepository extends AbstractRepository
{

    public function getUserById(int $id): stdClass
    {
        $sql = "SELECT * FROM users WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function getUserByEmail(string $email): ?stdClass
    {
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        return $result ? $result : null;
    }

    public function createUser(array $user): void
    {
        $sql = "INSERT INTO users (email, password, pseudo) VALUES (:email, :password, :pseudo)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':email', htmlspecialchars($user['email']));
        $stmt->bindValue(':password', crypt($user['password'], PASSWORD_BCRYPT));
        $stmt->bindValue(':pseudo', htmlspecialchars($user['pseudo']));
        $stmt->execute();
    }
    public function saveThumbnail(array $file): void {}
}
