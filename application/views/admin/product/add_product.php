<?php defined('BASEPATH') or exit('No direct script access allowed');
$product = isset($product) ? json_decode($product) : false;
// var_dump($product->gallery);exit;
?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"><?= $title ?></h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url('admin/product') ?>">Product</a></li>
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
            <?php
            $category = set_value('category', $product ? $product->category : '');
            $subcategory = set_value('subcategory', $product ? $product->subcategory : '');
            $name = set_value('name', $product ? $product->name : '');
            $description = set_value('description', $product ? $product->description : '');
            $price = set_value('price', $product ? $product->price : '');
            $availability = set_value('availability', $product ? $product->availability : '');
            $special = set_value('special', $product ? $product->special : '');
            $featured = set_value('featured', $product ? $product->featured : '');
            ?>
            <!-- form start -->
            <form action="" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $product_id ?>">
                <div class="card-body">
                    <div class="row form-group">
                        <div class="col-md-2">
                            <label>Category <span class="text-danger">*</span></label>
                        </div>
                        <div class="col-md-10">
                            <select name="category" id="category" class="form-control text-uppercase">
                                <option value="f" disabled selected>---Select a category---</option>
                                <?php foreach ($category_list as $l) : ?>
                                    <option value="<?= $l->id ?>" <?= $l->id == $category ? "selected" : "" ?>><?= $l->name ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?= form_error('category', '<div class="invalid-feedback">', '</div>') ?>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-2">
                            <label>Subcategory <span class="text-danger">*</span></label>
                        </div>
                        <div class="col-md-10">
                            <select name="subcategory" id="subcategory" class="form-control text-uppercase">
                                <option value="" disabled selected>---Select a Subcategory---</option>
                                <?php foreach ($subcategory_list as $l) : ?>
                                    <option value="<?= $l->id ?>" <?= $l->id == $subcategory ? "selected" : "" ?>><?= $l->name ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?= form_error('subcategory', '<div class="invalid-feedback">', '</div>') ?>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-2">
                            <label>Name <span class="text-danger">*</span></label>
                        </div>
                        <div class="col-md-10">
                            <input type="text" class="form-control" placeholder="Enter product name" name="name" value="<?= $name ?>">
                            <?= form_error('name', '<div class="invalid-feedback">', '</div>') ?>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-2">
                            <label>Description</label>
                        </div>
                        <div class="col-md-10">
                            <textarea name="description" rows="4" class="form-control" placeholder="Enter product description"><?= $description ?></textarea>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-2">
                            <label>Price <span class="text-danger">*</span></label>
                        </div>
                        <div class="col-md-10">
                            <input type="text" class="form-control" placeholder="Enter product price" name="price" value="<?= $price ?>">
                            <?= form_error('price', '<div class="invalid-feedback">', '</div>') ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="offset-md-3 col-md-2">
                            <?php
                            if ($product && isset($product->image_extension)) {
                                echo  '<img src="' .base_url('upload/product/small/'. $product_id  . $product->image_extension ).'" class="d-block mx-auto image-responsive mb-3" >';
                            }
                            ?>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-2">
                            <label>Fetured Image <span class="text-danger"><?= $product_id ? '' : "*" ?></span></label>
                        </div>
                        <div class="col-md-10">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="image" accept="image/jpeg,image/png" <?= $product_id ? '' : "" ?>>
                                <label class="custom-file-label">Choose file</label>
                                <?= form_error('image', '<div class="invalid-feedback">', '</div>') ?>
                            </div>
                            <label class="text-info text-sm">(Image should be &lt;10MB and minimum 1000&times;1000 pixels square sized)</label>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-2">
                            <label>Availability <span class="text-danger">*</span></label>
                        </div>
                        <div class="col-md-10">
                            <select name="availability" class="form-control">
                                <option value="1" <?= $availability == "1" ? 'selected' : '' ?>>In Stock</option>
                                <option value="0" <?= $availability == "0" ? 'selected' : '' ?>>Out of Stock</option>
                            </select>
                        </div>
                    </div>
                    <div class="row gallery mb-3">
                        <div class="col-md-2"></div>
                        <?php
                        if ($product && !empty($product->gallery)) :
                            $gallery = explode(',', $product->gallery);
                            foreach ($gallery as $key => $extension) :
                        ?>
                                <div class="col-md-2 mb-1">
                                    <img src="<?= base_url('upload/productgallery/small/'.$extension) ?>" alt="" class="image-responsive d-block mx-auto">
                                </div>
                        <?php endforeach;
                        endif; ?>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-2">
                            <label>Gallery Image</label>
                        </div>
                        <div class="col-md-10">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" multiple="true" name="gallery[]" accept="image/jpeg,image/png">
                                <label class="custom-file-label">Choose file</label>
                                <?= form_error('gallery', '<div class="invalid-feedback">', '</div>') ?>
                            </div>
                            <label class="text-info text-sm">*** You can choose multiple image here for product gallery *** <br />(Image should be &lt;10MB and minimum 1000&times;1000 pixels square sized)</label>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="offset-md-2 col-md-10 row">
                            <div class="col-md-3 form-check">
                                <input type="checkbox" name="special" class="form-check-input" <?= $special == 1 || $special == 'on' ? 'checked' : '' ?>>
                                <label class="form-check-label">Add to Special Product</label>
                            </div>
                            <div class="col-md-3 form-check">
                                <input type="checkbox" name="featured" class="form-check-input" <?= $featured == 1 || $featured == 'on' ? 'checked' : '' ?>>
                                <label class="form-check-label">Add to Featured Product</label>
                            </div>
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

<!-- extra  -->

<script>
    $(function() {
        bsCustomFileInput.init();
    });
    $(function() {
        $('#category').on('change', function() {
            const data = {
                id: $('#category').val()
            };
            $.ajax({
                url: '<?= base_url('admin/product/get_subcategory') ?>',
                type: 'post',
                dataType: 'json',
                data,
                success: function(data) {
                    $('#subcategory').empty();
                    $('#subcategory').append('<option disabled selected value>--- SELECT SUBCATEGORY ---</option>');

                    $.each(data, function(i, value) {
                        $('#subcategory').append('<option value="' + value.id + '">' + value.name + '</option>');
                    });
                },
                error: function(response) {
                    console.log({
                        error: response
                    });
                }
            });
        });
    });
</script>