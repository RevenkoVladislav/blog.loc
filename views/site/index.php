<?php include(ROOT . '/views/layouts/header.php');?>
    <body>
    <!-- Wrapper -->
<div id="wrapper">
    <!-- Header -->
    <?php include (ROOT . '/views/layouts/menu.php');?>

    <!-- Main -->
    <div id="main">
        <!-- Post -->
        <?php foreach($news as $newsItem):?>
            <article class="post">
                <header>
                    <div class="title">
                        <h2><a href="/news/<?=$newsItem['id'];?>"><?=$newsItem['stateName'];?></a></h2>
                        <p>Category: <?=$newsItem['stateCategory'];?></p>
                    </div>
                    <div class="meta">
                        <time class="published" datetime="<?=$newsItem['stateDate'];?>"><?=$newsItem['stateDate'];?></time>
                        <a href="#" class="author"><span class="name"><?=$newsItem['author'];?></span><img src="/views/images/avatar.jpg" alt="" /></a>
                    </div>
                </header>
                <a href="#" class="image featured"><img src="/views/images/pic01.jpg" alt="" /></a>
                <p><?=$newsItem['stateDescription'];?></p>
                <footer>
                    <ul class="actions">
                        <li><a href="/news/<?=$newsItem['id'];?>" class="button big">Continue Reading</a></li>
                    </ul>
                    <ul class="stats">
                        <li><a href="#">General</a></li>
                        <li><a href="#" class="icon fa-heart"><?=$newsItem['likes'];?></a></li>
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
                <h2>Горячие новости</h2>
                <!-- Mini Post -->
                <?php foreach($hotNews as $miniNew): ?>
                <article class="mini-post">

                    <header>
                        <h3><a href="/views/<?=$miniNew['id'];?>"><?=$miniNew['stateName'];?></a></h3>
                        <time class="published" datetime="2015-10-20">October 20, 2015</time>
                        <a href="#" class="author"><img src="/views/images/avatar.jpg" alt="" /></a>
                    </header>
                    <a href="#" class="image"><img src="/views/images/pic04.jpg" alt="" /></a>

                </article>
                <?php endforeach; ?>
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
<?php include(ROOT . '/views/layouts/footer.php');?>