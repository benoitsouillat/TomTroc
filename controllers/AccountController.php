<?php

declare(strict_types=1);

class AccountController
{
    public function showLogin(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userRepository = new UserRepository();
            $user = $userRepository->getUserByEmail($_POST['email']);
            if (!empty($user)) {
                if (password_verify($_POST['password'], $user->password) === true) {
                    $this->setUserSession($user);
                    $_SESSION['connection']['message'] = sprintf("<div class='message success-message'>Bonjour %s</div>", $user->pseudo);
                    header('Location: /index.php?action=account');
                } else {
                    $_SESSION['connection']['errors'] = "Echec lors de la connexion";
                }
            }
        }
        $view = new View("Connexion");
        $view->render("account/login");
    }
    public function showRegister(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errors = [];
            $errors = userFormValidator::checkRegister($_POST['password'], $_POST['confirm'], $_POST['email']);
            if (!empty($errors)) {
                $_SESSION['register']['errors'] = $errors;
            } else {
                try {
                    $userRepository = new UserRepository();
                    $userRepository->createUser($_POST);
                    $_SESSION['register']['message'] = "Votre compte a bien été créé.";
                    header("Location: index.php?action=login");
                } catch (Exception $e) {
                    var_dump($e);
                    die();
                }
            }
        }
        $view = new View("Inscription");
        $view->render("account/register");
    }
    public function showAccount(): void
    {
        if (empty($_SESSION['user'])) {
            $_SESSION['connection']['errors'] = "Vous devez être connecté pour accéder à cette page";
            header('Location: index.php?action=login');
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userRepository = new UserRepository();
            $errors = [];
            if (!empty($_POST['email'])) {
                $errors = userFormValidator::checkEmail($_POST['email'], $_SESSION['user']['id']);
                $errors = array_merge($errors, userFormValidator::checkPseudo($_POST['pseudo']));
                if (empty($errors)) {
                    $userRepository->updateUserInfo($_POST);
                    $user = $userRepository->getUserByEmail($_POST['email']);
                    $this->setUserSession($user);
                    $_SESSION['user']['message'] = "Vos informations ont bien été mises à jour";
                }
                if (!empty($errors)) {
                    $user = $userRepository->getUserById($_SESSION['user']['id']);
                    $this->setUserSession($user);
                    $_SESSION['user']['errors'] = $errors;
                }
            } elseif (!empty($_FILES['profile_thumbnail'])) {
                $fileTmpPath = $_FILES['profile_thumbnail']['tmp_name'];
                $fileType = $_FILES['profile_thumbnail']['type'];
                if (str_starts_with($fileType, 'image/')) {
                    $fileTypeExploded = explode('/', $fileType);
                    $extension = $fileTypeExploded[1];
                    // Prévoir une erreur de la taille 
                    $filename =  sprintf('/public/media/users/%s_%s.%s', $_SESSION['user']['id'], $_SESSION['user']['pseudo'], $extension);
                    $destination = $_SERVER['DOCUMENT_ROOT'] . $filename;
                    if (move_uploaded_file($fileTmpPath, $destination)) {
                        $userRepository->saveThumbnail($filename);
                        $_SESSION['user']['thumbnail'] = $filename;
                        $_SESSION['picture']['message'] = "Votre image a été mise à jour";
                        header("Location: /index.php?action=account"); // le renvoi du header supprime les valeurs de $_SESSION
                    }
                } else {
                    $_SESSION['picture']['errors'] = "L'extension du fichier n'est pas supportée. Veuillez utiliser une image en jpg, png, webp ou gif";
                }
            } elseif (!empty($_POST['newpassword'])) {
                $errors = userFormValidator::checkPassword($_POST['newpassword'], $_POST['confirm'], $_POST['password']);
                if (empty($errors)) {
                    try {
                        $user = [];
                        $user['email'] = $_SESSION['user']['email'];
                        $user['pseudo'] = $_SESSION['user']['pseudo'];
                        $user['password'] = $_POST['newpassword'];
                        $userRepository->updateUser($user);
                        $_SESSION['user']['message'] = "Votre mot de passe a bien été modifié";
                        // Il faudrait retourner sur informations personnelles mais le renvoi du header supprime les valeurs de $_SESSION
                    } catch (Exception $e) {
                        var_dump('Une erreur s\'est produite lors du changement de mot de passe : ' . $e);
                        die();
                    }
                }
                if (!empty($errors)) {
                    $_SESSION['user']['errors'] = $errors;
                }
            }
        }
        $bookRepository = new BookRepository();
        $books = $bookRepository->getAllBooksOfUser((int)$_SESSION['user']['id']);

        $view = new View("Mon compte");
        $view->render("account/account", ['books' => $books]);
    }
    public function showEditThumbnail(): void
    {
        $view = new View("Editer");
        $view->render("account/editThumbnail");
    }
    private function setUserSession(stdClass $user): void
    {
        $_SESSION['user'] = [];
        $_SESSION['user']['id'] = $user->id;
        $_SESSION['user']['pseudo'] = $user->pseudo;
        $_SESSION['user']['email'] = $user->email;
        $_SESSION['user']['thumbnail'] = $user->thumbnail;
    }
    public function logout(): void
    {
        $_SESSION['user'] = [];
        $_SESSION['connection']['errors'] = "Vous avez été déconnecté.";
        header('Location: /index.php?action=login');
    }
}
