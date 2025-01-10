<?php

declare(strict_types=1);
class userSessionValidator
{
    public static function checkBookOwner(int $bookID): bool
    {
        $bookRepository = new BookRepository();
        $owner = $bookRepository->getOwnerOfBook($bookID);
        if ($_SESSION['user']['id'] === $owner) {
            return true;
        }
        return false;
    }

    public static function checkUserIdNotSessionUser(int $userID): bool
    {
        if (isset($_SESSION['user']['id'])) {
            return $_SESSION['user']['id'] == $userID ? false : true;
        }
        return false;

    }
}
