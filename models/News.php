<?php

class News
{
    public static function getAllNews()
    {
        $db = DB::dbConnection();
        $result = $db->query("SELECT id, author, stateDescription, stateName, stateCategory, stateDate, stateCategory, likes FROM `blog.loc`.news ORDER BY stateDate LIMIT 5");
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
        $result = $db->query("SELECT id, stateName, stateDate FROM `blog.loc`.news ORDER BY stateDate LIMIT 3");
        $latestNews = [];

        for($i = 0; $row = $result->fetch(); $i++){
            $latestNews[$i]['id'] = $row['id'];
            $latestNews[$i]['author'] = $row['stateName'];
            $latestNews[$i]['stateName'] = $row['stateDate'];
        }
        return $latestNews;
    }

}