<?php include(ROOT . '/views/layouts/header.php');?>
    <body class="single">
<!-- Wrapper -->
<div id="wrapper">
    <!-- Header -->
    <?php include (ROOT . '/views/layouts/menu.php');?>

    <div id="main">
        <article class="post">
        <section>
        <h3>Регистрация</h3>
        <form method="post" action="">
            <?php if(!empty($errors)): ?>
                <div class="4u$ 12u$(small)">
                    <label>Ой, произошли следующие ошибки:</label>
                    <?php foreach($errors as $error): ?>
                        <p class="error">* <?=$error;?></p>
                    <?php endforeach;?>
                </div>
            <?php endif;?>

            <?php if($register): ?>
                <p class="succes">Вы успешно зарегистрированы ! <a href="/">Вернуться на главную.</a></p>
            <?php endif;?>

            <div class="row uniform">
                <div class="6u 12u$(xsmall)">
                    <label for="name">Ваше имя</label>
                    <input type="text" name="name" id="name" value="<?php if(!empty($_POST['name'])) echo $_POST['name'];?>" placeholder="Name" required/>
                </div>
                <div class="6u 12u$(xsmall)">
                    <label for="surname">Ваша фамилия</label>
                    <input type="text" name="surname" id="surname" value="<?php if(!empty($_POST['surname'])) echo $_POST['surname'];?>" placeholder="Surname" required/>
                </div>
                <div class="6u 12u$(xsmall)">
                    <label for="login">Ваш логин</label>
                    <input type="text" name="login" id="login" value="<?php if(!empty($_POST['login'])) echo $_POST['login'];?>" placeholder="Login" required/>
                </div>
                <div class="6u 12u$(xsmall)">
                    <label for="email">Ваш email</label>
                    <input type="email" name="email" id="email" value="<?php if(!empty($_POST['email'])) echo $_POST['email'];?>" placeholder="Email" required/>
                </div>
                <div class="6u 16u$(xsmall)">
                    <label for="password">Ваш пароль</label>
                    <input type="password" name="password" id="password" value="" placeholder="Password" required/>
                </div>
                <div class="6u 16u$(xsmall)">
                    <label for="repeatPassword">Повторите пароль еще раз</label>
                    <input type="password" name="repeatPassword" id="repeatPassword" value="" placeholder="Repeat Password" required/>
                </div>
                <div class="6u 16u$(xsmall)">
                    <label for="pseudonym">Придумайте авторский псевдоним</label>
                    <input type="text" name="pseudonym" id="pseudonym" value="<?php if(!empty($_POST['pseudonym'])) echo $_POST['pseudonym'];?>" placeholder="Pseudonym" required/>
                </div>

                <div class="12u$">
                    <label for="messageSelf">Расскажите о себе</label>
                    <textarea name="messageSelf" id="messageSelf" placeholder="Tell us about yourself" rows="6" required><?php if(!empty($_POST['messageSelf'])) echo $_POST['messageSelf'];?></textarea>
                </div>

                <div class="4u$ 12u$(small)">
                    <input type="checkbox" id="autoLog" name="autoLog" <?php if(!empty($_POST['autoLog'])) echo 'checked';?>>
                    <label for="autoLog">Login upon successful registration ?</label>
                </div>

                <div class="4u$ 12u$(small)">
                    <label for="captcha">Подтвердите, что вы не робот</label>
                    <input type="checkbox" id="captcha" name="captcha">
                    <label for="captcha">Not a robot</label>
                </div>

                <div class="6u$ 12u$">
                    <ul class="actions fit">
                        <li><input class="fit" name="register" type="submit" value="Register" /></li>
                        <li><input type="reset" value="Reset" /></li>
                    </ul>
                </div>
            </div>
        </form>
        </section>
        </article>
</div>

<?php include(ROOT . '/views/layouts/footer.php');?>