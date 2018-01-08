<?php $this->load->view('admin/content/sidebar'); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo $title ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i></a></li>
        <?php  foreach($breadcumbs as $b){?>
           <li><a href="#"><?php echo $b ?></a></li>
        <?php } ?>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <!-- Default box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">
                <ol class="breadcrumb">
                  <li><a href="#"><i class="fa fa-dashboard"></i></a></li>
                  <?php  foreach($breadcumbs as $b){?>
                     <li><a href="#"><?php echo $b ?></a></li>
                  <?php } ?>
                </ol>
              </h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                  <i class="fa fa-minus"></i></button>
              </div>
            </div>
            <div class="box-body">
              <div>
                <a href="<?php echo base_url('admin/user') ?>">
                  <button class="btn btn-primary"><i class="fa fa-chevron-left"></i> Kembali </button>
                </a>
              </div>
              <br>
              <div class="error-message">
                 <?php if(isset($_SESSION['error_message'])){ ?>
                   <div class="alert alert-danger">
                     <?php echo $_SESSION['error_message']; ?>
                   </div>
                 <?php  unset($_SESSION['error_message']); }?>
                      
                 <?php if(isset($_SESSION['success_message'])){ ?>
                   <div class="alert alert-success">
                     <?php echo $_SESSION['success_message']; ?>
                   </div>
                 <?php  unset($_SESSION['success_message']); }?>
                      
                 <?php echo validation_errors(); ?>
               </div>
               <!--content here-->
               <?php foreach($list_user as $x){ ?>
                <form action="<?php echo base_url('admin/user/password/'.$x->id_user) ?>" method="post">
                    <div class="error-message">
                      <?php if(isset($_SESSION['error_message'])){ ?>
                        <div class="alert alert-danger">
                          <?php echo $_SESSION['error_message']; ?>
                        </div>
                      <?php  unset($_SESSION['error_message']); }?>
                      
                      <?php if(isset($_SESSION['success_message'])){ ?>
                        <div class="alert alert-success">
                          <?php echo $_SESSION['success_message']; ?>
                        </div>
                      <?php  unset($_SESSION['success_message']); }?>
                      
                      <?php echo validation_errors(); ?>
                    </div>
                    <p><b>Data User</b></p>
                    <div class="form-group has-feedback">
                      <p>
                        Password Baru 
                      </p>
                      <input type="password" class="form-control" placeholder="Password baru" name="new_password" required>
                    </div>
                    <div class="form-group has-feedback">
                      <p>
                        Ulangi Password Baru 
                      </p>
                      <input type="password" class="form-control" placeholder="Password baru" name="new_password_2" required>
                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-lg"><i class="fa fa-plus"></i> Simpan Perubahan akun</button>
                    </div>
                  </form>    
               <?php } ?>
               
            </div>
            <!-- /.box-footer-->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
