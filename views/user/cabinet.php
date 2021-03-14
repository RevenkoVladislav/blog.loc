<?php include(ROOT . '/views/layouts/header.php');?>
<body class="single">
<!-- Wrapper -->
<div id="wrapper">
    <!-- Header -->
    <?php include (ROOT . '/views/layouts/menu.php');?>

<?php
echo $_SESSION['userId'];
echo "<br>";
echo $_SESSION['userLogin'];
?>

    <div id="main">
        <article class="post">
            <section>
                <h3>Ваш кабинет</h3>
                <form method="post" action="">

                    <div class="row uniform">
                        <div class="6u 12u$(xsmall)">
                            <label for="name">Ваше имя</label>
                            <input type="text" id="name" value="" disabled/>
                        </div>
                        <div class="6u 12u$(xsmall)">
                            <label for="surname">Ваша фамилия</label>
                            <input type="text" id="surname" value="" disabled/>
                        </div>
                        <div class="6u 12u$(xsmall)">
                            <label for="login">Ваш логин</label>
                            <input type="text" id="login" value="" disabled/>
                        </div>
                        <div class="6u 12u$(xsmall)">
                            <label for="email">Ваш email</label>
                            <input type="email" id="email" value="" disabled/>
                        </div>
                        <div class="12u$">
                            <label for="messageSelf">О вас</label>
                            <textarea id="messageSelf" rows="6" disabled></textarea>
                        </div>
                    </div>
                </form>
            </section>
        </article>
    </div>

<?php include(ROOT . '/views/layouts/footer.php');?>
