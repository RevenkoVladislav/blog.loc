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
                                        <p class="myLink">CATEGORY: <a href="/category/<?=$newsById['stateCategory'];?>"><?=$newsById['stateCategory'];?></a></p>
									</div>
									<div class="meta">
										<time class="published stateDate" datetime="<?=$newsById['stateDate'];?>"><?=$newsById['stateDate'];?></time>
										<a href="/profile/<?=$newsById['userId'];?>" class="author"><span class="name"><?=$newsById['author'];?></span><img src="/views/images/<?=$newsById['authorAvatar'];?>" alt="" /></a>
									</div>
								</header>
								<span class="image featured"><img src="/views/images/<?=$newsById['imagePath'];?>" alt="" /></span>
								<p><?=$newsById['state'];?><br id="like"></p>
								<footer>
									<ul class="stats">
                                        <?php if($checkAuth === true){
                                            if($edit === true){ ?>
                                                <li><a href="/user/edit/<?=$id;?>">Edit</a></li>
                                            <?php }

                                            if($likeCount === true){ ?>
                                                <li><a href="/news/<?=$newsById['id'];?>/1" class="fa fa-heart disabledIcon "> <?=$newsById['likes'];?></a></li>
                                            <?php } elseif($likeCount === false){ ?>
                                            <li><a href="/news/<?=$newsById['id'];?>/2" class="icon fa-heart likes"><?=$newsById['likes'];?></a></li>
                                            <?php }
                                        } else { ?>
                                            <li><a href="" class="icon fa-heart disabled"><?=$newsById['likes'];?></a></li>
                                        <?php } ?>
                                            <li><a href="#comments" class="icon fa-comment"><?=$newsById['comment'];?></a></li>

									</ul>
								</footer>
							</article>

                        <?php if($checkAuth === true): ?>

                        <article class="post" id="comments">
                            <?php if($userBan): ?>
                                <h3 class="error align-center">You profile are banned</h3>
                                <p class="error align-center">Your profile has been banned for violating the site rules. For all your questions, you can contact us</p>
                            <?php else: ?>
                            <form method="post" action="">
                                <div class="row uniform">

                                    <div class="12u$">
                                        <label for="comment">Send your comment</label>
                                        <textarea name="comment" id="comment" placeholder="Send your comment" rows="6" required></textarea>
                                            </div>

                                    <div class="6u$ 12u$">
                                        <ul class="actions fit">
                                            <li><input class="fit" name="commentSend" type="submit" value="Send comment" /></li>
                                            <li><input type="reset" value="Reset" /></li>
                                        </ul>
                                    </div>
                                </div>
                            </form>
                            <?php endif; ?>
                        </article>

                            <article class="post">
                        <?php if(!empty($comments)): ?>
                        <?php foreach($comments as $comment): ?>
                                <div class="title">
                                    <h2><a href="/profile/<?=$comment['userId'];?>"><?= $comment['author'];?></a></h2>
                                    <p>Send comment - <?=$comment['publishedDate'];?></p>
                                </div>
                            <pre><code><?=$comment['comment'];?></code></pre>
                        <?php endforeach; ?>
                        <?php else : ?>
                            <p>This article has no comments yet.</p>
                        <?php endif; ?>
                            </article>

                        <?php else: ?>
                            <article class="post" id="comments">
                                <p>Only authorized users can view and post comments.</p>
                                <p>Please <a href="/user/register">Sign up</a> or <a href="/user/login">Sign in</a></p>
                            </article>
                        <?php endif; ?>
					</div>
<?php include(ROOT . '/views/layouts/footer.php');?>