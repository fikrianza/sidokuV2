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
                <div class="panel panel-primary">
                  <div class="panel-heading"><h4>Detail data user</h4></div>
                  <div class="panel-body">
                    <ul class="list-group">
                      <li class="list-group-item">
                        Status : 
                        <?php if($x->status=='t'){echo "<span class='label label-success'> Aktif </span>";} ?>
                        <?php if($x->status=='f'){echo "<span class='label label-warning'> Tidak Aktif </span>";} ?>
                        <!--postgres syntax-->
                        <?php //if( $x->status=='t'){echo "<span class='label label-success'> Aktif </span>";} ?>
                        <?php //if( $x->status=='f'){echo "<span class='label label-warning'> Tidak Aktif </span>";} ?>
                      </li>
                      <li class="list-group-item">
                        Nama Lengkap : <?php echo $x->nama; ?>
                      </li>
                      <li class="list-group-item">
                        Username : <?php echo $x->username; ?>
                      </li>
                      <li class="list-group-item">
                        Email : <?php echo $x->email; ?>
                      </li>
                      <li class="list-group-item">
                        NIP : <?php echo $x->nip; ?>
                      </li>
                      <li class="list-group-item">
                        Nama Role / Jabatan: <?php echo $x->nama_role; ?>
                      </li>
                      <li class="list-group-item">
                        Dibuat pada : <?php echo $x->created_date; ?>
                      </li>
                      <li class="list-group-item">
                        Diupdate terakhir pada : <?php echo $x->update_date; ?>
                      </li>
                    </ul>
                  </div>
                </div>     
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
