<?php

class NewsController
{
    public function actionIndex()
    {

    }

    public function actionView($id){
        if($id) {
            $newsById = News::getNewsById($id);
            require_once (ROOT . '/views/news/single.php');
        }
        return true;
    }

}