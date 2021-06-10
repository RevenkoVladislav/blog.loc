<?php

/**
 * CRUD админ панель
 */
class AdminController
{
    public function actionIndex()
    {
        /*
        if(Admin::checkAdmin()){

        } else {
            die('access denied');
        }
*/
        require_once(ROOT . '/views/admin/index.php');
        return true;
    }

    public function actionEnter()
    {

        require_once(ROOT . '/views/admin/enter.php');
        return true;
    }

    public function actionRegister()
    {
        if(!empty($_POST['newAdminSub'])){
            $login = htmlspecialchars($_POST['Login']);
            $pass = htmlspecialchars($_POST['Pass']);

            $errors = Admin::validateAdminRegister($login, $pass);

            if(empty($errors)) {
                $register = Admin::registerAdmin($login, $pass);
                if ($register) {
                    header("Location: /admin");
                }
            }
        }
        require_once(ROOT . '/views/admin/register.php');
        return true;
    }
}