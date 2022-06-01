<?php 
defined('BASEPATH') OR exit('no direct access allowed');
$category=isset($category)?json_decode($category):false;
?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><?= $title ?> </h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url('admin/category') ?>">Category</a></li>
                    <li class="breadcrumb-item active"><?= $title ?></li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <!-- general form elements -->
        <div class="card card-outline card-info">
            <div class="card-header">
                <h3 class="card-title"><?= $title ?></h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <?php
            $name = set_value('name',$category ? $category->name : '');
            $categoryorder = set_value('categoryorder',$category ? $category->categoryorder : '0');
            $isactive =set_value('isactive',$category ? $category->isactive : "");
            ?>

            <form action="" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $category_id ?>">
                <div class="card-body">
                    <div class="row form-group">
                        <div class="col-md-2">
                            <label>Name <span class="text-danger">*</span></label>
                        </div>
                        <div class="col-md-10">
                            <input type="text" class="form-control <?= form_error('name') ? 'is-invalid' : ''; ?>" placeholder="Enter category name" name="name" value="<?= $name ?>">
                            <?= form_error('name', '<div class="invalid-feedback">', '</div>') ?>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-2">
                            <label>Order <span class="text-danger">*</span></label>
                        </div>
                        <div class="col-md-10">
                            <input type="text" class="form-control <?= form_error('categoryorder') ? 'is-invalid' : ''; ?>" placeholder="Enter category Order" name="categoryorder" value="<?= $categoryorder ?>">
                            <?= form_error('categoryorder', '<div class="invalid-feedback">', '</div>') ?>
                        </div>
                    </div>
                    <?php
                    if ($category && isset($category->extension)) {
                        echo '<div class="row mb-3">';
                        echo '<div class="col-md-3"></div>';
                        echo '<div class="col-md-2">';
                        echo '<img style="background-color:rgb(180 217 129)" class="image image-responsive d-block mx-auto" src="'.base_url('upload/category/').$category_id.$category->extension.'" />';
                        echo '</div>';
                        echo '</div>';
                    }
                    ?>
                    <div class="row form-group">
                        <div class="col-md-2">
                            <label>Image <span class="text-danger"><?= $category_id > 0 ? '' : "*" ?></span></label>
                        </div>
                        <div class="col-md-10">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input <?= form_error('image') ? 'is-invalid' : ''; ?>" name="image" accept="image/jpeg,image/png" <?= $category_id ? '' : "" ?>>
                                <label class="custom-file-label">Choose file</label>
                                <?= form_error('image', '<div class="invalid-feedback">', '</div>') ?>
                            </div>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-2">
                            <label>Status <span class="text-danger">*</span></label>
                        </div>
                        <div class="col-md-10">
                            <select name="isactive" class="form-control <?= form_error('isactive') ? 'is-invalid' : ''; ?>">
                                <option value="1" <?= $isactive == "1" ? 'selected' : '' ?>>Active</option>
                                <option value="0" <?= $isactive == "0" ? 'selected' : '' ?>>Deactive</option>
                            </select>
                            <?= form_error('isactive', '<div class="invalid-feedback">', '</div>') ?>
                        </div>
                    </div>
                    <div class=" text-center">
                        <button type="submit" class="btn btn-sm btn-success"><?= $btn_text ?></button>&nbsp;&nbsp;<button type="reset" class="btn btn-sm btn-warning text-white">Reset</button>
                    </div>
                </div>
                <!-- /.card-body -->
            </form>
        </div>
        <!-- /.card -->

    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

<script>
    $(function() {
        bsCustomFileInput.init();
    });
</script>