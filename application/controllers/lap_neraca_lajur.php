<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lap_neraca_lajur extends CI_Controller {

	/**
	 * @author : Deddy Rusdiansyah,S.Kom
	 * @web : http://deddyrusdiansyah.blogspot.com
	 * @keterangan : Controller untuk halaman profil
	 **/
	
	public function index()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			/*
			$cari = $this->input->post('no_rek');
			if(empty($cari)){
				$where = " WHERE no_rek='xxx' ";
				$d['judul']="Buku Besar";
			}else{
				$where = " WHERE no_rek='$cari'";
				$nama_rek = $this->app_model->CariNamaRek($cari);
				$d['judul']="Buku Besar No.Rek ".$cari." - ".$nama_rek;
			}
			*/
			$d['judul']="Neraca Lajur";
			
			$d['prg']= $this->config->item('prg');
			$d['web_prg']= $this->config->item('web_prg');
			
			$d['nama_program']= $this->config->item('nama_program');
			$d['instansi']= $this->config->item('instansi');
			$d['usaha']= $this->config->item('usaha');
			$d['alamat_instansi']= $this->config->item('alamat_instansi');

			$text = "SELECT year(tgl_jurnal) as th FROM jurnal_umum  GROUP BY year(tgl_jurnal) ORDER BY year(tgl_jurnal)";
			$d['list_th'] = $this->app_model->manualQuery($text);
			
			$text = "SELECT month(tgl_jurnal) as bln FROM jurnal_umum  GROUP BY month(tgl_jurnal) ORDER BY month(tgl_jurnal)";
			$d['list_bln'] = $this->app_model->manualQuery($text);
			
			$text = "SELECT * FROM rekening ORDER BY no_rek ASC";
			$d['list_rek'] = $this->app_model->manualQuery($text);
			
			
			$d['content'] = $this->load->view('lap_neraca_lajur/view', $d, true);		
			$this->load->view('home',$d);
		}else{
			header('location:'.base_url());
		}
	}
	
	public function view_data()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			
			$d['th'] = $this->input->post('th');
			$d['bln'] = $this->input->post('bln');
			
			$text = "SELECT * FROM rekening WHERE level=0 ORDER BY no_rek";
			$d['data'] = $this->app_model->manualQuery($text);
			
			$this->load->view('lap_neraca_lajur/view_data',$d);
			
		}else{
			header('location:'.base_url());
		}
	}
	
	public function cetak_data()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			
			$d['prg']= $this->config->item('prg');
			$d['web_prg']= $this->config->item('web_prg');
			
			$d['nama_program']= $this->config->item('nama_program');
			$d['instansi']= $this->config->item('instansi');
			$d['usaha']= $this->config->item('usaha');
			$d['alamat_instansi']= $this->config->item('alamat_instansi');
			
			$d['th'] = $this->uri->segment(3);
			
			$text = "SELECT * FROM rekening WHERE level=0 ORDER BY no_rek";
			$d['data'] = $this->app_model->manualQuery($text);
			
			$this->load->view('lap_neraca_lajur/cetak_data',$d);
	
		}else{
			header('location:'.base_url());
		}
	}
	
}

/* End of file profil.php */
/* Location: ./application/controllers/profil.php */