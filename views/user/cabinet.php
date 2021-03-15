<?php include(ROOT . '/views/layouts/header.php'); ?>
<body class="single">
<!-- Wrapper -->
<div id="wrapper">
    <!-- Header -->
    <?php include(ROOT . '/views/layouts/menu.php'); ?>

    <div id="main">
        <article class="post">
            <section>
                <h3 class="align-center">Your profile</h3>
                <form method="post" action="">

                    <?php if (!empty($errors)): ?>
                        <div class="4u$ 12u$(small)">
                            <label>Oops, the following errors occurred:</label>
                            <?php foreach ($errors as $error): ?>
                                <p class="error">* <?= $error; ?></p>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <div class="row uniform">
                        <div class="6u 12u$(xsmall)">
                            <label for="name">Ваше имя</label>
                            <input type="text" name="dataName" id="name"
                                   value="<?= $userData['userName']; ?>" disabled/>
                        </div>
                        <div class="6u 12u$(xsmall)">
                            <label for="surname">Ваша фамилия</label>
                            <input type="text" name="dataSurname" id="surname"
                                   value="<?= $userData['userSurname']; ?>" disabled/>
                        </div>
                        <div class="6u 12u$(xsmall)">
                            <label for="login">Ваш логин</label>
                            <input type="text" name="dataLogin" id="login"
                                   value="<?= $userData['userLogin']; ?>" disabled/>
                        </div>
                        <div class="6u 12u$(xsmall)">
                            <label for="email">Ваш email</label>
                            <input type="email" name="dataEmail" id="email"
                                   value="<?= $userData['userEmail']; ?>" disabled/>
                        </div>
                        <div class="6u 12u$(xsmall)">
                            <label for="pseudonym">Ваш псевдоним</label>
                            <input type="text" name="dataPseudonym" id="pseudonym"
                                   value="<?= $userData['userPseudonym']; ?>" disabled/>
                        </div>
                        <div class="12u$">
                            <label for="messageSelf">О вас</label>
                            <textarea name="dataMessageSelf" id="messageSelf"
                                      rows="6" disabled><?= $userData['userMessageSelf']; ?></textarea>
                        </div>

                    </div>
                </form>
            </section>

            <?php if ($changeData === false): ?>
                <section>
                    <div class="row uniform">
                        <div class="6u 12u">
                            <a href="/user/cabinet/changeForm" class="button big fit">Change account details</a>
                        </div>
                        <div class="6u 12u">
                            <a href="/user/cabinet/changePassword" class="button big fit">Change password</a>
                        </div>
                        <div class="6u 12u">
                            <a href="/user/cabinet/changeLogin" class="button big fit">Change login</a>
                        </div>
                        <div class="6u 12u">
                            <a href="/user/cabinet/changeEmail" class="button big fit">Change email</a>
                        </div>
                    </div>
                </section>


            <?php elseif ($changeData === 'changeForm'): ?>
                <section>
                    <h3 class="align-center">Change data</h3>
                    <form method="post">

                        <div class="row uniform">
                            <div class="6u 12u$(xsmall)">
                                <label for="name">Изменить имя</label>
                                <input type="text" name="dataName" id="name"
                                       value="<?= $userData['userName']; ?>" required/>
                            </div>
                            <div class="6u 12u$(xsmall)">
                                <label for="surname">Изменить фамилию</label>
                                <input type="text" name="dataSurname" id="surname"
                                       value="<?= $userData['userSurname']; ?>" required/>
                            </div>
                            <div class="12u$">
                                <label for="messageSelf">Изменить описание</label>
                                <textarea name="dataMessageSelf" id="messageSelf"
                                          rows="6" required><?php if (!empty($_POST['dataMessageSelf'])) {
                                        echo $_POST['dataMessageSelf'];
                                    } else {
                                        echo $userData['userMessageSelf'];
                                    } ?></textarea>
                            </div>
                            <div class="-3u 6u 12u">
                                <input class="fit" type="submit" name="changeDataForm" value="Change your data"/>
                            </div>
                        </div>
                    </form>
                </section>

            <?php endif; ?>

            <br>
            <section>
                <h3 class="align-center">Your publications</h3>
                <div class="table-wrapper">
                    <?php if($userPublications){ ?>
                    <table class="alt">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Category</th>
                        </tr>
                        </thead>

                        <tbody>

                        <?php foreach($userPublications as $publication): ?>

                        <tr>
                            <td><a href="/news/<?=$publication['id'];?>"><?=$publication['stateName'];?></a></td>
                            <td><?=$publication['stateDescription'];?></td>
                            <td><?=$publication['stateCategory'];?></td>
                        </tr>
                        </tbody>

                        <?php endforeach; } else { ?>
                            <p class="align-center">You have not posted anything yet. Go to the <a href="#">publication page ?</a></p>
                        <?php };?>

                    </table>

                </div>
            </section>

        </article>
    </div>

    <?php include(ROOT . '/views/layouts/footer.php'); ?>
