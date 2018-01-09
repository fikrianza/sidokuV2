<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

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
		  if($_SESSION['level']!=0){ 
				$_SESSION['error_message']="Anda tidak memiliki hak akses ini";
				redirect('admin');
			}
		  $this->load->model('admin/User_model','User_model');
      $this->load->model('admin/Role_model','Role_model');
   }

   public function index()
   {
     //load login view
     $data= array(
       'view'          => 'user/view',
       'title'         => 'Kelolah Akun ',
       'breadcumbs'    => array('User','Preview'),
			 'list_user'		 => $this->User_model->selectAll()
     );
     $this->load->view('admin/template/content',$data);
   }
	
	 public function add()
   {
     //load add user view
     $data= array(
       'view'          => 'user/add',
       'title'         => 'Kelolah Akun',
       'breadcumbs'    => array('User','Tambah user'),
			 'list_role'		 => $this->Role_model->selectAll()
     );
		 //if exist add action
		 if ($_SERVER['REQUEST_METHOD'] === 'POST')
     {
			 $this->form_validation->set_message('required', 'Data %s tidak boleh kosong');
       $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
       $this->form_validation->set_rules('nama'				, 'Nama'			, 'required');
       $this->form_validation->set_rules('username'	  , 'Password'	, 'required');
			 $this->form_validation->set_rules('email'			, 'Email'			, 'required');
       $this->form_validation->set_rules('nip'			  , 'NIP'				, 'required');
			 $this->form_validation->set_rules('password'	  , 'Password'	, 'required');
       $this->form_validation->set_rules('role'	  		, 'Role'			, 'required');
       if ($this->form_validation->run() == TRUE)
       {
				 			 $password 			 	 	= $this->input->post('password');
							 $re_password 			= $this->input->post('re_password');
							 if($password==$re_password)
							 {
								$data = array(
									 'nama'				  => $this->input->post('nama'),
									 'username'			=> $this->input->post('username'),
									 'email'				=> $this->input->post('email'),
									 'nip'					=> $this->input->post('nip'),
									 'password'			=> md5($this->input->post('password')),
									 'id_role'			=> $this->input->post('role'),
									 //'foto'					=> 'profile.png',
									 'status'				=> true ,
									 'is_deleted'		=> false ,
									 'created_by'		=> $_SESSION['id_user'],
									 'created_date' => date('Y-m-d H:i:s'),
									 'update_by'		=> $_SESSION['id_user'],
									 'update_date'  => date('Y-m-d H:i:s')			 
								);
								 //send data into database
								 $this->User_model->add($data);
								 redirect('admin/user');
							 }
							 else
							 {
								$_SESSION['error_message']="Password tidak sama";
								redirect('admin/user/add');
							 }
       }			 
		 }
     $this->load->view('admin/template/content',$data);
  }
	
	public function detail($id)
	{
		$list_user = $this->User_model->selectById($id);
		$nama_user='';
		foreach($list_user as $x)
		{
			$nama_user 	= $x->nama;
		}
		$data= array(
       'view'          => 'user/detail',
       'title'         => 'Kelolah Akun > Detail  ',
       'breadcumbs'    => array('User','Detail user',$nama_user),
			 'list_role'		 => $this->Role_model->selectAll(),
			 'list_user'		 => $list_user
     );
		$this->load->view('admin/template/content',$data);
	}
	
	public function edit($id='')
	{
		$list_user = $this->User_model->selectById($id);
		$nama_user='';
		foreach($list_user as $x)
		{
			$nama_user 	= $x->nama;
		}
		$data= array(
       'view'          => 'user/edit',
       'title'         => 'Kelolah Akun > Edit  ',
       'breadcumbs'    => array('User','Edit user',$nama_user),
			 'list_role'		 => $this->Role_model->selectAll(),
			 'list_user'		 => $list_user
     );
		
		//if exist add action
		 if ($_SERVER['REQUEST_METHOD'] === 'POST')
     {
			 $this->form_validation->set_message('required', 'Data %s tidak boleh kosong');
       $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
       $this->form_validation->set_rules('nama'				, 'Nama'			, 'required');
       $this->form_validation->set_rules('username'	  , 'Password'	, 'required');
			 $this->form_validation->set_rules('email'			, 'Email'			, 'required');
       $this->form_validation->set_rules('nip'			  , 'NIP'				, 'required');
       $this->form_validation->set_rules('role'	  		, 'Role'			, 'required');
			 $this->form_validation->set_rules('status'	  	, 'Status'		, 'required');
       if ($this->form_validation->run() == TRUE)
       {				
				 				if($this->input->post('status')=='1')
								{
									$status = true;
								}
				 				elseif($this->input->post('status')=='0')
								{
									$status = false;
								}
				 				else
								{
									redirect('admin/user');
								}
								$data = array(
									 'id_user'      => $id,
									 'nama'				  => $this->input->post('nama'),
									 'username'			=> $this->input->post('username'),
									 'email'				=> $this->input->post('email'),
									 'nip'					=> $this->input->post('nip'),
									 'id_role'			=> $this->input->post('role'),
									 //'foto'					=> 'profile.png',
									 'status'				=> $status ,
									 //'created_by'		=> $_SESSION['id_user'],
									 //'created_date' => date('Y-m-d H:i:s'),
									 'update_by'		=> $_SESSION['id_user'],
									 'update_date'  => date('Y-m-d H:i:s')			 
								);
								 //send data into database
								 $this->User_model->saveEdit($data);
								 redirect('admin/user');
       }			 
		 }
		
		$this->load->view('admin/template/content',$data);
	}
	
	public function delete($id)
	{
		$list_user = $this->User_model->selectById($id);
		$nama_user='';
		foreach($list_user as $x)
		{
			$nama_user 	= $x->nama;
		}
		$data= array(
       'view'          => 'user/delete',
       'title'         => 'Kelolah Akun > Hapus  ',
       'breadcumbs'    => array('User','Hapus user',$nama_user),
			 'list_role'		 => $this->Role_model->selectAll(),
			 'list_user'		 => $list_user
     );
		if ($_SERVER['REQUEST_METHOD'] === 'POST')
    {
			$this->User_model->delete($id);
		}
		$this->load->view('admin/template/content',$data);
	}
	
	public function password($id='')
	{
		$list_user = $this->User_model->selectById($id);
		$nama_user='';
		foreach($list_user as $x)
		{
			$nama_user 	= $x->nama;
		}
		
		$data= array(
       'view'          => 'user/password',
       'title'         => 'Kelolah Akun > Ubah Password User ',
       'breadcumbs'    => array('User',$nama_user,'Ubah Password'),
			 'list_user'		 => $this->User_model->selectById($id)
     );
		if ($_SERVER['REQUEST_METHOD'] === 'POST')
    {
			 $new_password 		=  $this->input->post('new_password');
			 $new_password_2	=  $this->input->post('new_password_2');
			 if($new_password==$new_password_2)
			 {
				 $this->form_validation->set_message('required', 'Data %s tidak boleh kosong');
				 $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
				 $this->form_validation->set_rules('new_password'		, 'Password Baru'			, 'required');
				 $this->form_validation->set_rules('new_password_2'	, 'Ulangi Password'		, 'required');
				 if ($this->form_validation->run() == TRUE)
				 {
					 $data= array(
						 'id_user'			=> $id,
						 'password'			=> md5($this->input->post('new_password')),
						 'update_by'		=> $_SESSION['id_user'],
						 'update_date'  => date('Y-m-d H:i:s')
						 //posgres syntax
					 //'update_date'							=> date('Y-m-d H:m:s'),
					 );
					 $this->User_model->savePassworduserByAdmin($data);			
					 redirect('admin/user');
				 }
			 }
			 else
			 {
				 $_SESSION['error_message'] = "Password dan ulangi password tidak sama";
			 }
		}
		$this->load->view('admin/template/content',$data);
	}
}

