<script>
  $("#inbox").addClass("active");
</script>
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
                    <?php if($_SESSION['level']!=5){ ?>
                    <?php $this->load->view('admin/content/surat/widget_sidebar'); ?>
                    <?php } ?>
                    <!-- /. box -->
                   
                    <!-- /.box -->
                  </div>
                  
                  <!-- /.col -->
                  <div class="col-md-9">
                    <div class="box box-primary">
                      <div class="box-header with-border">
                        <h3 class="box-title">Detail Surat</h3>
                        
                        <!-- /.box-tools -->
                      </div>
                      <!-- /.box-header -->
                      <div class="box-body ">
                        <button class="btn btn-primary" onclick="window.history.go(-1)"> Kembali </button>
                        <br><br>
                        <?php foreach($list_surat as $new_list_surat){?>
                          <div class="body-surat well row" style="background-color:white;width:80%;margin:auto">
                            <div class="col-sm-12"><h4>
                              Detail Surat
                              </h4><hr></div>
                            <div class="col-sm-6">
                               <b>Nomor Surat : </b> <?php echo $new_list_surat->kode_surat; ?>
                                <br><br>
                            </div> 
                            <div class="col-sm-6">
                               <b>Jenis Surat : </b> <?php echo $new_list_surat->nama_jenis_surat; ?>
                              <br><br>
                            </div>
                            <div class="col-sm-6">
                               <b>Keaslian Surat : </b> <?php echo $new_list_surat->nama_keaslian_surat; ?>
                              <br><br>
                            </div>
                            <div class="col-sm-6">
                               <b>No Urut Surat : </b> <?php echo $new_list_surat->no_urut_surat; ?>
                               <br><br>
                            </div>
                            <div class="col-sm-6">
                               <b>Perihal Surat : </b> <?php echo $new_list_surat->perihal_surat; ?>
                               <br><br>
                            </div>
                            <div class="col-sm-6">
                               <b>Jumlah Lampiran : </b> <?php echo $new_list_surat->jumlah_lampiran; ?>
                                <br><br>
                            </div> 
                            <div class="col-sm-6">
                               <b>Asal Surat : </b> <?php echo $new_list_surat->asal_surat; ?>
                              <br><br>
                            </div>
                            <div class="col-sm-6">
                               <b>Tujuan Surat : </b> <?php echo $new_list_surat->tujuan_surat; ?>
                              <br><br>
                            </div>
                            <div class="col-sm-6">
                               <b>Tanggal pembuatan surat : </b> <?php echo $new_list_surat->tanggal_pembuatan_surat; ?>
                               <br><br>
                            </div>
                            <div class="col-sm-6">
                               <b>Tanggal terima surat : </b> <?php echo $new_list_surat->tanggal_terima_surat; ?>
                               <br><br>
                            </div>
                          </div>
                          <br>
                          <div class="body-surat well row" style="background-color:white;width:80%;margin:auto">
                            <div class="col-sm-12">
                              <h4>Pesan dari Pengirim </h4>
                              <hr>
                              <p><?php echo $new_list_surat->deskripsi; ?></p>
                            </div>
                          </div>
                          <?php if($_SESSION['level']!='1' && $_SESSION['level']!='5'){?>
                          <hr>
                          <div style="background-color:white;width:80%;margin:auto">
                            <h3>Forward surat</h3>
                            <form action="<?php echo base_url('admin/surat/disposisi_send') ?>" method="post">
                              <input name="surat" type="text" hidden value="<?php echo $new_list_surat->id_surat; ?>">
                              <div class="form-group">
                                Tujuan
                                <select name="recipient" id="" class="form-control">
                                  <?php foreach($list_recipient as $x){?>
                                    <option value="<?php echo $x->id_user ?>"><?php echo $x->username." - ".$x->nama_role ?></option>
                                  <?php } ?>
                                </select>
                              </div>
                              <div class="form-group">
                                Komentar
                                <textarea name="deskripsi" class="form-control textarea" rows="10"></textarea>
                              </div>
                              <div class="form-group">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-share"></i> Forward</button>
                              </div>
                            </form>                        
                          </div>
                          <?php } ?>
                          <br>
                        <?php } ?>
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

