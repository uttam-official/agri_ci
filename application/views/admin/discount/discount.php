<?php defined('BASEPATH') or exit('No script direct access allowed'); ?>
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Discount coupon</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Dashboard</a></li>
                    <li class="breadcrumb-item">Discount coupon</li>
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
            <div class="text-right mt-3">
                <a href="<?= base_url('admin/discount/add') ?>" class="btn btn-sm btn-success mr-3"><i class="fa fa-plus-circle"></i> Add
                    New</a>
            </div>
            <div class="card-body">
                <div class="rounded-top pt-3" style="border-top: solid 3px #17a2b8;">
                    <table id="category_table" class="table table-hover table-striped nowrap dataTable data-table">
                        <thead>
                            <tr class="text-center table-secondary">
                                <th>#</th>
                                <th class="text-left">Discount Name</th>
                                <th>Valid From</th>
                                <th>Valid Till</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($page_data as $key => $value) : ?>
                                <tr class="text-center">
                                    <td><?= $key + 1 ?></td>
                                    <td class="text-left"><?= $value->name ?></td>
                                    <td><?= $value->validfrom != null ? date('d-m-Y', strtotime($value->validfrom)) : '' ?></td>
                                    <td><?= $value->validtill != null ? date('d-m-Y', strtotime($value->validtill)) : '' ?></td>
                                    <td ><?= $value->amount ?></td>
                                    <td><?= $value->isactive ? '<span class="badge badge-primary">Active</span>' : '<span class="badge badge-secondary">Inactive</span>'; ?></td>
                                    <td>
                                        <a href="<?= base_url('admin/discount/add/'.$value->id)  ?>" class="btn btn-sm btn-outline-info" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></a>
                                        <a href="<?= base_url('admin/discount/delete/'.$value->id) ?>" class="btn btn-sm btn-outline-danger" data-toggle="tooltip" title="Delete"> <i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.card -->
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

    </div><!-- /.container-fluid -->
</section>
<!-- /.content -->


<!-- extra  -->
<?php if ($this->session->flashdata('discount_error')) : ?>
    <script>
        toastr.error("<?=$this->session->flashdata('discount_error')?>");
    </script>
<?php endif; ?>
<?php if ($this->session->flashdata('discount_success')) : ?>
    <script>
        toastr.success("<?=$this->session->flashdata('discount_success')?>");
    </script>
<?php endif; ?>