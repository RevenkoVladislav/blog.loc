<?php

class User
{
    public static function formValidate($login, $email, $password, $repeatPassword, $messageSelf, $captcha)
    {
        $errors = [];

        if(strlen($login) < 4){
            $errors[] = 'Короткий логин (менее 4х символов).';
        }

        if(self::checkLogin($login)){
            $errors[] = 'Логин уже занят.';
        }

        if(preg_match('#\w+#', $login) == false){
            $errors[] = 'Допустимы только латинские буквы и цифры.';
        }

        if(filter_var($email, FILTER_VALIDATE_EMAIL) != true){
            $errors[] = 'Некорректный email.';
        }

        if(self::checkEmail($email)){
            $errors[] = 'Пользователь, с данным email, уже зарегистрирован.';
        }

        if($password != $repeatPassword){
            $errors[] = 'Введенные вами пароли не совпадают.';
        }

        if(strlen($password) < 5){
            $errors[] = 'слишком короткий пароль (менее 5 символов).';
        }

        if(strlen($messageSelf) < 20){
            $errors[] = 'Пожалуйста, расскажите побольше о себе. Нам будет очень интересно !';
        }

        if(empty($captcha)){
            $errors[] = 'Подтвердите, что вы не робот.';
        }

        return $errors;
    }

    private static function checkEmail($email)
    {
        $db = DB::dbConnection();

        $result = $db->query("SELECT userEmail FROM `blog.loc`.users WHERE userEmail = '$email'")->fetch();

        return $result;
    }

    private static function checkLogin($login)
    {
        $db = DB::dbConnection();

        $result = $db->query("SELECT userLogin FROM `blog.loc`.users WHERE userLogin = '$login'")->fetch();

        return $result;
    }

    public static function register($userName, $userSurname, $userLogin, $userEmail, $userPassword, $userMessageSelf){
        $db = DB::dbConnection();

        $sql = "INSERT INTO `blog.loc`.users (userName, userSurname, userLogin, userEmail, userPassword, userMessageSelf) VALUES (:userName, :userSurname, :userLogin, :userEmail, :userPassword, :userMessageSelf)";
        $result = $db->prepare($sql);

        $result->bindParam(':userName', $userName, PDO::PARAM_STR);
        $result->bindParam(':userSurname', $userSurname, PDO::PARAM_STR);
        $result->bindParam(':userLogin', $userLogin, PDO::PARAM_STR);
        $result->bindParam(':userEmail', $userEmail, PDO::PARAM_STR);
        $result->bindParam(':userPassword', $userPassword, PDO::PARAM_STR);
        $result->bindParam(':userMessageSelf', $userMessageSelf, PDO::PARAM_STR);

        return $result->execute();
    }

    public static function getUserId($login){
        $db = DB::dbConnection();
        $id = '';

        $result = $db->query("SELECT id FROM `blog.loc`.users WHERE userLogin = '$login'")->fetch();
        $id = $result['id'];

        return $id;
    }
}