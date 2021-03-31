<?php

class ProfileController
{
    public function actionIndex()
    {
        header("Location: /");
        return true;
    }

    public function actionView($id)
    {
        if(User::checkAuth() AND $id == $_SESSION['userId']){
            header("Location: /user/cabinet");
        }
        $profileData = User::getProfileUserData($id);
        $userPublications = User::getUserPublication($profileData['userPseudonym']);

        $categories = Category::getCategories();

        require_once (ROOT . '/views/profile/view.php');
        return true;
    }
}