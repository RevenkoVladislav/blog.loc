<?php include(ROOT . '/views/layouts/header.php');?>
<body class="single">
<!-- Wrapper -->
<div id="wrapper">
    <!-- Header -->
    <?php include (ROOT . '/views/layouts/menu.php');?>
<?php
echo $_SESSION['userId'];
echo "<br>";
echo $_SESSION['userLogin'];
?>

<?php include(ROOT . '/views/layouts/footer.php');?>
