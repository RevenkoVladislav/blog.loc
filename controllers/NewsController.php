<?php

/**
 * Контроллер для одиночной страницы с новостью
 */
class NewsController
{
    public function actionView($id, $like = 0){
        $categories = Category::getCategories();

        /**
         * Получаем страницу по id, если id Не существует то получаем ошибку страницу.
         */
        if($id) {
            $newsById = News::getNewsById($id);

            if(empty($newsById)){
                $newsById = false;
            } else {
                //рендер текста для переноса строк
                $newsById['state'] = News::renderStateText($newsById['state']);
                $comments = News::getAllComments($id);
                $checkAuth = User::checkAuth();

                /**
                 * если авторизованный пользователь это автор статьи, то доступна кнопка для перехода к редактированию
                 */

                if ($checkAuth) {
                    if ($newsById['author'] == $_SESSION['userPseudonym']) {
                        $edit = true;
                    } else {
                        $edit = false;
                    }
                }

                //отправка комментария, валидация, рефреш страницы для обновления комментариев.
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

                    //система лайков без JS, проверка по двум таблицам БД, рефреш с таргетом по id в Html
                    if ($like == 2 AND $checkAuth === true AND $likeCount === false) {
                        News::like($id, $author);
                        header("Refresh:0; url=/news/$id" . "#like");
                    }

                    if ($like == 1 AND $checkAuth === true AND $likeCount === true) {
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