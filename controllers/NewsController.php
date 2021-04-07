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
                $checkAuth = User::checkAuth();

                if($checkAuth){
                    if($newsById['author'] == $_SESSION['userPseudonym']){
                        $edit = true;
                    } else {
                        $edit = false;
                    }
                }

                if(!empty($_POST['commentSend'])){
                    $comment = htmlspecialchars($_POST['comment']);
                    $commentDate = date("Y-m-d h:i:s", time());
                    $author = $_SESSION['userPseudonym'];

                    $result = News::sendComment($author, $comment, $commentDate, $id);

                    if($result){
                        header("Refresh:0");
                    }
                }
            }


            require_once (ROOT . '/views/news/single.php');
        }
        return true;
    }

}