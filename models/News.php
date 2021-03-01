<?php

class News
{
    const SHOW_NEWS = 3;

    public static function getAllNews($page)
    {
        $page = intval($page);

        if($page >= 0){
            $page = 1;
        }

        $db = DB::dbConnection();
        $offset = ($page - 1) * self::SHOW_NEWS;
        $result = $db->query("SELECT id,author,stateDescription, stateName, stateCategory, stateDate, likes FROM `blog.loc`.news WHERE status = '1' ORDER BY stateDate LIMIT " . self::SHOW_NEWS . " OFFSET " . $offset);
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
        }
        return $news;
    }

    public static function getNewsById($id)
    {
        $id = intval($id);
        if($id){
            $db = DB::dbConnection();
            $result = $db->query("SELECT * FROM `blog.loc`.news WHERE id='$id'");
            $newsById = $result->fetch();
            //добавить проверку существования по id, если нет то либо редирект, либо просто не открывать статью, либо ошибку 404
            return $newsById;
        }
    }

    public static function getHotNews()
    {
        $db = DB::dbConnection();
        $result = $db->query("SELECT id, author, stateName, stateDescription FROM `blog.loc`.news ORDER BY likes DESC LIMIT 5");
        $hotNews = [];

        for($i = 0; $row = $result->fetch(); $i++){
            $hotNews[$i]['id'] = $row['id'];
            $hotNews[$i]['author'] = $row['author'];
            $hotNews[$i]['stateName'] = $row['stateName'];
            $hotNews[$i]['stateDescription'] = substr($row['stateDescription'], '0', '15') . '...';
        }
        return $hotNews;
    }

    public static function getLatestNews()
    {
        $db = DB::dbConnection();
        $result = $db->query("SELECT id, stateName, stateDate FROM `blog.loc`.news ORDER BY stateDate DESC LIMIT 5");
        $latestNews = [];

        for($i = 0; $row = $result->fetch(); $i++){
            $latestNews[$i]['id'] = $row['id'];
            $latestNews[$i]['stateName'] = $row['stateName'];
            $latestNews[$i]['stateDate'] = $row['stateDate'];
        }
        return $latestNews;
    }

    public static function getTotalNewsList()
    {
        $db = DB::dbConnection();
        $result = $db->query("SELECT count(id) AS count FROM `blog.loc`.news WHERE status='1'");
        $row = $result->fetch();
        $count = ceil($row['count'] / self::SHOW_NEWS);
        return $count;
    }

    public static function getNextPage($page)
    {
        $total = self::getTotalNewsList();
        $linkNext = '';
        if($page < $total){
            ++$page;
            $linkNext = "<li><a href='/page-$page' class='button big next'>Next Page</a></li>";
        } elseif ($page == $total){
            $linkNext = '<li><a href="" class="disabled button big next">Next Page</a></li>';
        }
        return $linkNext;
    }

    public static function getPrevPage($page)
    {
        $total = self::getTotalNewsList();
        $linkPrev = '';
        if($page != 1){
            --$page;
            $linkPrev = "<li><a href='/page-$page' class='button big previous'>Previous Page</a></li>";
        } elseif ($page == 1){
            $linkPrev = "<li><a href='' class='disabled button big previous'>Previous Page</a></li>";
        }
        return $linkPrev;
    }
}