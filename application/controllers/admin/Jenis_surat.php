<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jenis_surat extends CI_Controller {

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
		  if($_SESSION['level']!=0){ 
				$_SESSION['error_message']="Anda tidak memiliki hak akses ini";
				redirect('admin');
			}
		  $this->login_helper->validate_login_session();
		  $this->load->model('admin/Jenis_surat_model','Jenis_surat_model');
   }

   public function index()
   {
     //load login view
     $data= array(
       'view'                  => 'jenis_surat/view',
       'title'                 => 'Kelolah Jenis Surat ',
       'breadcumbs'            => array('Jenis surat','Preview'),
			 'list_jenis_surat'		 => $this->Jenis_surat_model->selectAll()
     );
     $this->load->view('admin/template/content',$data);
   }
	
	 public function add()
   {
     //load add jenis_surat view
     /*$data= array(
       'view'          => 'jenis_surat/add',
       'title'         => 'Kelolah Jenis Surat',
       'breadcumbs'    => array('Jenis_surat','Tambah jenis surat')
     );*/
		 //if exist add action
		 if ($_SERVER['REQUEST_METHOD'] === 'POST')
     {
			 $this->form_validation->set_message('required', 'Data %s tidak boleh kosong');
       $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
       $this->form_validation->set_rules('jenis_surat'				, 'Jenis surat'			, 'required');
       if ($this->form_validation->run() == TRUE)
       {
				 $data=array(
					 'nama_jenis_surat'					=> $this->input->post('jenis_surat'),
					 'created_by'								=> $_SESSION['id_user'],
					 'created_date'							=> date('Y-m-d H:i:s'),
					 //posgres syntax
					 //'created_date'							=> date('Y-m-d H:i:s'),
					 'update_by'								=> $_SESSION['id_user'],
					 'update_date'							=> date('Y-m-d H:i:s')
					 //posgres syntax
					 //'update_date'							=> date('Y-m-d H:i:s'),
				 );
				 $this->Jenis_surat_model->add($data);
       }
			 
		 }
     redirect('admin/jenis_surat');
  }
	
	public function edit($id='')
	{
		$list_jenis_surat = $this->Jenis_surat_model->selectById($id);
		$nama_jenis_surat='';
		foreach($list_jenis_surat as $x)
		{
			$nama_jenis_surat 	= $x->nama_jenis_surat;
		}
		$data= array(
       'view'         			 => 'jenis_surat/edit',
       'title'        			 => 'Kelolah Surat > Edit  ',
       'breadcumbs'   			 => array('Jenis_surat','Edit Jenis Surat',$nama_jenis_surat),
			 'list_jenis_surat'		 => $list_jenis_surat
     );
		
		//if exist add action
		 if ($_SERVER['REQUEST_METHOD'] === 'POST')
     {
			 $this->form_validation->set_message('required', 'Data %s tidak boleh kosong');
       $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
       $this->form_validation->set_rules('jenis_surat'				, 'Jenis surat'			, 'required');
       if ($this->form_validation->run() == TRUE)
       {				
							$data=array(
								 'id_jenis_surat'						=> $id,
								 'nama_jenis_surat'					=> $this->input->post('jenis_surat'),
								 'update_by'								=> $_SESSION['id_user'],
								 'update_date'							=> date('Y-m-d H:i:s')
								 //posgres syntax
								 //'update_date'							=> date('Y-m-d H:i:s'),
							 );
								 //send data into database
								$this->Jenis_surat_model->saveEdit($data);
								redirect('admin/jenis_surat');
       }			 
		 }
		
		$this->load->view('admin/template/content',$data);
	}
	
	public function delete($id)
	{
		$list_jenis_surat = $this->Jenis_surat_model->selectById($id);
		$nama_jenis_surat='';
		foreach($list_jenis_surat as $x)
		{
			$nama_jenis_surat 	= $x->nama_jenis_surat;
		}
		$data= array(
       'view'         			 => 'jenis_surat/delete',
       'title'         			 => 'Kelolah Jenis Surat > Hapus  ',
       'breadcumbs'    			 => array('Jenis surat','Hapus jenis surat',$nama_jenis_surat),
			 'list_jenis_surat'		 => $list_jenis_surat
     );
		if ($_SERVER['REQUEST_METHOD'] === 'POST')
    {
			$this->Jenis_surat_model->delete($id);
		}
		$this->load->view('admin/template/content',$data);
	}
}
