<?php

class Category
{
    public static function getCategories()
    {
        $db = DB::dbConnection();
        $result = $db->query("SELECT id, categoryName FROM `blog.loc`.category WHERE categoryAvailability = '1'");
    }

}