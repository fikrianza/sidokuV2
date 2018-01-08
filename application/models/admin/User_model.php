<?php
class User_model extends CI_Model {
    //this function below to manage /
        //$ci = &get_instance();
    public function __construct()
    {
            // Call the CI_Model constructor
            parent::__construct();
    }

    public function login($data)
    {
      $this->db->select('username , password');
      $this->db->from('master_user');
      $this->db->where('username',$data['username']);
      $this->db->where('password',$data['password']);
      $query = $this->db->get();
      if($query->num_rows() > 0)
      {
        $this->db->select('master_user.username , master_user.id_role , master_user.id_user , master_user.status , master_role.level');
        $this->db->from('master_user');
        $this->db->join('master_role','master_user.id_role =  master_role.id_role');
        $this->db->where('username',$data['username']);
        $this->db->where('password',$data['password']);
        $this->db->where('is_deleted', false);
        //
        $query = $this->db->get();
        return $query->result();
      }
      else
      {
        $_SESSION['error_message']= "Data akun tidak ditemukan";
        redirect('admin/login');
      }
      
    }
    
    public function getMyProfile()
    {
      $this->db->select('master_user.nama, master_user.username , master_user.email , master_user.nip , master_user.password , master_role.nama_role');
      $this->db->from('master_user');
      $this->db->join('master_role','master_user.id_role =  master_role.id_role');
      $this->db->where('id_user',$_SESSION['id_user']);
      $query = $this->db->get();
      return $query->result();
    }
    
    public function logout()
    {
      //function untuk logout admin
    }
  
    public function selectById($id_user)
    {
      //function untuk lihat berdasarkan id -khusus untuk MASTER ADMIN
      $this->db->select("master_user.* , master_role.nama_role");
      $this->db->from('master_user');
      $this->db->join('master_role','master_user.id_role =  master_role.id_role');
      $this->db->where('id_user',$id_user);
      $query = $this->db->get();
      return $query->result();
    }
  
    public function saveEdit($data)
    {
      //function untuk simpan edit data
      $this->db->select('id_user');
      $this->db->from('master_user');
      $this->db->where('id_user',$data['id_user']);
      $query = $this->db->get();
      if($query->num_rows() > 0)
      {
        $this->db->set($data);
        $this->db->where('id_user',$data['id_user']);
        $this->db->update('master_user');
        $_SESSION['success_message']= "Berhasil Edit data";
      }
      
    }
	
	public function changePassword($data , $old_password)
    {
      //function untuk ubah password
      $this->db->select('password');
      $this->db->from('master_user');
      $this->db->where('id_user',$data['id_user']);
      $this->db->where('password',$old_password);
      $query = $this->db->get();
      if($query->num_rows() == 0)
      {
        $_SESSION['error_message'] = "Password lama tidak sesuai";
        redirect('admin/profile/edit_password');
      }
      else  
      {
         $this->db->set($data);
         $this->db->where('id_user',$data['id_user']);
         $this->db->update('master_user');
         $_SESSION['success_message'] = "Berhasil edit password baru,silahkan Login ulang";
         session_destroy();
				 redirect('admin/login');
      }
    }
  
    public function add($data)
    {
      //function untuk save user baru
      $this->db->select('username , email , nip');
      $this->db->from('master_user');
      //$this->db->where('is_deleted',false);
      $this->db->where('username',$data['username']);
      $this->db->or_where('email',$data['email']);
      $this->db->or_where('nip',$data['nip']);
      $query = $this->db->get();
      if($query->num_rows() == 0)
      {
          $this->db->insert('master_user',$data);
          $this->db->trans_complete();
          if ($this->db->trans_status() === FALSE)
          {
           $_SESSION['error_message'] = 'Error occured while send to database';
          }
          else{
            $_SESSION['success_message'] = 'Berhasil menambah data';    
          }
      }
      else
      {
        $_SESSION['error_message']= "Data Username , Email , atau NIP sudah ada";
        redirect('admin/user/add');
      }
    }
  
    public function selectAll()
    {
      //function untuk select all semua user (khusus master admin)
      $this->db->select('master_user.id_user,
                         master_user.username , 
                         master_user.email , 
                         master_user.nama , 
                         master_user.status,
                         master_user.nip ,
                         master_user.password,
                         master_role.nama_role');
      $this->db->from('master_user');
      $this->db->join('master_role','master_user.id_role =  master_role.id_role');
      $this->db->where('master_user.is_deleted',false);
      $this->db->where('master_user.id_role <>',1);
      $query = $this->db->get();
      return $query->result();
      
    }
  
    public function delete($id)
    {
      $this->db->where('id_user',$id);
      $this->db->set('is_deleted',true);
      $this->db->update('master_user');
      $_SESSION['success_message']= "Berhasil hapus data";
      redirect('admin/user');
    }
  
    public function selectManager()
    {
      $levelManager =  $_SESSION['level']+1;
      $this->db->select('master_user.id_user , master_user.username , master_user.nama , master_role.level, master_role.nama_role ');
      $this->db->from('master_user');
      $this->db->join('master_role','master_user.id_role= master_role.id_role');
      $this->db->where('master_user.status',true);
      $this->db->where('master_user.is_deleted',false);
      $this->db->where('master_role.level',$levelManager);
      if($_SESSION['level']==2)
      {
        $this->db->or_where('master_role.level',2);
      }
      $query = $this->db->get();
      return $query->result();
    }
  
    public function getCount()
    {
      $this->db->select(' COUNT(id_user) as c ');
      $this->db->from("master_user");
      $this->db->where('is_deleted',false);
      $this->db->where('id_role<>',1);
      $query = $this->db->get();
      return $query->result();
    }

	public function savePassworduserByAdmin($data)
    {
      $this->db->set($data);
      $this->db->where('id_user',$data['id_user']);
      $this->db->update('master_user');
      $_SESSION['success_message'] = "Berhasil ganti password ";
    }	
}
