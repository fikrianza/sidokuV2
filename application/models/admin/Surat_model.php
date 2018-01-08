<?php
class Surat_model extends CI_Model {
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
      $this->db->select("master_surat.* , master_jenis_surat.nama_jenis_surat , master_keaslian_surat.nama_keaslian_surat");
      $this->db->from('master_surat');
      $this->db->join('master_jenis_surat',' master_surat.id_jenis_surat =  master_jenis_surat.id_jenis_surat');
      $this->db->join('master_keaslian_surat ',' master_surat.id_keaslian_surat =  master_keaslian_surat.id_keaslian_surat');
      $this->db->where('master_surat.status',true);
      $this->db->where('id_surat', $id);
      $query = $this->db->get();
      return $query->result();
    }
  
    public function saveEdit($data_surat , $data_disposisi)
    {
      //function untuk simpan edit data
      $this->db->set($data_surat);
      $this->db->where('id_surat',$data_surat['id_surat']);
      $this->db->update('master_surat');
      $this->db->trans_complete();
      if ($this->db->trans_status() === TRUE)
      {
        $this->db->set($data_disposisi);
        $this->db->where('id_surat',$data_disposisi['id_surat']);
        $this->db->where('id_user_pengirim',$data_disposisi['id_user_pengirim']);
        $this->db->update('relasi_disposisi');
        $_SESSION['success_message'] = "Berhasil edit data";
      }   
    }
  
    public function add2($data_surat , $data_disposisi)
    {
      //function untuk save  baru
      $this->db->select('kode_surat');
      $this->db->from('master_surat');
      $this->db->where('kode_surat',$data_surat['kode_surat']);
      $query = $this->db->get();
      if($query->num_rows() == 0)
      {
          $this->db->insert('master_surat',$data_surat);
          $this->db->trans_complete();
          if ($this->db->trans_status() === FALSE)
          {
           $_SESSION['error_message'] = 'Error occured while send to database';
          }
          else{
            $this->db->select('id_surat');
            $this->db->from('master_surat');
            $this->db->where($data_surat);
            $query = $this->db->get();
            $val = $query->result();
            foreach($val as $x)
            {
               $data_disposisi['id_surat'] = $x->id_surat;
               $this->db->insert('relasi_disposisi',$data_disposisi);
               $_SESSION['success_message'] = 'Berhasil menambah data'; 
            } 
          }
      }
      else
      {
        $_SESSION['error_message']= "Data Kode Surat sudah ada";
        redirect('admin/surat');
      }
    }
	
	 public function add($data_surat , $data_disposisi)
    {
      //function untuk save  baru
     
      //==============================================//
      $this->db->select('kode_surat');
      $this->db->from('master_surat');
      $this->db->where('kode_surat',$data_surat['kode_surat']);
      $query = $this->db->get();
      if($query->num_rows() == 0)
      {
          $this->db->insert('master_surat',$data_surat);
          $this->db->trans_complete();
          if ($this->db->trans_status() === FALSE)
          {
           $_SESSION['error_message'] = 'Error occured while send to database';
          }
          else{
            $this->db->select('id_surat');
            $this->db->from('master_surat');
            $this->db->where($data_surat);
            $query = $this->db->get();
            $val = $query->result();
            foreach($val as $x)
            {
               $data_disposisi['id_surat'] = $x->id_surat;
               $this->db->insert('relasi_disposisi',$data_disposisi);
               $_SESSION['success_message'] = 'Berhasil menambah data'; 
            } 
            //after succes insert
              $tahun =  date('Y');
              $this->db->select('nomor_surat_terakhir , created_date as tahun ');
              $this->db->from('antrian_surat_per_tahun');
              $this->db->where('created_date',$tahun);
              $query = $this->db->get();
              if($query->num_rows() == 0)
              {
                $data = array(
                  'nomor_surat_terakhir' => 1,
                  'created_date'         => date('Y')
                );
                $this->db->insert('antrian_surat_per_tahun',$data);
              }
              else
              {
                $this->db->set('nomor_surat_terakhir',$data_surat['no_urut_surat']);
				$this->db->where('created_date',$tahun);
                $this->db->update('antrian_surat_per_tahun');
              }
          }
      }
      else
      {
        $_SESSION['error_message']= "Data Kode Surat sudah ada";
        redirect('admin/surat');
      }
    }
  
    public function selectAll()
    {
      //function untuk select all semua role (khusus master admin)
      //$this->db->select('master_user.nama');
      //$this->db->where('master_user.id_user = master_jenis_surat.created_by');
      //$x =  $this->db->get_compiled_select();
      $this->db->select("master_surat.* , master_jenis_surat.nama_jenis_surat , master_keaslian_surat.nama_keaslian_surat");
      $this->db->from('master_surat');
      $this->db->join('master_jenis_surat',' master_surat.id_jenis_surat =  master_jenis_surat.id_jenis_surat');
      $this->db->join('master_keaslian_surat ',' master_surat.id_keaslian_surat =  master_keaslian_surat.id_keaslian_surat');
      $this->db->where('master_surat.status',true);
      $this->db->where('master_surat.created_by',$_SESSION['id_user']);
	  $this->db->order_by('id_surat','DESC');
      $query = $this->db->get();
      return $query->result();
    }
  
    public function selectAllByAdmin()
    {
      $this->db->select("master_surat.* , master_jenis_surat.nama_jenis_surat , master_keaslian_surat.nama_keaslian_surat");
      $this->db->from('master_surat');
      $this->db->join('master_jenis_surat',' master_surat.id_jenis_surat =  master_jenis_surat.id_jenis_surat');
      $this->db->join('master_keaslian_surat ',' master_surat.id_keaslian_surat =  master_keaslian_surat.id_keaslian_surat');
      $this->db->where('master_surat.status',true);
      $query = $this->db->get();
      return $query->result();
    }
  
    public function selectByIdByAdmin($id)
    { 
      //function untuk pilih berdasarkan id
      $this->db->select("master_surat.* , master_jenis_surat.nama_jenis_surat , master_keaslian_surat.nama_keaslian_surat , master_user.username , master_user.nama , master_user.id_user");
      $this->db->from('master_surat');
      $this->db->join('master_jenis_surat',' master_surat.id_jenis_surat =  master_jenis_surat.id_jenis_surat');
      $this->db->join('master_keaslian_surat ',' master_surat.id_keaslian_surat =  master_keaslian_surat.id_keaslian_surat');
      $this->db->join('master_user','master_surat.created_by =  master_user.id_user');
      $this->db->where('master_surat.status',true);
      $this->db->where('master_surat.id_surat', $id);
      $query = $this->db->get();
      return $query->result();
    }
  
    public function getTimelineSurat($id_surat)
    {
      $this->db->select('relasi_disposisi.*, master_user.nama');
      $this->db->from('relasi_disposisi');
      $this->db->join('master_user','master_user.id_user = relasi_disposisi.id_user_pengirim');
      $this->db->where('id_surat',$id_surat);
      $this->db->order_by('id_disposisi','desc');
      $query = $this->db->get();
      return $query->result();
    }
  
    public function delete($id)
    {
      //function untuk delete role
      $this->db->select('id_surat');
      $this->db->from('master_surat');
      $this->db->where('id_surat',$id);
      $query = $this->db->get();
      if($query->num_rows() == 1)
      {
        $this->db->where('id_surat',$id);
        $this->db->set('status',false);
        $this->db->update('master_surat');
        $_SESSION['success_message']="Berhasil Hapus Data";
      }
      else{
        $_SESSION['error_message']="ID Data tidak ditemukan";
      }

      redirect('admin/surat');
    }
  
    public function deleteAll()
    {
      //function untuk delete seluruh role
    }
  
    public function is_read($id ,$val)
    {
      $this->db->set('is_read' , $val);
      $this->db->where('id_disposisi',$id);
      $this->db->where('id_user_penerima',$_SESSION['id_user']);
      $this->db->update('relasi_disposisi');
    }
  
    public function getCount()
    {
      $this->db->select(' COUNT(id_surat) as c ');
      $this->db->from("master_surat");
      $this->db->where('status',true);
      $query = $this->db->get();
      return $query->result();
    }
  
   public function getLatest()
   {
     $this->db->limit('1');
     $this->db->select("master_surat.* , master_jenis_surat.nama_jenis_surat , master_keaslian_surat.nama_keaslian_surat");
      $this->db->from('master_surat');
      $this->db->join('master_jenis_surat',' master_surat.id_jenis_surat =  master_jenis_surat.id_jenis_surat');
      $this->db->join('master_keaslian_surat ',' master_surat.id_keaslian_surat =  master_keaslian_surat.id_keaslian_surat');
      $this->db->where('master_surat.status',true);
     $this->db->order_by('id_surat','DESC');
     $query = $this->db->get();
     return $query->result();
   }
  
   public function selectAllByAdminTop5()
   {
      $this->db->limit('5');
      $this->db->select("master_surat.* , master_jenis_surat.nama_jenis_surat , master_keaslian_surat.nama_keaslian_surat");
      $this->db->from('master_surat');
      $this->db->join('master_jenis_surat',' master_surat.id_jenis_surat =  master_jenis_surat.id_jenis_surat');
      $this->db->join('master_keaslian_surat ',' master_surat.id_keaslian_surat =  master_keaslian_surat.id_keaslian_surat');
      $this->db->where('master_surat.status',true);
      $this->db->order_by('id_surat','DESC');
      $query = $this->db->get();
     
      return $query->result();
   }
  
  public function selectAllByUserTop5()
  {
      $this->db->limit('5');
      $this->db->select("master_surat.* , master_jenis_surat.nama_jenis_surat , master_keaslian_surat.nama_keaslian_surat");
      $this->db->from('master_surat');
      $this->db->join('master_jenis_surat',' master_surat.id_jenis_surat =  master_jenis_surat.id_jenis_surat');
      $this->db->join('master_keaslian_surat ',' master_surat.id_keaslian_surat =  master_keaslian_surat.id_keaslian_surat');
      $this->db->where('master_surat.status',true);
      $this->db->order_by('id_surat','DESC');
      $query = $this->db->get();
      return $query->result();
  }
  
  public function selectJumlahSuratPerTahunIni()
  {
    /*
	$year = date('Y');
    $this->db->select('COUNT(id_surat) as c ,  MONTH( created_date ) AS bulan');
    $this->db->from('master_surat');
    $this->db->where('YEAR(created_date)' ,$year);
    $this->db->where('status',true);
    //$this->db->group_by('bulan');
    $query = $this->db->get();
    return $query->result();
    */
	//postgres syntax dibawah
    $year = date('Y');
    $this->db->select('COUNT(id_surat) as c, (select extract (YEAR from (created_date))) AS tahun');
    $this->db->from('master_surat');
    $this->db->where('(select extract (YEAR from (created_date))) =' ,$year);
    $this->db->group_by('(select extract (YEAR from (created_date)))');
	$this->db->where('status',true);
    $query = $this->db->get();
    return $query->result();
    
  }
  
  public function setStatusKeuangan($data)
  {
      $this->db->select('id_disposisi');
      $this->db->from('relasi_disposisi');
      $this->db->where('id_disposisi',$data['id_disposisi']);
      $query = $this->db->get();
      if($query->num_rows() == 1)
      {
        $this->db->set('id_status_keuangan' , $data['id_status_keuangan']);
        $this->db->where('id_disposisi',$data['id_disposisi']);
        $this->db->update('relasi_disposisi');
        $_SESSION['success_message'] = "Berhasil Update Status Keuangan";
      }
     else
     {
       $_SESSION['error_message'] = "Some Error Has Occured";
     }
  }
  
  public function setKeuanganSurat($data)
  {
      $this->db->select('id_disposisi');
      $this->db->from('relasi_disposisi');
      $this->db->where('id_disposisi',$data['id_disposisi']);
      $query = $this->db->get();
      if($query->num_rows() == 1)
      {
        $this->db->set('nominal_uang'       , $data['nominal_uang']);
        $this->db->set('deskripsi_keuangan' , $data['deskripsi_keuangan']);
        $this->db->where('id_disposisi',$data['id_disposisi']);
        $this->db->update('relasi_disposisi');
        $_SESSION['success_message'] = "Berhasil Update  Keuangan";
      }
     else
     {
       $_SESSION['error_message'] = "Some Error Has Occured";
     }
  }
  
  public function selectJumlahKeuanganPerBulanPerTahun()
  {
    $year = date('Y');
    //$this->db->select('SUM(nominal_uang) as c ,  MONTH( created_date ) AS bulan');
    
    $this->db->select('SUM(nominal_uang) as c ,  (select extract (MONTH from (created_date))) AS bulan');
    
    
    $this->db->from('relasi_disposisi');
    //$this->db->where('YEAR(created_date)' ,$year);
    
    $this->db->where('(select extract (YEAR from (created_date))) = ' ,$year);
    
    $this->db->where('id_status_keuangan',5);
    $this->db->where('nominal_uang<>',0);
    
    $this->db->group_by('bulan');
    $query = $this->db->get();
    return $query->result();
    
  }
  
  public function selectJumlahKeuanganPerTahun()
  {
    $year = date('Y');
    $this->db->select('SUM(nominal_uang) as c ,  (select extract (YEAR from (created_date))) AS tahun');
    $this->db->from('relasi_disposisi');
    $this->db->where('id_status_keuangan',5);
    $this->db->where('nominal_uang<>',0);
    $this->db->group_by('tahun');
	$this->db->order_by('tahun','asc');
    $query = $this->db->get();
    return $query->result();
  }
  
  public function selectHistoryJumlahSuratPerTahun()
  {
    //fungsi untuk select jumlah surat setiap tahun ex : 2014,2015,2016,2017,...,etc
    $this->db->select('COUNT(id_surat) as c ,  (select extract (YEAR from (created_date))) AS tahun');
    $this->db->from('master_surat');
    $this->db->where('status',true);
    $this->db->group_by('tahun');
	$this->db->order_by('tahun','asc');
    $query = $this->db->get();
    return $query->result();
  }
  
  public function selectHistoryJumlahSuratPerBulanPerTahunIni()
  {
    $year = date('Y');    
    $this->db->select('COUNT(id_surat) as c ,  (select extract (MONTH from (created_date))) AS bulan');   
    $this->db->from('master_surat');
    $this->db->where('(select extract (YEAR from (created_date))) = ' ,$year);
    $this->db->where('status',true);
    $this->db->group_by('bulan');
	
    $query = $this->db->get();
    return $query->result();
  }

  public function getLastQueue()
  {
      $tahun =  date('Y');
      $nomor_urut;
      $this->db->select('nomor_surat_terakhir , created_date as tahun ');
      $this->db->from('antrian_surat_per_tahun');
      $this->db->where('created_date',$tahun);
      $query = $this->db->get();
      if($query->num_rows() == 0)
      {
        $nomor_urut =1;
      }
      else
      {
        $this->db->select('nomor_surat_terakhir ,created_date as tahun ');
        $this->db->from('antrian_surat_per_tahun');
        $this->db->where('created_date',$tahun);
        $query = $this->db->get()->result();
        foreach($query as $x)
        {
			//$nomor_urut =  $x->nomor_surat_terakhir ;
			$nomor_urut =  $x->nomor_surat_terakhir+1;
        }
      }
    return $nomor_urut;
  }
}
