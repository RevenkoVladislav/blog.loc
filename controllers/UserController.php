<?php

class UserController
{
    public function actionRegister()
    {
        $categories = Category::getCategories();
        $register = false;
        $errors = [];

        if(User::checkAuth()){
            header("Location: /");
        }

        if(!empty($_POST['register'])){
            $name = htmlspecialchars($_POST['name']);
            $surname = htmlspecialchars($_POST['surname']);
            $login = htmlspecialchars($_POST['login']);
            $email = htmlspecialchars($_POST['email']);
            $password = htmlspecialchars($_POST['password']);
            $repeatPassword = htmlspecialchars($_POST['repeatPassword']);
            $pseudonym = htmlspecialchars($_POST['pseudonym']);
            $messageSelf = htmlspecialchars($_POST['messageSelf']);
            $autoLog = '';
            $captcha = '';

            if(!empty($_POST['autoLog'])){
                $autoLog = htmlspecialchars($_POST['autoLog']);
            }

            if(!empty($_POST['captcha'])){
                $captcha = htmlspecialchars($_POST['captcha']);
            }

            $errors = User::formValidate($login, $email, $password, $repeatPassword, $messageSelf, $captcha, $pseudonym);

            if(empty($errors)){
                $register = User::register($name, $surname, $login, $email, $password, $messageSelf, $pseudonym);

                if(!empty($autoLog)){
                    User::userAuth($login);
                    header("Location: /");
                }
            }
        }

        require_once(ROOT . '/views/user/register.php');
        return true;
    }

    public function actionLogout()
    {
        unset ($_SESSION['userId'], $_SESSION['userLogin'], $_SESSION['userPseudonym']);
        header("Location: /");
    }

    public function actionLogin()
    {
        $categories = Category::getCategories();

        if(User::checkAuth()){
            header("Location: /user/cabinet");
        }

        if(!empty($_POST['inSub'])){
            $login = htmlspecialchars($_POST['inLogin']);
            $password = md5(md5(htmlspecialchars($_POST['inPassword'])));

            if(User::checkLoginData($login, $password)){
                header("Location: /user/cabinet");
            } else {
                $error = 'Неверное сочетание логин-пароль';
            }
        }

        require_once (ROOT . '/views/user/login.php');
        return true;
    }

    public function actionCabinet($changeData = false)
    {
        if(User::checkAuth()) {
            $categories = Category::getCategories();
            $userData = User::getUserData();

            if(!empty($_POST['changeDataForm'])){
                $name = htmlspecialchars($_POST['dataName']);
                $surname = htmlspecialchars($_POST['dataSurname']);
                $messageSelf = htmlspecialchars($_POST['dataMessageSelf']);

                $errors = User::ValidateMessage($messageSelf);

                if(empty($errors)) {
                    $changeUserData = User::changeData($name, $surname, $messageSelf);

                    if($changeData){
                        header("Location: /user/cabinet");
                    }
                }
            }

            $userPublications = User::getUserPublication($_SESSION['userPseudonym']);

            require_once(ROOT . '/views/user/cabinet.php');
        } else {
            header("Location: /user/login");
        }
        return true;
    }
}