<?php include(ROOT . '/views/adminLayouts/header.php');?>
    <body class="single">
    <!-- Wrapper -->
<div id="wrapper">
    <!-- Header -->
    <?php include (ROOT . '/views/adminLayouts/menu.php');?>

    <div id="main">
        <article class="post">
            <section>
                <?php if(!empty($editNew)): ?>

                    <h3 class="align-center">Edit News</h3>
                    <form method="post" action="" enctype="multipart/form-data">

                        <?php if(!empty($errors)): ?>
                        <div class="4u$ 12u$(small)">
                            <label>Oops, the following errors occurred:</label>
                            <?php foreach($errors as $error): ?>
                                <p class="error">* <?=$error;?></p>
                            <?php endforeach;?>
                        </div>
                    <?php endif;?>

                    <div class="row uniform">

                        <div class="6u 12u$ (xsmall)">
                            <label for="editStateName">State Name</label>
                            <input type="text" name="editStateName" id="editStateName" value="<?=$editNew['stateName'];?>" required>
                        </div>

                        <div class="6u 12u$(xsmall)">
                            <label for="editStateDescription">Description</label>
                            <input type="text" name="editStateDescription" id="editStateDescription"
                                   value="<?php if (!empty($editStateDescription)){
                                       echo $_POST['editStateDescription'];
                                   } else {
                                       echo $editNew['stateDescription'];
                                   }
                                   ?>" required/>
                        </div>

                        <div class="6u 12u$ (xsmall)">
                            <label for="editImage">Image</label>
                            <input type="file" name="editImage" id="editImage">
                        </div>

                        <div class="6u 12u$ (xsmall)">
                            <label for="editAuthor">Author</label>
                            <input type="text" name="editAuthor" id="editAuthor" value="<?=$editNew['author'];?>" required>
                        </div>

                        <div class="6u 12u$ (xsmall)">
                            <label for="editDate">Published date</label>
                            <input type="date" name="editDate" id="editDate" value="<?=$editNew['stateDate'];?>" required>
                        </div>

                        <div class="6u 12u$(xsmall)">
                            <label for="editCategory">Category</label>
                            <select class="select-wrapper" name="editCategory" id="editCategory">
                                <option disabled>Select a category</option>
                                <?php foreach($categories as $category): ?>
                                    <option <?php if(!empty($stateCategory) AND $stateCategory == $category['categoryName']){
                                        echo 'selected';
                                    } elseif ($editNew['stateCategory'] == $category['categoryName']) {
                                        echo 'selected';
                                    };?> value="<?=$category['categoryName'];?>"><?=$category['categoryName'];?></option>
                                <?php endforeach;?>
                            </select>
                        </div>

                        <div class="12u$">
                            <label for="editState">Article</label>
                            <textarea name="editState" id="editState" placeholder="Article" rows="15" required><?php if (!empty($editState)){ echo $_POST['editState']; } else { echo $editNew['state']; };?></textarea>
                        </div>

                        <div class="6u$ 12u$">
                            <ul class="actions fit">
                                <li><input class="fit" name="adminEditArticle" type="submit" value="Edit article" /></li>
                                <li><input type="reset" value="Reset" /></li>
                            </ul>
                        </div>
                    </div>
                    </form>

                <?php endif;?>

                <h3 class="align-center">News</h3>
                <div class="table-wrapper">
                    <table class="alt">
                        <thead>
                        <tr>
                            <th class="align-center">News Id</th>
                            <th class="align-center">Author</th>
                            <th class="align-center">Name state</th>
                            <th class="align-center">Category</th>
                            <th class="align-center">Status</th>
                            <th class="align-center">Hide</th>
                            <th class="align-center">Delete</th>
                            <th class="align-center">Edit</th>
                            <th class="align-center">Default image</th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php foreach($news as $new): ;?>
                            <tr>
                                <td class="align-center"><?=$new['id'];?></td>
                                <td class="align-center"><?=$new['author'];?></td>
                                <td class="align-center"><?=$new['stateName'];?></td>
                                <td class="align-center"><?=$new['stateCategory'];?></td>
                                <td class="align-center"><?=$new['status'];?></td>
                                <td class="align-center"><a href="/admin/news/<?=$new['commandHide'];?>/<?=$new['id'];?>" class="<?=$new['iconHide'];?>"></a></td>
                                <td class="align-center"><a href="/admin/news/delete/<?=$new['id'];?>" class="icon fa-trash"></td>
                                <td class="align-center"><a href="/admin/news/edit/<?=$new['id'];?>" class="icon fa-pencil"></td>
                                <td class="align-center"><a href="/admin/news/defaultImage/<?=$new['id'];?>" class="icon fa-image"></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                    <h3 class="align-center">WARNING !</h3>
                    <p class="align-center">If you need to create a new article, then you can do this through your personal account on the site and then edit it on this page</p>
                </div>
            </section>
        </article>
    </div>

<?php include(ROOT . '/views/adminLayouts/footer.php');?>