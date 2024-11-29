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
        $stmt = $this->db->prepare("SELECT B.id as book_id, U.id as user_id, B.*, U.* FROM books B INNER JOIN users U ON B.owner = U.id WHERE B.id = :id");
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
    public function createBook(array $book): void
    {
        $stmt = $this->db->prepare("INSERT INTO books (title, author, description, available, picture, owner) VALUES (:title, :author, :description, :available, :picture, :owner)");
        $stmt->bindValue(':title', $book['title']);
        $stmt->bindValue(':author', $book['author']);
        $stmt->bindValue(':description', $book['comment']);
        $stmt->bindValue(':available', $book['available']);
        $stmt->bindValue(':picture', ''); // Récupérer le path de l'image
        $stmt->bindValue(':owner', $_SESSION['user']['id']);
        $stmt->execute();
    }
    public function updateBook(array $book): void
    {
        $stmt = $this->db->prepare("UPDATE books SET title = :title, author = :author, description = :description, available = :available, picture = :picture, owner = :owner WHERE id = :id");
        $stmt->bindValue(':id', $book['bookId']);
        $stmt->bindValue(':title', $book['title']);
        $stmt->bindValue(':author', $book['author']);
        $stmt->bindValue(':description', $book['comment']);
        $stmt->bindValue(':available', $book['available']);
        $stmt->bindValue(':picture', ''); // Récupérer le path de l'image
        $stmt->bindValue(':owner', $_SESSION['user']['id']);
        $stmt->execute();
    }
}
