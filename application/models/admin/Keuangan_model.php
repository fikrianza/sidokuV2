<?php
class Keuangan_model extends CI_Model {
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
      $this->db->select("*");
      $this->db->from('master_status_keuangan');
      $query = $this->db->get();
      return $query->result();
    }
}
