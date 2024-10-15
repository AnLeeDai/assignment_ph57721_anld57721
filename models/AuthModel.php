<?php

namespace models;

class AuthModel extends BaseModel
{
    protected $table = 'users';

    public function __construct()
    {
        parent::__construct();
    }

    public function isUserExits($username, $password): bool
    {
        $conditions = 'username = :username AND password = :password';

        $params = [
            ':username' => $username,
            ':password' => $password
        ];

        $user = $this->find('*', $conditions, $params);

        return (bool)$user;
    }
}
