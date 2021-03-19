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

                    <?php if(!empty($message)): ?>
                        <p class="succes"><?=$message;?> !</p>
                    <?php endif;?>

                    <div class="row uniform">
                        <div class="6u 12u$(xsmall)">
                            <label for="name">Name</label>
                            <input type="text" name="dataName" id="name"
                                   value="<?= $userData['userName']; ?>" disabled/>
                        </div>
                        <div class="6u 12u$(xsmall)">
                            <label for="surname">Surname</label>
                            <input type="text" name="dataSurname" id="surname"
                                   value="<?= $userData['userSurname']; ?>" disabled/>
                        </div>
                        <div class="6u 12u$(xsmall)">
                            <label for="login">Login</label>
                            <input type="text" name="dataLogin" id="login"
                                   value="<?= $userData['userLogin']; ?>" disabled/>
                        </div>
                        <div class="6u 12u$(xsmall)">
                            <label for="email">Email</label>
                            <input type="email" name="dataEmail" id="email"
                                   value="<?= $userData['userEmail']; ?>" disabled/>
                        </div>
                        <div class="6u 12u$(xsmall)">
                            <label for="pseudonym">Pseudonym</label>
                            <input type="text" name="dataPseudonym" id="pseudonym"
                                   value="<?= $userData['userPseudonym']; ?>" disabled/>
                        </div>
                        <div class="12u$">
                            <label for="messageSelf">About you</label>
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
                                <label for="name">Change name</label>
                                <input type="text" name="dataName" id="name"
                                       value="<?= $userData['userName']; ?>" required/>
                            </div>
                            <div class="6u 12u$(xsmall)">
                                <label for="surname">Chane surname</label>
                                <input type="text" name="dataSurname" id="surname"
                                       value="<?= $userData['userSurname']; ?>" required/>
                            </div>
                            <div class="12u$">
                                <label for="messageSelf">Change descriptions</label>
                                <textarea name="dataMessageSelf" id="messageSelf"
                                          rows="6" required><?php if (!empty($_POST['dataMessageSelf'])) {
                                        echo $_POST['dataMessageSelf'];
                                    } else {
                                        echo $userData['userMessageSelf'];
                                    } ?></textarea>
                            </div>
                            <div class="-3u 6u 12u">
                                <input class="big fit" type="submit" name="changeDataForm" value="Change your data"/>
                            </div>
                            <div class="-3u 6u 12u">
                                <a href="/user/cabinet" class="button big fit">Go back</a>
                            </div>
                        </div>
                    </form>
                </section>

            <?php elseif($changeData === 'changePassword'): ?>

                <section>
                    <h3 class="align-center">Change password</h3>
                    <form method="post">

                        <div class="row uniform">
                            <div class="6u 12u$(xsmall)">
                                <label for="dataPassword">Enter password</label>
                                <input type="password" name="dataPassword" id="dataPassword"
                                       value="" required/>
                            </div>
                            <div class="6u 12u$(xsmall)">
                                <label for="dataRepeatPassword">Repeat password</label>
                                <input type="password" name="dataRepeatPassword" id="dataRepeatPassword"
                                       value="" required/>
                            </div>
                            <div class="-3u 6u 12u">
                                <input class="big fit" type="submit" name="changePassword" value="Change your password"/>
                            </div>
                            <div class="-3u 6u 12u">
                                <a href="/user/cabinet" class="button big fit">Go back</a>
                            </div>
                        </div>
                    </form>
                </section>

            <?php elseif($changeData === 'changeLogin'): ?>

                <section>
                    <h3 class="align-center">Change login</h3>
                    <form method="post">

                        <div class="row uniform">
                            <div class="-3u 6u 12u$(xsmall)">
                                <label for="dataLogin">Enter login</label>
                                <input type="text" name="dataLogin" id="dataLogin"
                                       value="<?= $userData['userLogin'];?>" required/>
                            </div>
                            <div class="-3u 6u 12u">
                                <input class="big fit" type="submit" name="changeLogin" value="Change your login"/>
                            </div>
                            <div class="-3u 6u 12u">
                                <a href="/user/cabinet" class="button big fit">Go back</a>
                            </div>
                        </div>
                    </form>
                </section>

            <?php elseif($changeData === 'changeEmail'): ?>

                <section>
                    <h3 class="align-center">Change email</h3>
                    <form method="post">

                        <div class="row uniform">
                            <div class="-3u 6u 12u$(xsmall)">
                                <label for="dataEmail">Enter email</label>
                                <input type="text" name="dataEmail" id="dataEmail"
                                       value="<?= $userData['userEmail'];?>" required/>
                            </div>
                            <div class="-3u 6u 12u">
                                <input class="big fit" type="submit" name="changeEmail" value="Change your email"/>
                            </div>
                            <div class="-3u 6u 12u">
                                <a href="/user/cabinet" class="button big fit">Go back</a>
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
