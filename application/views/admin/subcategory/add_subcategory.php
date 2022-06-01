<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
$subcategory=$subcategory?json_decode($subcategory):false; 
// var_dump($subcategory);exit;
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
                       <li class="breadcrumb-item"><a href="<?= base_url() ?>/components/subcategory">Subcategory</a></li>
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
                    $parent=set_value('parent',$subcategory?$subcategory->parent:'');
                    $isactive=set_value('isactive',$subcategory?$subcategory->isactive:'');
                    $name=set_value('name',$subcategory?$subcategory->name:'');
                    $categoryorder=set_value('categoryorder',$subcategory?$subcategory->categoryorder:'');
                ?>
               <form action="" method="POST">
                   <input type="hidden" name="id" value="<?= $subcategory_id ?>">
                   <div class="card-body">
                       <div class="row form-group">
                           <div class="col-md-2">
                               <label>Category <span class="text-danger">*</span></label>
                           </div>
                           <div class="col-md-10">
                               <select name="parent" class="form-control text-uppercase <?= form_error('parent') ? 'is-invalid' : ''; ?>">
                                   <option value="" disabled selected>---Select a category---</option>
                                   <?php foreach ($category_list as $l) : ?>
                                       <option value="<?= $l->id ?>" <?= $l->id == $parent ? "selected" : "" ?>><?= $l->name ?></option>
                                   <?php endforeach; ?>
                               </select>
                               <?= form_error('parent', '<div class="invalid-feedback">', '</div>') ?>
                           </div>
                       </div>
                       <div class="row form-group">
                           <div class="col-md-2">
                               <label>Name <span class="text-danger">*</span></label>
                           </div>
                           <div class="col-md-10">
                               <input type="text" class="form-control <?= form_error('name') ? 'is-invalid' : ''; ?>" placeholder="Enter category name" name="name" value="<?= $name  ?>">
                               <?= form_error('name', '<div class="invalid-feedback">', '</div>') ?>
                           </div>
                       </div>
                       <div class="row form-group">
                           <div class="col-md-2">
                               <label>Order <span class="text-danger">*</span></label>
                           </div>
                           <div class="col-md-10">
                               <input type="text" class="form-control <?= form_error('categoryorder') ? 'is-invalid' : ''; ?>" placeholder="Enter category Order" name="categoryorder" value="<?= $categoryorder?>">
                               <?= form_error('categoryorder', '<div class="invalid-feedback">', '</div>') ?>
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