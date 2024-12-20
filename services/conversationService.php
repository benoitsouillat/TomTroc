<?php

declare(strict_types=1);

class conversationService
{

    public static function selectPartnerID(stdClass $conversation): int
    {
        if ($conversation->user_from == $_SESSION['user']['id']) {
            return (int)$conversation->user_to;
        }
        return (int)$conversation->user_from;
    }
    public static function checkConversationExist(int $partnerID)
    {
        // If $SESSIONuserID et $partnerID dans une conversation alors conversation existe
        // Sinon conversation existe pas => go to createConversation dans le conversation repository
    }
}
