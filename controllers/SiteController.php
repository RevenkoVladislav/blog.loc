<?php

class SiteController
{
    public function actionIndex()
    {
        $categories = Category::getCategories();
        $hotNews = News::getHotNews();
        $latestNews = News::getLatestNews();
        $news = News::getAllNews();
        require_once (ROOT . '/views/site/index.php');
        return true;
    }
}