<?php

class SiteController
{
    public function actionIndex($page = 1)
    {
        $categories = Category::getCategories();
        $hotNews = News::getHotNews();
        $latestNews = News::getLatestNews();
        $news = News::getAllNews();

        //пагинация
        $total = News::getTotalNewsList();
        $pagination = new Pagination($total, $page, 3, 'page-');
        require_once (ROOT . '/views/site/index.php');
        return true;
    }
}