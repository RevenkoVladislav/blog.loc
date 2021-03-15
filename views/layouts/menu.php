<header id="header">
    <h1><a href="/">Blog.loc</a></h1>
    <nav class="links">
        <ul>
            <?php foreach($categories as $category):?>
                <?php $link = "/category/{$category['categoryName']}";
                if(preg_match("#$link#", $_SERVER['REQUEST_URI'])){
                    $class = 'disabled';
                } else {
                    $class = '';
                }
                ?>
                <li class='<?=$class;?>'><a href="<?=$link;?>" class='<?=$class;?>'><?=$category['categoryName'];?></a></li>
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
                <a href="/user/cabinet">
                    <h3>Перейти в личный кабинет</h3>
                    <p>Посмотреть ваши публикации, изменить данные ...</p>
                </a>
            </li>
            <li>
                <a href="#">
                    <h3>Добавить статью</h3>
                    <p></p>
                </a>
            </li>
        </ul>
    </section>

    <!-- Actions -->
    <section>
        <ul class="actions vertical">
            <?php if(!empty($_SESSION['userId']) OR !empty($_SESSION['userLogin'])): ?>
            <li><a href="/user/logout" class="button big fit">Sign OUT</a></li>
            <?php else: ?>
            <li><a href="/user/login" class="button big fit">Sign IN</a></li>
            <li><a href="/user/register" class="button big fit">Sign UP</a></li>
            <?php endif; ?>
        </ul>
    </section>
</section>