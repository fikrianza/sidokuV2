<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Monitoring extends CI_Controller {

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
		  $this->login_helper->validate_login_session();
      $this->load->model('admin/Disposisi_model'   	  	,'Disposisi_model');
	  $this->load->model('admin/Surat_model'			,'Surat_model');
   }

   public function index()
   {
     //load login view
			 $data= array(
       'view'                  => 'monitoring/view',
       'title'                 => 'Monitoring Surat ',
       'breadcumbs'            => array('Monitoring','Preview'),
       'list_disposisi'        => $this->Disposisi_model->selectMonitoring()
     );
     $this->load->view('admin/template/content',$data);
   }
   
   public function detail($id)
	{
		$list_surat = $this->Surat_model->selectById($id);
		$kode_surat='';
		foreach($list_surat as $x)
		{
			$kode_surat 	= $x->kode_surat;
		}
		
		$data= array(
       'view'                  => 'monitoring/detail',
       'title'                 => 'Monitoring Surat > detail ',
       'breadcumbs'            => array('Monitoring','Preview' ,'Detail',$kode_surat),
       'list_disposisi'        => $this->Disposisi_model->detailMonitoring($id)
     );
     $this->load->view('admin/template/content',$data);
	}
}
