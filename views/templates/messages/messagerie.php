<div class="container d-flex">
    <section class="conversations-sidebar">
        <h1>Messagerie</h1>
        <div class="conversations-list">

            <?php
            foreach ($messages as $message) {
                echo sprintf('<a href="/index.php?action=messages&user_to=%s"><aside class="conversation-container">
                <div><img class="thumbnail-user" src="%s"></div>
                        <div class="message-preview">
                    <p>%s</p>
                    <p>%s</p>
                    <p class="text-grey">%s</p>
                </div>
                    </aside></a>', $message->user_to, $message->thumbnail, $message->pseudo, date('h:i', strtotime($message->send_date)), $message->message);
            }
            // var_dump($messages);

            ?>


            <aside class="conversation-container">
                <div class="thumbnail-user"><img src="/public/media/users/36_Benoît.jpeg"></div>
                <div class="message-preview">
                    <p>Alexlecture</p>
                    <p>15:43</p>
                    <p class="text-grey">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sapiente
                        repellendus,
                        doloremque in molestias tenetur corporis nam consequatur dignissimos ratione ipsum itaque
                        voluptatibus animi totam quos sit tempora quae porro? Id tempora nisi illum eligendi ipsam ad
                        eos accusamus alias accusantium maiores quod aut ratione natus eveniet quia, dolorum tempore ab
                        amet nulla molestiae doloremque aliquid dolorem. Recusandae corrupti esse doloremque possimus
                        sint id provident saepe minima atque, officia nihil magnam beatae eos tempora aspernatur
                        perspiciatis itaque aperiam nobis dolorem fugit?</p>
                </div>
            </aside>

        </div>
    </section>
    <section class="messaging-container">
        <aside class="user-partner">
            <div class="thumbnail-user"><img src="/public/media/users/36_Benoît.jpeg"></div>
            <p>Alexlecture</p>
        </aside>
        <div class="messages">

            <aside class="message-container message-from">
                <div class="message-meta">
                    <img src='/public/media/users/36_Benoît.jpeg' class="thumbnail-user">
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
        <form action="/index.php?action=messages&user_to=<?= $_GET['user_to'] ?>" method="post">
            <input type="text" name="sending" id="sending" placeholder="Tapez votre message ici">
            <button type="submit" class="btn">Envoyer</button>
        </form>

    </section>
</div>