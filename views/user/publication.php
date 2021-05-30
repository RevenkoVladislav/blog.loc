<?php include(ROOT . '/views/layouts/header.php');?>
    <body class="single">
    <!-- Wrapper -->
<div id="wrapper">
    <!-- Header -->
    <?php include (ROOT . '/views/layouts/menu.php');?>
    <div id="main">
        <article class="post">
            <section>
                <h3 class="align-center">Add article</h3>
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
                        <div class="6u 12u$(xsmall)">
                            <label for="stateName">Article name</label>
                            <input type="text" name="stateName" id="stateName" value="<?php if (!empty($stateName)) echo $_POST['stateName'];?>" placeholder="Article name" required/>
                        </div>

                        <div class="6u 12u$(xsmall)">
                            <label for="stateDescription">Article description</label>
                            <input type="text" name="stateDescription" id="stateDescription" value="<?php if (!empty($stateDescription)) echo $_POST['stateDescription'];?>" placeholder="Article Description" required/>
                        </div>

                        <div class="6u 12u$(xsmall)">
                            <label for="stateCategory">Article category</label>
                            <select class="select-wrapper" name="stateCategory" id="stateCategory" required>
                                <option disabled>Select a category</option>
                                <?php foreach($categories as $category): ?>
                                <option <?php if(!empty($stateCategory) AND $stateCategory == $category['categoryName']) echo 'selected';?> value="<?=$category['categoryName'];?>"><?=$category['categoryName'];?></option>
                                <?php endforeach;?>
                            </select>
                        </div>

                        <div class="6u 12u$(xsmall)">
                        <label for="stateImage">Upload image</label>
                            <input type="file" name="stateImage" id="stateImage">
                        </div>

                        <div class="12u$">
                            <label for="state">Article</label>
                            <textarea name="state" id="state" placeholder="Article" rows="15" required><?php if (!empty($state)) echo $_POST['state'];?></textarea>
                        </div>

                        <div class="6u$ 12u$">
                            <ul class="actions fit">
                                <li><input class="fit" name="addArticle" type="submit" value="Publication" /></li>
                                <li><input type="reset" value="Reset" /></li>
                            </ul>
                        </div>
                    </div>
                </form>
            </section>
        </article>
    </div>

<?php include(ROOT . '/views/layouts/footer.php');?>