<?php

declare(strict_types=1);
class Error extends Exception
{

    public string $error = "";
    public int $code = 0;

    public function __construct(string $error)
    {
        $this->error = $error;
    }
}
