<?php

class Admin
{
    public static function checkAdmin()
        /**
         * проверка авторизации админа
         */
    {
        if((!empty($_SESSION['adminId'])) or (!empty($_SESSION['adminLogin']))){
            return true;
        } else {
            return false;
        }
    }

    public static function registerAdmin($login, $pass)
        /**
         * метод регистрации админа
         */
    {
        $db = DB::dbConnection();
        $pass = md5(md5($pass));

        $sql = "INSERT INTO `blog.loc`.admin SET adminLogin = '$login', adminPassword = '$pass'";
        $result = $db->query($sql);
        if($result){
            return true;
        } else {
            return false;
        }
    }

    public static function validateAdminRegister($login, $pass)
        /**
         * валидация регистрации админа
         */
    {
        $errors = [];

        if (strlen($login) < 4) {
            $errors[] = 'Short login (less than 4 characters).';
        }

        if (self::checkAdminLogin($login)) {
            $errors[] = 'Login is already taken.';
        }

        if (preg_match('#^[a-zA-Z][a-zA-Z0-9-_\.]{4,20}$#', $login) == false) {
            $errors[] = 'Only Latin letters and numbers are allowed.';
        }

        if (strlen($pass) < 5 OR mb_strlen($pass) < 5) {
            $errors[] = 'Too short password (less than 5 characters).';
        }
        return $errors;
    }

    private static function checkAdminLogin($login)
        /**
         * проверка на занятость @login для админа
         */
    {
        $db = DB::dbConnection();

        $result = $db->query("SELECT adminLogin FROM `blog.loc`.admin WHERE adminLogin = '$login'")->fetch();

        return $result;
    }
}