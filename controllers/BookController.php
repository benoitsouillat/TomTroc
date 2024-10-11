<?php

class BookController
{
    public function showHome(): void
    {
        $bookRepository = new BookRepository();
        $userRepository = new UserRepository();
        $books = $bookRepository->getLastFourthbooks();
        foreach ($books as &$book) {
            $owner = $userRepository->getUserById($book['owner']);
            $book['seller'] = ucfirst($owner['firstname']) . " " . ucfirst($owner['lastname']);
        }

        $view = new View("Accueil");
        $view->render("home", ['books' => $books]);
    }
}
