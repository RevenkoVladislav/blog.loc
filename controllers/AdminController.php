<?php

/**
 * CRUD админ панель
 */
class AdminController
{
    public function actionIndex()
        /**
         * index в admin page
         */
    {
        if (Admin::checkAdmin()) {

        } else {
            header("Location: /admin/enter");
        }
        require_once(ROOT . '/views/admin/index.php');
        return true;
    }

    public function actionEnter()
        /**
         * открываем доступ к админке
         */
    {
        if (Admin::checkAdmin()) {
            header("Location: /admin");
        } else {
            if (!empty($_POST['adminSub'])) {
                $login = htmlspecialchars($_POST['adminLogin']);
                $pass = htmlspecialchars($_POST['adminPass']);

                if (Admin::authAdmin($login, $pass)) {
                    header("Location: /admin");
                } else {
                    $errors[] = "wrong login or password";
                }
            }
        }
        require_once(ROOT . '/views/admin/enter.php');
        return true;
    }

    public function actionRegister()
        /**
         * регистрация нового админа
         */
    {
        if (Admin::checkAdmin()) {
            if (!empty($_POST['newAdminSub'])) {
                $login = htmlspecialchars($_POST['Login']);
                $pass = htmlspecialchars($_POST['Pass']);

                $errors = Admin::validateAdminRegister($login, $pass);

                if (empty($errors)) {
                    $register = Admin::registerAdmin($login, $pass);
                    if ($register) {
                        header("Location: /admin");
                    }
                }
            }
        } else {
            die('access denied');
        }
        require_once(ROOT . '/views/admin/register.php');
        return true;
    }

    public function actionCategory($command = false, $id = false)
        /**
         * работа с категориями, CRUD
         */
    {
        if (Admin::checkAdmin()) {
            $categories = Admin::getAllCategory();

            $command = htmlspecialchars($command);
            $id = htmlspecialchars(intval($id));

            if ($command == 'hide') {
                Admin::hideCategory($id);
                header("Location: /admin/category");
            }

            if ($command == 'open') {
                Admin::openCategory($id);
                header("Location: /admin/category");
            }

            if ($command == 'delete') {
                Admin::deleteCategory($id);
                header("Location: /admin/category");
            }

            if (!empty($_POST['addCategory'])) {
                $newCategory = htmlspecialchars($_POST['categoryName']);
                Admin::addCategory($newCategory);
                header("Location: /admin/category");
            }
        } else {
            die('access denied');
        }
        require_once(ROOT . '/views/admin/category.php');
        return true;
    }

    public function actionNews($command = false, $id = false)
    {
        if (Admin::checkAdmin()) {
            $news = Admin::getAllNews();

            $command = htmlspecialchars($command);
            $id = htmlspecialchars(intval($id));

            if ($command == 'open') {
                Admin::openNews($id);
                header("Location: /admin/news");
            }

            if ($command == 'hide') {
                Admin::hideNews($id);
                header("Location: /admin/news");
            }

            if ($command == 'delete') {
                Admin::deleteNews($id);
                header("Location: /admin/news");
            }

            if ($command == 'defaultImage') {
                Admin::setDefaultImage($id);
                header("Location: /admin/news");
            }

            if ($command == 'edit') {
                $editNew = Admin::getNewsById($id);
                $categories = Category::getCategories();

                if (!empty($_POST['adminEditArticle'])) {
                    $stateName = htmlspecialchars($_POST['editStateName']);
                    $stateDescription = htmlspecialchars($_POST['editStateDescription']);
                    $author = htmlspecialchars($_POST['editAuthor']);
                    $date = $_POST['editDate'];
                    $category = $_POST['editCategory'];
                    $state = $_POST['editState'];

                    if (!empty($_FILES['editImage']['size'])) {
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

                    $errors = User::fileValidate($tmpImage, $imageSize, $finalImageName, $fileUpload, 'image');

                    if (empty($errors)) {
                        if ($fileUpload) {
                            User::deleteImageWhileEdit($id, 'image');
                            User::uploadImage($tmpImage, $imageName, $imageFormat);
                        }
                        $publication = Admin::editNews($stateName, $stateDescription, $author, $date, $category, $state,
                            $finalImageName, $id);
                        if ($publication) {
                            header("Location: /admin/news");
                        }
                    }
                }
            }
        } else {
            die('access denied');
        }
        require_once(ROOT . '/views/admin/news.php');
        return true;
    }

    public function actionComments($command = false, $id = false, $commentCommand = false, $commentId = false)
    {
        if(Admin::checkAdmin()){
            $commentsAndLikes = Admin::getTotalCommentsAndLikes();

            $command = htmlspecialchars($command);
            $id = intval(htmlspecialchars($id));
            $commentCommand = htmlspecialchars($commentCommand);
            $commentId = intval(htmlspecialchars($commentId));
            $setLikes = false;
            $showComments = false;

            if($command == 'setLikes'){
                $setLikes = true;
                if(!empty($_POST['setLikes'])){
                    $quantity = intval(htmlspecialchars($_POST['likes']));
                    Admin::setLikes($quantity, $id);
                    header("Location: /admin/comments");
                }
            }

            if($command == 'showComments'){
                $showComments = true;
                $comments = Admin::getAllComments($id);

                if($commentCommand == 'hide'){
                    Admin::hideComment($id, $commentId);
                    header("Location: /admin/comments/$command/$id");
                }
                if($commentCommand == 'open'){
                    Admin::openComment($id, $commentId);
                    header("Location: /admin/comments/$command/$id");
                }
                if($commentCommand == 'delete'){
                    Admin::deleteComment($id, $commentId);
                    header("Location: /admin/comments/$command/$id");
                }
            }
        } else {
            die('access denied');
        }
        require_once (ROOT . '/views/admin/comments.php');
        return true;
    }

    public function actionUsers($command = false, $id = false)
    {
        if (Admin::checkAdmin()) {
            $users = Admin::getAllUsers();

            $command = htmlspecialchars($command);
            $id = intval(htmlspecialchars($id));
            $showUser = false;

            if ($command == 'show') {
                $showUser = true;
                $userDetails = Admin::getUserDetails($id);

                if (!empty($_POST['adminEditUser'])) {
                    $userName = htmlspecialchars($_POST['editUserName']);
                    $userSurname = htmlspecialchars($_POST['editUserSurname']);
                    $userLogin = htmlspecialchars($_POST['editUserLogin']);
                    $userEmail = htmlspecialchars($_POST['editUserEmail']);
                    $userPseudonym = htmlspecialchars($_POST['editUserPseudonym']);
                    $userMessage = htmlspecialchars($_POST['editUserMessageSelf']);

                    if (!empty($_FILES['editUserAvatar']['size'])) {
                        $tmpImage = $_FILES['editUserAvatar']['tmp_name']; //бинарный файл
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
                    $errors = User::fileValidate($tmpImage, $imageSize, $finalImageName, $fileUpload, 'avatar');

                    if (empty($errors)) {
                        if ($fileUpload) {
                            User::deleteImageWhileEdit($id, 'avatar');
                            User::uploadImage($tmpImage, $imageName, $imageFormat);
                        }
                        $editUser = Admin::editUser($userName, $userSurname, $userLogin, $userEmail, $userMessage, $userPseudonym,
                            $finalImageName, $id);
                        if ($editUser) {
                            header("Location: /admin/users");
                        }
                    }
                }
            }

            if($command == 'showPosts'){
                $showPosts = true;
                $userDetails = Admin::getUserDetails($id);
                $userPosts = Admin::getUserPosts($userDetails['userPseudonym']);
            }

            if($command == 'defaultAvatar'){
                Admin::setDefaultAvatar($id);
                header("Location: /admin/users");
            }

            if($command == 'deleteUser'){
                Admin::deleteUsers($id);
                header("Location: /admin/users");
            }

            if($command == 'banUser'){
                Admin::banUser($id);
                header("Location: /admin/users");
            }

            if($command == 'unbanUser'){
                Admin::unbanUser($id);
                header("Location: /admin/users");
            }
        } else {
                die('access denied');
            }
            require_once(ROOT . '/views/admin/users.php');
            return true;
        }
}