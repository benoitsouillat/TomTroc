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
    public function getLastFourthbooks(): array
    {
        $stmt = $this->db->prepare("SELECT * FROM books ORDER BY id DESC LIMIT 4");
        $stmt->execute();
        return $stmt->fetchAll();
    }
}
