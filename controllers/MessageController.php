<?php

declare(strict_types=1);

class MessageController
{
    public function showMessages(): void
    {
        if (empty($_SESSION['user'])) {
            $_SESSION['connection']['errors'] = "Vous devez être connecté pour accéder à cette page";
            header('Location: index.php?action=login');
        }
        $messageRepository = new MessageRepository();
        $conversationRepository = new ConversationRepository();
        $userRepository = new UserRepository();

        $conversations = $conversationRepository->getAllFromUser((int)$_SESSION['user']['id']);
        $activeConversation = null;

        if (isset($_GET['conversationID']) && !empty($_GET['conversationID'])) {
            $activeConversation = $conversationRepository->getByID((int)$_GET['conversationID']);
            $partner = $userRepository->getUserById(conversationService::selectPartnerID($activeConversation));
            $messages = $messageRepository->getAllOfConversation($activeConversation->getID());
        }
        if (isset($_GET['user_toID']) && !empty($_GET['user_toID'])) {
            $conversation = new Conversation((int)$_GET['user_toID']);

            conversationService::checkConversationExist((int)$_GET['user_toID']) 
            ? $activeConversation = $conversationRepository->getFromUsers((int)$_SESSION['user']['id'], (int)$_GET['user_toID']) 
            : $activeConversation = $conversationRepository->create($conversation)->getFromUsers((int)$_SESSION['user']['id'], (int)$_GET['user_toID']); 

            $partner = $userRepository->getUserById((int)$_GET['user_toID']);

        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['conversationID']) && !empty($_POST['conversationID'])) {
                $conversationID = (int)$_POST['conversationID'];
                $activeConversation = $conversationRepository->getByID($conversationID);
                $message = new Message($conversationID);
                $message->setMessage($_POST['sending']);
                $message->setUserToID(conversationService::selectPartnerID($activeConversation));
            }
            
            $lastMessageID = $messageRepository->sendMessage($message);
            $conversationRepository->updateLastMessage($conversationID, $lastMessageID);
            header("Location: /index.php?action=messages&conversationID=" . $conversationID);
        }

        $view = new View('Messagerie');
        $view->render('messages/messagerie', [
            'conversations' => $conversations, 
            'activeConversation' => isset($activeConversation) ? $activeConversation : null,
            'partner' => isset($partner) ? $partner : null,
            'messages' => isset($messages) ? $messages : null,
        ]);
    }
}
