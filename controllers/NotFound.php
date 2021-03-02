<?php
/**
 * Created by PhpStorm.
 * User: Геральт
 * Date: 02.03.2021
 * Time: 7:34
 */

class NotFound
{
    public function actionIndex()
    {
        require_once (ROOT . '/views/errors/notfound.php');
    }
}