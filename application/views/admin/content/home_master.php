<?php $this->load->view('admin/content/sidebar'); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        <?php echo $title; ?>
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
          
          <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <a href="<?php echo base_url('admin/surat/add') ?>">
                  <span class="info-box-icon bg-aqua"><i class="fa fa-files-o"></i></span>
                  <div class="info-box-content">
                    <br>
                    <span class="info-box-text">Buat Formulir Surat</span>

                  </div>
                </a>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <a href="<?php echo base_url('admin/surat/disposisi_inbox') ?>">
                  <span class="info-box-icon bg-red"><i class="fa fa-envelope-o"></i></span>
                  <div class="info-box-content">
                    <br>
                    <span class="info-box-text">Disposisi Surat</span>
                  </div>
                </a>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix visible-sm-block"></div>

            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <a href="<?php echo base_url('admin/surat/disposisi_keuangan') ?>">
                  <span class="info-box-icon bg-green"><i class="fa fa-money"></i></span>
                  <div class="info-box-content">
                    <br>
                    <span class="info-box-text"> Verifikasi<br> Keuangan</span>
                  </div>
                </a>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
              <div class="info-box">
                <a href="<?php echo base_url('admin/monitoring') ?>
                         ">
                <span class="info-box-icon bg-yellow"><i class="fa fa-search"></i></span>

                <div class="info-box-content">
                  <br>
                  <span class="info-box-text">Monitoring Surat</span>
                </div>
                </a>
                <!-- /.info-box-content -->
              </div>
              <!-- /.info-box -->
            </div>
            <!-- /.col -->
          </div>
          <div class="row">
             <div class="col-lg-4 col-xs-6">
                            <!-- small box -->
               <div class="small-box bg-aqua">
                              <div class="inner">
                                <h3><?php foreach($count_user as $x){echo $x->c; } ?></h3>

                                <p>Jumlah User</p>
                              </div>
                              <div class="icon">
                                <i class="fa fa-users"></i>
                              </div>
                              <a href="<?php echo base_url('admin/user') ?>" class="small-box-footer">Detail <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
             </div>
              <!-- ./col -->
             <div class="col-lg-4 col-xs-6">
                            <!-- small box -->
               <div class="small-box bg-green">
                              <div class="inner">
                                <h3><?php foreach($count_surat as $x){echo $x->c; } ?></h3>

                                <p>Jumlah Berkas</p>
                              </div>
                              <div class="icon">
                                <i class="fa fa-file"></i>
                              </div>
                              <a href="<?php echo base_url('admin/track_surat') ?>" class="small-box-footer">Detail <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
             </div>
             <!-- ./col -->
             <div class="col-lg-4 col-xs-6">
                            <!-- small box -->
                            <div class="small-box bg-yellow">
                              <div class="inner">
                                <h3><?php foreach($count_jenis_surat as $x){echo $x->c; } ?></h3>

                                <p>Jenis Surat</p>
                              </div>
                              <div class="icon">
                                <i class="ion ion-person-add"></i>
                              </div>
                              <a href="<?php echo base_url('admin/jenis_surat') ?>" class="small-box-footer">Detail <i class="fa fa-arrow-circle-right"></i></a>
                            </div>
                          </div>
             <!-- ./col -->
             <!-- ./col -->
          </div>
          <br>
          <div class="row">
            <div class="col-sm-12">
               <div class="box box-primary">           
                <div class="box-body">
                  <div class="row">
                    <div class="col-sm-12">
                      <h4>Surat terbaru</h4>
                      <div class="table-responsive">
                       <table id="example" class="table table-bordered table-striped " >
                        <thead>
                        <tr>
                          <th>#</th>
                          <th>Nomor Surat</th>
                          <th>Tanggal Input</th>
                          <th>Tanggal Update</th>
                          <th>Tindakan</th>
                        </tr>
                        </thead>
                        <tbody>
                          <?php $count=1; foreach($list_surat as $x){ ?>
                             <tr>
                               <td><?php echo $count ?></td>
                               <td><?php echo $x->kode_surat; ?></td>
                               <td><?php echo $x->created_date; ?></td>
                               <td><?php echo $x->update_date ?></td>
                               <td><a href="<?php echo base_url('admin/track_surat/detail/'.$x->id_surat) ?>"><i class="fa fa-search"></i> Lihat Detail</a></td>
                            </tr>
                          <?php $count++;} ?>
                        </tbody>
                      </table>
                   </div>
                    </div>
                  </div>
                </div>
                <!-- /.box-footer-->
               </div>             
            </div>
            
           </div>
          
          <div class="row">
            <div class="col-sm-12">
              <div class="box box-primary">           
                <div class="box-body">
                  <h4>Jumlah Surat Tahun Ini</h4>
                  <hr>
                  <canvas id="myChart" width="900" height="400"></canvas>
                  <?php  
                      $jumlah_surat = "";
                      $tahun = "";
                      $bgColor = "";
                      
                      $v=0;
                      foreach($jumlah_surat_per_tahun_ini as $x)
                      {
                        $v++;
                        $jumlah_surat =  $jumlah_surat . $x->c . ",";
                        $tahun =  $tahun . "'".$x->tahun."'" . ",";
                        $bgColor =  $bgColor . "'#2A68F7'" . ",";
                      }
                      if($v!=0)
                      {
                          $jumlah_surat =  $jumlah_surat . "0";
                          $tahun = $tahun . "'".(($x->tahun)+1)."'";
                          $bgColor =  $bgColor . "'#FFFFFF'" . ",";
                      }
                    
                      //echo $bulan;
                  ?>
                  <script>
                  var ctx = document.getElementById("myChart");
                    data = {
                        datasets: [{
                            data: [<?php echo $jumlah_surat ?>],
                            backgroundColor: [<?php echo $bgColor ?>],
                            label : ['Jumlah Surat Tahun ini']
                        }],

                        // These labels appear in the legend and in the tooltips when hovering different arcs
                        labels: [
                            <?php echo date('Y'); ?>
                        ]
                    };
                  var myChart = new Chart(ctx, {
                      type: 'bar',
                      data: data
                  });
                  </script>
                </div>
              </div>
            </div>
          </div>
          
          <div class="row">
            <div class="col-sm-12">
              <div class="box box-primary">           
                <div class="box-body">
                  <h4>History Jumlah Surat Per Tahun</h4>
                  <hr>
                  <canvas id="c" width="900" height="400"></canvas>
                  <?php  
                     $v=0;
                     $tahun = "";
                     $jumlah_surat="";
                     $bgColor="";
                      foreach($history_jumlah_surat_per_tahun as $x)
                      {
                        $v++;
                        $jumlah_surat =  $jumlah_surat . $x->c . ",";
                        $tahun =  $tahun . "'".$x->tahun."'" . ",";
                        $bgColor =  $bgColor . "'#2A68F7'" . ",";
                      }
                      if($v!=0)
                      {
                          $jumlah_surat =  $jumlah_surat . "0";
                          $tahun = $tahun . "'".(($x->tahun)+1)."'";
                          $bgColor = $bgColor . "'#FFFFFF'";
                      }
                  ?>
                  <script>
                  var ctx = document.getElementById("c");
                    data = {
                        datasets: [{
                            data: [<?php echo $jumlah_surat ?>],
                            backgroundColor: [<?php echo $bgColor ?>],
                            label : ['Jumlah Surat per Tahun']
                        }],

                        // These labels appear in the legend and in the tooltips when hovering different arcs
                        labels: [
                            <?php echo $tahun; ?>
                        ]
                    };
                  var myChart = new Chart(ctx, {
                      type: 'bar',
                      data: data
                  });
                  </script>
                </div>
              </div>
            </div>
          </div>
          
          <div class="row">
            <div class="col-sm-12">
              <div class="box box-primary">           
                <div class="box-body">
                  <h4>History Jumlah Surat Per Bulan Tahun <?php echo date('Y') ?></h4>
                  <hr>
                  <canvas id="cc" width="900" height="400"></canvas>
                  <?php  
                      $jumlah_surat = "";
                      $bulan = "";
                      $bgColor = "";
                      $months = array                     (1=>'Jan',2=>'Feb',3=>'Mar',4=>'Apr',5=>'May',6=>'Jun',7=>'Jul',8=>'Aug',9=>'Sep',10=>'Oct',11=>'Nov',12=>'Dec',13=>'Empty',14=>'Empty');
                      $bgColorArray = array(1=>"#0074D9",2=>"#FF4136",3=>"#2ECC40",4=>'#d6a939',5=>'#db3a32',6=>'#3face2',7=>'#165e82',8=>'#ea893a',9=>'#674dd1',10=>'#2a64a8',11=>'#e8a127',12=>'#6bbf16',13=>'#fafafa',14=>'#fafafa');
                      $v=0;
                      foreach($history_junlah_surat_per_bulan_tahun_ini as $x)
                      {
                        $v++;
                        $jumlah_surat =  $jumlah_surat . $x->c . ",";
                        $bulan =  $bulan . "'".$months[$x->bulan]."'" . ",";
                        $bgColor =  $bgColor . "'".$bgColorArray[$x->bulan]."'" . ",";
                      }
                      if($v!=0)
                      {
                          $jumlah_surat =  $jumlah_surat . "0";
                          $bulan = $bulan . "'".$months[($x->bulan)+1]."'";
                          $bgColor = $bgColor . "'".$bgColorArray[($x->bulan)+1]."'";
                      }
                    
                      //echo $bulan;
                  ?>
                  <script>
                  var ctx = document.getElementById("cc");
                    data = {
                        datasets: [{
                            data: [<?php echo $jumlah_surat ?>],
                            backgroundColor: [<?php echo $bgColor ?>],
                            label : ['Jumlah Surat per Bulan']
                        }],

                        // These labels appear in the legend and in the tooltips when hovering different arcs
                        labels: [
                            <?php echo $bulan; ?>
                        ]
                    };
                  var myChart = new Chart(ctx, {
                      type: 'bar',
                      data: data
                  });
                  </script>
                </div>
              </div>
            </div>
          </div>
          
          <div class="row">
            <div class="col-sm-12">
               <div class="box box-primary">           
                 <div class="box-body">
                    <div class="row">
                      <div class="col-sm-12">
                        <h4>
                          Grafik Keuangan per Bulan di Tahun <?php echo date("Y"); ?>
                        </h4>
                      </div>
                      <div class="col-sm-12">
                        <canvas id="c2" width="900" height="400"></canvas>
                        <?php  $keuangan = ""; ?>
                        <?php  $bg_color = "";?>
                        <?php   $months = array                     (1=>'Jan',2=>'Feb',3=>'Mar',4=>'Apr',5=>'May',6=>'Jun',7=>'Jul',8=>'Aug',9=>'Sep',10=>'Oct',11=>'Nov',12=>'Dec',13=>'Empty',14=>'Empty'); ?>
                        <?php $bulan = ""?>
                        <?php $count=0; ?>
                        <?php  foreach($jumlah_keuangan_per_bulan_pertahun as $x){
                          $count++;
                          $keuangan = $keuangan.$x->c.",";
                          $bg_color = $bg_color ."'rgba(54, 162, 235, 0.9)'" . ","; 
                          $bulan =  $bulan . "'".$months[$x->bulan]."'" . ",";
                        } ?>
                        <?php if($count!=0)
                        {
                          $keuangan =  $keuangan."0";
                          $bg_color = $bg_color ."'rgba(54, 162, 235, 0.9)'" ;
                          $bulan = $bulan . "'".$months[($x->bulan)+1]."'";
                        }
                        ?>
                        <?php //echo $keuangan; ?>
                        <?php //echo $bg_color; ?>
                        <?php //echo $bulan; ?>
                        <script>
                          var ctx = document.getElementById("c2").getContext('2d');
                          //var ctx = document.getElementById("myChart").getContext('2d');
                          var myChart = new Chart(ctx, {
                              type: 'bar',
                              data: {
                                  labels: [<?php echo $bulan; ?>],
                                  datasets: [{
                                      label: 'Jumlah Keuangan',
                                      data: [<?php echo $keuangan; ?>],
                                      backgroundColor: [
                                          <?php echo $bg_color; ?>
                                      ],
                                      borderWidth: 1
                                  }]
                              },
                              options: {
                                  scales: {
                                      yAxes: [{
                                          ticks: {
                                              beginAtZero:true
                                          }
                                      }]
                                  }
                              }
                          });
                        </script>
                      </div>
                    </div>
                 </div>
               </div>
            </div>
          </div>
          
          <div class="row">
            <div class="col-sm-12">
               <div class="box box-primary">           
                 <div class="box-body">
                    <div class="row">
                      <div class="col-sm-12">
                        <h4>
                          Grafik Keuangan per Tahun
                        </h4>
                      </div>
                      <div class="col-sm-12">
                        <canvas id="c3" width="900" height="400"></canvas>
                        <?php  $keuangan = ""; ?>
                        <?php  $bg_color = "";?>
                        <?php $tahun = ""?>
                        <?php $count=0; ?>
                        <?php  foreach($jumlah_keuangan_per_tahun as $x){
                          $count++;
                          $keuangan = $keuangan.$x->c.",";
                          $bg_color = $bg_color ."'rgba(54, 162, 235, 0.9)'" . ","; 
                          $tahun =  $tahun . "'".$x->tahun."'" . ",";
                        } ?>
                        <?php if($count!=0)
                        {
                          $keuangan =  $keuangan."0";
                          $bg_color = $bg_color ."'rgba(54, 162, 235, 0.9)'" ;
                          $bulan = $bulan . "'".(($x->tahun)+1)."'";
                        }
                        ?>
                        <?php //echo $keuangan; ?>
                        <?php //echo $bg_color; ?>
                        <?php //echo $tahun; ?>
                        <script>
                          var ctx = document.getElementById("c3").getContext('2d');
                          //var ctx = document.getElementById("myChart").getContext('2d');
                          var myChart = new Chart(ctx, {
                              type: 'bar',
                              data: {
                                  labels: [<?php echo $tahun; ?>],
                                  datasets: [{
                                      label: 'Jumlah Keuangan',
                                      data: [<?php echo $keuangan; ?>],
                                      backgroundColor: [
                                          <?php echo $bg_color; ?>
                                      ],
                                      borderWidth: 1
                                  }]
                              },
                              options: {
                                  scales: {
                                      yAxes: [{
                                          ticks: {
                                              beginAtZero:true
                                          }
                                      }]
                                  }
                              }
                          });
                        </script>
                      </div>
                    </div>
                 </div>
               </div>
            </div>
          </div>
         </div>
          <!-- /.box -->
      </div>
        <!-- /.col -->
      
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
