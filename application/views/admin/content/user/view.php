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
               <div class="table-responsive">
                 <table id="example1" class="table table-bordered table-striped" >
                <thead>
                <tr>
                  <th>#</th>
                  <th>Nama Lengkap</th>
                  <th>Username</th>
                  <th>Email</th>
                  <th>NIP</th>
                  <th>Role</th>
                  <th>Status</th>
                  <th>Tindakan</th>
                </tr>
                </thead>
                <tbody>
                  <?php $count=1; foreach($list_user as $x){ ?>
                    <tr>
                      <td><?php echo $count; ?></td>
                      <td><?php echo $x->nama; ?></td>
                      <td><?php echo $x->username; ?></td>
                      <td><?php echo $x->email; ?></td>
                      <td><?php echo $x->nip; ?></td>
                      <td><?php echo $x->nama_role; ?></td>
                      <td>
                        <!--postgres syntax-->
                        <?php if( $x->status=='t'){echo "<span class='label label-success'> Aktif </span>";} ?>
                        <?php if( $x->status=='f'){echo "<span class='label label-warning'> Tidak Aktif </span>";} ?>
                      </td>
                      <td>
                        <div class="row">
                          <div class="col-sm-3">
                            <a href="<?php echo base_url('admin/user/detail/'.$x->id_user) ?>">
                              <button class="btn btn-link"><i class="fa fa-search"></i></button>
                            </a>
                          </div>
                          <div class="col-sm-3">
                            <a href="<?php echo base_url('admin/user/edit/'.$x->id_user) ?>">
                              <button class="btn btn-link"><i class="fa fa-edit"></i></button>
                            </a>
                          </div>
                          <div class="col-sm-3">
                            <a href="<?php echo base_url('admin/user/delete/'.$x->id_user) ?>">
                              <button class="btn btn-link"><i class="fa fa-trash-o"></i></button>
                            </a>
                          </div>
						  <div class="col-sm-3">
                            <a href="<?php echo base_url('admin/user/password/'.$x->id_user) ?>">
                              <button class="btn btn-link"><i class="fa fa-unlock-alt"></i></button>
                            </a>
                          </div>
                        </div>
                      </td>
                    </tr>
                  <?php $count++;} ?>
                </tbody>
              </table>
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
