<?php
require_once 'config/config.php';
require_once 'config/autoload.php';
session_start();

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
            if (isset($_REQUEST['book_id'])) {
                $bookId = $_REQUEST['book_id'];
            }
            if (!isset($bookId)) {
                /* Redirection */
            }
            $bookController = new BookController();
            $bookController->showBook((int)$bookId);
            break;
        case 'edit_book':
            if (isset($_REQUEST['book_id'])) {
                $bookId = $_REQUEST['book_id'];
            }
            $bookController = new BookController();
            if (!isset($bookId)) {
                $bookController->editBook();
            } else {
                $bookController->editBook((int)$bookId);
            }
            break;
        case 'delete_book':
            $bookId = $_REQUEST['book_id'];
            $bookController = new BookController();
            $bookController->deleteBook((int)$bookId);
            break;
        case 'edit_book_picture':
            $bookId = $_REQUEST['book_id'];
            $bookController = new BookController();
            $bookController->editPicture($bookId);
            break;
        case 'login':
            $accountController = new AccountController();
            $accountController->showLogin();
            break;
        case 'register':
            $accountController = new AccountController();
            $accountController->showRegister();
            break;
        case 'account':
            $accountController = new AccountController();
            $accountController->showAccount();
            break;
        case 'profile':
            $accountController = new AccountController();
            $accountController->showPublicProfile();
            break;
        case 'logout':
            $accountController = new AccountController();
            $accountController->logout();
            break;
        case 'edit_thumbnail':
            $accountController = new AccountController();
            $accountController->showEditThumbnail();
            break;
        case 'messages':
            $messageController = new MessageController();
            $messageController->showMessages();
            break;
        default:
            throw new Exception("La page demandée n'existe pas.");
    }
} catch (Exception $e) {
    $errorView = new View('Erreur');
    $errorView->render('errorPage', ['errorMessage' => $e->getMessage()]);
}
