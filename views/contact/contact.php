<?php include(ROOT . '/views/layouts/header.php');?>
    <body class="single">
    <!-- Wrapper -->
<div id="wrapper">
    <!-- Header -->
    <?php include (ROOT . '/views/layouts/menu.php');?>

    <div id="main">
        <article class="post">
            <section>
                <h3 class="align-center">Contact Us</h3>
                <form method="post" action="">

                    <?php if(!empty($errors)): ?>
                        <div class="4u$ 12u$(small)">
                            <label>Oops, the following errors occurred:</label>
                            <?php foreach($errors as $error): ?>
                                <p class="error">* <?=$error;?></p>
                            <?php endforeach;?>
                        </div>
                    <?php endif;?>

                    <?php if($result): ?>
                        <p class="succes">Your message has been successfully sent ! <a href="/">Go back to the main page.</a></p>
                    <?php endif;?>

                    <div class="row uniform">
                        <div class="-3u 6u 12u$(xsmall)">
                            <label for="contactEmail">Your email</label>
                            <input type="email" name="contactEmail" id="contactEmail" value="<?=$userEmail;?>" placeholder="Email" required/>
                        </div>
                        <div class="-3u 6u$">
                            <label for="contactMessage">Your message</label>
                            <textarea name="contactMessage" id="contactMessage" placeholder="Enter your message" rows="6" required><?php if(!empty($_POST['contactMessage'])) echo $_POST['contactMessage'];?></textarea>
                        </div>

                        <div class="-3u 6u 12u$">
                            <ul class="actions fit">
                                <li><input class="fit" name="contactUs" type="submit" value="Contact Us" /></li>
                            </ul>
                        </div>
                    </div>
                </form>
            </section>
        </article>
    </div>

<?php include(ROOT . '/views/layouts/footer.php');?>