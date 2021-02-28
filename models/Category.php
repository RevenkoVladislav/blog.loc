<?php

class Category
{
    public static function getCategories()
    {
        $db = DB::dbConnection();
        $result = $db->query("SELECT id, categoryName FROM `blog.loc`.category WHERE categoryAvailability = '1'");
        for($i = 0; $row = $result->fetch(); $i++){
            $categories[$i]['id'] = $row['id'];
            $categories[$i]['categoryName'] = $row['categoryName'];
        }
        return $categories;
    }

}