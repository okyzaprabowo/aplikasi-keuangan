<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class App_Model extends CI_Model {

	/**
	 * @author : Deddy Rusdiansyah
	 * @web : http://deddyrusdiansyah.blogspot.com
	 * @keterangan : Model untuk menangani semua query database aplikasi
	 **/
	
	public function getAllData($table)
	{
		return $this->db->get($table);
	}
	
	public function getAllDataLimited($table,$limit,$offset)
	{
		return $this->db->get($table, $limit, $offset);
	}
	
	public function getSelectedDataLimited($table,$data,$limit,$offset)
	{
		return $this->db->get_where($table, $data, $limit, $offset);
	}
		
	//select table
	public function getSelectedData($table,$data)
	{
		return $this->db->get_where($table, $data);
	}
	
	//update table
	function updateData($table,$data,$field_key)
	{
		$this->db->update($table,$data,$field_key);
	}
	function deleteData($table,$data)
	{
		$this->db->delete($table,$data);
	}
	
	function insertData($table,$data)
	{
		$this->db->insert($table,$data);
	}
	
	//Query manual
	function manualQuery($q)
	{
		return $this->db->query($q);
	}
	
    
    public function getListRek(){
        return $this->db->get('rekening');
    }
    
    public function getFoto($id){
        $this->db->where('username',$id);
        $q = $this->db->get('users');
        if($q->num_rows()>0){
            foreach($q->result() as $row){
                $hasil = $row->foto;
            }
        }else{
            $hasil = '';
        }
        return $hasil;
    }
	public function CariLevel($id){
		$text = "SELECT * FROM rekening WHERE no_rek='$id'";
		$data = $this->app_model->manualQuery($text);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$hasil = $t->level;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
	
	public function CariNamaRek($id){
		$text = "SELECT * FROM rekening WHERE no_rek='$id'";
		$data = $this->app_model->manualQuery($text);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$hasil = $t->nama_rek;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
	
	public function MaxNoJurnal(){
		$bln = date('m');
		$th = date('y');
		$text = "SELECT max(no_jurnal) as no FROM jurnal_umum";
		$data = $this->app_model->manualQuery($text);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$no = $t->no; 
				$tmp = ((int) substr($no,5,5))+1;
				$hasil = $bln.$th.sprintf("%05s", $tmp);
			}
		}else{
			$hasil = $bln.$th.'00001';
		}
		return $hasil;
	}
	public function MaxNoAJP(){
		$bln = date('m');
		$th = date('y');
		$text = "SELECT max(no_jurnal) as no FROM jurnal_penyesuaian";
		$data = $this->app_model->manualQuery($text);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$no = $t->no; 
				$tmp = ((int) substr($no,5,5))+1;
				$hasil = $bln.$th.sprintf("%05s", $tmp);
			}
		}else{
			$hasil = $bln.$th.'00001';
		}
		return $hasil;
	}
	
	public function dr_sa($no,$p){
		$q = "SELECT * FROM saldo_awal WHERE (no_rek='$no' OR no_rek LIKE '$no.%') AND periode='$p'";
		$data = $this->app_model->manualQuery($q);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$hasil = $t->debet;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
	
	public function kr_sa($no,$p){
		$q = "SELECT * FROM saldo_awal WHERE (no_rek='$no' OR no_rek LIKE '$no.%') AND periode='$p'";
		$data = $this->app_model->manualQuery($q);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$hasil = $t->kredit;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}

	public function dr_ju($no,$p){
		$q = "SELECT sum(debet) as debet FROM jurnal_umum WHERE (no_rek='$no' OR no_rek LIKE '$no.%') AND year(tgl_jurnal)='$p'";
		$data = $this->app_model->manualQuery($q);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$hasil = $t->debet;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
	
	public function kr_ju($no,$p){
		$q = "SELECT sum(kredit) as kredit FROM jurnal_umum WHERE (no_rek='$no' OR no_rek LIKE '$no.%') AND year(tgl_jurnal)='$p'";
		$data = $this->app_model->manualQuery($q);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$hasil = $t->kredit;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
	
	public function neraca_saldo($no_rek,$p){
        //$norek = explode('.',$no_rek);
        //$induk = $norek[0];
		$periode = $p-1;
		$saldo = 0;
		$dr_sa = $this->app_model->dr_sa($no_rek,$periode);
		$kr_sa = $this->app_model->kr_sa($no_rek,$periode);
		$saldo = $saldo+$dr_sa-$kr_sa;
		$q = "SELECT * FROM jurnal_umum WHERE (no_rek='$no_rek' OR no_rek LIKE '$no_rek.%')  AND year(tgl_jurnal)='$p'";
		$data = $this->app_model->manualQuery($q);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$saldo = ($saldo+$t->debet)-$t->kredit;
				$hasil = $saldo;
			}
		}else{
			$hasil = $saldo+0;
		}
		return $hasil;
	}
	
	public function dr_ajp($no,$p){
		$q = "SELECT sum(debet) as debet FROM jurnal_penyesuaian WHERE no_rek='$no' AND year(tgl_jurnal)='$p'";
		$data = $this->app_model->manualQuery($q);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$hasil = $t->debet;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
	
	public function kr_ajp($no,$p){
		$q = "SELECT sum(kredit) as kredit FROM jurnal_penyesuaian WHERE no_rek='$no' AND year(tgl_jurnal)='$p'";
		$data = $this->app_model->manualQuery($q);
		if($data->num_rows() > 0 ){
			foreach($data->result() as $t){
				$hasil = $t->kredit;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
	
	public function GrafikDebet($bln,$thn){
		$t = "SELECT month(a.tgl_jurnal) as bln, year(a.tgl_jurnal) as th, sum(debet) as jml 
			FROM jurnal_umum as a
			WHERE month(a.tgl_jurnal)='$bln' AND year(a.tgl_jurnal)='$thn'
			GROUP BY month(a.tgl_jurnal),year(a.tgl_jurnal)";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->jml;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
	public function GrafikKredit($bln,$thn){
		$t = "SELECT month(a.tgl_jurnal) as bln, year(a.tgl_jurnal) as th, sum(kredit) as jml 
			FROM jurnal_umum as a
			WHERE month(a.tgl_jurnal)='$bln' AND year(a.tgl_jurnal)='$thn'
			GROUP BY month(a.tgl_jurnal),year(a.tgl_jurnal)";
		$d = $this->app_model->manualQuery($t);
		$r = $d->num_rows();
		if($r>0){
			foreach($d->result() as $h){
				$hasil = $h->jml;
			}
		}else{
			$hasil = 0;
		}
		return $hasil;
	}
	
	//Konversi tanggal
	public function tgl_sql($date){
		$exp = explode('-',$date);
		if(count($exp) == 3) {
			$date = $exp[2].'-'.$exp[1].'-'.$exp[0];
		}
		return $date;
	}
	public function tgl_str($date){
		$exp = explode('-',$date);
		if(count($exp) == 3) {
			$date = $exp[2].'-'.$exp[1].'-'.$exp[0];
		}
		return $date;
	}
	
	public function ambilTgl($tgl){
		$exp = explode('-',$tgl);
		$tgl = $exp[2];
		return $tgl;
	}
	
	public function ambilBln($tgl){
		$exp = explode('-',$tgl);
		$tgl = $exp[1];
		$bln = $this->app_model->getBulan($tgl);
		$hasil = substr($bln,0,3);
		return $hasil;
	}
	
	public function tgl_indo($tgl){
			$jam = substr($tgl,11,10);
			$tgl = substr($tgl,0,10);
			$tanggal = substr($tgl,8,2);
			$bulan = $this->app_model->getBulan(substr($tgl,5,2));
			$tahun = substr($tgl,0,4);
			return $tanggal.' '.$bulan.' '.$tahun.' '.$jam;		 
	}	

	public function getBulan($bln){
		switch ($bln){
			case 1: 
				return "Januari";
				break;
			case 2:
				return "Februari";
				break;
			case 3:
				return "Maret";
				break;
			case 4:
				return "April";
				break;
			case 5:
				return "Mei";
				break;
			case 6:
				return "Juni";
				break;
			case 7:
				return "Juli";
				break;
			case 8:
				return "Agustus";
				break;
			case 9:
				return "September";
				break;
			case 10:
				return "Oktober";
				break;
			case 11:
				return "November";
				break;
			case 12:
				return "Desember";
				break;
		}
	} 
	
	public function hari_ini($hari){
		date_default_timezone_set('Asia/Jakarta'); // PHP 6 mengharuskan penyebutan timezone.
		$seminggu = array("Minggu","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu");
		//$hari = date("w");
		$hari_ini = $seminggu[$hari];
		return $hari_ini;
	}
	
	//query login
	public function getLoginData($usr,$psw)
	{
		$u = mysql_real_escape_string($usr);
		$p = md5(mysql_real_escape_string($psw));
		$q_cek_login = $this->db->get_where('users', array('username' => $u, 'password' => $p));
		if(count($q_cek_login->result())>0)
		{
			foreach($q_cek_login->result() as $qck)
			{
					foreach($q_cek_login->result() as $qad)
					{
						$sess_data['logged_in'] = 'aingLoginAkuntansiYeuh';
						$sess_data['username'] = $qad->username;
						$sess_data['nama_lengkap'] = $qad->nama_lengkap;
                        $sess_data['level'] = $qad->level;
                        $sess_data['foto'] = $qad->foto;
						$this->session->set_userdata($sess_data);
					}
					header('location:'.base_url().'index.php/home');
			}
		}
		else
		{
			$this->session->set_flashdata('result_login', '<br>Username atau Password yang anda masukkan salah.');
			header('location:'.base_url().'index.php/login');
		}
	}
}
	
/* End of file app_model.php */
/* Location: ./application/models/app_model.php */