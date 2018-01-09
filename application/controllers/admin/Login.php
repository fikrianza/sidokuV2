<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

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
        $this->load->model('admin/User_model','User_model');
   }

   //must content index()
   public function index()
   {
     //load login view
		 if(isset($_SESSION['username']) && isset($_SESSION['role']))
     {
      redirect('admin/home');
     }
     $this->load->view('admin/template/login');
   }

   //untuk cek validasi input login
   public function auth_login()
   {
     if ($_SERVER['REQUEST_METHOD'] === 'POST')
     {
       //form validation
       $this->form_validation->set_message('required', 'Data %s tidak boleh kosong');
       $this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
       $this->form_validation->set_rules('username', 'Username', 'required');
       $this->form_validation->set_rules('password', 'Password', 'required');
       if ($this->form_validation->run() == FALSE)
       {
         $this->load->view('admin/template/login');
       }
       else {
				 $data = array(
				 	'username' 			=> $this->input->post('username'),
					'password'			=> md5($this->input->post('password'))
				 );
				 $val = $this->User_model->login($data);
				 foreach($val as $x)
				 {
					 $_SESSION['username'] = $x->username;
					 $_SESSION['role'] 		 = $x->id_role;
					 $_SESSION['id_user']	 = $x->id_user;
					 $_SESSION['status']	 = $x->status;
					 $_SESSION['level']		 = $x->level;
				 }
         redirect('admin/home');
       }
     }
     else {
      redirect('admin/login');
     }
   }

   public function logout()
   {
     session_destroy();
     redirect('admin/login');
   }

}
