<?php

class User
{
    public static function formValidate($login, $email, $password, $repeatPassword, $messageSelf, $captcha)
    {
        $errors = [];

        if(strlen($login) < 4){
            $errors[] = 'Короткий логин (менее 4х символов';
        }

        if(filter_var($email, FILTER_VALIDATE_EMAIL) !== true){
            $errors[] = 'Некорректный emeil';
        }

        if($password != $repeatPassword){
            $errors[] = 'Введенные вами пароли не совпадают';
        }

        if(strlen($messageSelf) < 20){
            $errors[] = 'Пожалуйста, расскажите побольше о себе. Нам будет очень интересно !';
        }

        if(empty($captcha)){
            $errors[] = 'Подтвердите, что вы не робот';
        }
    }
}