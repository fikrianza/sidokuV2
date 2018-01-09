<?php
class Keaslian_surat_model extends CI_Model {
    //this function below to manage /
        //$ci = &get_instance();
    public function __construct()
    {
            // Call the CI_Model constructor
            parent::__construct();
    }
  
    public function selectAll()
    {
      //function untuk select all semua role (khusus master admin)
      //$this->db->select('master_user.nama');
      //$this->db->where('master_user.id_user = master_jenis_surat.created_by');
      //$x =  $this->db->get_compiled_select();
      $this->db->select("*");
      $this->db->from('master_keaslian_surat');
      $query = $this->db->get();
      return $query->result();
    }
}
