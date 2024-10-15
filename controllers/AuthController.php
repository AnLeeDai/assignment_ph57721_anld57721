<?php

namespace controllers;

use JetBrains\PhpStorm\NoReturn;
use models\AuthModel;

spl_autoload_register('autoImport');

class AuthController extends AuthModel
{
    public function __construct()
    {
        parent::__construct();
    }

    public function login(): void
    {
        require_once PATH_VIEWS . 'Login.php';

        if (isset($_POST['form_login'])) {

            if (empty($_POST['username']) || empty($_POST['password'])) {
                return;
            }

            $username = $_POST['username'];
            $password = $_POST['password'];


            if ($this->isUserExits($username, $password) === false) {
                return;
            }

            $_SESSION['user'] = $username;
            header('Location: ?route=news');
            exit();
        }
    }

    #[NoReturn] public function logout(): void
    {
        session_destroy();
        header('Location: index.php');
        exit();
    }
}