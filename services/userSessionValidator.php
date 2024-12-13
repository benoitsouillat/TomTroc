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
}
