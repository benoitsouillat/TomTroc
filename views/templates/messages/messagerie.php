<div class="container d-flex">
    <section class="conversations-sidebar">
        <h1>Messagerie</h1>
        <div class="conversations-list">
        <?php

            if (empty($conversations)) {
                echo "<p>Aucune conversation n'a été commencée</p>";
            } else {
                foreach ($conversations as $conversation) {
                    if (empty($conversation->getLastMessage())) {
                        continue;
                    }
                    $userRepository = new UserRepository();
                    $messageRepository = new MessageRepository();
                    $user = $userRepository->getUserByID(conversationService::selectPartnerID($conversation));
                    $lastMessage = $messageRepository->getMessageByID($conversation->getLastMessage());

                    echo sprintf('<a href="/index.php?action=messages&conversationID=%s">
                                <aside class="conversation-container">
                                    <div><img class="thumbnail-user" src="%s"></div>
                                            <div class="message-preview">
                                        <p>%s</p>
                                        <p>%s</p>
                                        <p class="text-grey">%s</p>
                                    </div>
                                </aside></a>', 
                    $conversation->getID(), 
                    $user->thumbnail, 
                    $user->pseudo, 
                    !empty($lastMessage) ? $lastMessage->getDate()->format('h:i') : '-' , 
                    !empty($lastMessage) ? $lastMessage->getMessage() : ""
                );
            }
            }
            ?>
        </div>
    </section>
    <section class="messaging-container">
        <?php if (isset($activeConversation) && !empty($activeConversation)) { ?>
            <aside class="user-partner">
            <a href="/index.php?action=profile&userID=<?= $partner->id ?>">
                <div class="thumbnail-user"><img src="<?= $partner->thumbnail ?>"></div>
                <p><?= $partner->pseudo ?></p></a>
            </aside>
            <div class="messages">
                <?php
                if (!empty($messages))
                {
                    foreach($messages as $message)
                    {
                        if ($message->getUserFromID() == $_SESSION['user']['id'])
                        {
                            echo sprintf('
                                <aside class="message-container message-to">
                                    <div class="message-meta">
                                        <span class="text-grey">%s</span>
                                    </div>
                                    <p class="message-content">%s</p>
                                </aside>
                                ', $message->getDate()->format('d/m h:i'), $message->getMessage());
                        }
                        else {
                            echo sprintf('
                            <aside class="message-container message-from">
                                <div class="message-meta">
                                    <img src=%s class="thumbnail-user">
                                    <span class="text-grey">%s</span>
                                </div>
                                <p class="message-content">%s</p>
                            </aside>
                            ', $partner->thumbnail, $message->getDate()->format('d/m h:i'), $message->getMessage());
                        }
                    }
                }
                ?>
            </div>
            <form accept-charset="UTF-8" action="/index.php?action=messages&conversationID=<?= $activeConversation->getId() ?>" method="post">
                <input type="hidden" name="conversationID" value=<?= $activeConversation->getId() ?>>
                <input type="text" name="sending" id="sending" placeholder="Tapez votre message ici">
                <button type="submit" class="btn">Envoyer</button>
            </form>
        <?php } ?>

    </section>
</div>