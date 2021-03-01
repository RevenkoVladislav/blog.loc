<?php

class SiteController
{
    public function actionIndex($page = 1)
    {
        $categories = Category::getCategories();
        $hotNews = News::getHotNews();
        $latestNews = News::getLatestNews();
        $news = News::getAllNews($page);

        //пагинация
        $nextPage = News::getNextPage($page);
        $prevPage = News::getPrevPage($page);

        require_once (ROOT . '/views/site/index.php');
        return true;
    }
}