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
              <div  class="row">
                <div class="col-sm-12">
                   <form action="<?php echo base_url('admin/user/add') ?>" method="post">
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
                    <div class="form-group has-feedback">
                      <p>
                        Nama Lengkap
                      </p>
                      <input type="text" class="form-control" placeholder="Nama Lengkap" name="nama" required>                    
                    </div>
                     <div class="form-group has-feedback">
                       <p>
                        Username Pengguna
                      </p>
                      <input type="text" class="form-control" placeholder="username pengguna" name="username" required>          
                    </div>
                    <div class="form-group has-feedback">
                      <p>
                        Email Pengguna
                      </p>
                      <input type="email" class="form-control" placeholder="Email" name="email" required>
                    </div>
                    <div class="form-group has-feedback">
                      <p>
                        NIP / NIK
                      </p>
                      <input type="text" class="form-control" placeholder="NIP/NIK" name="nip" required>
                    </div>
                    <div class="form-group has-feedback">
                      <p>
                        Pilih Role
                      </p>
                      <select name="role" id="" class="form-control" required>
                        <?php foreach($list_role as $x){ ?>
                          <option value="<?php echo $x->id_role ?>"><?php echo $x->nama_role ?></option>
                        <?php  } ?>
                      </select>                    
                    </div>
                    <div class="form-group has-feedback">
                      <p>
                        Password
                      </p>
                      <input type="password" class="form-control" placeholder="Masukan Password" name="password" required>
                    </div>
                     <div class="form-group has-feedback">
                       <p>
                        Tulis Ulang Password
                      </p>
                      <input type="password" class="form-control" placeholder="Masukan Ulang Password" name="re_password" required>
                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-lg"><i class="fa fa-plus"></i> Tambahkan akun</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <!-- /.box-body -->
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
