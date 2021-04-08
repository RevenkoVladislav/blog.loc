<?php

class NewsController
{
    public function actionView($id, $like = 0){
        $categories = Category::getCategories();
        
        if($id) {
            $newsById = News::getNewsById($id);

            if(empty($newsById)){
                $newsById = false;
            } else {
                $newsById['state'] = News::renderStateText($newsById['state']);
                $comments = News::getAllComments($id);
                $checkAuth = User::checkAuth();

                if ($checkAuth) {
                    if ($newsById['author'] == $_SESSION['userPseudonym']) {
                        $edit = true;
                    } else {
                        $edit = false;
                    }
                }


                if ($checkAuth) {
                    $author = $_SESSION['userPseudonym'];

                    if (!empty($_POST['commentSend'])) {
                        $comment = htmlspecialchars($_POST['comment']);
                        $commentDate = date("Y-m-d h:i:s", time());

                        $result = News::sendComment($author, $comment, $commentDate, $id);

                        if ($result) {
                            header("Refresh:0");
                        }
                    }

                    $likeCount = News::getLike($id, $author);

                    if ($like == 2 AND $checkAuth === true AND $likeCount === false) {
                        News::like($id, $author);
                        header("Refresh:0; url=/news/$id" . "#like");
                    }

                    if ($like == 1 AND $checkAuth === true AND $likeCount == true) {
                        News::unlike($id, $author);
                        header("Refresh:0; url=/news/$id" . "#like");
                    }
                }
            }

            require_once (ROOT . '/views/news/single.php');
        }
        return true;
    }

}