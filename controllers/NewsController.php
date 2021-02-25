<?php

class NewsController
{
    public function actionIndex()
    {
        echo "actionIndex";
        return true;
    }

    public function actionView($id){
        echo 'actionView ' . $id ;
        return true;
    }

}