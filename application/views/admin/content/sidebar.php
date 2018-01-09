<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
      </div>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
	  <li class="header">
          <h4>SIDOKU</h4>
          <p>Sistem Dokumentasi Keuangan</p>
	  <p><a href="<?php echo base_url('assets/uploads/')?>Usermanual.pdf">User Manual</a></p>
        </li>
        <li class="header">MAIN NAVIGATION</li>
        <li class="">
          <a href="<?php echo base_url('admin') ?>">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <?php// if($_SESSION['level']==0){ ?>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-users"></i>
            <span>Pengaturan Akun</span>
            <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
             </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url('admin/user/add') ?>"><i class="fa fa-circle-o"></i> Tambahkan akun </a></li>
            <li><a href="<?php echo base_url('admin/user') ?>"><i class="fa fa-circle-o"></i> Lihat akun</a></li>
          </ul>
        </li>
        <?php// } ?>
        
        <?php //if($_SESSION['level']==0){ ?>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-file-o"></i>
            <span>Pengaturan Jenis Berkas</span>
            <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
             </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url('admin/jenis_surat/add') ?>"><i class="fa fa-circle-o"></i> Tambahkan jenis surat </a></li>
            <li><a href="<?php echo base_url('admin/jenis_surat') ?>"><i class="fa fa-circle-o"></i> Lihat jenis surat</a></li>
          </ul>
        </li>
        <?php //} ?>
          <li class="treeview">
            <a href="#">
              <i class="fa fa-file-o"></i>
              <span> Form</span>
              <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
               </span>
            </a>
            <ul class="treeview-menu">
              <?php //if($_SESSION['level']==1){ ?>
                 <li><a href="<?php echo base_url('admin/surat/add') ?>"><i class="fa fa-circle-o"></i> Tambahkan Form Surat </a></li>
                <li><a href="<?php echo base_url('admin/surat') ?>"><i class="fa fa-circle-o"></i> Lihat Form Surat</a></li>
              <?php //} ?>
              <li><a href="<?php echo base_url('admin/surat/disposisi') ?>"><i class="fa fa-circle-o"></i> Lihat Surat Terdisposisi</a></li>
              <?php //if($_SESSION['level']==0){?>
              <li><a href="<?php echo base_url('admin/track_surat') ?>"><i class="fa fa-circle-o"></i> Lihat Surat ( Admin )</a></li>
              <?php //} ?>
              <li><a href="<?php echo base_url('admin/surat/disposisi_keuangan') ?>"><i class="fa fa-circle-o"></i> Disposisi Keuangan</a></li>
              <?php  ?>
            </ul>
          </li>
        
        <li class="treeview">
          <a href="#">
            <i class="fa fa-files-o"></i>
            <span> Monitoring Surat</span>
            <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
             </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url('admin/monitoring/') ?>"><i class="fa fa-circle-o"></i> Lihat Data</a></li>
         </ul>
        </li>
        
        <li class="treeview">
          <a href="#">
            <i class="fa fa-user"></i>
            <span> Profile saya</span>
            <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
             </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?php echo base_url('admin/profile/') ?>"><i class="fa fa-circle-o"></i> Edit Profile </a></li>
            <li><a href="<?php echo base_url('admin/profile/edit_password') ?>"><i class="fa fa-circle-o"></i> Ubah Password </a></li>
            <li><a href="<?php echo base_url('admin/login/logout') ?>"><i class="fa fa-circle-o"></i> Logout</a></li>
          </ul>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
