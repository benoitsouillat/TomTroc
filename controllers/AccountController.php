<?php

declare(strict_types=1);

class AccountController
{
    public function showLogin(): void
    {
        $view = new View("Connexion");
        $view->render("account/login");
    }
}
