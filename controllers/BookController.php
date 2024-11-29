<?php

declare(strict_types=1);

class BookController
{
    public function showHome(): void
    {
        $bookRepository = new BookRepository();
        $books = $bookRepository->getLastFourthbooks();
        foreach ($books as &$book) {
            $book->seller = ucfirst($book->pseudo);
        }
        $view = new View("Accueil");
        $view->render("home", ['books' => $books]);
    }
    public function showBooks(): void
    {
        $bookRepository = new BookRepository();
        $books = $bookRepository->getAllBooksAvailables();
        foreach ($books as &$book) {
            $book->seller =  sprintf("%s", ucfirst($book->pseudo));
        }
        $view = new View("Nos livres à l'échange");
        $view->render("book/list", ['books' => $books]);
    }
    public function showBook(int $bookId): void
    {

        $bookRepository = new BookRepository();
        $book = $bookRepository->getBookById($bookId);
        /* Si Book n'existe pas => Redirection avec Erreur */
        $view = new View("Livre seul");
        $view->render("book/show", ['book' => $book]);
    }
    public function editBook(?int $bookId = null): void
    {
        $bookRepository = new BookRepository();
        if (empty($_SESSION['user'])) {
            $_SESSION['connection']['errors'] = "Vous devez être connecté pour accéder à cette page";
            header('Location: index.php?action=login');
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errors = [];
            if (!empty($errors)) {
                $_SESSION['editbook']['errors'] = $errors;
            } else {
                try {
                    if (isset($bookId)) {
                        $bookRepository->updateBook($_POST);
                        $_SESSION['editbook']['message'] = "<div class='message success-message'>Votre livre a bien été mis à jour.</div>";
                    } else {
                        $bookRepository->createBook($_POST);
                        $_SESSION['editbook']['message'] = "<div class='message success-message'>Votre livre a bien été ajouté.</div>";
                    }
                    header("Location: index.php?action=account");
                } catch (Exception $e) {
                    var_dump($e);
                    die();
                }
            }
        }
        $view = new View("Edition d'un livre");
        if (!empty($bookId)) {
            $book = $bookRepository->getBookById($bookId);
            $view->render("book/edit", ['book' => $book]);
        } else {
            $view->render("book/edit");
        }
    }
}
