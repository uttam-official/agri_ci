<!-- Content Header (Page header) -->
<div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Category</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item">Category</li>
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
                <div class="card-body">
                    <div class="d-flex flex-wrap justify-content-center mb-2">
                        <a href="<?= base_url('admin') ?>/components/category" class="btn btn-success btn-sm mr-1 mb-1">ALL</a>
                        <?php
                        for ($char = ord('A'); $char <= ord('Z'); $char++) {
                            echo '<a href="' . base_url('admin') . '/components/category/index.php?search=' . chr($char) . '" class="btn btn-success btn-sm mr-1 mb-1">' . chr($char) . '</a>';
                        }
                        ?>
                    </div>
                    <form action="" method="GET" class="">
                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-2">
                                <input type="text" class="form-control" name="srh" placeholder="Search category ...">
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-success form-control">Search</button>
                            </div>
                        </div>
                    </form>



                    <div class="rounded-top" style="border-top: solid 3px #17a2b8;">
                        <div class="text-right my-2">
                            <a href="<?= base_url('admin') ?>/components/category/add.php" class="btn btn-sm btn-success">Add
                                New</a>
                        </div>
                        <div class="row mt-4">
                            <table class="table-sm table-bordered table-hover col-md-11 mx-auto">
                                <thead>
                                    <tr class="text-center table-secondary">
                                        <th>#</th>
                                        <th class="text-left">Category Name</th>
                                        <th>Order</th>
                                        <th>Status</th>
                                        <th>Number of Sub-category</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($page_data && !is_null($page_data)) :
                                        foreach ($page_data as $key => $value) :
                                    ?>
                                            <tr class="text-center">
                                                <td><?= $key + 1 ?></td>
                                                <td class="text-left"><?= $value->name ?></td>
                                                <td><?= $value->categoryorder ?></td>
                                                <td><?= $value->isactive ? '<span class="badge badge-primary">Active</span>' : '<span class="badge badge-secondary">Inactive</span>'; ?></td>
                                                <td><?= $value->no_of_subcategory ?></td>
                                                <td>
                                                    <a href="<?= base_url('admin') ?>/components/category/add.php?id=<?= $value->id ?>" class="btn btn-sm btn-outline-info" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></a>
                                                    <a href="<?= base_url('admin') ?>/components/category/delete.php?id=<?= $value->id ?>" class="btn btn-sm btn-outline-danger" data-toggle="tooltip" title="Delete"> <i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        <?php endforeach;
                                    else : ?>
                                        <tr>
                                            <td class="text-center text-danger" colspan="6">No data found !</td>
                                        </tr>
                                    <?php endif; ?>
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