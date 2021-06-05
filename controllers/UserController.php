<?php
/**
 * Контроллер пользователя, регистрация, добавление и редактирование статей
 */

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

        /**
         * Валидация при ригестрации, создание таблицы likes по псевдониму
         */
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

            if(!empty($_FILES['avatar']['size'])){
                $tmpImage = $_FILES['avatar']['tmp_name']; //бинарный файл
                $imageSize = getimagesize($tmpImage); //узнаем размер файла
                $imageName = md5_file($tmpImage); //генерируем имя на основе md5-хеша
                $imageExtension = image_type_to_extension($imageSize[2]); //Генерируем расширение файла на основе его типа
                $imageFormat = str_replace('jpeg', 'jpg', $imageExtension);
                $finalImageName = $imageName . $imageFormat;
                $fileUpload = true;
            } else {
                $tmpImage = false;
                $imageSize = false;
                $finalImageName = 'avatar.jpg';
                $fileUpload = false;
            }


            $errors = User::formValidate($login, $email, $password, $repeatPassword, $messageSelf, $captcha, $pseudonym, $tmpImage, $imageSize, $finalImageName, $fileUpload);

            if(empty($errors)){
                if($fileUpload){
                    User::uploadImage($tmpImage, $imageName, $imageFormat);
                }
                $register = User::register($name, $surname, $login, $email, $password, $messageSelf, $pseudonym, $finalImageName);
                User::createLikesTable($pseudonym);

                //авторизация после регистрации если выбрано $autoLog
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

            /**
             * Проверка при авторизации
             */

            if(User::checkLoginData($login, $password)){
                header("Location: /user/cabinet");
            } else {
                $error = 'Invalid login-password combination';
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

            /**
             * Изменение данных пользователя
             */
            if(!empty($_POST['changeDataForm'])){
                $name = htmlspecialchars($_POST['dataName']);
                $surname = htmlspecialchars($_POST['dataSurname']);
                $messageSelf = htmlspecialchars($_POST['dataMessageSelf']);

                $errors = User::validateMessage($messageSelf);

                if(empty($errors)) {
                    $changeUserData = User::changeData($name, $surname, $messageSelf);

                    if($changeData){
                        $message = User::createMessage($changeData);
                        header("refresh: 3; url=/user/cabinet");
                    }
                }
            }

            /**
             * Изменение пароля
             */
            if(!empty($_POST['changePassword'])){
                $password = htmlspecialchars($_POST['dataPassword']);
                $repeatPassword = htmlspecialchars($_POST['dataRepeatPassword']);

                $errors = User::validateChangePassword($password, $repeatPassword);

                if(empty($errors)){
                    $changeUserPassword = User::changePassword($password);

                    if($changeUserPassword){
                        $message = User::createMessage($changeData);
                        header("refresh: 3; url=/user/cabinet");
                    }
                }
            }

            /**
             * Изменение логина
             */
            if(!empty($_POST['changeLogin'])){
                $login = htmlspecialchars($_POST['dataLogin']);

                $errors = User::validateLogin($login);

                if(empty($errors)){
                    $changeLogin = User::changeLogin($login);

                    if($changeLogin){
                        $message = User::createMessage($changeData);
                        header("refresh: 3; url=/user/cabinet");
                    }
                }
            }

            /**
             * Изменение email
             */
            if(!empty($_POST['changeEmail'])){
                $email = htmlspecialchars($_POST['dataEmail']);

                $errors = User::validateEmail($email);

                if(empty($errors)){
                    $changeEmail = User::changeEmail($email);

                    if($changeEmail){
                        $message = User::createMessage($changeData);
                        header("refresh: 3; url=/user/cabinet");
                    }
                }
            }

            //получаем публикации
            $userPublications = User::getUserPublication($_SESSION['userPseudonym']);

            require_once(ROOT . '/views/user/cabinet.php');
        } else {
            header("Location: /user/login");
        }
        return true;
    }

    public function actionPublication()
    {
        /**
         * Публикация статьи, валидация, проверка mime типа картинки, создание таблицы комментариев для статьи, загрузка картинки
         */
        if(User::checkAuth()) {
            $categories = Category::getCategories();
            $publication = false;
            $errors = [];

            if (!empty($_POST['addArticle'])) {
                $stateName = htmlspecialchars($_POST['stateName']);
                $stateDescription = htmlspecialchars($_POST['stateDescription']);
                $state = htmlspecialchars($_POST['state']);
                $stateCategory = htmlspecialchars($_POST['stateCategory']);

                if (!empty($_FILES['stateImage']['size'])) {
                    $tmpImage = $_FILES['stateImage']['tmp_name']; //бинарный файл
                    $imageSize = getimagesize($tmpImage); //узнаем размер файла
                    $imageName = md5_file($tmpImage); //генерируем имя на основе md5-хеша
                    $imageExtension = image_type_to_extension($imageSize[2]); //Генерируем расширение файла на основе его типа
                    $imageFormat = str_replace('jpeg', 'jpg', $imageExtension);
                    $finalImageName = $imageName . $imageFormat;
                    $fileUpload = true;
                } else {
                    $tmpImage = false;
                    $imageSize = false;
                    $finalImageName = 'default.jpg';
                    $fileUpload = false;
                }

                $errors = User::validateArticle($stateName, $stateDescription, $state, $tmpImage, $imageSize, $finalImageName, $fileUpload);

                if(empty($errors)){
                    if($fileUpload) {
                        User::uploadImage($tmpImage, $imageName, $imageFormat);
                    }
                    $publication = User::addArticle($stateName, $stateDescription, $state, $stateCategory, $finalImageName);
                    User::createCommentsTable(User::getPublicationId($stateName));

                    if($publication){
                        header("Location: /news/$publication");
                    }
                }
            }

            require_once(ROOT . "/views/user/publication.php");
        } else {
            header("Location: /user/login");
        }
        return true;
    }

    public static function actionEdit($id)
    {
        /**
         * редактирование статьи
         */
        if(User::checkAuth()) {
            $categories = Category::getCategories();
            $article = News::getNewsById($id);
            $errors = [];

            if ($article['author'] == $_SESSION['userPseudonym']) {

                if (!empty($_POST['editArticle'])) {
                    $editStateDescription = trim(htmlspecialchars($_POST['editStateDescription']));
                    $editState = trim(htmlspecialchars($_POST['editState']));

                    if(!empty($_FILES['editImage']['size'])){
                        $tmpImage = $_FILES['editImage']['tmp_name']; //бинарный файл
                        $imageSize = getimagesize($tmpImage); //узнаем размер файла
                        $imageName = md5_file($tmpImage); //генерируем имя на основе md5-хеша
                        $imageExtension = image_type_to_extension($imageSize[2]); //Генерируем расширение файла на основе его типа
                        $imageFormat = str_replace('jpeg', 'jpg', $imageExtension);
                        $finalImageName = $imageName . $imageFormat;
                        $fileUpload = true;
                    } else {
                        $tmpImage = false;
                        $imageSize = false;
                        $finalImageName = false;
                        $fileUpload = false;
                    }

                    $errors = User::editValidateArticle($editStateDescription, $editState, $fileUpload, $tmpImage, $imageSize, $finalImageName);

                    if (empty($errors)) {
                        if($fileUpload) {
                            User::uploadImage($tmpImage, $imageName, $imageFormat);
                        }

                        $edit = User::editArticle($editStateDescription, $editState, $id, $finalImageName);

                        if ($edit) {
                            header("Location: /news/$id");
                        }
                    }
                }
            } else {
                header("Location: /news/$id");
            }
        }

        require_once (ROOT . "/views/user/edit.php");
        return true;
    }
}