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
                if (password_verify($_POST['password'], $user->password)); {
                    $_SESSION['username'] = $user->pseudo;
                    $_SESSION['connection']['message'] = sprintf("<div class='message success-message'>Bonjour %s</div>", $user->pseudo);
                    header('Location: /index.php?action=account');
                }
            }
        }

        $view = new View("Connexion");
        $view->render("account/login");
    }
    public function showRegister(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userRepository = new UserRepository();
            $errors = [];
            if (strlen($_POST['password']) < 8) {
                $errors[] = "Le mot de passe doit contenir au moins 8 caractères.";
            }
            if ($this->checkAccount($_POST['email'])) {
                $errors[] = "Ce compte existe déjà.";
            }
            if ($_POST['password'] !== $_POST['confirm']) {
                $errors[] = "Les mots de passe ne sont pas identiques.";
            }
            if (!empty($errors)) {
                $_SESSION['register']['errors'] = $errors;
            }

            // Rajouter la vérification de l'email non vide et respectant la REGEX
            if ($_POST['password'] === $_POST['confirm'] && empty($errors)) {
                try {
                    $userRepository->createUser($_POST);
                    $message = "Votre compte a bien été créé.";
                    $_SESSION['register']['message'] = $message;
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
        if (empty($_SESSION['username'])) {
            $_SESSION['connection']['errors'] = "Vous devez être connecté pour accéder à cette page";
            header('Location: index.php?action=login');
        }
        $view = new View("Mon compte");
        $view->render("account/account");
    }
    public function logout(): void
    {
        $_SESSION['username'] = [];
        $_SESSION['connection']['errors'] = "Vous avez été déconnecté.";
        header('Location: /index.php?action=login');
    }
    public function checkAccount(string $email): bool
    {
        $userRepository = new UserRepository();
        if ($userRepository->getUserByEmail($email))
            return true;
        else
            return false;
    }
    public function connectUser(): void
    {
        $userRepository = new UserRepository();
        $userRepository->connectUser();
    }
}
