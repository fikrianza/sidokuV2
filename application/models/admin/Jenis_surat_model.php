<?php
class Jenis_surat_model extends CI_Model {
    //this function below to manage /
        //$ci = &get_instance();
    public function __construct()
    {
            // Call the CI_Model constructor
            parent::__construct();
    }
  
    public function selectById($id)
    { 
      //function untuk pilih berdasarkan id
      $this->db->select('*');
      $this->db->from('master_jenis_surat');
      $this->db->where('id_jenis_surat', $id);
      $query = $this->db->get();
      return $query->result();
    }
  
    public function saveEdit($data)
    {
      //function untuk simpan edit data
      $this->db->set($data);
      $this->db->where('id_jenis_surat',$data['id_jenis_surat']);
      $this->db->update('master_jenis_surat');
      $_SESSION['success_message'] = "Berhasil edit data";
    }
  
    public function add($data)
    {
      //function untuk save  baru
      $this->db->select('nama_jenis_surat');
      $this->db->from('master_jenis_surat');
      $this->db->where('nama_jenis_surat',$data['nama_jenis_surat']);
      $query = $this->db->get();
      if($query->num_rows() == 0)
      {
          $this->db->insert('master_jenis_surat',$data);
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
        $_SESSION['error_message']= "Data Nama Jenis Surat sudah ada";
        redirect('admin/jenis_surat');
      }
    }
  
    public function selectAll()
    {
      //function untuk select all semua role (khusus master admin)
      $this->db->select('master_user.nama');
      $this->db->where('master_user.id_user = master_jenis_surat.created_by');
      $x =  $this->db->get_compiled_select();
      
      $this->db->select('master_user.nama');
      $this->db->where('master_user.id_user = master_jenis_surat.update_by');
      $y =  $this->db->get_compiled_select();
      /* nama_created_by = (".$x."),
                         nama_update_by =  (".$y."), */
      $this->db->select("id_jenis_surat , 
                         nama_jenis_surat,
                         created_by,
                         created_date,
                         update_by,
                         update_date
                         ");
      $this->db->from('master_jenis_surat');
      $query = $this->db->get();
      return $query->result();
    }
  
    public function delete($id)
    {
      //function untuk delete role
      $this->db->select('id_jenis_surat');
      $this->db->from('master_jenis_surat');
      $this->db->where('id_jenis_surat',$id);
      $query = $this->db->get();
      if($query->num_rows() == 1)
      {
        $this->db->select('id_jenis_surat');
        $this->db->from('master_surat');
        $this->db->where('id_jenis_surat',$id);
        $query = $this->db->get();
        if($query->num_rows() == 0)
        { 
          $this->db->where('id_jenis_surat',$id);
          $this->db->delete('master_jenis_surat');
          $_SESSION['success_message']="Berhasil Hapus Data";
        }
        else
        {
          $_SESSION['error_message']="Data ini tidak dapat dihapus karena sedang digunakan ditemukan";
        }
      }
      else{
        $_SESSION['error_message']="ID Data tidak ditemukan";
      }

      redirect('admin/jenis_surat');
    }
  
    public function deleteAll()
    {
      //function untuk delete seluruh role
    }
  
    public function getCount()
    {
      $this->db->select(' COUNT(id_jenis_surat) as c ');
      $this->db->from("master_jenis_surat");
      $query = $this->db->get();
      return $query->result();
    }
}
