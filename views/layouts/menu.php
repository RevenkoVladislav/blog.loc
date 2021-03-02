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