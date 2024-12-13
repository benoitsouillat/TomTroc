<?php

declare(strict_types=1);

class MessageController
{
    public function showMessages(): void
    {
        $messageRepository = new MessageRepository();
        $messages = $messageRepository->getAllMyMessages();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $message = new Message($_POST['sending'], (int)$_GET['user_to']);
            $messageRepository->sendMessage($message);
            header("Location: /index.php?action=messages&user_to=" . $_GET['user_to']);
        }
        $view = new View('Messagerie');
        $view->render('messages/messagerie', ['messages' => $messages]);
    }
}
