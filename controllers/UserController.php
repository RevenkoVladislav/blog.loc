<?php

class UserController
{
    public function actionRegister()
    {
        $categories = Category::getCategories();
        $result = false;
        $errors = [];

        if(!empty($_POST['register'])){
            $name = htmlspecialchars($_POST['name']);
            $surname = htmlspecialchars($_POST['surname']);
            $login = htmlspecialchars($_POST['login']);
            $email = htmlspecialchars($_POST['email']);
            $password = htmlspecialchars($_POST['password']);
            $repeatPassword = htmlspecialchars($_POST['repeatPassword']);
            $messageSelf = htmlspecialchars($_POST['messageSelf']);
            $autoLog = '';
            $captcha = '';

            if(!empty($_POST['autoLog'])){
                $autoLog = htmlspecialchars($_POST['autoLog']);
            }

            if(!empty($_POST['captcha'])){
                $captcha = htmlspecialchars($_POST['captcha']);
            }

            $errors = User::formValidate($login, $email, $password, $repeatPassword, $messageSelf, $captcha);
        }

        require_once(ROOT . '/views/user/register.php');
        return true;
    }
}