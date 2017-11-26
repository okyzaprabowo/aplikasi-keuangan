<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Buku_besar extends CI_Controller {

	/**
	 * @author : Deddy Rusdiansyah,S.Kom
	 * @web : http://deddyrusdiansyah.blogspot.com
	 * @keterangan : Controller untuk halaman profil
	 **/

	public function index()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			$cari = $this->input->post('no_rek');
			if(empty($cari)){
				$where = " WHERE no_rek='xxx' ";
				$d['judul']="Buku Besar";
				$d['no_rek'] = '';
			}else{
				$where = " WHERE (no_rek='$cari' OR no_rek LIKE '$cari.%')";
				$nama_rek = $this->app_model->CariNamaRek($cari);
				$d['judul']="Buku Besar No.Rek ".$cari." - ".$nama_rek;
				$d['no_rek'] = $cari;
			}

			$d['prg']= $this->config->item('prg');
			$d['web_prg']= $this->config->item('web_prg');

			$d['nama_program']= $this->config->item('nama_program');
			$d['instansi']= $this->config->item('instansi');
			$d['usaha']= $this->config->item('usaha');
			$d['alamat_instansi']= $this->config->item('alamat_instansi');



			//paging
			$page=$this->uri->segment(3);
			$limit=$this->config->item('limit_data');
			if(!$page):
			$offset = 0;
			else:
			$offset = $page;
			endif;

			$text = "SELECT * FROM jurnal_umum $where ";
			$tot_hal = $this->app_model->manualQuery($text);

			$d['tot_hal'] = $tot_hal->num_rows();

			$config['base_url'] = site_url() . '/buku_besar/index/';
			$config['total_rows'] = $tot_hal->num_rows();
			$config['per_page'] = $limit;
			$config['uri_segment'] = 3;
			$config['next_link'] = 'Lanjut &raquo;';
			$config['prev_link'] = '&laquo; Kembali';
			$config['last_link'] = '<b>Terakhir &raquo; </b>';
			$config['first_link'] = '<b> &laquo; Pertama</b>';
			$this->pagination->initialize($config);
			$d["paginator"] =$this->pagination->create_links();
			$d['hal'] = $offset;


			$text = "SELECT * FROM jurnal_umum $where
					ORDER BY no_jurnal ASC
					LIMIT $limit OFFSET $offset";
			$d['data'] = $this->app_model->manualQuery($text);

			$text = "SELECT * FROM rekening  ORDER BY no_rek ASC";
			$d['list_rek'] = $this->app_model->manualQuery($text);


			$d['content'] = $this->load->view('buku_besar/view', $d, true);
			$this->load->view('home',$d);
		}else{
			header('location:'.base_url());
		}
	}

}

/* End of file profil.php */
/* Location: ./application/controllers/profil.php */
