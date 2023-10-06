<?php

namespace src\Models\User;


class User{
    private $id;
    private $nickname;
    private $email;
    private $isConfirmed;
    private $role;
    private $passwordHash;
    private $authToken;

    public function getName(){
        return $this->name;
    }
}

