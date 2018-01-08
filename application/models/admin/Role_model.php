<?php
class Role_model extends CI_Model {
    //this function below to manage /
        //$ci = &get_instance();
    public function __construct()
    {
            // Call the CI_Model constructor
            parent::__construct();
    }
  
    public function selectById($id_role)
    { 
      //function untuk pilih berdasarkan id
    }
  
    public function saveEdit($id_role)
    {
      //function untuk simpan edit data
    }
  
    public function add()
    {
      //function untuk save role baru
    }
  
    public function selectAll()
    {
      //function untuk select all semua role (khusus master admin)
      $this->db->select("*");
      $this->db->from('master_role');
      $this->db->where('level<>',0);
      $query = $this->db->get();
      return $query->result();
    }
  
    public function delete($id_role)
    {
      //function untuk delete role
    }
  
    public function deleteAll()
    {
      //function untuk delete seluruh role
    }
}
