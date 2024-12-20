<?php

declare(strict_types=1);

class MessageController
{
    public function showMessages(): void
    {
        $messageRepository = new MessageRepository();
        $conversationRepository = new ConversationRepository();
        $userRepository = new UserRepository();

        // $messages = $messageRepository->getAllMyMessages();
        $conversations = $conversationRepository->getAllConversationsFromUser((int)$_SESSION['user']['id']);
        // Ajouter le service conversation pour créer ou vérifier l'existance de la conversation et mettre à jour le last message
        if (isset($_GET['conversationID']) && !empty($_GET['conversationID'])) {
            $activeConversation = $conversationRepository->getConversationByID((int)$_GET['conversationID']);
            $partner = $userRepository->getUserById(conversationService::selectPartnerID($activeConversation));
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $message = new Message($_POST['sending'], $activeConversation->id);
            $messageRepository->sendMessage($message);

            header("Location: /index.php?action=messages&conversation=" . $_GET['conversationID']);
        }

        $view = new View('Messagerie');
        $view->render('messages/messagerie', [
            'conversations' => $conversations, 
            'partner' => isset($partner) ? $partner : null
        ]);
    }
}
