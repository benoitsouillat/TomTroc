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
        if (empty($book)) {
            $view = new View('Livre inexistant');
            $view->render("errorPage", ['errors' => ['Ce livre n\'existe pas !']]);
        } else {
            $view = new View("Livre seul");
            $view->render("book/show", ['book' => $book]);
        }
    }
    public function editBook(?int $bookId = null): void
    {
        $bookRepository = new BookRepository();
        if (empty($_SESSION['user'])) {
            $_SESSION['connection']['errors'] = "Vous devez être connecté pour accéder à cette page";
            header('Location: index.php?action=login');
        }
        if (!empty($bookId) && !userSessionValidator::checkBookOwner($bookId)) {
            header('Location: index.php?action=account');
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errors = [];
            if (!empty($errors)) {
                $_SESSION['editbook']['errors'] = $errors;
            } else {
                $picture = "";
                if (!empty($_FILES['book_picture'])) {
                    $fileTmpPath = $_FILES['book_picture']['tmp_name'];
                    $fileType = $_FILES['book_picture']['type'];
                    if (str_starts_with($fileType, 'image/')) {
                        $fileTypeExploded = explode('/', $fileType);
                        $extension = $fileTypeExploded[1];
                        $filename = sprintf('/public/media/books/%s.%s', $_POST['title'], $extension);
                        $destination = $_SERVER['DOCUMENT_ROOT'] . $filename;
                        if (move_uploaded_file($fileTmpPath, $destination)) {
                            $picture = $filename;
                        }
                    }
                }
                try {
                    if (isset($bookId)) {
                        $bookRepository->updateBook($_POST);
                        $_SESSION['editbook']['message'] = "<div class='message success-message'>Votre livre a bien été mis à jour.</div>";
                    } else {
                        $bookRepository->createBook($_POST, $picture);
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
    public function deleteBook(int $bookId): void
    {
        if (!userSessionValidator::checkBookOwner($bookId)) {
            header('Location: index.php?action=account');
        }
        $bookRepository = new BookRepository();
        $bookRepository->deleteBook($bookId);
        $books = $bookRepository->getAllBooksOfUser($_SESSION['user']['id']);
        $view = new View("Compte de l'utilisateur");
        $view->render("account/account", ['books' => $books]);
    }

    /**
     * Edition d'une image pour un livre existant
     * 
     */
    public function editPicture(int $bookId): void
    {
        if (!userSessionValidator::checkBookOwner($bookId)) {
            header('Location: index.php?action=account');
        }
        $_SESSION['book']['id'] = $bookId;
        $bookRepository = new BookRepository();
        $book = $bookRepository->getBookById($bookId);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!empty($_FILES['book_picture'])) {
                $fileTmpPath = $_FILES['book_picture']['tmp_name'];
                $fileType = $_FILES['book_picture']['type'];
                if (str_starts_with($fileType, 'image/')) {
                    $fileTypeExploded = explode('/', $fileType);
                    $extension = $fileTypeExploded[1];
                    $filename = sprintf('/public/media/books/%s_%s.%s', $book->book_id, $book->title, $extension);
                    $destination = $_SERVER['DOCUMENT_ROOT'] . $filename;
                    if (move_uploaded_file($fileTmpPath, $destination)) {
                        $bookRepository->saveThumbnail($filename);
                        header('Location: /index.php?action=edit_book&book_id=' . $bookId);
                    }
                }
            }
        }
        $view = new View("Mettre à jour l'image du livre");
        $view->render("book/edit_picture", ['book' => $book]);
    }
}
