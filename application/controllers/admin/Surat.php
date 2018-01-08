<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Surat extends CI_Controller {

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
		  if($_SESSION['level']==0 || $_SESSION['level']==6){ 
				$_SESSION['error_message']="Anda tidak memiliki hak akses ini";
				redirect('admin');}
		  $this->login_helper->validate_login_session();
      $this->load->model('admin/Keaslian_surat_model' ,'Keaslian_surat_model');
		  $this->load->model('admin/Disposisi_model'   	  ,'Disposisi_model');
		  $this->load->model('admin/Jenis_surat_model'    ,'Jenis_surat_model');
      $this->load->model('admin/Surat_model'          ,'Surat_model');
		  $this->load->model('admin/User_model'         	,'User_model');
		  $this->load->model('admin/Keuangan_model'				,'Keuangan_model');
   }

   public function index()
   {
     //load login view
		 if($_SESSION['level']!=1)
			{
			 	$_SESSION['error_message']="Anda tidak memiliki hak akses ini";
				redirect('admin');
			}
			 $data= array(
       'view'                  => 'surat/view',
       'title'                 => 'Kelolah Surat ',
       'breadcumbs'            => array('Surat','Preview'),
			 'list_surat'		         => $this->Surat_model->selectAll()
     );
     $this->load->view('admin/template/content',$data);
   }
	
	 public function add()
   {
		  if($_SESSION['level']!=1)
			{
				$_SESSION['error_message']="Anda tidak memiliki hak akses ini";
				redirect('admin');
			}
     //load add jenis_surat view
     $data= array(
       'view'               => 'surat/add',
       'title'              => 'Kelolah Surat',
       'breadcumbs'         => array('Surat','Tambah surat'),
       'list_jenis_surat'   => $this->Jenis_surat_model->selectAll(),
       'list_keaslian_surat'=> $this->Keaslian_surat_model->selectAll(),
			 'list_recipient'			=> $this->User_model->selectManager(),
     );
		 //if exist add action
		 if ($_SERVER['REQUEST_METHOD'] === 'POST')
     {
			 $this->form_validation->set_message('required', 'Data %s tidak boleh kosong');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
		$this->form_validation->set_rules('kode_surat'				  		, 'Kode surat'							, 'required');
		$this->form_validation->set_rules('recipient'				  		, 'Penerima'							  , 'required');
		//$this->form_validation->set_rules('no_urut_surat'					, 'No urut surat'						, 'required');
		$this->form_validation->set_rules('jenis_surat'						, 'Jenis surat'							, 'required');
		$this->form_validation->set_rules('keaslian_surat'					, 'Keaslian surat'					, 'required');
		$this->form_validation->set_rules('perihal_surat'					, 'Perihal surat'						, 'required');
		$this->form_validation->set_rules('jumlah_lampiran'				, 'Jumlah_lampiran'					, 'required');
		$this->form_validation->set_rules('asal_surat'							, 'Asal surat'							, 'required');
		$this->form_validation->set_rules('tujuan_surat'						, 'tujuan surat'						, 'required');
		$this->form_validation->set_rules('tanggal_pembuatan_surat', 'Tanggal pembuatan surat'	, 'required');
		$this->form_validation->set_rules('tanggal_terima_surat'		, 'Tanggal terima surat'  	, 'required');
		if ($this->form_validation->run() == TRUE)
		{
				 $data_surat=array(
					 //match 'column_name' => 'post_name'
					 'id_jenis_surat'						=> $this->input->post('jenis_surat'),
					 'id_keaslian_surat'				=> $this->input->post('keaslian_surat'),
					 //'no_urut_surat'						=> $this->input->post('no_urut_surat'),
					 'no_urut_surat'      					=> $this->Surat_model->getLastQueue(),
					 'perihal_surat'						=> $this->input->post('perihal_surat'),
					 'jumlah_lampiran'					=> $this->input->post('jumlah_lampiran'),
					 'asal_surat'								=> $this->input->post('asal_surat'),
					 'tujuan_surat'							=> $this->input->post('tujuan_surat'),
					 'kode_surat'								=> $this->input->post('kode_surat'),
					 'tanggal_pembuatan_surat'	=> $this->input->post('tanggal_pembuatan_surat'),
					 'tanggal_terima_surat'			=> $this->input->post('tanggal_terima_surat'),
					 'deskripsi_surat'					=> $this->input->post('deskripsi_surat'),
					 'status'										=> true,
					 'created_by'								=> $_SESSION['id_user'],
					 'created_date'							=> date('Y-m-d H:i:s'),
					 //posgres syntax
					 //'created_date'							=> date('Y-m-d H:i:s'),
					 'update_by'								=> $_SESSION['id_user'],
					 'update_date'							=> date('Y-m-d H:i:s')
					 //posgres syntax
					 //'update_date'							=> date('Y-m-d H:i:s'),
				 );
				 $data_disposisi=array(
					  'id_user_pengirim'			=> $_SESSION['id_user'],
						'id_user_penerima'			=> $this->input->post('recipient'),
						'id_status_keuangan'	  => '1',
						'deskripsi'							=> $this->input->post('deskripsi_surat'),
						'is_approve'						=> false ,
						'is_read'								=> false,
					  'nominal_uang'					=> 0,
						'created_by'						=> $_SESSION['id_user'],
						'created_date'					=> date('Y-m-d H:i:s'),
						'update_by'							=> $_SESSION['id_user'],
						'update_date'						=> date('Y-m-d H:i:s')
				 );
				 
				 $this->Surat_model->add($data_surat , $data_disposisi);
         redirect('admin/surat/disposisi');
       }		 
		 }
     $this->load->view('admin/template/content',$data);
  }
	
	public function edit($id='')
	{
		 if($_SESSION['level']!=1)
			{
				redirect('admin');
			}
		$list_surat = $this->Surat_model->selectById($id);
		$kode_surat='';
		foreach($list_surat as $x)
		{
			$kode_surat 	= $x->kode_surat;
		}
		$data= array(
       'view'         			 => 'surat/edit',
       'title'        			 => 'Kelolah Surat > Edit  ',
       'breadcumbs'   			 => array('Surat','Edit Surat',$kode_surat),
			 'list_surat'		 			 => $list_surat,
			 'list_jenis_surat'   => $this->Jenis_surat_model->selectAll(),
       'list_keaslian_surat'=> $this->Keaslian_surat_model->selectAll(),
			 'list_recipient'			=> $this->User_model->selectManager(),
     );
		
		//if exist add action
		 if ($_SERVER['REQUEST_METHOD'] === 'POST')
     {
			 $this->form_validation->set_message('required', 'Data %s tidak boleh kosong');
       $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
       $this->form_validation->set_rules('kode_surat'				  		, 'Kode surat'							, 'required');
			 $this->form_validation->set_rules('recipient'				  		, 'Penerima'							  , 'required');
       //$this->form_validation->set_rules('no_urut_surat'					, 'No urut surat'						, 'required');
       $this->form_validation->set_rules('jenis_surat'						, 'Jenis surat'							, 'required');
       $this->form_validation->set_rules('keaslian_surat'					, 'Keaslian surat'					, 'required');
       $this->form_validation->set_rules('perihal_surat'					, 'Perihal surat'						, 'required');
       $this->form_validation->set_rules('jumlah_lampiran'				, 'Jumlah_lampiran'					, 'required');
       $this->form_validation->set_rules('asal_surat'							, 'Asal surat'							, 'required');
			 $this->form_validation->set_rules('tujuan_surat'						, 'tujuan surat'						, 'required');
       $this->form_validation->set_rules('tanggal_pembuatan_surat', 'Tanggal pembuatan surat'	, 'required');
       $this->form_validation->set_rules('tanggal_terima_surat'		, 'Tanggal terima surat'  	, 'required');
       if ($this->form_validation->run() == TRUE)
       {
				 $data_surat=array(
					 //match 'column_name' => 'post_name'
					 'id_surat'									=> $id,
					 'id_jenis_surat'						=> $this->input->post('jenis_surat'),
					 'id_keaslian_surat'				=> $this->input->post('keaslian_surat'),
					 //'no_urut_surat'						=> $this->input->post('no_urut_surat'),
					 'perihal_surat'						=> $this->input->post('perihal_surat'),
					 'jumlah_lampiran'					=> $this->input->post('jumlah_lampiran'),
					 'asal_surat'								=> $this->input->post('asal_surat'),
					 'tujuan_surat'							=> $this->input->post('tujuan_surat'),
					 'kode_surat'								=> $this->input->post('kode_surat'),
					 'tanggal_pembuatan_surat'	=> $this->input->post('tanggal_pembuatan_surat'),
					 'tanggal_terima_surat'			=> $this->input->post('tanggal_terima_surat'),
					 'deskripsi_surat'					=> $this->input->post('deskripsi_surat'),
					 'status'										=> true,
					 'update_by'								=> $_SESSION['id_user'],
					 'update_date'							=> date('Y-m-d H:i:s')
				 );
				 $data_disposisi=array(
					  'id_surat'							=> $id,
					  'id_user_pengirim'			=> $_SESSION['id_user'],
						'id_user_penerima'			=> $this->input->post('recipient'),
						'id_status_keuangan'	  => '1',
						'deskripsi'							=> $this->input->post('deskripsi_surat'),
						'is_approve'						=> false ,
						'is_read'								=> false,
						'created_by'						=> $_SESSION['id_user'],
						'created_date'					=> date('Y-m-d H:i:s'),
						'update_by'							=> $_SESSION['id_user'],
						'update_date'						=> date('Y-m-d H:i:s')
				 );
				 $this->Surat_model->saveEdit($data_surat , $data_disposisi);
				 redirect('admin/surat');		 
			 }
		 }
		
		$this->load->view('admin/template/content',$data);
	}
	
	public function delete($id)
	{
		 if($_SESSION['level']!=1)
			{
				redirect('admin');
			}
		$list_surat = $this->Surat_model->selectById($id);
		$kode_surat='';
		foreach($list_surat as $x)
		{
			$kode_surat 	= $x->kode_surat;
		}
		$data= array(
       'view'         			 => 'surat/delete',
       'title'         			 => 'Kelolah Surat > Hapus  ',
       'breadcumbs'    			 => array('Surat','Hapus surat',$kode_surat),
			 'list_surat'		 			 => $list_surat
     );
		if ($_SERVER['REQUEST_METHOD'] === 'POST')
    {
			$this->Surat_model->delete($id);
		}
		$this->load->view('admin/template/content',$data);
	}
	
	public function detail($id)
	{
		$list_surat = $this->Surat_model->selectById($id);
		$nama_surat='';
		foreach($list_surat as $x)
		{
			$nama_surat 	= $x->kode_surat;
		}
		if(isset($_GET['action']) && $_GET['action']=='cetak')
		{
					$data= array(
						 'view'         			 => 'surat/cetak',
						 'title'         			 => 'Kelolah Surat > Cetak  ',
						 'breadcumbs'    			 => array('Surat','Cetak surat',$nama_surat),
						 'list_surat'		 			 => $list_surat,
						 'list_jenis_surat'   => $this->Jenis_surat_model->selectAll(),
						 'list_keaslian_surat'=> $this->Keaslian_surat_model->selectAll()
					 );
					$this->load->view('admin/template/content',$data);
		}
		else
		{
					$data= array(
						 'view'         			 => 'surat/detail',
						 'title'         			 => 'Kelolah Surat > Detail  ',
						 'breadcumbs'    			 => array('Surat','Detail surat',$nama_surat),
						 'list_surat'		 			 => $list_surat,
						 'list_jenis_surat'   => $this->Jenis_surat_model->selectAll(),
						 'list_keaslian_surat'=> $this->Keaslian_surat_model->selectAll()
					 );
					$this->load->view('admin/template/content',$data);
		}
	}
	
	public function disposisi()
	{
		if($_SESSION['level']==5)
			{ redirect('admin');}
		$data= array(
       'view'          => 'surat/disposisi',
       'title'         => 'Kelolah Surat > Disposisi  ',
       'breadcumbs'    => array('Surat','Disposisi surat'),
			 'list_surat'		 => $this->Surat_model->selectAll(),
			 'list_recipient'=> $this->User_model->selectManager(),
			 'list_disposisi'=> $this->Disposisi_model->selectAll(),
			 'list_not_read' => $this->Disposisi_model->getNotReadMessage()
     );
		if ($_SERVER['REQUEST_METHOD'] === 'POST')
    {
			$this->form_validation->set_message('required', 'Data %s tidak boleh kosong');
      $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
      $this->form_validation->set_rules('surat'				  , 'Surat'						, 'required');
      $this->form_validation->set_rules('recipient'			, 'Penerima surat'	, 'required');
			if ($this->form_validation->run() == TRUE)
      {
				$data = array(
					'id_user_pengirim'			=> $_SESSION['id_user'],
					'id_user_penerima'			=> $this->input->post('recipient'),
					'id_surat'							=> $this->input->post('surat'),
					'id_status_keuangan'	  => '1',
					'deskripsi'							=> $this->input->post('deskripsi'),
					'is_approve'						=> false ,
					'is_read'								=> false,
					'created_by'						=> $_SESSION['id_user'],
					'created_date'					=> date('Y-m-d H:i:s'),
					'update_by'							=> $_SESSION['id_user'],
					'update_date'						=> date('Y-m-d H:i:s')
				);
				$this->Disposisi_model->addDisposisi($data);
				$_SESSION['success_message']	= "Berhasil tambah data";
				redirect('admin/surat/disposisi');
			}
			else
			{
				
			}	
		}
		$this->load->view('admin/template/content',$data);
	}
	
	public function disposisi_inbox()
	{
		if($_SESSION['level']=='0'||
			 $_SESSION['level']=='1'||
			 $_SESSION['level']=='5'){
				$_SESSION['error_message']="Anda tidak memiliki hak akses ini";
				redirect('admin');
			}
		$data= array(
       'view'          => 'surat/disposisi_inbox',
       'title'         => 'Kelolah Surat > Disposisi > Kotak Masuk  ',
       'breadcumbs'    => array('Surat','Disposisi surat' , 'Kotak Masuk'),
			 'list_surat'		 => $this->Surat_model->selectAll(),
			 'list_disposisi'=> $this->Disposisi_model->selectMyInbox(),
			 'list_not_read' => $this->Disposisi_model->getNotReadMessage()
     );
		$this->load->view('admin/template/content',$data);
	}
	
	public function disposisi_detail($id='')
	{
		//if($_SESSION['level']==2 || $_SESSION['level']==3 ||$_SESSION['level']==4 || $_SESSION['level']==5)
		//{
			$this->Surat_model->is_read($id, true);
		//}
		$data= array(
       'view'          => 'surat/disposisi_detail',
       'title'         => 'Kelolah Surat > Disposisi > Detail  ',
       'breadcumbs'    => array('Surat','Disposisi surat' , 'Detail'),
			 'list_surat'		 => $this->Disposisi_model->selectDisposisiDetail($id),
			 'list_recipient'=> $this->User_model->selectManager(),
			 'list_not_read' => $this->Disposisi_model->getNotReadMessage()
     );
		$this->load->view('admin/template/content',$data);
	}
	
	public function disposisi_send()
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST')
    {
			$this->form_validation->set_message('required', 'Data %s tidak boleh kosong');
      $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
      $this->form_validation->set_rules('surat'				  , 'Surat'						, 'required');
      $this->form_validation->set_rules('recipient'			, 'Penerima surat'	, 'required');
			if ($this->form_validation->run() == TRUE)
      {
				$data = array(
					'id_user_pengirim'			=> $_SESSION['id_user'],
					'id_user_penerima'			=> $this->input->post('recipient'),
					'id_surat'							=> $this->input->post('surat'),
					'id_status_keuangan'	  => '1',
					'deskripsi'							=> $this->input->post('deskripsi'),
					'is_approve'						=> false ,
					'is_read'								=> false,
					'created_by'						=> $_SESSION['id_user'],
					'created_date'					=> date('Y-m-d H:i:s'),
					'update_by'							=> $_SESSION['id_user'],
					'update_date'						=> date('Y-m-d H:i:s')
				);
				$this->Disposisi_model->addDisposisi($data);
				$_SESSION['success_message']	= "Berhasil mengirim ";
				redirect('admin/surat/disposisi');
			}
		}
		redirect('admin/surat/disposisi');
	}
	
	public function disposisi_keuangan()
	{
		if($_SESSION['level']!=5)
		{
			$_SESSION['error_message']="Anda tidak memiliki hak akses ini";
			redirect('admin');
		}
		if ($_SERVER['REQUEST_METHOD'] === 'POST')
    {
			$data = array(
				'id_disposisi'			=> $this->input->post('disposisi'),
				'id_status_keuangan'=> $this->input->post('status_keuangan')
			);
			$this->Surat_model->setStatusKeuangan($data);
			redirect('admin/surat/disposisi_keuangan');
		}
		$data= array(
       'view'          => 'surat/disposisi_keuangan',
       'title'         => 'Kelolah Surat > Disposisi  > Keuangan  ',
       'breadcumbs'    => array('Surat','Disposisi surat'  ,  'Keuangan'),
			 'list_disposisi'=> $this->Disposisi_model->selectMyInbox(),
			 'list_not_read' => $this->Disposisi_model->getNotReadMessage(),
			 'list_status_keuangan' => $this->Keuangan_model->selectAll()
     );
		$this->load->view('admin/template/content',$data);
	}
	
	public function disposisi_keuangan_submit()
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST')
    {
			$data = array(
				'id_disposisi'			=> $this->input->post('id_disposisi'),
				'nominal_uang'			=> $this->input->post('nominal_uang'),
				'deskripsi_keuangan'=> $this->input->post('deskripsi_keuangan')
			);
			$this->Surat_model->setKeuanganSurat($data);

		}
		redirect('admin/surat/disposisi_keuangan');
	}
}
