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
        $stmt->bindValue(':password', password_hash($user['password'], PASSWORD_BCRYPT));
        $stmt->bindValue(':pseudo', htmlspecialchars($user['pseudo']));
        $stmt->execute();
    }

    public function updateUser(array $user): void
    {
        $userData = $this->getUserByEmail($user['email']);
        $userID = $userData->id;
        $sql = "UPDATE users SET email = :email, password = :password, pseudo = :pseudo WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $userID);
        $stmt->bindValue(':email', htmlspecialchars($user['email']));
        $stmt->bindValue(':password', password_hash($user['password'], PASSWORD_BCRYPT));
        $stmt->bindValue(':pseudo', htmlspecialchars($user['pseudo']));
        $stmt->execute();
    }

    public function updateUserInfo(array $user): void
    {
        $userData = $this->getUserByEmail($_SESSION['user']['email']);
        $userID = $userData->id;
        $sql = "UPDATE users SET email = :email, pseudo = :pseudo WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $userID);
        $stmt->bindValue(':email', htmlspecialchars($user['email']));
        $stmt->bindValue(':pseudo', htmlspecialchars($user['pseudo']));
        $stmt->execute();
    }

    public function checkEmailUserInfo(string $email): bool
    {
        $dbUserByEmail = $this->getUserByEmail($email);
        if (isset($dbUserByEmail) && $dbUserByEmail->id != $_SESSION['user']['id']) {
            return false;
        }
        return true;
    }

    public function saveThumbnail(string $url): void
    {
        $userData = $this->getUserByEmail($_SESSION['user']['email']);
        $userID = $userData->id;
        $sql = "UPDATE users SET thumbnail = :thumbnail WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $userID);
        $stmt->bindValue(':thumbnail', $url);
        $stmt->execute();
    }
}
