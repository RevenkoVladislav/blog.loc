<?php

class News
{
    public static function getAllNews()
    {
        $db = DB::dbConnection();
        $result = $db->query("SELECT id, author, stateDescription, stateName, stateCategory, stateDate FROM `blog.loc`.news ORDER BY stateDate LIMIT 5");

        for($i = 0; $row = $result->fetch(); $i++){
            $news[$i]['id'] = $row['id'];
            $news[$i]['author'] = $row['author'];
            $news[$i]['stateDescription'] = $row['stateDescription'];
            $news[$i]['stateName'] = $row['stateName'];
            $news[$i]['stateCategory'] = $row['stateCategory'];
            $news[$i]['stateDate'] = $row['stateDate'];
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

}