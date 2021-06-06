<?php include(ROOT . '/views/layouts/header.php'); ?>
<body class="single">
<!-- Wrapper -->
<div id="wrapper">
    <!-- Header -->
    <?php include(ROOT . '/views/layouts/menu.php'); ?>

    <div id="main">
        <article class="post">
            <section>

                <?php if ($profileData === false): ?>
                    <div class="4u$ 12u$(small)">
                        <label>Oops, the following errors occurred:</label>
                        <p class="error">* No such user exists.</p>
                        <p>Go to <a href="/">home page.</a></p>
                    </div>
                <?php die; endif; ?>

                <h3 class="align-center"><?= $profileData['userName']; ?> - profile</h3>
                <form method="post" action="">
                    <div class="row uniform">
                        <div class="6u 12u$(xsmall)">
                            <label for="name">Name</label>
                            <input type="text" name="dataName" id="name"
                                   value="<?= $profileData['userName']; ?>" disabled/>
                        </div>
                        <div class="6u 12u$(xsmall)">
                            <label for="surname">Surname</label>
                            <input type="text" name="dataSurname" id="surname"
                                   value="<?= $profileData['userSurname']; ?>" disabled/>
                        </div>
                        <div class="6u 12u$(xsmall)">
                            <label for="email">Email</label>
                            <input type="email" name="dataEmail" id="email"
                                   value="<?= $profileData['userEmail']; ?>" disabled/>
                        </div>
                        <div class="6u 12u$(xsmall)">
                            <label for="pseudonym">Pseudonym</label>
                            <input type="text" name="dataPseudonym" id="pseudonym"
                                   value="<?= $profileData['userPseudonym']; ?>" disabled/>
                        </div>
                        <div class="1u 12u$(xsmall)">
                            <label for="avatar">Avatar</label>
                            <p class="author" id="avatar"><img src="/views/images/<?=$profileData['userAvatar'];?>" alt="" /></p>
                        </div>
                        <div class="12u$">
                            <label for="messageSelf">About you</label>
                            <textarea name="dataMessageSelf" id="messageSelf"
                                      rows="6" disabled><?= $profileData['userMessageSelf']; ?></textarea>
                        </div>

                    </div>
                </form>
            </section>


            <br>
            <section>
                <h3 class="align-center"><?= $profileData['userName']; ?> -  publications</h3>
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
                            <p class="align-center">This user has not published any articles yet.</p>
                        <?php };?>

                    </table>

                </div>
            </section>

        </article>
    </div>

    <?php include(ROOT . '/views/layouts/footer.php'); ?>
