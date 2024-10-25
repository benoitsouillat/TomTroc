<?php

declare(strict_types=1);

class BookRepository extends AbstractRepository
{

    public function getAllBooks(): array
    {
        $stmt = $this->db->prepare("SELECT * FROM books");
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function getAllBooksOfUser(int $userID): array
    {
        $stmt = $this->db->prepare("SELECT * FROM books B WHERE owner = :id");
        $stmt->bindValue(':id', $userID);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function getAllBooksAvailables(): array
    {
        $stmt = $this->db->prepare("SELECT * FROM books B INNER JOIN users U ON B.owner = U.id WHERE B.available = 1");
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function getBookById(int $id): stdClass
    {
        $stmt = $this->db->prepare("SELECT * FROM books B INNER JOIN users U ON B.owner = U.id WHERE B.id = :id");
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
    }
    public function getLastFourthbooks(): array
    {
        $stmt = $this->db->prepare("SELECT * FROM books B INNER JOIN users U ON B.owner = U.id ORDER BY B.id DESC LIMIT 4 ");
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
