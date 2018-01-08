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
                   <form action="<?php echo base_url('admin/surat/add') ?>" method="post" class="box-body pad">
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
                        Nomor Surat 
                      </p>
                      <input type="text" class="form-control" placeholder="Nomor Surat" name="kode_surat" required>                    
                    </div>
                    <div class="form-group has-feedback">
                      <p>Dikirim kepada</p>
                      <select name="recipient" id="" class="form-control">
                        <?php  foreach($list_recipient as $x){?>
                          <option value="<?php echo $x->id_user ?>"><?php echo $x->username." - ".$x->nama_role ?></option>
                        <?php }?>
                      </select>
                    </div>
                    <!-- <div class="form-group has-feedback">
                      <p>
                        No Urut Surat 
                      </p>
                      <input type="number" min="1" class="form-control" placeholder="Nomor Urut Surat" name="no_urut_surat" required>                    
                    </div> -->
                    <div class="form-group has-feedback">
                      <p>
                        Jenis Surat 
                      </p>
                      <select name="jenis_surat" id="" class="form-control" required>
                        <?php  foreach($list_jenis_surat as $x){ ?>
                          <option value="<?php echo $x->id_jenis_surat ?>"><?php echo $x->nama_jenis_surat ?></option>
                        <?php  } ?>
                      </select>                    
                    </div>
                    <div class="form-group has-feedback">
                      <p>
                        Keaslian Surat 
                      </p>
                      <select name="keaslian_surat" id="" class="form-control" required>
                        <?php  foreach($list_keaslian_surat as $x){ ?>
                          <option value="<?php echo $x->id_keaslian_surat ?>"><?php echo $x->nama_keaslian_surat ?></option>
                        <?php  } ?>
                      </select>                    
                    </div>
                    <div class="form-group has-feedback">
                      <p>
                        Perihal 
                      </p>
                      <input type="text" class="form-control" placeholder="Perihal" name="perihal_surat" >                    
                    </div>
                    <div class="form-group has-feedback">
                      <p>
                        Jumlah Lampiran ( Lembar )
                      </p>
                      <input type="number" min="0" class="form-control" placeholder="lampiran" name="jumlah_lampiran" >                    
                    </div>
                    <div class="form-group has-feedback">
                      <p>
                        Asal Surat
                      </p>
                      <input type="text" class="form-control" placeholder="asal surat" name="asal_surat" required>                    
                    </div>
                    <div class="form-group has-feedback">
                      <p>
                        Tujuan Surat
                      </p>
                      <input type="text" class="form-control" placeholder="tujuan surat" name="tujuan_surat" required>                    
                    </div>
                    <div class="form-group has-feedback">
                      <p>
                        Tanggal Pembuatan Surat
                      </p>
                      <input type="date" class="form-control" name="tanggal_pembuatan_surat" required>                    
                    </div>
                    <div class="form-group has-feedback">
                      <p>
                        Tanggal Penerimaan Surat
                      </p>
                      <input type="date" class="form-control" name="tanggal_terima_surat" required>                    
                    </div>
                    <div class="form-group has-feedback">
                      <p>
                        Deskripsi
                      </p>
                      <textarea name="deskripsi_surat" placeholder="Place some text here" class="form-control" style="height:200px"></textarea>                    
                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-lg"><i class="fa fa-plus"></i> Tambahkan Surat</button>
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
 
