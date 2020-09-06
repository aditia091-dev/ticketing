<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class M_printer extends CI_Model {    

    function semua() {
        $gid=$this->session->userdata('gid');
        $query = $this->db->query("SELECT tb_inv_printer.id_printer,tb_inv_printer.kode_printer,tb_pengguna.nama_pengguna,tb_inv_printer.jenis_printer,
            tb_inv_printer.spesifikasi,tb_inv_printer.tgl_inv,tb_inv_printer.status,tb_inv_printer.note,tb_inv_printer.gid,tb_departemen.nama,tb_departemen.parent,tb_pengguna.id_dept
            FROM tb_inv_printer INNER JOIN tb_pengguna ON tb_pengguna.id_pengguna = tb_inv_printer.id_pengguna 
            INNER JOIN tb_departemen ON tb_departemen.id_dept = tb_pengguna.id_dept WHERE tb_inv_printer.status='DIGUNAKAN' OR tb_inv_printer.status ='SIAP DIGUNAKAN' OR tb_inv_printer.status='DIPERBAIKI' ORDER BY tb_inv_printer.id_printer DESC");
        return $query;
    }

    function semuagid() {
        $gid=$this->session->userdata('gid');
        $query = $this->db->query("SELECT tb_inv_printer.id_printer,tb_inv_printer.kode_printer,tb_pengguna.nama_pengguna,tb_inv_printer.jenis_printer,
            tb_inv_printer.spesifikasi,tb_inv_printer.tgl_inv,tb_inv_printer.status,tb_inv_printer.note,tb_inv_printer.gid,tb_departemen.nama,tb_departemen.parent,tb_pengguna.id_dept
            FROM tb_inv_printer INNER JOIN tb_pengguna ON tb_pengguna.id_pengguna = tb_inv_printer.id_pengguna 
            INNER JOIN tb_departemen ON tb_departemen.id_dept = tb_pengguna.id_dept WHERE tb_departemen.gid ='$gid' AND tb_inv_printer.status='DIGUNAKAN' OR tb_departemen.gid ='$gid' AND tb_inv_printer.status ='SIAP DIGUNAKAN' OR tb_departemen.gid ='$gid' AND tb_inv_printer.status='DIPERBAIKI' OR tb_departemen.gid ='$gid' AND tb_inv_printer.status='DIPINJAMKAN' ORDER BY tb_inv_printer.id_printer DESC");
        return $query;
    }

    function getsemua_tanggal($tglawal,$tglakhir)
    {
        $gid=$this->session->userdata('gid');
        $this->db->select("pr.id_printer,pr.kode_printer,p.nama_pengguna,pr.spesifikasi,pr.jenis_printer,pr.tgl_inv,pr.status,pr.note,dep.nama,dep.parent");
        $this->db->from("tb_inv_printer as pr");
        $this->db->join('tb_pengguna as p','p.id_pengguna=pr.id_pengguna');
        $this->db->join('tb_departemen as dep','dep.id_dept=p.id_dept');
        $this->db->where("DATE(pr.tgl_inv) BETWEEN '$tglawal' AND '$tglakhir'");
        $this->db->where_in("pr.status",array('DIGUNAKAN','SIAP DIGUNAKAN','DIPERBAIKI','DIPINJAMKAN'));     
        $this->db->order_by('pr.tgl_inv','ASC');
        return $this->db->get()->result();
        
    }

    function getall_tanggal($tglawal,$tglakhir)
    {
        $gid=$this->session->userdata('gid');
        $this->db->select("pr.id_printer,pr.kode_printer,p.nama_pengguna,pr.spesifikasi,pr.jenis_printer,pr.tgl_inv,pr.status,pr.note,dep.nama,dep.parent");
        $this->db->from("tb_inv_printer as pr");
        $this->db->join('tb_pengguna as p','p.id_pengguna=pr.id_pengguna');
        $this->db->join('tb_departemen as dep','dep.id_dept=p.id_dept');
        $this->db->where("DATE(pr.tgl_inv) BETWEEN '$tglawal' AND '$tglakhir'");
        $this->db->where("pr.gid='$gid'");
        $this->db->where_in("pr.status",array('DIGUNAKAN','SIAP DIGUNAKAN','DIPERBAIKI','DIPINJAMKAN'));     
        $this->db->order_by('pr.tgl_inv','ASC');
        return $this->db->get()->result();
        
    }

    function semua_arsip() {
        $gid=$this->session->userdata('gid');
        $query = $this->db->query("SELECT tb_inv_printer.id_printer,tb_inv_printer.kode_printer,tb_pengguna.nama_pengguna,tb_inv_printer.jenis_printer,
            tb_inv_printer.spesifikasi,tb_inv_printer.tgl_inv,tb_inv_printer.status,tb_inv_printer.note,tb_inv_printer.gid,tb_departemen.nama,tb_departemen.parent,tb_pengguna.id_dept
            FROM tb_inv_printer INNER JOIN tb_pengguna ON tb_pengguna.id_pengguna = tb_inv_printer.id_pengguna 
            INNER JOIN tb_departemen ON tb_departemen.id_dept = tb_pengguna.id_dept WHERE tb_inv_printer.status='ARSIP/DISIMPAN' OR tb_inv_printer.status ='RUSAK/NOT FIXABLE' OR tb_inv_printer.status='HILANG/DICURI' ORDER BY tb_inv_printer.id_printer DESC");
        return $query;
    }

    function semuagid_arsip() {
        $gid=$this->session->userdata('gid');
        $query = $this->db->query("SELECT tb_inv_printer.id_printer,tb_inv_printer.kode_printer,tb_pengguna.nama_pengguna,tb_inv_printer.jenis_printer,
            tb_inv_printer.spesifikasi,tb_inv_printer.tgl_inv,tb_inv_printer.status,tb_inv_printer.note,tb_inv_printer.gid,tb_departemen.nama,tb_departemen.parent,tb_pengguna.id_dept
            FROM tb_inv_printer INNER JOIN tb_pengguna ON tb_pengguna.id_pengguna = tb_inv_printer.id_pengguna 
            INNER JOIN tb_departemen ON tb_departemen.id_dept = tb_pengguna.id_dept WHERE tb_departemen.gid ='$gid' AND tb_inv_printer.status='ARSIP/DISIMPAN' OR tb_departemen.gid ='$gid' AND tb_inv_printer.status ='RUSAK/NOT FIXABLE' OR tb_departemen.gid ='$gid' AND tb_inv_printer.status='HILANG/DICURI' ORDER BY tb_inv_printer.id_printer DESC");
        return $query;
    }

    function get_inv($id) {
        $query = $this->db->query("SELECT tb_inv_printer.id_printer,tb_inv_printer.kode_printer,tb_inv_printer.id_pengguna,tb_inv_printer.harga_beli,tb_pengguna.nama_pengguna,tb_inv_printer.jenis_printer,
            tb_inv_printer.spesifikasi,tb_inv_printer.tgl_inv,tb_inv_printer.status,tb_inv_printer.note,tb_inv_printer.gid,tb_departemen.nama,tb_departemen.parent,tb_pengguna.id_dept
            FROM tb_inv_printer INNER JOIN tb_pengguna ON tb_pengguna.id_pengguna = tb_inv_printer.id_pengguna 
            INNER JOIN tb_departemen ON tb_departemen.id_dept = tb_pengguna.id_dept WHERE tb_inv_printer.kode_printer ='$id' ");
        return $query;
    }

    function get_mutasi($id){
        $query=$this->db->query("SELECT tb_inv_history.id_history,tb_inv_history.no_inventaris,tb_inv_history.tgl_update,tb_inv_history.status,tb_inv_history.admin,tb_inv_history.id_pengguna_awal,tb_inv_history.id_pengguna,tb_inv_history.lokasi,tb_inv_history.note,tb_inv_printer.jenis_printer,tb_inv_printer.spesifikasi FROM tb_inv_history INNER JOIN tb_inv_printer ON tb_inv_printer.kode_printer = tb_inv_history.no_inventaris WHERE tb_inv_history.id_history ='$id'");
        return $query;
    }

    function getkode($id) {
        $kode = array('kode_printer' => $id);
        return $this->db->get_where('tb_inv_printer', $kode);
    }
   
    function kdotomatis() {
    	$group=$this->db->get_where('tb_group',array('gid'=>$this->session->userdata('gid')))->row_array();
    	$kode=$group['nama_alias'];
        $jenis = "PRI-".$kode."-".date('y');
        $query = $this->db->query("SELECT max(kode_printer) as maxID FROM tb_inv_printer WHERE kode_printer LIKE '$jenis%'");
        $data = $query->row_array();
        $idMax = $data['maxID'];
        $noUrut = (int) substr($idMax, 10, 3);
        $noUrut++;
        $newID = $jenis . sprintf("%03s", $noUrut);
        return $newID;       
    }

    function getpengguna() {
        $gid=$this->session->userdata('gid');
        $query=$this->db->query("SELECT tb_pengguna.id_pengguna,tb_pengguna.nama_pengguna 
            FROM tb_pengguna INNER JOIN tb_departemen ON tb_departemen.id_dept = tb_pengguna.id_dept INNER JOIN tb_group ON tb_group.gid = tb_departemen.gid 
            WHERE tb_departemen.gid ='$gid' ORDER BY tb_pengguna.nama_pengguna ASC");
        return $query;
    }
        
    function simpan($data) {
        $this->db->insert('tb_inv_printer', $data);
        return $this->db->insert_id();
    }

    function update($kode,$data) {        
        $this->db->where('kode_printer', $kode);
        $this->db->update('tb_inv_printer', $data);
    }

    function hapus($kode) {
        $this->db->where('id_printer', $kode);
        $this->db->delete('tb_inv_printer');
    }

    function total_rows($q = NULL) {
        $gid=$this->session->userdata('gid');       
        $this->db->or_like('kode_printer', $q);
        $this->db->where('gid', $gid);
        $this->db->where_in('status',['DIGUNAKAN','DIPERBAIKI','SIAP DIGUNAKAN','DIPINJAMKAN']);
	    $this->db->from('tb_inv_printer');
        return $this->db->count_all_results();
    }

    // get data with limit and search
    function get_limit_data($limit, $start = 0, $q = NULL) {
        $gid=$this->session->userdata('gid');
    	$this->db->or_like('kode_printer', $q);    	
    	$this->db->limit($limit, $start);        
        $this->db->where('gid', $gid);
        $this->db->where_in('status',['DIGUNAKAN','DIPERBAIKI','SIAP DIGUNAKAN','DIPINJAMKAN']);
        $this->db->from('tb_inv_printer');        
        return $this->db->get()->result();
    }

    function get_tempbarcode(){
        $this->db->select('i.kode_printer,t.barcode');
        $this->db->from('temp_barcode as t');
        $this->db->join('tb_inv_printer as i','t.barcode=i.barcode');
        return $this->db->get()->result_array();
    }
}
