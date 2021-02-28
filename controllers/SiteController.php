<?php

require_once (ROOT . '/models/News.php');
require_once (ROOT . '/models/Category.php');

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