<?php include(ROOT . '/views/adminLayouts/header.php');?>
    <body class="single">
    <!-- Wrapper -->
<div id="wrapper">
    <!-- Header -->
    <?php include (ROOT . '/views/adminLayouts/menu.php');?>

    <div id="main">
        <article class="post">
            <section>
                <h3 class="align-center">News</h3>
                <div class="table-wrapper">
                    <table class="alt">
                        <thead>
                        <tr>
                            <th class="align-center">News Id</th>
                            <th class="align-center">Author</th>
                            <th class="align-center">state</th>
                            <th class="align-center">Name state</th>
                            <th class="align-center">Description</th>
                            <th class="align-center">Date published</th>
                            <th class="align-center">Category</th>
                            <th class="align-center">Likes</th>
                            <th class="align-center">Status</th>
                            <th class="align-center">Image</th>
                            <th class="align-center">Hide</th>
                            <th class="align-center">Delete</th>
                            <th class="align-center">Edit</th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php foreach($news as $new): ;?>
                            <tr>
                                <td class="align-center"><?=$new['id'];?></td>
                                <td class="align-center"><?=$new['author'];?></td>
                                <td class="align-center">ссылку сюда</td>
                                <td class="align-center"><?=$new['stateName'];?></td>
                                <td class="align-center"><?=$new['stateDescription'];?></td>
                                <td class="align-center"><?=$new['stateDate'];?></td>
                                <td class="align-center"><?=$new['stateCategory'];?></td>
                                <td class="align-center"><?=$new['likes'];?></td>
                                <td class="align-center"><?=$new['status'];?></td>
                                <td class="align-center"><?=$new['imagePath'];?></td>
                                <td class="align-center">1</td>
                                <td class="align-center">2</td>
                                <td class="align-center">3</td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                    <h3 class="align-center"><a href="/admin/category/addCategory">Add new category</a></h3>
                </div>
            </section>
        </article>
    </div>

<?php include(ROOT . '/views/adminLayouts/footer.php');?>