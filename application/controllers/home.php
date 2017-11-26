<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	/**
	 * @author : Deddy Rusdiansyah,S.Kom
	 * @web : http://deddyrusdiansyah.blogspot.com
	 * @keterangan : Controller untuk halaman awal ketika aplikasi  diakses
	 **/
	public function index()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			$d['prg']= $this->config->item('prg');
			$d['web_prg']= $this->config->item('web_prg');
			
			$d['nama_program']= $this->config->item('nama_program');
			$d['instansi']= $this->config->item('instansi');
			$d['usaha']= $this->config->item('usaha');
			$d['alamat_instansi']= $this->config->item('alamat_instansi');

			
			$d['judul']="Home";

			$d['content']= $this->load->view('content',$d,true);
			$this->load->view('home',$d);
		}else{
			header('location:'.base_url().'index.php/login');
		}
	}
	
	public function logout(){
		$cek = $this->session->userdata('logged_in');
		if(empty($cek))
		{
			header('location:'.base_url().'index.php/login');
		}else{
			$this->session->sess_destroy();
			header('location:'.base_url().'index.php/login');
		}
	}
	
	
}

/* End of file index.php */
/* Location: ./application/controllers/index.php */