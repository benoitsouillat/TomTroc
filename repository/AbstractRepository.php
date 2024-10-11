<?php

declare(strict_types=1);

abstract class AbstractRepository
{
    protected $db;

    public function __construct()
    {
        $this->db = DatabaseRepository::getInstance()->getConnection();
    }
}
