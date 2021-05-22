<?php

class NotFound
{
    public function actionIndex()
    {
        require_once (ROOT . '/views/errors/notfound.php');
    }
}