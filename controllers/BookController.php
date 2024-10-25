<?php

declare(strict_types=1);

class BookController
{
    public function showHome(): void
    {
        $bookRepository = new BookRepository();
        $books = $bookRepository->getLastFourthbooks();
        foreach ($books as &$book) {
            $book->seller = ucfirst($book->firstname) . " " . ucfirst($book->lastname);
        }
        $view = new View("Accueil");
        $view->render("home", ['books' => $books]);
    }
    public function showBooks(): void
    {
        $bookRepository = new BookRepository();
        $books = $bookRepository->getAllBooksAvailables();
        foreach ($books as &$book) {
            $book->seller =  sprintf("%s %s", ucfirst($book->firstname), ucfirst($book->lastname));
        }
        $view = new View("Nos livres à l'échange");
        $view->render("book/list", ['books' => $books]);
    }
    public function showBook(int $bookId): void
    {

        $bookRepository = new BookRepository();
        $book = $bookRepository->getBookById($bookId);
        /* Si Book n'existe pas => Redirection avec Erreur */
        $book->owner =  sprintf("%s %s", ucfirst($book->firstname), ucfirst($book->lastname));
        $view = new View("Livre seul");
        $view->render("book/show", ['book' => $book]);
    }
}
