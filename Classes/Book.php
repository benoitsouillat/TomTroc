<?php

declare(strict_types=1);

class Book
{
    private ?int $id = null;
    private ?string $title = null;
    private ?string $author = null;
    private ?User $owner = null;
    private ?string $picture = null;
}
