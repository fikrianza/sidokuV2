<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_helper {
  public function __construct()
   {

   }

  public function validate_login_session()
  {
    if(!isset($_SESSION['username']) && !isset($_SESSION['role']) && !isset($_SESSION['status']))
    {
      $_SESSION['error_message'] = "Anda harus Login dahulu";
      redirect('admin/login');
    }
		//if($_SESSION['status']==0 || $_SESSION['status']==false)
		if( $_SESSION['status']=='f')
		//if($_SESSION['status']==0 )
		{
			$_SESSION['error_message'] = 'Akun anda sedang di non-aktifkan';
			redirect('admin/suspend');
			//redirect('admin/login/logout');
		}

  }
}
