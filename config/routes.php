<?php
return
    [
        'news/([0-9]+)' => 'news/view/$1', //actionView в NewsController
        '' => 'site/index' //actionIndex в SiteController
    ];

