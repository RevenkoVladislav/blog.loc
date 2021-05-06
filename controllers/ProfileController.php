<?php

/**
 * Контроллер для просмотра чужого профиля
 */
class ProfileController
{
    public function actionIndex()
    {
        header("Location: /");
        return true;
    }

    public function actionView($id)
    {
        /**
         * Если мы переходим к просмотру своего профиля то переходим в ЛК
         */
        if(User::checkAuth() AND $id == $_SESSION['userId']){
            header("Location: /user/cabinet");
        }

        /**
         * Получаем данные пользователя и публикации пользователя
         */
        $profileData = User::getProfileUserData($id);
        $userPublications = User::getUserPublication($profileData['userPseudonym']);

        $categories = Category::getCategories();

        require_once (ROOT . '/views/profile/view.php');
        return true;
    }
}