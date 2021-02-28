<?php require_once(ROOT . '/views/layouts/header.php');?>
    <body>
    <!-- Wrapper -->
<div id="wrapper">
    <!-- Header -->
    <header id="header">
        <h1><a href="#">Резервированный блок</a></h1>
        <nav class="links">
            <ul>
                <?php foreach($categories as $category):?>
                    <li><a href="/<?=$category['id'];?>"><?=$category['categoryName'];?></a></li>
                <?php endforeach; ?>
            </ul>
        </nav>
        <nav class="main">
            <ul>
                <!--<li class="search">
                    <a class="fa-search" href="#search">Search</a>
                    <form id="search" method="get" action="#">
                        <input type="text" name="query" placeholder="Search" />
                    </form>
                </li>-->
                <li class="menu">
                    <a class="fa-bars" href="#menu">Menu</a>
                </li>
            </ul>
        </nav>
    </header>

    <!-- Menu -->
    <section id="menu">
        <!-- Search -->
        <!--<section>
            <form class="search" method="get" action="#">
                <input type="text" name="query" placeholder="Search" />
            </form>
        </section>-->
        <!-- Links -->
        <section>
            <ul class="links">
                <li>
                    <a href="#">
                        <h3>Возможно сюда лк</h3>
                        <p>Feugiat tempus veroeros dolor</p>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <h3>Регистрация и т.д</h3>
                        <p>Sed vitae justo condimentum</p>
                    </a>
                </li>
            </ul>
        </section>

        <!-- Actions -->
        <section>
            <ul class="actions vertical">
                <li><a href="#" class="button big fit">Log In</a></li>
            </ul>
        </section>
    </section>

    <!-- Main -->
    <div id="main">
        <!-- Post -->
        <?php foreach($news as $newsItem):?>
            <article class="post">
                <header>
                    <div class="title">
                        <h2><a href="#"><?=$newsItem['stateName'];?></a></h2>
                        <p>Category: <?=$newsItem['stateCategory'];?></p>
                    </div>
                    <div class="meta">
                        <time class="published" datetime="<?=$newsItem['stateDate'];?>"><?=$newsItem['stateDate'];?></time>
                        <a href="#" class="author"><span class="name"><?=$newsItem['author'];?></span><img src="/views/images/avatar.jpg" alt="" /></a>
                    </div>
                </header>
                <a href="#" class="image featured"><img src="/views/images/pic01.jpg" alt="" /></a>
                <p><?=$newsItem['stateDescription'];?>Модифицировать модель и обрезать полную статью после 10-20 слов</p>
                <footer>
                    <ul class="actions">
                        <li><a href="#" class="button big">Continue Reading</a></li>
                    </ul>
                    <ul class="stats">
                        <li><a href="#">General</a></li>
                        <li><a href="#" class="icon fa-heart">28</a></li>
                        <li><a href="#" class="icon fa-comment">128</a></li>
                    </ul>
                </footer>
            </article>
        <?php endforeach; ?>

        <!-- Pagination -->
        <ul class="actions pagination">
            <li><a href="" class="disabled button big previous">Previous Page</a></li>
            <li><a href="#" class="button big next">Next Page</a></li>
        </ul>
    </div>

    <!-- Sidebar -->
    <section id="sidebar">
        <!-- Intro -->
        <section id="intro">
            <a href="#" class="logo"><img src="/views/images/logo.jpg" alt="" /></a>
            <header>
                <h2>Имя пользователя</h2>
                <p>Ссылка на профиль <a href="http://html5up.net">HTML5 UP</a></p>
            </header>
        </section>

        <!-- Mini Posts -->
        <section>
            <div class="mini-posts">
                <h2>Горячие новости (ранжировка 5 статей по кол-ву лайков)</h2>
                <!-- Mini Post -->
                <article class="mini-post">
                    <header>
                        <h3><a href="#">Vitae sed condimentum</a></h3>
                        <time class="published" datetime="2015-10-20">October 20, 2015</time>
                        <a href="#" class="author"><img src="/views/images/avatar.jpg" alt="" /></a>
                    </header>
                    <a href="#" class="image"><img src="/views/images/pic04.jpg" alt="" /></a>
                </article>
            </div>
        </section>

        <!-- Posts List -->
        <section>
            <h2>Последние новости (ранжировка из 3-5 статей по дате)</h2>
            <ul class="posts">
                <li>
                    <article>
                        <header>
                            <h3><a href="#">Lorem ipsum fermentum ut nisl vitae</a></h3>
                            <time class="published" datetime="2015-10-20">October 20, 2015</time>
                        </header>
                        <a href="#" class="image"><img src="/views/images/pic08.jpg" alt="" /></a>
                    </article>
                </li>
            </ul>
        </section>

        <!-- About -->
        <section class="blurb">
            <h2>About</h2>
            <p>Mauris neque quam, fermentum ut nisl vitae, convallis maximus nisl. Sed mattis nunc id lorem euismod amet placerat. Vivamus porttitor magna enim, ac accumsan tortor cursus at phasellus sed ultricies.</p>
            <ul class="actions">
                <li><a href="#" class="button">Learn More</a></li>
            </ul>
        </section>
<?php require_once(ROOT . '/views/layouts/footer.php');?>