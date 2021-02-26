<?php

require_once (ROOT . '/models/News.php');

class NewsController
{
    public function actionIndex()
    {
        //echo "actionIndex <br>";
        $news = News::getAllNews();
        require_once (ROOT . '/views/index.html');
        return true;
    }

    public function actionView($id){
        if($id) {
            echo 'actionView ' . $id . "<br>";
            $newsById = News::getNewsById($id);
            echo "<pre>";
            print_r($newsById);
            echo "</pre>";
        }
        return true;
    }

}