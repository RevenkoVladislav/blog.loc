<?php include(ROOT . '/views/layouts/header.php');?>
    <body class="single">
    <!-- Wrapper -->
<div id="wrapper">
    <!-- Header -->
    <?php include (ROOT . '/views/layouts/menu.php');?>

    <div id="main">
        <article class="post">
            <section>
                <h3 class="align-center">Log IN</h3>
                <form method="post" action="">
                    <?php if(!empty($error)): ?>
                        <div class="4u$ 12u$(small)">
                            <label>Oops, an error occured:</label>
                                <p class="error">* <?=$error;?></p>
                        </div>
                    <?php endif;?>

                    <div class="row uniform">

                        <div class="-5u 12u$(xsmall)">
                            <label for="login">Ваш логин</label>
                            <input type="text" name="inLogin" id="login" value="" placeholder="Login" required/>
                        </div>

                        <div class="-5u 12u$(xsmall)">
                            <label for="password">Ваш пароль</label>
                            <input type="password" name="inPassword" id="password" value="" placeholder="Password" required/>
                        </div>

                        <div class="-5u 7u 12u$">
                            <input type="submit" name="inSub" value="Log In" />
                        </div>

                        <div class="-5u -12u$ (xsmall)">
                            <p>You are not registred ? Then <a href="/user/register">click !</a></p>
                        </div>
                        
                    </div>

                </form>
            </section>
        </article>
    </div>

<?php include(ROOT . '/views/layouts/footer.php');?>