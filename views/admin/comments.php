<?php include(ROOT . '/views/adminLayouts/header.php');?>
    <body class="single">
    <!-- Wrapper -->
<div id="wrapper">
    <!-- Header -->
    <?php include (ROOT . '/views/adminLayouts/menu.php');?>

    <div id="main">
        <article class="post">
            <section>
                <?php if(!empty($showComments)):?>
                    <h3 class="align-center">Comments for ID - <?=$id;?></h3>
                    <div class="table-wrapper">
                        <table class="alt">
                            <thead>
                            <tr>
                                <th class="align-center">Comments ID</th>
                                <th class="align-center">Author</th>
                                <th class="align-center">Comment</th>
                                <th class="align-center">Date</th>
                                <th class="align-center">Status</th>
                                <th class="align-center">Hide Comment</th>
                                <th class="align-center">Delete Comment</th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php foreach($comments as $comment): ?>
                                <tr>
                                    <td class="align-center"><?=$comment['id'];?></td>
                                    <td class="align-center"><a href="/admin/users/show/<?=$comment['authorId'];?>" ><?=$comment['author']?></a></td>
                                    <td class="align-center"><?=$comment['comment'];?></td>
                                    <td class="align-center"><?=$comment['publishedDate'];?></td>
                                    <td class="align-center"><?=$comment['status'];?></td>
                                    <td class="align-center"><a href="/admin/comments/<?=$command;?>/<?=$id;?>/<?=$comment['commandHide'];?>/<?=$comment['id'];?>" class="<?php echo $comment['iconHide'] . ' '; if(!empty($comment['class'])){ echo $comment['class'];}?>"></a></td>
                                    <td class="align-center"><a href="/admin/comments/<?=$command;?>/<?=$id;?>/delete/<?=$comment['id'];?>" class="icon fa-trash"></a></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif;?>

                <?php if(!empty($setLikes)):?>
                    <h3 class="align-center">Set Likes For ID - <?=$id;?> state</h3>

                    <form action="" method="post">
                        <div class="row uniform">
                            <div class="-5u 12u$(xsmall)">
                                <label for="likes">Set Likes</label>
                                <input type="text" name="likes" id="likes">
                            </div>
                            <div class="-5u 7u 12u$)">
                                <input name="setLikes" type="submit" value="set likes" />
                            </div>
                        </div>
                    </form>
                <?php endif;?>

                <h3 class="align-center">Comments and Likes</h3>
                <div class="table-wrapper">
                    <table class="alt">
                        <thead>
                        <tr>
                            <th class="align-center">News Id</th>
                            <th class="align-center">Name State</th>
                            <th class="align-center">Total Comments</th>
                            <th class="align-center">Total Likes</th>
                            <th class="align-center">Show Comments</th>
                            <th class="align-center">Set Likes</th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php foreach($commentsAndLikes as $commentAndlike): ?>
                            <tr>
                                <td class="align-center"><?=$commentAndlike['id'];?></td>
                                <td class="align-center"><a href="/admin/news/edit/<?=$commentAndlike['id'];?>"><?=$commentAndlike['stateName'];?></a></td>
                                <td class="align-center"><?=$commentAndlike['totalComments'];?></td>
                                <td class="align-center"><?=$commentAndlike['totalLike'];?></td>
                                <td class="align-center"><a href="/admin/comments/showComments/<?=$commentAndlike['id'];?>" class="icon fa-eye"></a></td>
                                <td class="align-center"><a href="/admin/comments/setLikes/<?=$commentAndlike['id'];?>" class="icon fa-pencil"></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </section>
        </article>
    </div>

<?php include(ROOT . '/views/adminLayouts/footer.php');?>