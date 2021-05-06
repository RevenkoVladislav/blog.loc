<?php

/**
 * Контроллер главной страницы
 */
class SiteController
{
    public function actionIndex($page = 1)
    {
        $checkAuth = User::checkAuth();
        if($checkAuth) {
            $userPseudonym = 'Welcome, ' . $_SESSION['userPseudonym'];
            $userAuthor = $_SESSION['userPseudonym'];
        } else {
            $userPseudonym = 'Welcome, guest';
            $userAuthor = false;
        }

        $categories = Category::getCategories();

        //получаем статьи с большим кол-вом лайков
        $hotNews = News::getHotNews();

        //получаем последние (по дате) статьи
        $latestNews = News::getLatestNews();

        //все статьи получаем
        $news = News::getAllNews($page, $userAuthor);

        //пагинация
        $nextPage = News::getNextPage($page);
        $prevPage = News::getPrevPage($page);

        require_once (ROOT . '/views/site/index.php');
        return true;
    }
}