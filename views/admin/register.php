<?php include(ROOT . '/views/adminLayouts/header.php');?>
    <body class="single">
    <!-- Wrapper -->
<div id="wrapper">
    <!-- Header -->
    <?php include (ROOT . '/views/adminLayouts/menu.php');?>

    <div id="main">
        <article class="post">
            <section>
                <h3 class="align-center">Register New Admin</h3>
                <form method="post" action="">
                    <?php if(!empty($errors)): ?>
                        <div class="4u$ 12u$(small)">
                            <label>Oops, the following errors occurred:</label>
                            <?php foreach($errors as $error): ?>
                                <p class="error">* <?=$error;?></p>
                            <?php endforeach;?>
                        </div>
                    <?php endif;?>
                    <div class="row uniform">
                        <div class="-5u 12u$(xsmall)">
                            <label for="Login">login</label>
                            <input type="text" name="Login" id="Login" value="" placeholder="Login" required/>
                        </div>

                        <div class="-5u 12u$(xsmall)">
                            <label for="Pass">pass</label>
                            <input type="password" name="Pass" id="Pass" value="" placeholder="Password" required/>
                        </div>

                        <div class="-5u 7u 12u$">
                            <input type="submit" name="newAdminSub" value="register" />
                        </div>
                    </div>
                </form>
            </section>
        </article>
    </div>

<?php include(ROOT . '/views/adminLayouts/footer.php');?>