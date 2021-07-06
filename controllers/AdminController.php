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
        if(Admin::checkAdmin()){

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
        if(Admin::checkAdmin()){
            header("Location: /admin");
        } else {
            if(!empty($_POST['adminSub'])){
                $login = htmlspecialchars($_POST['adminLogin']);
                $pass = htmlspecialchars($_POST['adminPass']);

                if(Admin::authAdmin($login, $pass)){
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
        if(Admin::checkAdmin()) {
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
        if(Admin::checkAdmin()){
            $categories = Admin::getAllCategory();

            $command = htmlspecialchars($command);

            if($command == 'hide'){
                Admin::hideCategory($id);
                header("Location: /admin/category");
            }

            if($command == 'open'){
                Admin::openCategory($id);
                header("Location: /admin/category");
            }

            if($command == 'delete'){
                Admin::deleteCategory($id);
                header("Location: /admin/category");
            }

            if(!empty($_POST['addCategory'])){
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

    public function actionNews()
    {
        if(Admin::checkAdmin()){
            $news = Admin::getAllNews();

        } else {
            die('access denied');
        }
        require_once (ROOT . '/views/admin/news.php');
        return true;
    }
}