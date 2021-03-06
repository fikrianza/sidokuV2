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
               <!--content here-->
              <section class="content">
                <div class="row">
                  <div class="col-md-3">
                    <?php $this->load->view('admin/content/surat/widget_sidebar'); ?>
                    <!-- /. box -->

                    <!-- /.box -->
                  </div>
                  <!-- /.col -->
                  <div class="col-md-9">
                    <div class="box box-primary">
                      <div class="box-header with-border">
                        <h3 class="box-title">Surat terkirim</h3>
                        <!-- /.box-tools -->
                      </div>
                      <!-- /.box-header -->
                      <div class="box-body no-padding">
                        <div class="mailbox-controls">
                          <!-- Check all button -->

                          <!-- /.btn-group -->
                          <!-- /.pull-right -->
                        </div>
                        <br>
                        <div class="table-responsive mailbox-messages">
                          <table id="example" class="table table-hover table-striped" >
                            <thead>
                               <tr>
								<th> Antrian surat</th>
                                <th>Penerima</th>
                                <th>Isi disposisi</th>
                                <th>Waktu</th>
                                <th>Status</th>
								<th>Tindakan</th>
                               </tr>
                            </thead>
                            <tbody>
                              <?php $count=1;foreach($list_disposisi as $new_list_disposisi){ ?>
                                <tr>
									<td><?php echo $new_list_disposisi->no_urut_surat ?></td>
									<td class="mailbox-name"><?php echo $new_list_disposisi->nama."( ".$new_list_disposisi->username . ")";  ?></td>
									<td class="mailbox-subject"><b><?php echo $new_list_disposisi->kode_surat ?></b>
									</td>
									<td class="mailbox-date"><?php echo $new_list_disposisi->created_date ?></td>
									<td>
                                  	<!-- postgres syntax-->
									<?php if($new_list_disposisi->is_read=='f'){echo "<span class='label label-default'><i class='fa fa-eye'></i> Belum dibaca</span>";} ?>
                                    <?php if($new_list_disposisi->is_read=='t'){echo "<span class='label label-info'><i class='fa fa-eye'></i> Telah dibaca</span>";} ?>
									</td>
									<td><a href="<?php echo base_url('admin/surat/disposisi_detail/'.$new_list_disposisi->id_disposisi) ?>"><i class="fa fa-search"></i> Lihat Detail</a></td>
                                </tr>
                              <?php  $count++;}  ?>
                            </tbody>
                          </table>
                          <!-- /.table -->
                        </div>
                        <!-- /.mail-box-messages -->
                      </div>
                      <!-- /.box-body -->

                    </div>
                    <!-- /. box -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </section>
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

<?php if(//$_SESSION['level']==2 ||
			 $_SESSION['level']==1){ ?>
<nav class="navbar navbar-default navbar-fixed-bottom" id="compose-nav" style="width:52%;margin-left:45%;
                                                                               ;padding:0px !important;background-color:transparent">
    <div class="box box-primary box-solid collapsed-box">
        <div class="box-header with-border">
          <h3 class="box-title">Buat disposisi</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
          </div>
              <!-- /.box-tools -->
        </div>
            <!-- /.box-header -->
        <div class="box-body" style="max-height:500px;overflow-y:scroll;overflow-x:hidden">
            <form action="<?php echo base_url('admin/surat/disposisi') ?>" method="post">
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <p>Pilih surat</p>
                    <select name="surat" id="" class="form-control">
                      <?php  foreach($list_surat as $x){?>
                        <option value="<?php echo $x->id_surat ?>"><?php echo $x->kode_surat ?></option>
                      <?php }?>
                    </select>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <p>Dikirim kepada</p>
                    <select name="recipient" id="" class="form-control">
                      <?php  foreach($list_recipient as $x){?>
                        <option value="<?php echo $x->id_user ?>"><?php echo $x->username." - ".$x->nama_role ?></option>
                      <?php }?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <p>Pesan</p>
                <textarea id="compose-textarea" class="form-control textarea" name="deskripsi"></textarea>
              </div>
              <div class="form-group">
               <button class=" btn btn-primary" type="submit"><i class="fa fa-envelope-o"></i> Kirim </button>
              </div>
            </form>
        </div>
           <!-- /.box-body -->
    </div>
</nav>

<?php } ?>
