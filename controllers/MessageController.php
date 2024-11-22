<?php

declare(strict_types=1);

class MessageController
{
    public function showMessages(): void
    {
        $view = new View('Messagerie');
        $view->render('messages/messagerie');
    }
}
