<?php

class NewsController
{
    public function actionView($id){
        $categories = Category::getCategories();
        
        if($id) {
            $newsById = News::getNewsById($id);
            require_once (ROOT . '/views/news/single.php');
        }
        return true;
    }

}