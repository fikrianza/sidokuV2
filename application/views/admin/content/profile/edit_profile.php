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
              
              <div>
                <?php foreach($list_profile as $x){ ?>
                  <div class="callout callout-info" style="background-color:#3c8dbc !important">
                    <p>Username : <?php echo $x->username ?></p>
                    <p>Role  : <?php echo $x->nama_role ?></p>
                  </div>
                  <br>
                  <form action="<?php echo base_url('admin/profile') ?>" method="post" style="width:500px">
                    <div class="form-group">
                      <p>Nama</p>
                      <input type="text" name="nama" class="form-control" value="<?php echo $x->nama ?>" required></input>
                    </div>
                    <div class="form-group">
                      <p>Email </p>
                      <input type="email" name="email" class="form-control" value="<?php echo $x->email ?>" required></input>
                    </div>

                    <div class="form-group">
                      <button class="btn btn-primary"><i class="fa fa-save"></i> Simpan Data</button>
                    </div>
                  </form>
                <?php } ?>
              </div>
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
