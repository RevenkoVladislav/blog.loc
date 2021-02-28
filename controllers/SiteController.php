<?php

class SiteController
{
    public function actionIndex()
    {
        $categories = Category::getCategories();
        $news = News::getAllNews();
        require_once (ROOT . '/views/site/index.php');
        return true;
    }
}