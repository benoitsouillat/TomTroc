<?php

declare(strict_types=1);

class Conversation
{

    private int $id;
    private int $user_from;
    private int $user_to;
    private ?int $last_message = null;


    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getUser_from()
    {
        return $this->user_from;
    }

    public function setUser_from($user_from)
    {
        $this->user_from = $user_from;

        return $this;
    }

    public function getUser_to()
    {
        return $this->user_to;
    }

    public function setUser_to($user_to)
    {
        $this->user_to = $user_to;

        return $this;
    }
}
