<?php

class User
{
    public string $email;
    public string $password;

    public function __construct(string $email, string $password)
    {
        $this->setEmail($email);
        $this->setPassword($password);
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password =  password_hash($password, PASSWORD_BCRYPT);
        return $this;
    }
}
