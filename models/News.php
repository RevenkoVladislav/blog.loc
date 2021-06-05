<?php

class News
{
    const SHOW_NEWS = 3;

    public static function getAllNews($page, $userAuthor = false)
        /**
         * Получаем все новости,
         * если пользователь авторизован получаем поставвленные пользователем лайки
         */
    {
        $offset = self::getOffset($page);

        $db = DB::dbConnection();
        $result = $db->query("SELECT id, author, stateDescription, stateName, stateCategory, stateDate, likes, imagePath FROM `blog.loc`.news WHERE status = '1' ORDER BY stateDate LIMIT " . self::SHOW_NEWS . " OFFSET " . $offset);

        $news = [];
        for($i = 0; $row = $result->fetch(); $i++){
            $news[$i]['id'] = $row['id'];
            $news[$i]['author'] = $row['author'];
            $news[$i]['stateDescription'] = $row['stateDescription'];
            $news[$i]['stateName'] = $row['stateName'];
            $news[$i]['stateCategory'] = $row['stateCategory'];
            $news[$i]['stateDate'] = $row['stateDate'];
            $news[$i]['stateCategory'] = $row['stateCategory'];
            $news[$i]['likes'] = $row['likes'];
            $news[$i]['userId'] = User::getAuthorId($row['author']);
            $news[$i]['comments'] = self::getTotalComments($row['id']);
            $news[$i]['imagePath'] = $row['imagePath'];
            $news[$i]['userAvatar'] = User::getUserAvatar($row['author']);
            if($userAuthor != false){
                $news[$i]['isArticleLike'] = self::getLike($row['id'], $userAuthor);
            }
        }
        return $news;
    }

    public static function getAllNewsByCategory($category, $page, $userAuthor = false)
        /**
         * получаем все статьи по категориям,
         * если пользователь авторизован получаем поставвленные пользователем лайки
         */
    {
        $category = htmlspecialchars($category);
        $offset = self::getOffset($page);

        $db = DB::dbConnection();
        $result = $db->query("SELECT id, author, stateDescription, stateName, stateCategory, stateDate, likes, imagePath FROM `blog.loc`.news WHERE status = '1' AND stateCategory = '$category' ORDER BY stateDate LIMIT " . self::SHOW_NEWS . " OFFSET " . $offset);

        $news = [];
        for($i = 0; $row = $result->fetch(); $i++){
            $news[$i]['id'] = $row['id'];
            $news[$i]['author'] = $row['author'];
            $news[$i]['stateDescription'] = $row['stateDescription'];
            $news[$i]['stateName'] = $row['stateName'];
            $news[$i]['stateCategory'] = $row['stateCategory'];
            $news[$i]['stateDate'] = $row['stateDate'];
            $news[$i]['stateCategory'] = $row['stateCategory'];
            $news[$i]['likes'] = $row['likes'];
            $news[$i]['stateImage'] = $row['imagePath'];
            $news[$i]['userId'] = User::getAuthorId($row['author']);
            $news[$i]['comment'] = self::getTotalComments($row['id']);
            if($userAuthor != false){
                $news[$i]['isArticleLike'] = self::getLike($row['id'], $userAuthor);
            }
        }
        return $news;
    }

    public static function getNewsById($id)
        /**
         * Получаем одну статью по id
         */
    {
        $id = intval($id);
        if($id){
            $db = DB::dbConnection();
            $result = $db->query("SELECT * FROM `blog.loc`.news WHERE id = '$id'")->fetch();

            if(empty($result)){
                return false;
            }

            $result['userId'] = User::getAuthorId($result['author']);
            $result['comment'] = News::getTotalComments($result['id']);
            return $result;
        }
    }

        public static function getHotNews()
            /**
             * Получаем горячие новости (где больше лайков)
             */
    {
        $db = DB::dbConnection();
        $result = $db->query("SELECT id, author, stateName, stateDescription, imagePath FROM `blog.loc`.news ORDER BY likes DESC LIMIT 5");
        $hotNews = [];

        for($i = 0; $row = $result->fetch(); $i++){
            $hotNews[$i]['id'] = $row['id'];
            $hotNews[$i]['author'] = $row['author'];
            $hotNews[$i]['stateName'] = $row['stateName'];
            $hotNews[$i]['stateDescription'] = substr($row['stateDescription'], '0', '25') . '...';
            $hotNews[$i]['stateImage'] = $row['imagePath'];
        }
        return $hotNews;
    }

    public static function getLatestNews()
        /**
         * Получаем последние статьи, по дате и времени
         */
    {
        $db = DB::dbConnection();
        $result = $db->query("SELECT id, stateName, stateDate, imagePath FROM `blog.loc`.news ORDER BY stateDate DESC LIMIT 5");
        $latestNews = [];

        for($i = 0; $row = $result->fetch(); $i++){
            $latestNews[$i]['id'] = $row['id'];
            $latestNews[$i]['stateName'] = $row['stateName'];
            $latestNews[$i]['stateDate'] = $row['stateDate'];
            $latestNews[$i]['stateImage'] = $row['imagePath'];
        }
        return $latestNews;
    }

    public static function getTotalNewsList()
        /**
         * Получаем общее количество новостей
         */
    {
        $db = DB::dbConnection();
        $result = $db->query("SELECT count(id) AS count FROM `blog.loc`.news WHERE status='1'");
        $row = $result->fetch();
        $count = ceil($row['count'] / self::SHOW_NEWS);
        return $count;
    }

    public static function getTotalNewsListByCategory($category)
        /**
         * Получаем общее количество новостей по категориям
         */
    {
        $category = htmlspecialchars($category);

        $db = DB::dbConnection();
        $result = $db->query("SELECT count(id) AS count FROM `blog.loc`.news WHERE status='1' AND stateCategory = '$category'");
        $row = $result->fetch();
        $count = ceil($row['count'] / self::SHOW_NEWS);
        return $count;
    }

    public static function getNextPage($page)
        /**
         * Метод для вывода пагинации следующей страницы
         */
    {
        $total = self::getTotalNewsList();
        $linkNext = '';
        if($page < $total){
            ++$page;
            $linkNext = "<li><a href='/page-$page' class='button big next'>Next Page</a></li>";
        } elseif ($page == $total){
            $linkNext = "<li><a href='/page-$page' class='disabled button big next'>Next Page</a></li>";
        } elseif ($page > $total){
            header("Location: /page-$total");
        }
        return $linkNext;
    }

    public static function getPrevPage($page)
        /**
         * Метод для вывода пагинации предыдущей страницы
         */
    {
        $linkPrev = '';
        if($page > 1 AND $page > 0){
            --$page;
            $linkPrev = "<li><a href='/page-$page' class='button big previous'>Previous Page</a></li>";
        } elseif ($page < 1 OR $page < 0){
            $linkPrev = "<li><a href='/page-$page' class='disabled button big previous'>Previous Page</a></li>";
        }
        return $linkPrev;
    }

    public static function getNextPageForCategory($category, $page)
        /**
         * Метод для вывода следующей страницы с учетом категории
         */
    {
        $total = self::getTotalNewsListByCategory($category);
        $linkNext = '';
        if($page < $total){
            ++$page;
            $linkNext = "<li><a href='/category/$category/page-$page' class='button big next'>Next Page</a></li>";
        } elseif ($page == $total){
            $linkNext = "<li><a href='/category/$category/page-$page' class='disabled button big next'>Next Page</a></li>";
        } elseif ($page > $total) {
            header("Location: /category/$category/page-$total");
        }
        return $linkNext;
    }

    public static function getPrevPageForCategory($category, $page)
        /**
         * Метод для вывода предыдущей страницы с учетом категории
         */
    {
        $linkPrev = '';
        if($page > 1 AND $page > 0){
            --$page;
            $linkPrev = "<li><a href='/category/$category/page-$page' class='button big previous'>Previous Page</a></li>";
        } elseif ($page < 1 OR $page < 0){
            $linkPrev = "<li><a href='/category/$category/page-$page' class='disabled button big previous'>Previous Page</a></li>";
        }
        return $linkPrev;
    }

    private static function getOffset($page)
        /**
         * Получаем оффсет для формирования пагинации
         */
    {
        $page = intval($page);

        if($page <= 0){
            $page = 1;
        }

        $offset = ($page - 1) * self::SHOW_NEWS;

        return $offset;
    }

    public static function renderStateText($state)
        /**
         * Рендер текста для корректного отображения в блоке,
         * Формируется перенос строки при достижении Заданого $counter
         */
    {
        $len = strlen($state);
        $counter = 0;
        $placeToAddSymbol = 0;
        for($i = 0; $i != $len; $i++){
            if($counter == 170){
                if($placeToAddSymbol == 0){
                    $placeToAddSymbol += $counter;
                }
                else{
                    $placeToAddSymbol += $counter + 4;
                }
                $state = substr_replace($state, "<br>", $placeToAddSymbol, 0);
                $counter = 0;
            }
            $counter++;
        }
        return $state;
    }

    public static function getAllComments($id)
        /**
         * Получаем все комментарии для статьи,
         * по @id статьи
         */
    {
        $db = DB::dbConnection();

        $result = $db->query("SELECT * FROM `blog.loc_comments`.`{$id}_comments` WHERE `status` = '1' ORDER BY `publishedDate` DESC");

        $comments = [];
            for($i = 0; $row = $result->fetch(); $i++){
                $comments[$i]['id'] = $row['id'];
                $comments[$i]['author'] = $row['author'];
                $comments[$i]['comment'] = $row['comment'];
                $comments[$i]['publishedDate'] = $row['publishedDate'];
                $comments[$i]['userId'] = User::getAuthorId($row['author']);
            }
        return $comments;
    }

    public static function sendComment($author, $comment, $commentDate, $stateId)
        /**
         * Отправляем комментарий
         */
    {
        $db = DB::dbConnection();

        $query = "INSERT INTO `blog.loc_comments`.`{$stateId}_comments` SET author = '$author', comment = '$comment', publishedDate = '$commentDate'";

        if($db->query($query)){
            return true;
        } else {
            return false;
        }
    }

    private static function getTotalComments($id)
        /**
         * Получаем количество всех комментариев по @id статьи
         */
    {
        $db = DB::dbConnection();

        $result = $db->query("SELECT count(*) FROM `blog.loc_comments`.`{$id}_comments` WHERE `status` = '1'")->fetchColumn();

        return $result;
    }

    public static function like($id, $author)
        /**
         * Метод для лайка,
         * Происходит проверка лайка статьи по @id от пользователя @author
         */
    {
        $db = DB::dbConnection();

        if(self::checkLike($id, $author)){
            $db->query("UPDATE `blog.loc_likes`.`{$author}_likes` SET `user_likes` = '1' WHERE `news_id` = '$id'");
        } else {
            $db->query("INSERT INTO `blog.loc_likes`.`{$author}_likes` SET `news_id` = '$id', `user_likes` = '1'");
        }
        $db->query("UPDATE `blog.loc`.news SET likes = likes+1 WHERE id ='$id'");
    }

    public static function getLike($id, $author)
        /**
         * Получаем все лайки по @id от @author для отображения
         */
    {
        $db = DB::dbConnection();

        $result = $db->query("SELECT `user_likes` FROM `blog.loc_likes`.`{$author}_likes` WHERE `news_id` ='$id'")->fetch();

        if($result['user_likes'] == 1){
            return true;
        } else {
            return false;
        }
    }

    public static function unlike($id, $author)
        /**
         * Дизлайк,
         * Происходит проверка лайка статьи по @id от пользователя @author
         */
    {
        $db = DB::dbConnection();

        $likeNews = $db->query("UPDATE `blog.loc`.news SET likes = likes-1 WHERE id ='$id'");

        if(self::checkLike($id, $author)) {
            $db->query("UPDATE `blog.loc_likes`.`{$author}_likes` SET `user_likes` = '0' WHERE `news_id` = '$id'");
        }
    }

    private static function checkLike($id, $author)
        /**
         * Проверка, есть ли лайк от @author для статьи по @id
         */
    {
        $db = DB::dbConnection();

        $result = $db->query("SELECT * FROM `blog.loc_likes`.`{$author}_likes` WHERE `news_id` ='$id'")->fetch();

        if($result){
            return true;
        } else {
            return false;
        }
    }
}