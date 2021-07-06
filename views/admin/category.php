<?php include(ROOT . '/views/adminLayouts/header.php');?>
    <body class="single">
    <!-- Wrapper -->
<div id="wrapper">
    <!-- Header -->
    <?php include (ROOT . '/views/adminLayouts/menu.php');?>

    <div id="main">
        <article class="post">
            <section>
                <h3 class="align-center">Categories</h3>
                <div class="table-wrapper">
                    <table class="alt">
                        <thead>
                        <tr>
                            <th class="align-center">Category Id</th>
                            <th class="align-center">Category Name</th>
                            <th class="align-center">Category Availability</th>
                            <th class="align-center">Total Articles in Category</th>
                            <th class="align-center">Hide category</th>
                            <th class="align-center">Delete category</th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php foreach($categories as $category): ;?>
                            <tr>
                                <td class="align-center"><?=$category['id'];?></td>
                                <td class="align-center"><?=$category['categoryName'];?></td>
                                <td class="align-center"><?=$category['categoryAvailability'];?></td>
                                <td class="align-center"><?=$category['categoryTotalArticles'];?></td>
                                <td class="align-center"><a href="/admin/category/<?=$category['commandHide'];?>/<?=$category['id'];?>" class="<?php echo $category['iconHide'] . ' '; if(!empty($category['class'])){ echo $category['class'];}?>"></a></td>
                                <td class="align-center"><a href="/admin/category/delete/<?=$category['id'];?>" class="icon fa-trash <?php if(!empty($category['class'])){ echo $category['class'];}?>"></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                <h3 class="align-center"><a href="/admin/category/addCategory">Add new category</a></h3>


                    <?php if($command == 'addCategory'):?>
                    <section>
                        <form method="post" action="">
                            <div class="row uniform">
                                <div class="-3u 6u$">
                                    <label for="categoryName">Category name</label>
                                    <input type="text" name="categoryName" id="categoryName" placeholder="Category Name" required/>
                                </div>
                                <div class="-3u 6u$">
                                        <input class="fit" name="addCategory" type="submit" value="Add Category" />
                                </div>
                            </div>
                        </form>
                    </section>
                    <?php endif;?>
                </div>
            </section>
        </article>
    </div>

<?php include(ROOT . '/views/adminLayouts/footer.php');?>