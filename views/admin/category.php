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
                                <td class="align-center"><a href="/admin/category/<?=$category['commandHide'];?>/<?=$category['id'];?>" class="<?=$category['iconHide'];?>"></a></td>
                                <td class="align-center"></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                <h3 class="align-center"><a href="#">Add new category</a></h3>
                </div>
            </section>
        </article>
    </div>

<?php include(ROOT . '/views/adminLayouts/footer.php');?>