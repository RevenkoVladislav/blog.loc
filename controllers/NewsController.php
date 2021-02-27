<?php

require_once (ROOT . '/models/News.php');

class NewsController
{
    public function actionIndex()
    {
        $news = News::getAllNews();
        require_once (ROOT . '/views/index.html');
        return true;
    }

    public function actionView($id){
        if($id) {
            $newsById = News::getNewsById($id);
            require_once (ROOT . '/views/single.html');
        }
        return true;
    }

}