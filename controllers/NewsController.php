<?php

class NewsController
{
    public function actionIndex()
    {
        echo "actionIndex";
        return true;
    }

    public function actionView(){
        echo 'actionView';
        return true;
    }

}