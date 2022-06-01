<!DOCTYPE html>
<html lang="en">
<?php include_once 'includes/header.php' ?>


<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <?php include_once 'includes/preloader.php'?>
        <?php include_once 'includes/navbar.php' ?>
        <?php include_once 'includes/sidebar.php' ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <?= $content; ?>
        </div>
        <!-- /.content-wrapper -->
        <?php include_once 'includes/footer.php' ?>
        <?php include_once 'includes/js.php' ?>
    </div>
    <!-- ./wrapper -->
</body>

</html>