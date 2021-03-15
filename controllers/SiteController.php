<?php

class SiteController
{
    public function actionIndex($page = 1)
    {
        $categories = Category::getCategories();

        //получаем статьи с большим кол-вом лайков
        $hotNews = News::getHotNews();

        //получаем последние (по дате) статьи
        $latestNews = News::getLatestNews();

        //все статьи получаем
        $news = News::getAllNews($page);

        if(User::checkAuth()) {
            $userPseudonym = 'Welcome, ' . $_SESSION['userPseudonym'];
        } else {
            $userPseudonym = 'Welcome, guest';
        }

        //пагинация
        $nextPage = News::getNextPage($page);
        $prevPage = News::getPrevPage($page);

        require_once (ROOT . '/views/site/index.php');
        return true;
    }
}