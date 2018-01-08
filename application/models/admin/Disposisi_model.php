<?php
class Disposisi_model extends CI_Model {
    //this function below to manage /
        //$ci = &get_instance();
    public function __construct()
    {
            // Call the CI_Model constructor
            parent::__construct();
    }
  
   public function addDisposisi($data)
   {
     $this->db->insert('relasi_disposisi',$data);
   }
   
  public function selectAll()
  {
    $this->db->select("master_surat.no_urut_surat , relasi_disposisi.*, master_user.nama , master_user.username , master_surat.kode_surat ");
    $this->db->from('relasi_disposisi');
    $this->db->join('master_user','relasi_disposisi.id_user_penerima =  master_user.id_user');
    $this->db->join('master_surat','relasi_disposisi.id_surat = master_surat.id_surat');
    if($_SESSION['level']!=0)
    {
      $this->db->where('relasi_disposisi.id_user_pengirim',$_SESSION['id_user']);
    }
    $this->db->order_by('id_disposisi','DESC');
    $query = $this->db->get();
    return $query->result();
  }
  
  public function selectMyInbox()
  {
    $this->db->select("master_surat.no_urut_surat,relasi_disposisi.*, master_user.nama , master_user.username , master_surat.kode_surat , master_status_keuangan.nama_status_keuangan");
    $this->db->from('relasi_disposisi');
    $this->db->join('master_user','relasi_disposisi.id_user_pengirim =  master_user.id_user');
    $this->db->join('master_surat','relasi_disposisi.id_surat = master_surat.id_surat');
    $this->db->join('master_status_keuangan','relasi_disposisi.id_status_keuangan =  master_status_keuangan.id_status_keuangan');
    $this->db->where('id_user_penerima',$_SESSION['id_user']);
    $this->db->order_by('id_disposisi','DESC');
    $query = $this->db->get();
    return $query->result();
  }
  
  public function selectDisposisiDetail($id)
  {
    $this->db->select('id_user_penerima , id_user_pengirim FROM relasi_disposisi WHERE
                       id_disposisi = '.$id.' AND (id_user_penerima = '.$_SESSION['id_user'].' OR
                       id_user_pengirim = '.$_SESSION['id_user'].'
                       )'                   
                     );
    //$this->db->from('relasi_disposisi');
    //$this->db->where('id_disposisi',$id);
    //$this->db->where('id_user_penerima',$_SESSION['id_user']);
    //$this->db->or_where('id_user_pengirim',$_SESSION['id_user']);

    $query = $this->db->get();
    if($query->num_rows() == 0)
    {
        $_SESSION['error_message'] = 'Data surat tidak tersedia saat ini';
        redirect('admin/surat/disposisi');
    }
    else
    {
      $this->db->select("relasi_disposisi.* , 
                       master_surat.id_jenis_surat ,
                       master_surat.id_keaslian_surat,
                       master_surat.no_urut_surat,
                       master_surat.perihal_surat,
                       master_surat.jumlah_lampiran,
                       master_surat.asal_surat,
                       master_surat.tujuan_surat,
                       master_surat.kode_surat,
                       master_surat.tanggal_pembuatan_surat,
                       master_surat.tanggal_terima_surat,
                       master_surat.deskripsi_surat,
                       relasi_disposisi.created_date as tanggal_kirim,
                       master_jenis_surat.nama_jenis_surat,
                       master_keaslian_surat.nama_keaslian_surat,
                       ");
      $this->db->from('relasi_disposisi');
      $this->db->join('master_surat','relasi_disposisi.id_surat= master_surat.id_surat');
      $this->db->join('master_jenis_surat','master_surat.id_jenis_surat =  master_jenis_surat.id_jenis_surat');
      $this->db->join('master_keaslian_surat','master_surat.id_keaslian_surat=master_keaslian_surat.id_keaslian_surat');
      //$this->db->where('relasi_disposisi.id_user_pengirim',$_SESSION['id_user']);
      //$this->db->or_where('relasi_disposisi.id_user_penerima',$_SESSION['id_user']);
      $this->db->where('relasi_disposisi.id_disposisi',$id);

      $query = $this->db->get();
      return $query->result();
    }
    
  }
  
  public function getNotReadMessage()
  {
    $this->db->select('COUNT(id_surat) as c');
	$this->db->from(' (select "master_surat"."no_urut_surat", "relasi_disposisi".*, "master_user"."nama", "master_user"."username", "master_surat"."kode_surat", "master_status_keuangan"."nama_status_keuangan" FROM "relasi_disposisi" JOIN "master_user" ON "relasi_disposisi"."id_user_pengirim" = "master_user"."id_user" JOIN "master_surat" ON "relasi_disposisi"."id_surat" = "master_surat"."id_surat" JOIN "master_status_keuangan" ON "relasi_disposisi"."id_status_keuangan" = "master_status_keuangan"."id_status_keuangan" WHERE "id_user_penerima" = '.$_SESSION['id_user'].' ORDER BY "created_date" DESC) as filtered WHERE is_read = false');
    $query = $this->db->get();
    return $query->result();
  }
  
  public function selectMonitoring()
  {
    $this->db->select('id_surat , kode_surat , perihal_surat,created_date');
    $this->db->from('master_surat');
	$this->db->order_by('id_surat','DESC');
    $query = $this->db->get();
    return $query->result();
  }
  
  public function detailMonitoring($id)
  {
     $this->db->select('relasi_disposisi.* , master_role.nama_role , master_user.id_user , master_user.nama,master_surat.kode_surat,master_status_keuangan.nama_status_keuangan');
    $this->db->from('relasi_disposisi');
    $this->db->join('master_surat','relasi_disposisi.id_surat = master_surat.id_surat');
    $this->db->join('master_user','relasi_disposisi.id_user_penerima=master_user.id_user');
    $this->db->join('master_role','master_user.id_role=master_role.id_role');
    $this->db->join('master_status_keuangan','relasi_disposisi.id_status_keuangan =  master_status_keuangan.id_status_keuangan');
    $this->db->where('relasi_disposisi.id_surat',$id);
    $this->db->order_by('id_disposisi','DESC');
    $query = $this->db->get();
    return $query->result();
  }
}
