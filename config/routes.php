<?php
return
    [
        'news/([0-9]+)' => 'news/view/$1', //actionView в NewsController
        'page-([0-9]+)' => 'site/index/$1', //actionIndex в SiteController
        '' => 'site/index' //actionIndex в SiteController
    ];

