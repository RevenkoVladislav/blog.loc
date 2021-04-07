<?php include(ROOT . '/views/layouts/header.php');?>
    <body class="single">
    <!-- Wrapper -->
<div id="wrapper">
    <!-- Header -->
    <?php include (ROOT . '/views/layouts/menu.php');?>

    <div id="main">
        <article class="post">
            <section>
                <h3 class="align-center">Edit article</h3>
                <form method="post" action="">

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
                            <label for="editStateDescription">Article description</label>
                            <input type="text" name="editStateDescription" id="editStateDescription"
                            value="<?php if (!empty($editStateDescription)){
                                echo $_POST['editStateDescription'];
                                } else {
                                echo $article['stateDescription'];
                                }
                                ?>" placeholder="Article Description" required/>
                        </div>

                        <div class="12u$">
                            <label for="editState">Article</label>
                            <textarea name="editState" id="editState" placeholder="Article" rows="15" required>
                                <?php if (!empty($editState)){
                                    echo $_POST['editState'];
                                } else {
                                    echo $article['state'];
                                };?>
                            </textarea>
                        </div>

                        <div class="6u$ 12u$">
                            <ul class="actions fit">
                                <li><input class="fit" name="editArticle" type="submit" value="Edit article" /></li>
                                <li><input type="reset" value="Reset" /></li>
                            </ul>
                        </div>
                    </div>
                </form>
            </section>
        </article>
    </div>

<?php include(ROOT . '/views/layouts/footer.php');?>