<?php $this->load->view('admin/content/sidebar'); ?>
<script>
 function cetak() {
          //$(".wr-link").empty();
          $("#example1").removeAttr("id");
          $(".hidden-print").show();
          w=window.open();
          w.document.write($('#cetak').html());
          w.print();
          w.close();
          window.location.reload();
        }
</script>
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
              <button class="btn btn-success" onclick="cetak()">Cetak</button>
              <hr>
               <?php foreach($list_surat as $new_list_surat){ ?>            
                  <div class="content" id="cetak" style="">
                    <div>
                      <img src="<?php echo base_url('assets/images/logo.png') ?>" alt="" style="width:20%">
                      <p style="text-align:right;margin-left:-10px;margin-top:-20px">
                        UN2.F16.D3/OTL.06.02/<?php echo date('Y', strtotime($new_list_surat->created_date)); ?>
                      </p>                
                    </div>
                    <div>
                    <center>
                      <h4>LEMBAR DISPOSISI</h4>
                      <!--<table cellpadding="8" style="width:50%;margin:auto">
                        <tr>
                          <td style="width:50%;text-align:center">
                            <input type="checkbox" value="Wadek Diklitma">Wadek Diklitma
                          </td>
                          <td style="width:50%;text-align:center">
                            <input type="checkbox" value="Wadek Sumdavum">Wadek Sumdavum
                          </td>
                        </tr>
                      </table>-->
                     </center>
                    </div>
                    <div>
                      <table cellpadding="0" style="border: 0px solid black; border-collapse: collapse;width:100%">
                        <tr>
                          <td style="border: 1px solid black;width:100%;padding:5px">No Urut : <?php echo $new_list_surat->no_urut_surat ?>                               </td>
                        </tr>
                        <tr>
                          <td style="border: 1px solid black;width:100%;padding:5px"><b>Asal Surat </b>: <?php echo $new_list_surat->asal_surat ?>                               </td>
                        </tr>
                        <tr>
                          <td style="border: 1px solid black;width:100%;padding:5px"><b>Ditujukan Kepada </b> : <?php echo $new_list_surat->tujuan_surat ?>                               </td>
                        </tr>
                        <tr>                          
                          <td style="border: 1px solid black;width:100%;padding:5px">
                           Perihal : <?php echo $new_list_surat->perihal_surat; ?>
                          </td>
                        </tr>
                        <tr>
                          <td style="border: 1px solid black;width:100%;padding:5px">
                          Lampiran : <?php echo $new_list_surat->jumlah_lampiran; ?> Lembar
                          </td>
                        </tr>
                        <tr>
                          <td style="border: 1px solid black;width:100%;padding:5px">
                          No.Surat : <?php echo $new_list_surat->kode_surat ?>
                          </td>
                        </tr>
                        <tr>
                          <td style="border: 1px solid black;width:100%;padding:5px">
                            Tanggal Surat : <?php echo $new_list_surat->tanggal_pembuatan_surat ?>
                          </td>
                        </tr>
                        <tr>
                          <td style="border: 1px solid black;width:100%;padding:5px">
                            Tanggal Terima Surat : <?php echo $new_list_surat->tanggal_terima_surat ?>
                          </td>
                        </tr>
                        <tr>
                          <td style="border: 1px solid black;width:100%;padding:5px">
                            <b>Asli/Tembusan</b> : <?php echo $new_list_surat->nama_keaslian_surat ?>
                          </td>
                        </tr>
                        <tr>
                          <td >
                           <table  style="border: 0px solid black; border-collapse: collapse;width:100%">
                            <tr>
                             <td style="border: 1px solid black;width:51%;padding:5px;padding-bottom:30px; vertical-align: top">
                               Sifat : 
                               <br><br>
                               <table>
                                <tr>
                                 <?php foreach($list_jenis_surat as $x){ ?>
                                  
                                    <input type="checkbox" style="padding : 5px;"> <?php echo $x->nama_jenis_surat; ?>
                                  
                                 <?php } ?>
                                </tr>
                               </table>
                             </td>
                             <td style="border: 1px solid black;width:25%;padding:5px;padding-bottom:30px; vertical-align: top">
                               Paraf : 
                             </td>
                             <td style="border: 1px solid black;width:25%;padding:5px;;padding-bottom:30px">
                               Tanggal Disposisi :
                               <br><br><br>
                               <?php echo $new_list_surat->created_date; ?>
                             </td>
                            </tr>
                            <tr>
                             <td style="border: 0px solid black;width:50%;padding:5px">
                               
                             </td>
                            </tr>
                           </table>
                          </td>
                        </tr>
                      </table>
                    </div>
                    <div>
                      <table cellpadding="5">
                        <tr>
                           <td style="width:25%"><input type="checkbox"> Untuk Diketahui </td>
                           <td style="width:25%"><input type="checkbox"> ............... </td>
                           <td style="width:25%"><input type="checkbox"> Untuk Diarsipkan </td>
                           <td style="width:25%"><input type="checkbox"> Mohon Paraf/Tanda Tangan </td>
                        </tr>
                         <tr>
                           <td style="width:25%"><input type="checkbox"> Untuk Dikoreksi </td>
                           <td style="width:25%"><input type="checkbox"> Mohon Tanggapan </td>
                           <td style="width:25%"><input type="checkbox"> Harap Temui Saya </td>
                           <td style="width:25%"> </td>
                        </tr>
                        <tr>
                           <td style="width:25%"><input type="checkbox"> Untuk Diselesaikan </td>
                           <td style="width:25%"><input type="checkbox"> Mohon Diteliti </td>
                           <td style="width:25%"><input type="checkbox"> Untuk Dibahas Bersama </td>
                           <td style="width:25%"><input type="checkbox"> Mohon Laporan <br> ...........</td>
                        </tr>
                        <tr>
                           <td style="width:25%"><input type="checkbox"> Untuk Disebarkan </td>
                           <td style="width:25%"><input type="checkbox"> Mohon Mewakili</td>
                           <td style="width:25%"><input type="checkbox"> Jadwalkan </td>                         
                        </tr>
                        <tr>
                           <td style="width:25%"><input type="checkbox"> Kepada yang Terhormat </td>
                           <td style="width:25%"><input type="checkbox"> Siapkan Jawaban</td>
                           <td style="width:25%"><input type="checkbox"> Mohon Persetujuan </td>                         
                        </tr>
                      </table>
                    </div>
                    <br>
                    <div>
                      <table cellpadding="0" style="border: 0px solid black; border-collapse: collapse;width:100%">
                        <tr>
                          <td style="border: 1px solid black;width:50%;padding:5px"><b>Jabatan</b></td>
                          <td style="border: 1px solid black;width:15%;padding:5px"><b>Paraf</b></td>
                          <td style="border: 1px solid black;width:15%;padding:5px"><b>Tanggal</b></td>
                          <td style="border: 1px solid black;width:30%;padding:5px"><b>Rekomendasi/Tindak lanjut</b></td>
                        </tr>
                        <?php  
                          $data=array(
                            'Ketua DGBF',
                            'Ketua SAF',
                            'Sekretais Pimpinan',
                            'Kepala UPMA dan SPI',
                            'Manajer Pendidikan dan Kemahasiswaan',
                            'Manajer Rispub dan Pengmas',
                            'Manajer Umum',                           
                            'Asisten Manajer Kemahasiswaan',
                            'Asisten Manajer Keuangan',
                            'Asisten Manajer Infrastruktur',
                            'Ketua Departemen/Program Studi Negara',
                            'Ketua Departemen/Program Studi Niaga',
                            'Ketua Departemen/Program Studi Fiskal',
                            'Ketua Program Pascasarjana',
                            'Pusat Kajian/laboratorium',
                            'Koordinator Pengembangan Teknologi Pembelajaran , Metode Pembelajaran dan Modul Pembelajaran',
                            'Bagian Humas dan Kerjasama',
                            'Bagian Hukum',
                            'Bagian Urusan Internasional'
                          );
                          for($c = 1; $c <= count($data); $c++)
                          {
                        ?>
                            <tr>
                              <td style="border: 1px solid black;width:50%;padding:5px"><span><?php echo $c ?>. <?php echo $data[$c-1] ?></span><p style="text-align:right;margin-top:-20px;"><input type="checkbox"></p>

                              </td>
                              <td style="border: 1px solid black;width:15%;padding:5px"></td>
                              <td style="border: 1px solid black;width:15%;padding:5px"></td>
                              <?php 
                              if($c==1)
                              {
                              ?>
                                <td style="border: 1px solid black;width:30%;padding:5px" rowspan="<?php echo count($data) ?>"></td>
                              <?php
                              }
                              ?>
                              
                            </tr>
                        <?php
                          }
                        ?>
                        
                     
                      </table>
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
