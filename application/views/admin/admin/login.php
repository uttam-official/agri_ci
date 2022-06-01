<div class="login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="#"><b>Agri Express</b> LOGIN</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in to start your session</p>
                <?= $this->session->flashdata('login_error')? '<p class="bg-danger text-danger text-center p-2 rounded">' . $this->session->flashdata('login_error') . '</p>' : '' ?>
                <?= $this->session->flashdata('login_warning')? '<p class="bg-warning text-center p-2 rounded">' . $this->session->flashdata('login_warning') . '</p>' : '' ?>
                <?= form_open(base_url('admin/login'), ['method' => 'post', 'class' => 'form']) ?>
                <?= form_error('email', '<span class="invalid-feedback">', '</span>') ?>
                <div class="input-group mb-3">
                    <input type="text" class="form-control <?=form_error('email')?'is-invalid':''?>" placeholder="Email" name="email" value="<?=set_value('email')?>">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <?= form_error('password', '<span class="invalid-feedback">', '</span>') ?>
                <div class="input-group mb-3">
                    <input type="password" class="form-control <?=form_error('password')?'is-invalid':''?>" placeholder="Password" name="password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!-- /.col -->
                    <div class="col-5 mx-auto">
                        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                    </div>
                    <!-- /.col -->
                </div>
                <?= form_close() ?>
                <!-- /.login-card-body -->
            </div>
        </div>
        <!-- /.login-box -->
    </div>