<?php

declare(strict_types=1);

class conversationService
{
    public static function selectPartnerID(Conversation $conversation): int
    {
        return $conversation->getUserFrom() == $_SESSION['user']['id'] ? (int)$conversation->getUserTo() : (int)$conversation->getUserFrom();
    }

    public static function checkConversationExist(int $partnerID): bool
    {
        $conversationRepository = new ConversationRepository;
        $partnerConversations = $conversationRepository->getAllFromUser($partnerID);
        $currentUserConversations = $conversationRepository->getAllFromUser((int)$_SESSION['user']['id']);
        foreach ($partnerConversations as $conversation)
        {
            if (in_array($conversation, $currentUserConversations))
            {
                return true;
            }
        }
        return false;
    }
}
