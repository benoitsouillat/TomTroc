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
        $stmt = $this->db->prepare("SELECT B.id as book_id, B.* FROM books B WHERE owner = :id");
        $stmt->bindValue(':id', $userID);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function getAllBooksAvailables(): array
    {
        $stmt = $this->db->prepare("SELECT B.id as book_id, U.id as user_id, B.*, U.* FROM books B INNER JOIN users U ON B.owner = U.id WHERE B.available = 1");
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function getBookById(int $id): ?stdClass
    {
        $stmt = $this->db->prepare("SELECT B.id as book_id, U.id as user_id, B.*, U.* FROM books B INNER JOIN users U ON B.owner = U.id WHERE B.id = :id");
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return $stmt->fetch() ?: null;
    }
    public function getOwnerOfBook(int $bookID): int
    {
        $stmt = $this->db->prepare("SELECT owner FROM books WHERE id = :id");
        $stmt->bindParam(':id', $bookID);
        $stmt->execute();
        $value = $stmt->fetch();
        return $value->owner;
    }
    public function getLastFourthbooks(): array
    {
        $stmt = $this->db->prepare("SELECT B.id as book_id, U.id as user_id, B.*, U.* FROM books B INNER JOIN users U ON B.owner = U.id ORDER BY B.id DESC LIMIT 4 ");
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function searchBooks(string $value): ?array
    {
        $value = "%" . htmlspecialchars($value) . "%";
        $stmt = $this->db->prepare("SELECT B.id as book_id, U.id as user_id, B.*, U.* FROM books B INNER JOIN users U ON B.owner = U.id WHERE B.available = 1 AND B.title LIKE :value");
        $stmt->bindParam(':value', $value);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function createBook(array $book, string $picture): void
    {
        $stmt = $this->db->prepare("INSERT INTO books (title, author, description, available, picture, owner) VALUES (:title, :author, :description, :available, :picture, :owner)");
        $stmt->bindValue(':title', $book['title']);
        $stmt->bindValue(':author', $book['author']);
        $stmt->bindValue(':description', $book['comment']);
        $stmt->bindValue(':available', $book['available']);
        $stmt->bindValue(':picture', $picture);
        $stmt->bindValue(':owner', $_SESSION['user']['id']);
        $stmt->execute();
    }
    public function updateBook(array $book): void
    {
        $stmt = $this->db->prepare("UPDATE books SET title = :title, author = :author, description = :description, available = :available, owner = :owner WHERE id = :id");
        $stmt->bindValue(':id', $book['bookId']);
        $stmt->bindValue(':title', $book['title']);
        $stmt->bindValue(':author', $book['author']);
        $stmt->bindValue(':description', $book['comment']);
        $stmt->bindValue(':available', $book['available']);
        $stmt->bindValue(':owner', $_SESSION['user']['id']);
        $stmt->execute();
    }
    public function deleteBook(int $bookID): void
    {
        $stmt = $this->db->prepare("DELETE FROM books WHERE id = :id");
        $stmt->bindValue(':id', $bookID);
        $stmt->execute();
    }
    public function saveThumbnail(string $url): void
    {
        $bookID = $_SESSION['book']['id'];
        $sql = "UPDATE books SET picture = :picture WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $bookID);
        $stmt->bindValue(':picture', $url);
        $stmt->execute();
    }
}
