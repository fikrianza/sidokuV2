<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

   /* CREATED BY ARVIN */
   public function __construct()
   {
  			parent::__construct();
		 		$this->login_helper->validate_login_session();
        $this->load->model('admin/User_model'					,'User_model');
		 		$this->load->model('admin/Surat_model'				,'Surat_model');
		 		$this->load->model('admin/Jenis_surat_model'	,'Jenis_surat_model');
   }

   public function index()
   {
     //load login view
		 if($_SESSION['level']==0)
		 {
			  $data= array(
				 'view'    			 					=> 'home_master',
				 'title'				 					=> 'Beranda',
				 'breadcumbs'    					=> array('Beranda'),
				 'count_user'		 					=> $this->User_model->getCount(),
				 'count_surat'	 					=> $this->Surat_model->getCount(),
				 'count_jenis_surat'			=> $this->Jenis_surat_model->getCount(),
				 'list_surat'	      			=> $this->Surat_model->selectAllByAdminTop5(),
				 //'jumlah_surat_per_bulan'	=> $this->Surat_model->selectJumlahSuratPerBulanByAdmin(),
				 'jumlah_surat_per_tahun_ini'	=> $this->Surat_model->selectJumlahSuratPerTahunIni(),
				 'jumlah_keuangan_per_bulan_pertahun'=> $this->Surat_model->selectJumlahKeuanganPerBulanPerTahun(),
				 'jumlah_keuangan_per_tahun'=>$this->Surat_model->selectJumlahKeuanganPerTahun(),
				 'history_jumlah_surat_per_tahun' => $this->Surat_model->selectHistoryJumlahSuratPerTahun(),//untuk jumlah surat pet tahun etc 2015,2015,2016,2017,...,etc
			 	 'history_junlah_surat_per_bulan_tahun_ini'=> $this->Surat_model->selectHistoryJumlahSuratPerBulanPerTahunIni()
			 );
		 }
		 else
		 {
			 $data= array(
				 'view'    			 					=> 'home',
				 'title'								  => 'Beranda',
				 'breadcumbs'   				  => array('Beranda'),
				 'list_surat'	      			=> $this->Surat_model->selectAllByUserTop5(),
				 //'jumlah_surat_per_bulan'	=> $this->Surat_model->selectJumlahSuratPerBulanByAdmin(),
				 'jumlah_surat_per_tahun_ini'	=> $this->Surat_model->selectJumlahSuratPerTahunIni(),
				 'jumlah_keuangan_per_bulan_pertahun'=> $this->Surat_model->selectJumlahKeuanganPerBulanPerTahun(),
				 'jumlah_keuangan_per_tahun'=>$this->Surat_model->selectJumlahKeuanganPerTahun(),
				 'history_jumlah_surat_per_tahun' => $this->Surat_model->selectHistoryJumlahSuratPerTahun(),//untuk jumlah surat pet tahun etc 2015,2015,2016,2017,...,etc
			 	 'history_junlah_surat_per_bulan_tahun_ini'=> $this->Surat_model->selectHistoryJumlahSuratPerBulanPerTahunIni()
			 );
		 }

     $this->load->view('admin/template/content',$data);
   }

}
