<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Suspend extends CI_Controller {

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
      //$this->load->model('admin/Role_model','Role_model');
   }

   public function index()
   {
     //load login view
		 if(!isset($_SESSION['username']) && !isset($_SESSION['role']) && !isset($_SESSION['status']))
     {
			 redirect('admin/login');
		 }
		 if($_SESSION['status']=='1')
		 {
			 redirect('admin');
		 }
		 
     $data= array(
       'view'          => 'suspend',
     );
     $this->load->view('admin/template/content',$data);
   }
}
