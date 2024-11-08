<?php

declare(strict_types=1);

class AccountController
{
    public function showLogin(): void
    {
        $view = new View("Connexion");
        $view->render("account/login");
    }
    public function showRegister(): void
    {
        $view = new View("Inscription");
        $view->render("account/register");
    }
    public function showAccount(): void
    {
        $view = new View("Mon compte");
        $view->render("account/account");
    }
}
