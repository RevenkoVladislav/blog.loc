<?php
/**
 * Класс отвечающий за вывод статей по категориям
 */

class CategoryController
{
    public function actionIndex($categoryName, $page = 1)
    {
        $checkAuth = User::checkAuth();

        if($checkAuth) {
            $userPseudonym = 'Welcome, ' . $_SESSION['userPseudonym'];
            $userAuthor = $_SESSION['userPseudonym'];
            $userAvatar = User::getUserAvatar($userAuthor);
        } else {
            $userPseudonym = 'Welcome, guest';
            $userAuthor = false;
        }

        //получаем категории
        $categories = Category::getCategories();

        //получаем статьи с большим кол-вом лайков
        $hotNews = News::getHotNews();

        //получаем последние (по дате) статьи
        $latestNews = News::getLatestNews();

        //получаем все статьи по категории
        $news = News::getAllNewsByCategory($categoryName, $page, $userAuthor);

        //пагинация
        $nextPage = News::getNextPageForCategory($categoryName, $page);
        $prevPage = News::getPrevPageForCategory($categoryName, $page);

        require_once (ROOT . '/views/category/index.php');
        return true;
    }
}