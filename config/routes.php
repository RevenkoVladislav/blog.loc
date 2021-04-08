<?php
return
    [
        'profile/([0-9]+)' => 'profile/view/$1', //actionView в ProfileController
        'profile' => 'profile/index', //actionIndex в ProfileController

        'user/edit/([0-9]+)' => 'user/edit/$1', //actionEdit в UserController
        'user/cabinet/([a-z]+)' => 'user/cabinet/$1', //actionCabinet в UserController
        'user/cabinet' => 'user/cabinet', //actionCabinet в UserController
        'user/register' => 'user/register', //actionRegister в UserController
        'user/login' => 'user/login', //actionLogin в UserController
        'user/logout' => 'user/logout', //actionLogout в UserController
        'user/publication' => 'user/publication', //actionPublication в UserController

        'news/like/([0-9]+)' => 'news/like/$1', //actionLike в NewsController
        'news/([0-9]+)/([0-1])' => 'news/view/$1/$2', //actionView в NewsController с добавлением Like
        'news/([0-9]+)' => 'news/view/$1', //actionView в NewsController

        'category/([a-z]+)/page-([0-9])' => 'category/index/$1/$2', //actionIndex в CategoryController
        'category/([a-z]+)' => 'category/index/$1', //actionIndex в CategoryController

        'page-([0-9]+)' => 'site/index/$1', //actionIndex в SiteController
        '' => 'site/index' //actionIndex в SiteController
    ];

