<?php
defined('BASEPATH') or exit('No script direct access allowed');
$discount = !empty($discount) ? json_decode($discount) : false;
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
                    <li class="breadcrumb-item"><a href="<?= base_url() ?>">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="<?= base_url() ?>/components/discount">Discount</a></li>
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
                $name=set_value('name',$discount ? $discount->name : '');                
                $validfrom=set_value('validfrom',$discount ? $discount->validfrom : '');                
                $validtill=set_value('validtill',$discount ? $discount->validtill : '');                
                $type=set_value('type',$discount ? $discount->type : '');                
                $amount=set_value('amount',$discount ? $discount->amount : '');                
                $isactive=set_value('isactive',$discount ? $discount->isactive : '');                
            ?>
            <form action="<?= base_url('admin/discount/add') ?>" method="POST" onsubmit="return validation()">
                <input type="hidden" name="id" value="<?= $discount_id ?>">
                <div class="card-body">
                    <div class="row form-group">
                        <div class="col-md-2">
                            <label>Name <span class="text-danger">*</span></label>
                        </div>
                        <div class="col-md-10">
                            <input type="text" class="form-control <?= form_error('name') ? 'is-invalid' : ''; ?>" placeholder="Enter discount coupon name" name="name" value="<?= $name?>">
                            <?= form_error('name', '<div class="invalid-feedback">', '</div>') ?>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-2">
                            <label>Valid From</label>
                        </div>
                        <div class="col-md-10">
                            <input type="date" class="form-control" name="validfrom" id="valid_from" value="<?= $validfrom ?>">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-2">
                            <label>Valid Till</label>
                        </div>
                        <div class="col-md-10">
                            <input type="date" class="form-control" name="validtill" id="valid_till" value="<?= $validtill ?>">
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-2">
                            <label>Type <span class="text-danger">*</span></label>
                        </div>
                        <div class="col-md-10">
                            <select name="type" class="form-control text-uppercase <?= form_error('type') ? 'is-invalid' : ''; ?>">
                                <option value="1" <?= $type == "1" ? 'selected' : '' ?>>Fixed</option>
                                <option value="2" <?= $type == "2" ? 'selected' : '' ?>>Percentage</option>
                            </select>
                            <?= form_error('type', '<div class="invalid-feedback">', '</div>') ?>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-2">
                            <label>Amount <span class="text-danger">*</span></label>
                        </div>
                        <div class="col-md-10">
                            <input type="text" class="form-control <?= form_error('amount') ? 'is-invalid' : ''; ?>" placeholder="Enter discount coupon amount" name="amount" value="<?= $amount ?>">
                            <?= form_error('amount', '<div class="invalid-feedback">', '</div>') ?>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-md-2">
                            <label>Status <span class="text-danger">*</span></label>
                        </div>
                        <div class="col-md-10">
                            <select name="isactive" class="form-control text-uppercase <?= form_error('isactive') ? 'is-invalid' : ''; ?>">
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

<!-- extra -->
<script>
    function validation() {
        var from = $('#valid_from').val();
        var to = $('#valid_till').val();
        if (Date.parse(from) > Date.parse(to)) {
            toastr.warning('Valid till must greater than valid from ');
            return false;
        }
        return true;
    }
</script>