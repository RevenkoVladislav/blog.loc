<?php include(ROOT . '/views/layouts/header.php');?>
	<body class="single">

		<!-- Wrapper -->
			<div id="wrapper">
            <?php include (ROOT . '/views/layouts/menu.php');?>

				<!-- Main -->
					<div id="main">

						<!-- Post -->
							<article class="post">
								<header>
									<div class="title">
										<h2><a href="#"><?=$newsById['stateName'];?></a></h2>
										<p>CATEGORY: <?=$newsById['stateCategory'];?></p>
									</div>
									<div class="meta">
										<time class="published" datetime="<?=$newsById['stateDate'];?>"><?=$newsById['stateDate'];?></time>
										<a href="#" class="author"><span class="name"><?=$newsById['author'];?></span><img src="/views/images/avatar.jpg" alt="" /></a>
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

					</div>
<?php include(ROOT . '/views/layouts/footer.php');?>