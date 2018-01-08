<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Track_surat extends CI_Controller {

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
	 * @see https://codeigniter.com/jenis_surat_guide/general/urls.html
	 */

   /* CREATED BY ARVIN */
   public function __construct()
   {
  		parent::__construct();
		if($_SESSION['level']==1 || $_SESSION['level']==2 || $_SESSION['level']==3 || $_SESSION['level']==4 || $_SESSION['level']==5 ){ 
			$_SESSION['error_message']="Anda tidak memiliki hak akses ini";
			redirect('admin');
		}
		  $this->login_helper->validate_login_session();
		  $this->load->model('admin/Jenis_surat_model','Jenis_surat_model');
      $this->load->model('admin/Surat_model'      ,'Surat_model');
   }

   public function index()
   {
     //load login view
     $data= array(
       'view'                  => 'track_surat/view',
       'title'                 => 'Lihat Surat ',
       'breadcumbs'            => array('lihat surat','Preview'),
			 'list_surat'		         => $this->Surat_model->selectAllByAdmin()
     );
     $this->load->view('admin/template/content',$data);
   }

	public function detail($id='')
	{
		$list_surat = $this->Surat_model->selectByIdByAdmin($id);
		$nama_surat='';
		foreach($list_surat as $x)
		{
			$nama_surat 	= $x->kode_surat;
		}
		$data= array(
       'view'         			 => 'track_surat/detail',
       'title'        			 => 'Kelolah Surat > detail  ',
       'breadcumbs'   			 => array('Jenis_surat','Detail Surat',$nama_surat),
			 'list_surat'		       => $list_surat,
       'list_timeline'       => $this->Surat_model->getTimelineSurat($id)
     );
		$this->load->view('admin/template/content',$data);
	}
}
