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
            $book->owner = ucfirst($book->firstname) . " " . ucfirst($book->lastname);
        }
        $view = new View("Nos livres à l'échange");
        $view->render("books", ['books' => $books]);
    }
}
