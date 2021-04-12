<?php


class ContactController
{
    public function actionIndex()
    {
        $categories = Category::getCategories();
        $result = false;

        if(!User::checkAuth()){
            header("Location: /");
        }

        $userEmail = User::getUserEmail();

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