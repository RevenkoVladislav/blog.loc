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
            $userLogin = 'Здравствуй, ' . $_SESSION['userLogin'];
        } else {
            $userLogin = 'Добро пожаловать, гость';
        }

        //пагинация
        $nextPage = News::getNextPage($page);
        $prevPage = News::getPrevPage($page);

        require_once (ROOT . '/views/site/index.php');
        return true;
    }
}