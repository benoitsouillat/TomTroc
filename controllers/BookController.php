<?php

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
}
