<!-- Content Header (Page header) -->
<div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Settings</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url('admin') ?>">Dashboard</a></li>
                        <li class="breadcrumb-item active">Settings</li>
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
                <!-- /.card-header -->
                <!-- form start -->
                <div class="card-body">
                    <?=form_open('admin/settings',['method'=>'post','class'=>'form-group'])?>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <?php $email=empty(set_value('email'))?$email:set_value('email');?>
                                <label>Username/Email Id <span class="text-danger">*</span></label>
                                <input type="text" class="form-control <?=form_error('email')?'is-invalid':''?>" name="email" placeholder="Enter your username/email id" value="<?= $email ?>">
                                <?=form_error('email','<div class="invalid-feedback">','</div>')?>
                            </div>
                            <div class="col-md-6">
                                <label>Password <span class="text-danger">*</span></label>
                                <input type="password" name="password" class="form-control <?=form_error('password')?'is-invalid':''?>" placeholder="Enter new password" >
                                <?=form_error('password','<div class="invalid-feedback">','</div>')?>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="d-inline-block ml-auto mr-3">
                                <button class="btn btn-sm btn-success">Save</button>
                            </div>
                        </div>
                    <?=form_close();?>
                </div>
            </div>
        </div>
    </section>