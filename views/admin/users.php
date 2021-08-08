<?php include(ROOT . '/views/adminLayouts/header.php'); ?>
    <body class="single">
    <!-- Wrapper -->
<div id="wrapper">
    <!-- Header -->
<?php include(ROOT . '/views/adminLayouts/menu.php'); ?>

    <div id="main">
        <article class="post">
            <section>

            <?php if(!empty($showPosts)): ?>
            <h3 class="align-center">User Posts - <?=$userDetails['userPseudonym'];?></h3>
                <?php if(empty($userPosts)): ?>
                    <p class="align-center">This user has not posted anything.</p>
                <?php else: ?>
            <div class="table-wrapper">
                <table class="alt">
                    <thead>
                    <tr>
                        <th class="align-center">State Name</th>
                        <th class="align-center">State Description</th>
                        <th class="align-center">State Category</th>
                    </tr>
                    </thead>

                    <tbody>

                    <?php foreach($userPosts as $post): ?>
                        <tr>
                            <td class="align-center"><a href="/admin/news/edit/<?=$post['stateId'];?>"><?= $post['stateName']; ?></a></td>
                            <td class="align-center"><?= $post['stateDescription']; ?></td>
                            <td class="align-center"><?= $post['stateCategory']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>

            </div>

            <?php endif;?>
        <?php endif;?>


        <?php if (!empty($showUser)): ?>
            <h3 class="align-center">User Details - <?=$userDetails['userPseudonym'];?></h3>
                <form method="post" action="" enctype="multipart/form-data">

            <?php if (!empty($errors)): ?>
                <div class="4u$ 12u$(small)">
                    <label>Oops, the following errors occurred:</label>
                    <?php foreach ($errors as $error): ?>
                        <p class="error">* <?= $error; ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

                <div class="row uniform">

                    <div class="6u(xsmall)">
                        <label for="editUserName">User Name</label>
                        <input type="text" name="editUserName" id="editUserName" value="<?=$userDetails['userName'];?>" required>
                    </div>

                    <div class="1u(xsmall)">
                        <label for="editUserAvatar">User Avatar</label>
                        <input type="file" name="editUserAvatar" id="editAvatar">
                    </div>

                    <div class="1u 2u$ (xsmall)">
                        <label for="avatar">Avatar</label>
                        <p class="author" id="avatar"><img src="/views/images/<?=$userDetails['userAvatar'];?>" alt="" /></p>
                    </div>

                    <div class="6u(xsmall)">
                        <label for="editUserSurname">User Surname</label>
                        <input type="text" name="editUserSurname" id="editUserSurname" value="<?=$userDetails['userSurname'];?>" required>
                    </div>

                    <div class="6u(xsmall)">
                        <label for="editUserLogin">User Login</label>
                        <input type="text" name="editUserLogin" id="editUserLogin" value="<?=$userDetails['userLogin'];?>" required>
                    </div>

                    <div class="6u(xsmall)">
                        <label for="editUserEmail">User Email</label>
                        <input type="text" name="editUserEmail" id="editUserEmail" value="<?=$userDetails['userEmail'];?>" required>
                    </div>

                    <div class="6u(xsmall)">
                        <label for="editUserPseudonym">User Pseudonym</label>
                        <input type="text" name="editUserPseudonym" id="editUserPseudonym" value="<?=$userDetails['userPseudonym'];?>" required>
                    </div>

                    <div class="6u 12u$ (xsmall)">
                        <label for="editUserMessageSelf">User Message</label>
                        <input type="text" name="editUserMessageSelf" id="editUserMessageSelf"
                               value="<?php if (!empty($editUserMessageSelf)) {
                                   echo $_POST['editUserMessageSelf'];
                               } else {
                                   echo $userDetails['userMessageSelf'];
                               }
                               ?>" required/>
                    </div>

                    <div class="6u$ 12u$">
                        <ul class="actions fit">
                            <li><input class="fit" name="adminEditUser" type="submit" value="Edit"/></li>
                            <li><input type="reset" value="Reset"/></li>
                        </ul>
                    </div>
                </div>
            </form>

            <h3 class="align-center">WARNING !</h3>
            <p class="align-center">Do not change username, email and pseudonym unnecessarily</p>
            <?php endif; ?>

                <h3 class="align-center">Users</h3>
                <div class="table-wrapper">
                    <table class="alt">
                        <thead>
                        <tr>
                            <th class="align-center">User ID</th>
                            <th class="align-center">User Name</th>
                            <th class="align-center">User Surname</th>
                            <th class="align-center">User Login</th>
                            <th class="align-center">User Email</th>
                            <th class="align-center">User Pseudonym</th>
                            <th class="align-center">Show More/Edit</th>
                            <th class="align-center">Ban status</th>
                            <th class="align-center">Default Avatar</th>
                            <th class="align-center">Show Posts</th>
                            <th class="align-center">Delete</th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php foreach ($users as $user): ; ?>
                            <tr>
                                <td class="align-center"><?= $user['userId']; ?></td>
                                <td class="align-center"><?= $user['userName']; ?></td>
                                <td class="align-center"><?= $user['userSurname']; ?></td>
                                <td class="align-center"><?= $user['userLogin']; ?></td>
                                <td class="align-center"><?= $user['userEmail']; ?></td>
                                <td class="align-center"><?= $user['userPseudonym']; ?></td>
                                <td class="align-center"><a href="/admin/users/show/<?= $user['userId']; ?>" class="icon fa-eye"</td>
                                <td class="align-center"><a href="<?=$user['banLink'];?>" class="<?=$user['banStatus'];?>"></a></td>
                                <td class="align-center"><a href="/admin/users/defaultAvatar/<?=$user['userId'];?>" class="icon fa-image"></td>
                                <td class="align-center"><a href="/admin/users/showPosts/<?=$user['userId'];?>" class="icon fa-info-circle"</td>
                                <td class="align-center"><a href="/admin/users/deleteUser/<?=$user['userId'];?>" class="icon fa-trash"></a></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>

                </div>
            </section>
        </article>
    </div>

<?php include(ROOT . '/views/adminLayouts/footer.php'); ?>