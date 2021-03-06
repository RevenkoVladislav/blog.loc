<?php

class UserController
{
    public function actionRegister()
    {
        $categories = Category::getCategories();

        $name = '';
        $surname = '';
        $login = '';
        $email = '';

        require_once(ROOT . '/views/user/register.php');
        return true;
    }
}