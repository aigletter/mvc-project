<?php


namespace App\Controllers;


use App\Services\Auth\Auth;

class BankAccount
{
    public function form()
    {
        $code = md5(date('Y-m-d'));
        $_SESSION['code'] = $code;
        $url = 'http://mvc-project/bank/withdrawal?to=anton&amount=100000&code=' . $code;
        echo '<a href="' . $url . '">Перевести</a>';
    }

    public function withdrawal(Auth $auth)
    {
        $to = $_GET['to'];
        $amount = $_GET['amount'];

        if ($auth->isLogin() && $_GET['code'] == md5(date('Y-m-d'))) {
            // Действие
            echo 'Перевели ' . $amount . ' денег ' . $to;
        }
    }
}