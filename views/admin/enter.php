<?php include(ROOT . '/views/adminLayouts/header.php');?>
    <body class="single">
    <!-- Wrapper -->
<div id="wrapper">
    <!-- Header -->
    <?php include (ROOT . '/views/adminLayouts/menu.php');?>

    <div id="main">
        <article class="post">
            <section>
                <h3 class="align-center">Authorization</h3>
                <form method="post" action="">
                    <div class="row uniform">
                        <div class="-5u 12u$(xsmall)">
                            <label for="adminLogin">login</label>
                            <input type="text" name="adminLogin" id="adminLogin" value="" placeholder="Login" required/>
                        </div>

                        <div class="-5u 12u$(xsmall)">
                            <label for="adminPass">pass</label>
                            <input type="password" name="adminPass" id="adminPass" value="" placeholder="Password" required/>
                        </div>

                        <div class="-5u 7u 12u$">
                            <input type="submit" name="adminSub" value="authorization" />
                        </div>
                    </div>
                </form>
            </section>
        </article>
    </div>

<?php include(ROOT . '/views/adminLayouts/footer.php');?>