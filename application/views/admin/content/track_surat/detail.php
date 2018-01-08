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
               <div class="">
                <ul class="nav nav-tabs">
                  <li class="active"><a data-toggle="tab" href="#home"><i class="fa fa-info"></i> Data umum</a></li>
                  <li><a data-toggle="tab" href="#menu1"><i class="fa fa-clock-o"></i> History </a></li>
                </ul>

                <div class="tab-content" style="padding:20px">
                  <div id="home" class="tab-pane fade in active">
                    <?php foreach($list_surat as $new_list_surat){ ?>
                      <h3><?php echo $new_list_surat->kode_surat ?></h3>
                      <hr>
                      <ul class="list-group">
                       <li class="list-group-item">Diinput Oleh :  <a href="<?php echo base_url('admin/user/detail/'.$new_list_surat->id_user) ?>"><?php echo $new_list_surat->nama . "( ".$new_list_surat->username." )" ?></a></li>
                        <li class="list-group-item">Jenis surat : <?php echo $new_list_surat->nama_jenis_surat ?></li>
                        <li class="list-group-item">Keaslian surat : <?php echo $new_list_surat->nama_keaslian_surat ?></li>
                        <li class="list-group-item">No Urut: <?php echo $new_list_surat->no_urut_surat ?></li>
                        <li class="list-group-item">Perihal Surat: <?php echo $new_list_surat->perihal_surat ?></li>
                        <li class="list-group-item">Jumlah Surat ; <?php echo $new_list_surat->jumlah_lampiran ?></li>
                        <li class="list-group-item">Asal Surat: <?php echo $new_list_surat->asal_surat ?></li>
                        <li class="list-group-item">Tujuan Surat : <?php echo $new_list_surat->tujuan_surat ?></li>
                        <li class="list-group-item">Tanggal pembuatan: <?php echo $new_list_surat->tanggal_pembuatan_surat ?></li>
                        <li class="list-group-item">Tanggal terima surat : <?php echo $new_list_surat->tanggal_terima_surat ?></li>
                      </ul>
                    <?php  } ?>
                  </div>
                  <div id="menu1" class="tab-pane fade">
                    <ul class="timeline">
                      <!-- timeline time label -->
                      <!-- /.timeline-label -->
                      <!-- timeline item -->
                      <?php foreach($list_timeline as $x){ ?>
                      <li>
                        
                        <i class="fa fa-envelope bg-blue"></i>

                        <div class="timeline-item">
                          <span class="time"><i class="fa fa-clock-o"></i> <?php echo "dikirim pada : ".$x->created_date ?></span>

                          <h3 class="timeline-header"><a href="<?php echo base_url('admin/user/detail/'.$new_list_surat->id_user) ?>"><?php echo $x->nama ?></a> telah meneruskan surat</h3>

                          <div class="timeline-body">
                            <i><?php echo $x->deskripsi ?></i>
                          </div>
                        </div>
                        <br>
                      </li>
                      <?php  }?>
                      <!-- END timeline item -->
                      <!-- timeline item -->
                      <li>
                        <i class="fa fa-clock-o bg-gray"></i>
                      </li>
                    </ul>
                  </div>
                </div>
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
