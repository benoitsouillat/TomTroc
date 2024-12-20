<div class="container d-flex">
    <section class="conversations-sidebar">
        <h1>Messagerie</h1>
        <div class="conversations-list">

            <?php

            if (empty($conversations)) {
                echo "<p>Aucune conversation n'a été commencée</p>";
            } else {
                foreach ($conversations as $conversation) {

                    // Il faut vérifier que l'id from et to est déjà enregistré dans la base pour ne pas dupliquer les conversations
                    // Il faut qu'une conversation pour chaque couple d'id


                    $userRepository = new UserRepository();
                    $messageRepository = new MessageRepository();

                    $user = $userRepository->getUserByID(conversationService::selectPartnerID($conversation));
                    $message = !empty($conversation->last_message) ?
                        $messageRepository->getMessageByID($conversation->last_message) :
                        new Message('', $conversation->user_to);

                    echo sprintf('<a href="/index.php?action=messages&conversationID=%s"><aside class="conversation-container">
                <div><img class="thumbnail-user" src="%s"></div>
                        <div class="message-preview">
                    <p>%s</p>
                    <p>%s</p>
                    <p class="text-grey">%s</p>
                </div>
                    </aside></a>', $conversation->id, $user->thumbnail, $user->pseudo, '13:12', 'Message en dur', /* date('h:i', strtotime($message->send_date)), $message->message */);
                }
            }
            ?>
        </div>
    </section>
    <section class="messaging-container">
        <?php if (isset($_GET['conversationID']) && !empty($_GET['conversationID'])) { ?>
            <aside class="user-partner">
                <div class="thumbnail-user"><img src="<?= $partner->thumbnail ?>"></div>
                <p><?= $partner->pseudo ?></p>
            </aside>
            <div class="messages">

                <aside class="message-container message-from">
                    <div class="message-meta">
                        <img src="<?= $partner->thumbnail ?>" class="thumbnail-user">
                        <span class="text-grey">21.08 15:48</span>
                    </div>
                    <p class="message-content">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum corrupti consequatur
                        exercitationem ipsa non ullam quis eaque aut cum, ducimus excepturi culpa, cupiditate qui quia.
                    </p>
                </aside>

                <aside class="message-container message-to">
                    <div class="message-meta">
                        <span class="text-grey">21.08 15:49</span>
                    </div>
                    <p class="message-content">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum corrupti consequatur
                        exercitationem ipsa non ullam quis eaque aut cum, ducimus excepturi culpa, cupiditate qui quia.
                    </p>
                </aside>


            </div>
            <form action="/index.php?action=messages&user_to=<?= $_GET['conversationID'] ?>" method="post">
                <input type="text" name="sending" id="sending" placeholder="Tapez votre message ici">
                <button type="submit" class="btn">Envoyer</button>
            </form>
        <?php } ?>

    </section>
</div>