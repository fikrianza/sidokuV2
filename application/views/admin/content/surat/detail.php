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
                <a href="<?php echo base_url('admin/surat') ?>">
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
               <?php foreach($list_surat as $new_list_surat){ ?>               
                <div class="panel panel-primary">
                  <div class="panel-heading"><h4><b>Detail Umum</b></h4></div>
                  <div class="panel-body">
                      <a href="<?php echo base_url('admin/surat/detail/'.$new_list_surat->id_surat.'?action=cetak') ?>">
                        <button class="btn btn-success"><i class="fa fa-print"></i> Cetak Form</button>
                      </a>
                      <br><br>
                      <ul class="list-group">
                        <li class="list-group-item">
                          Nomor Surat : <?php echo $new_list_surat->kode_surat; ?>
                        </li>
                        <li class="list-group-item">
                          No Urut Surat : <?php echo $new_list_surat->no_urut_surat; ?>
                        </li>
                        <li class="list-group-item">
                          Jenis Surat : <?php echo $new_list_surat->nama_jenis_surat; ?>
                        </li>
                        <li class="list-group-item">
                          Keaslian Surat : <?php echo $new_list_surat->nama_keaslian_surat; ?>
                        </li>
                        <li class="list-group-item">
                          Perihal : <?php echo $new_list_surat->perihal_surat; ?>
                        </li>
                        <li class="list-group-item">
                          Jumlah Lampiran : <?php echo $new_list_surat->jumlah_lampiran; ?>
                        </li>
                        <li class="list-group-item">
                          Asal Surat : <?php echo $new_list_surat->asal_surat; ?>
                        </li>
                        <li class="list-group-item">
                          Tujuan Surat : <?php echo $new_list_surat->tujuan_surat; ?>
                        </li>
                        <li class="list-group-item">
                          Tanggal Pembuatan Surat : <?php echo $new_list_surat->tanggal_pembuatan_surat; ?>
                        </li>
                        <li class="list-group-item">
                          Tanggal Terima Surat : <?php echo $new_list_surat->tanggal_terima_surat; ?>
                        </li>                      
                      </ul>
                  </div>
                </div>   
                <hr>
                <div class="panel panel-primary">
                  <div class="panel-heading"><h4><b>Deskripsi Surat</b></h4></div>
                  <div class="panel-body"> 
                    <?php echo $new_list_surat->deskripsi_surat;  ?>
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
