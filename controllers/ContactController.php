<?php
/**
 * контроллер для обратной связи, отправки email
*/

class ContactController
{
    public function actionIndex()
    {
        $categories = Category::getCategories();
        $result = false;

        //доступ только авторизованным пользователям
        if(!User::checkAuth()){
            header("Location: /");
        }

        //получаем Email авторизованного пользователя
        $userEmail = User::getUserEmail();

        /**
         * валидация формы, формирование массива ошибок, отправка сообщения
         */

        if(!empty($_POST['contactUs'])){
            $email = htmlspecialchars($_POST['contactEmail']);
            $message = htmlspecialchars($_POST['contactMessage']);
            $errors = User::validateEmailForContact($email);

            if(empty($errors)){
                $adminEmail = 'testsendsmtp1@gmail.com';
                $message = "Текст: {$message} От: {$email}";
                $subject = "Новое сообщение от {$email}";
                $result = mail($adminEmail, $subject, $message);
            }
        }

        require_once (ROOT . "/views/contact/contact.php");
        return true;
    }
}