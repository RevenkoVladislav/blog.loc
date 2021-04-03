<?php include(ROOT . '/views/layouts/header.php');?>
	<body class="single">

		<!-- Wrapper -->
			<div id="wrapper">
            <?php include (ROOT . '/views/layouts/menu.php');?>

				<!-- Main -->
					<div id="main">

						<!-- Post -->
							<article class="post">

                                <?php if ($newsById === false): ?>
                                    <div class="4u$ 12u$(small)">
                                        <label>Oops, the following errors occurred:</label>
                                        <p class="error">* There is no such article.</p>
                                        <p>Go to <a href="/">home page.</a></p>
                                    </div>
                                    <?php die; endif; ?>

                                <header>
									<div class="title">
										<h2 class = "stateName"><?=$newsById['stateName'];?></a></h2>
                                        <p class="myLink">CATEGORY: <a href="/category/<?=$newsById['stateCategory'];?>"</a><?=$newsById['stateCategory'];?></p>
									</div>
									<div class="meta">
										<time class="published stateDate" datetime="<?=$newsById['stateDate'];?>"><?=$newsById['stateDate'];?></time>
										<a href="/profile/<?=$newsById['userId'];?>" class="author"><span class="name"><?=$newsById['author'];?></span><img src="/views/images/avatar.jpg" alt="" /></a>
									</div>
								</header>
								<span class="image featured"><img src="/views/images/pic01.jpg" alt="" /></span>
								<p><?=$newsById['state'];?></p>
								<footer>
									<ul class="stats">
										<li><a href="#">General</a></li>
										<li><a href="#" class="icon fa-heart"><?=$newsById['likes'];?></a></li>
										<li><a href="#" class="icon fa-comment">128</a></li>
									</ul>
								</footer>
							</article>

                        <?php if(!empty($comments)): ?>
                        <article class="post">
                                <div class="title">
                                    <h2><a href="/profile/<?=$comments['userId'];?>"><?= $comments['author'];?></a></h2>
                                    <p>Send comment - <?=$comments['publishedDate'];?></p>
                                </div>
                            <pre><code><?=$comments['comment'];?></code></pre>
                        </article>

                        <?php else : ?>
                            <p>No comments</p>
                        <?php endif; ?>
					</div>
<?php include(ROOT . '/views/layouts/footer.php');?>