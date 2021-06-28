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

    public static function authAdmin($login, $password)
    {
        $db = DB::dbConnection();
        $password = md5(md5($password));

        $sql = "SELECT id, adminLogin, adminPassword FROM `blog.loc`.admin WHERE adminLogin = '$login' AND adminPassword = '$password'";
        $result = $db->query($sql)->fetch();

        if ($result) {
            $_SESSION['adminId'] = $result['id'];
            $_SESSION['adminLogin'] = $result['adminLogin'];
            return true;
        } else {
            return false;
        }
    }

    public static function getAllCategory()
    {
        $db = DB::dbConnection();

        $categories = [];
        $sql = "SELECT * FROM `blog.loc`.category";
        $result = $db->query($sql);

        for($i = 1; $row = $result->fetch(); $i++){
            $categories[$i]['id'] = $row['id'];
            $categories[$i]['categoryName'] = $row['categoryName'];
            $categories[$i]['categoryAvailability'] = $row['categoryAvailability'];
            $categories[$i]['categoryTotalArticles'] = self::getTotalArticlesInCategory($row['categoryName']);
            if($row['categoryAvailability'] == 1){
                $categories[$i]['commandHide'] = 'hide';
                $categories[$i]['iconHide'] = 'icon fa-eye-slash';
            } else {
                $categories[$i]['commandHide'] = 'open';
                $categories[$i]['iconHide'] = 'icon fa-eye';
            }
        }

        return $categories;
    }

    public static function getTotalArticlesInCategory($categoryName)
    {
        $db = DB::dbConnection();

        $sql = "SELECT COUNT(stateName) as total FROM `blog.loc`.news WHERE stateCategory = '$categoryName'";
        $result = $db->query($sql)->fetch();

        return $result['total'];
    }

    public static function hideCategory($id)
    {
        $db = DB::dbConnection();

        $categoryName = self::getCategoryName($id);

        $sql = "UPDATE `blog.loc`.category SET categoryAvailability = 0 WHERE id = '$id'";
        $db->query($sql);

        $sql = "UPDATE `blog.loc`.news SET status = 0 WHERE stateCategory = '$categoryName'";
        $db->query($sql);
    }

    public static function openCategory($id)
    {
        $db = DB::dbConnection();

        $categoryName = self::getCategoryName($id);

        $sql = "UPDATE `blog.loc`.category SET categoryAvailability = 1 WHERE id = '$id'";
        $db->query($sql);

        $sql = "UPDATE `blog.loc`.news SET status = 1 WHERE stateCategory = '$categoryName'";
        $db->query($sql);
    }

    private static function getCategoryName($id)
    {
        $db = DB::dbConnection();

        $sql = "SELECT categoryName FROM `blog.loc`.category WHERE id = '$id'";
        $result = $db->query($sql)->fetch();
        return $result['categoryName'];
    }
}