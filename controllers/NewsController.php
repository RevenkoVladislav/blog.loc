<?php

class NewsController
{
    public function actionView($id){
        $categories = Category::getCategories();
        
        if($id) {
            $newsById = News::getNewsById($id);

            if(empty($newsById)){
                $newsById = false;
            } else {
                $newsById['state'] = News::renderStateText($newsById['state']);
                $comments = News::getAllComments($id);
            }


            require_once (ROOT . '/views/news/single.php');
        }
        return true;
    }

}