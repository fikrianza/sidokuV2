<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

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
		  $this->load->model('admin/User_model','User_model');
   }

   public function index()
   {
     //load login view
     $data= array(
       'view'          => 'profile/edit_profile',
       'title'         => 'Profile Saya ',
       'breadcumbs'    => array('Profile','Edit Profile'),
			 'list_profile'	=> $this->User_model->getMyProfile()
     );
		 //if exist add action
		 if ($_SERVER['REQUEST_METHOD'] === 'POST')
     {
			   $this->form_validation->set_message('required', 'Data %s tidak boleh kosong');
				 $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
				 $this->form_validation->set_rules('nama'						, 'Nama'			, 'required');
				 $this->form_validation->set_rules('email'					, 'Email'			, 'required');
				 if ($this->form_validation->run() == TRUE)
				 {
					 $data= array(
						 'id_user'			=> $_SESSION['id_user'],
						 'nama'					=> $this->input->post('nama'),
						 'email'				=> $this->input->post('email'),
						 'update_by'		=> $_SESSION['id_user'],
						 'update_date'  => date('Y-m-d H:i:s')
						 //posgres syntax
					  //'update_date'							=> date('Y-m-d H:m:s'),
					 );
					 $this->User_model->saveEdit($data);
					 redirect('admin/profile');
				 }
		 }
     $this->load->view('admin/template/content',$data);
   }
  
  public function edit_password()
  {
     $data= array(
       'view'          => 'profile/edit_password',
       'title'         => 'Profile Saya ',
       'breadcumbs'    => array('Profile','Edit password'),
			 'list_profile'	 => $this->User_model->getMyProfile()
     );
		//if exist add action
		 if ($_SERVER['REQUEST_METHOD'] === 'POST')
     {
			 $new_password 		=  $this->input->post('new_password');
			 $new_password_2	=  $this->input->post('new_password_2');
			 if($new_password==$new_password_2)
			 {
				 $this->form_validation->set_message('required', 'Data %s tidak boleh kosong');
				 $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
				 $this->form_validation->set_rules('old_password'		, 'Password lama'			, 'required');
				 $this->form_validation->set_rules('new_password'		, 'Password Baru'			, 'required');
				 $this->form_validation->set_rules('new_password_2'	, 'Ulangi Password'		, 'required');
				 if ($this->form_validation->run() == TRUE)
				 {
					 $data= array(
						 'id_user'			=> $_SESSION['id_user'],
						 'password'			=> md5($this->input->post('new_password')),
						 'update_by'		=> $_SESSION['id_user'],
						 'update_date'  => date('Y-m-d H:i:s')
						 //posgres syntax
					 //'update_date'							=> date('Y-m-d H:m:s'),
					 );
					 $old_password     = md5($this->input->post('old_password'));
					 $this->User_model->changePassword($data,$old_password);
					 session_destroy();
					 redirect('admin/login');
				 }
			 }
			 else
			 {
				 $_SESSION['error_message'] = "Password baru tidak sama";
			 }
		 }
     $this->load->view('admin/template/content',$data);
  }

}
