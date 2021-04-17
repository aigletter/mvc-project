<?php


namespace App\Services\Auth;


class Auth
{
    public function login()
    {
        session_start();
        $_SESSION['auth'] = true;
    }

    public function isLogin()
    {
        session_start();
        return $_SESSION['auth'] ?? false;
    }
}