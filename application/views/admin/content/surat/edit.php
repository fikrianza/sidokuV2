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
                <form action="<?php echo base_url('admin/surat/edit/'.$new_list_surat->id_surat) ?>" method="post">
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
                      <input type="text" class="form-control" placeholder="Kode Surat" name="kode_surat" required value="<?php echo $new_list_surat->kode_surat ?>">                    
                    </div>
                   <div class="form-group has-feedback">
                      <p>Dikirim kepada</p>
                      <select name="recipient" id="" class="form-control">
                          <option value="" >--Pilih Penerima--</option>
                        <?php  foreach($list_recipient as $x){?>
                          <option value="<?php echo $x->id_user ?>"><?php echo $x->username." - ".$x->nama_role ?></option>
                        <?php }?>
                      </select>
                    </div>
                    <!--<div class="form-group has-feedback">
                      <p>
                        No Urut Surat 
                      </p>
                      <input type="number" min="1" class="form-control" placeholder="Nomor Urut Surat" name="no_urut_surat" required value="<?php echo $new_list_surat->no_urut_surat ?>">                    
                    </div>-->
                    <div class="form-group has-feedback">
                      <p>
                        Jenis Surat 
                      </p>
                      <select name="jenis_surat" id="" class="form-control" required>
                        <option >Pilih jenis surat</option>
                        <?php  foreach($list_jenis_surat as $new_jenis_surat){ ?>
                          <option <?php if($new_jenis_surat->id_jenis_surat == $new_list_surat->id_jenis_surat){echo "selected";} ?> value="<?php echo $new_jenis_surat->id_jenis_surat ?>"><?php echo $new_jenis_surat->nama_jenis_surat ?></option>
                        <?php  } ?>
                      </select>                    
                    </div>
                    <div class="form-group has-feedback">
                      <p>
                        Keaslian Surat 
                      </p>
                      <select name="keaslian_surat" id="" class="form-control" required>
                        <option >Pilih keaslian surat</option>
                        <?php  foreach($list_keaslian_surat as $new_keaslian_surat){ ?>
                          <option <?php if($new_keaslian_surat->id_keaslian_surat == $new_list_surat->id_keaslian_surat){echo "selected";} ?> value="<?php echo $new_keaslian_surat->id_keaslian_surat ?>"><?php echo $new_keaslian_surat->nama_keaslian_surat ?></option>
                        <?php  } ?>
                      </select>                    
                    </div>
                    <div class="form-group has-feedback">
                      <p>
                        Perihal 
                      </p>
                      <input type="text" class="form-control" placeholder="Perihal" name="perihal_surat" value="<?php echo $new_list_surat->perihal_surat ?>" >                    
                    </div>
                    <div class="form-group has-feedback">
                      <p>
                        Jumlah Lampiran ( Lembar )
                      </p>
                      <input type="number" min="0" class="form-control" placeholder="lampiran" name="jumlah_lampiran" value="<?php echo $new_list_surat->jumlah_lampiran ?>">                    
                    </div>
                    <div class="form-group has-feedback">
                      <p>
                        Asal Surat
                      </p>
                      <input type="text" class="form-control" placeholder="asal surat" name="asal_surat" required value="<?php echo $new_list_surat->asal_surat ?>">                    
                    </div>
                    <div class="form-group has-feedback">
                      <p>
                        Tujuan Surat
                      </p>
                      <input type="text" class="form-control" placeholder="tujuan surat" name="tujuan_surat" required value="<?php echo $new_list_surat->tujuan_surat ?>">                    
                    </div>
                    <div class="form-group has-feedback">
                      <p>
                        Tanggal Pembuatan Surat
                      </p>
                      <input type="date" class="form-control" name="tanggal_pembuatan_surat" required value="<?php echo $new_list_surat->tanggal_pembuatan_surat ?>" >                    
                    </div>
                    <div class="form-group has-feedback">
                      <p>
                        Tanggal Penerimaan Surat
                      </p>
                      <input type="date" class="form-control" name="tanggal_terima_surat" required value="<?php echo $new_list_surat->tanggal_terima_surat ?>">                    
                    </div>
                    <div class="form-group has-feedback">
                      <p>
                        Deskripsi
                      </p>
                      <textarea name="deskripsi_surat" placeholder="Place some text here" class="form-control" style="height:200px"><?php echo $new_list_surat->deskripsi_surat ?></textarea>                    
                    </div>
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-lg"><i class="fa fa-plus"></i> Simpan perubahan</button>
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
