<?php

require_once (ROOT . '/models/News.php');
require_once (ROOT . '/models/Category.php');

class NewsController
{
    public function actionIndex()
    {
        $categories = Category::getCategories();
        $news = News::getAllNews();
        require_once (ROOT . '/views/news/index.php');
        return true;
    }

    public function actionView($id){
        if($id) {
            $newsById = News::getNewsById($id);
            require_once (ROOT . '/views/news/single.php');
        }
        return true;
    }

}