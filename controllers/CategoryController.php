<?php

class CategoryController
{
    public function actionIndex($categoryName, $page = 1)
    {
        $categories = Category::getCategories();

        //получаем статьи с большим кол-вом лайков
        $hotNews = News::getHotNews();

        //получаем последние (по дате) статьи
        $latestNews = News::getLatestNews();

        //получаем все статьи по категории
        $news = News::getAllNewsByCategory($categoryName, $page);

        //пагинация
        $nextPage = News::getNextPageForCategory($categoryName, $page);
        $prevPage = News::getPrevPageForCategory($categoryName, $page);

        require_once (ROOT . '/views/category/index.php');
        return true;
    }
}