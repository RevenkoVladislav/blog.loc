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
                        <h2 class = "stateName"><a href="/news/<?=$newsItem['id'];?>"><?=$newsItem['stateName'];?></a></h2>
                        <p class="myLink">Category: <a href="/category/<?=$newsItem['stateCategory'];?>"><?=$newsItem['stateCategory'];?></a></p>
                    </div>
                    <div class="meta">
                        <time class="published stateDate" datetime="<?=$newsItem['stateDate'];?>"><?=$newsItem['stateDate'];?></time>
                        <a href="/profile/<?=$newsItem['userId'];?>" class="author"><span class="name"><?=$newsItem['author'];?></span><img src="/views/images/<?=$newsItem['userAvatar'];?>" alt="" /></a>
                    </div>
                </header>
                <a href="/news/<?=$newsItem['id'];?>" class="image featured"><img src="/views/images/<?=$newsItem['stateImage'];?>" alt="" /></a>
                <p><?=$newsItem['stateDescription'];?></p>
                <footer>
                    <ul class="actions">
                        <li><a href="/news/<?=$newsItem['id'];?>" class="button big">Continue Reading</a></li>
                    </ul>
                    <ul class="stats">
                        <?php if($checkAuth){
                            if($newsItem['isArticleLike']){ ?>
                                <li><a href="/news/<?=$newsItem['id'];?>#like" class="fa fa-heart disabledIcon"> <?=$newsItem['likes'];?></a></li>
                            <?php } else { ?>
                                <li><a href="/news/<?=$newsItem['id'];?>#like" class="icon fa-heart"><?=$newsItem['likes'];?></a></li>
                            <?php }
                        } else { ?>
                            <li><a href="/news/<?=$newsItem['id'];?>#like" class="icon fa-heart"><?=$newsItem['likes'];?></a></li>
                            <?php } ?>
                        <li><a href="/news/<?=$newsItem['id'];?>#comments" class="icon fa-comment"><?=$newsItem['comment'];?></a></li>
                    </ul>
                </footer>
            </article>
        <?php endforeach; ?>

        <!-- Pagination -->
        <ul class="actions pagination">
            <?=$prevPage;?>
            <?=$nextPage;?>
        </ul>
    </div>

    <!-- Sidebar -->
    <section id="sidebar">
    <!-- Intro -->
    <section id="intro">
        <a href="/user/cabinet" class="logo"><img src="/views/images/<?=$userAvatar;?>" alt="" /></a>
        <header>
            <h2><?=$userPseudonym;?></h2>
        </header>
    </section>

    <!-- Mini Posts -->
    <section>
        <div class="mini-posts">
            <h2>Hot news</h2>
            <!-- Mini Post -->
            <?php foreach($hotNews as $miniNew): ?>
                <article class="mini-post">

                    <header>
                        <h3><a href="/news/<?=$miniNew['id'];?>"><?=$miniNew['stateName'];?></a></h3>
                        <p><?=$miniNew['stateDescription'];?></p>
                        <a href="/profile/<?=$miniNew['authorId'];?>" class="author"><img src="/views/images/<?=$miniNew['authorAvatar'];?>" alt="" /></a>
                    </header>
                    <a href="/news/<?=$miniNew['id'];?>" class="image"><img src="/views/images/<?=$miniNew['stateImage'];?>" alt="" /></a>

                </article>
            <?php endforeach; ?>
        </div>
    </section>

    <!-- Posts List -->
    <section>
        <h2>Latest news</h2>
        <ul class="posts">
            <?php foreach($latestNews as $miniLatestNew): ?>
                <li>
                    <article>
                        <header>
                            <h3><a href="/news/<?=$miniLatestNew['id'];?>"><?=$miniLatestNew['stateName'];?></a></h3>
                            <time class="published" datetime="<?=$miniLatestNew['stateDate'];?>"><?=$miniLatestNew['stateDate'];?></time>
                        </header>
                        <a href="/news/<?=$miniLatestNew['id'];?>" class="image"><img src="/views/images/<?=$miniLatestNew['stateImage'];?>" alt="" /></a>
                    </article>
                </li>
            <?php endforeach; ?>
        </ul>
    </section>

    <!-- About -->
    <section class="blurb">
        <h2>About</h2>
        <p>Mauris neque quam, fermentum ut nisl vitae, convallis maximus nisl. Sed mattis nunc id lorem euismod amet placerat. Vivamus porttitor magna enim, ac accumsan tortor cursus at phasellus sed ultricies.</p>
        <ul class="actions">
            <li><a href="/contact" class="button">Contact us</a></li>
        </ul>
    </section>
<?php include(ROOT . '/views/layouts/footer.php');?>