<?php

require_once 'config/config.php';
require_once 'config/autoload.php';

if (!empty($_REQUEST['action'])) {
    $action = $_REQUEST['action'];
} else {
    $action = 'home';
}

try {
    switch ($action) {
        case 'home':
            $bookController = new BookController();
            $bookController->showHome();
            break;
        case 'books':
            $bookController = new BookController();
            $bookController->showBooks();
            break;
        case 'book':
            $bookId = $_REQUEST['book_id'];
            if (!$bookId) {
                /* Redirection */
            }
            $bookController = new BookController();
            $bookController->showBook((int)$bookId);
            break;
        case 'login':
            $bookController = new AccountController();
            $bookController->showLogin();
            break;

        default:
            throw new Exception("La page demandée n'existe pas.");
    }
} catch (Exception $e) {
    $errorView = new View('Erreur');
    $errorView->render('errorPage', ['errorMessage' => $e->getMessage()]);
}
