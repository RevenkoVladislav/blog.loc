<?php

class UserController
{
    public function __construct()
    {
        session_start();
    }

    public function actionRegister()
    {
        $categories = Category::getCategories();

        require_once(ROOT . '/views/user/register.php');
        return true;
    }
}