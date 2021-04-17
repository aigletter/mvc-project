<?php


namespace App\Controllers;


use App\Services\Auth\Auth;

class AuthController
{
    public function login(Auth $auth)
    {
        $auth->login();
    }
}