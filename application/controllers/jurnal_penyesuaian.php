<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jurnal_penyesuaian extends CI_Controller {

	/**
	 * @author : Deddy Rusdiansyah,S.Kom
	 * @web : http://deddyrusdiansyah.blogspot.com
	 * @keterangan : Controller untuk halaman profil
	 **/
	
	public function index()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			$cari = $this->input->post('txt_cari');
			if(empty($cari)){
				$where = ' ';
			}else{
				$where = " WHERE no_jurnal LIKE '%$cari%' OR no_rek LIKE '%$cari%'";
			}
			
			$d['prg']= $this->config->item('prg');
			$d['web_prg']= $this->config->item('web_prg');
			
			$d['nama_program']= $this->config->item('nama_program');
			$d['instansi']= $this->config->item('instansi');
			$d['usaha']= $this->config->item('usaha');
			$d['alamat_instansi']= $this->config->item('alamat_instansi');

			
			$d['judul']="Jurnal Penyesuaian";
			
			//paging
			$page=$this->uri->segment(3);
			$limit=$this->config->item('limit_data');
			if(!$page):
			$offset = 0;
			else:
			$offset = $page;
			endif;
			
			$text = "SELECT * FROM jurnal_penyesuaian $where ";		
			$tot_hal = $this->app_model->manualQuery($text);		
			
			$d['tot_hal'] = $tot_hal->num_rows();
			
			$config['base_url'] = site_url() . '/jurnal_penyesuaian/index/';
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
			

			$text = "SELECT * FROM jurnal_penyesuaian $where 
					ORDER BY no_jurnal DESC,tgl_insert DESC 
					LIMIT $limit OFFSET $offset";
			$d['data'] = $this->app_model->manualQuery($text);
			
			$text = "SELECT * FROM rekening ORDER BY no_rek ASC";
			$d['list_rek'] = $this->app_model->manualQuery($text);
			
			
			$d['content'] = $this->load->view('jurnal_penyesuaian/view', $d, true);		
			$this->load->view('home',$d);
		}else{
			header('location:'.base_url());
		}
	}
	
	
	public function edit()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			
			$id = $this->input->post('id');  
			$text = "SELECT * FROM jurnal_penyesuaian WHERE no_jurnal='$id' LIMIT 1";
			$data = $this->app_model->manualQuery($text);
			foreach($data->result() as $db){
				$d['no_jurnal']	=$db->no_jurnal;
				$d['tgl']		= $this->app_model->tgl_str($db->tgl_jurnal);
				echo json_encode($d);
			}

		}else{
			header('location:'.base_url());
		}
	}
	
	
	public function hapus()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){			
			$id = $this->uri->segment(3);
			$this->app_model->manualQuery("DELETE FROM jurnal_penyesuaian WHERE no_jurnal='$id'");
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/jurnal_penyesuaian'>";			
		}else{
			header('location:'.base_url());
		}
	}
	
	
	public function simpan()
	{
		
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
				$up['no_jurnal']=$this->input->post('no_jurnal');
				$up['tgl_jurnal']=$this->app_model->tgl_sql($this->input->post('tgl'));

				$up['no_rek']=$this->input->post('no_rek');
				$up['debet']=str_replace(',','',$this->input->post('debet'));
				$up['kredit']=str_replace(',','',$this->input->post('kredit'));
				$up['username']=$this->session->userdata('username');
				$up['tgl_insert']=date('Y-m-d h:m:s');
				
				$id['no_jurnal']=$this->input->post('no_jurnal');
				$id['no_rek']=$this->input->post('no_rek');
				
				$no_jurnal 	=$this->input->post('no_jurnal');
				$no_rek 	=$this->input->post('no_rek');
				
				$text = "SELECT * FROM jurnal_penyesuaian WHERE no_jurnal='$no_jurnal' AND no_rek='$no_rek'";
				$data = $this->app_model->manualQuery($text); //$this->app_model->getSelectedData("jurnal_umum",$id);
				if($data->num_rows()>0){
					$this->app_model->updateData("jurnal_penyesuaian",$up,$id);
					echo 'Simpan data Sukses';
				}else{
					$this->app_model->insertData("jurnal_penyesuaian",$up);
					echo 'Simpan data Sukses';		
				}
		}else{
				header('location:'.base_url());
		}
	
	}
	
	public function DetailJurnalUmum()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			$id = $this->input->post('no_jurnal'); 
			
			$text = "SELECT * FROM jurnal_penyesuaian WHERE no_jurnal='$id'";
			$d['data'] = $this->app_model->manualQuery($text);
			
			$this->load->view('jurnal_penyesuaian/detail_jurnal',$d);
		
			//echo $text;
		}else{
			header('location:'.base_url());
		}
	}
	
	public function hapusDetail()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			$id = $this->input->post('no_jurnal'); 
			$rek = $this->input->post('no_rek'); 
			
			$text = "DELETE FROM jurnal_penyesuaian WHERE no_jurnal='$id' AND no_rek='$rek'";
			$d['data'] = $this->app_model->manualQuery($text);
			
			$text = "SELECT * FROM jurnal_penyesuaian WHERE no_jurnal='$id'";
			$d['data'] = $this->app_model->manualQuery($text);
			
			$this->load->view('jurnal_penyesuaian/detail_jurnal',$d);

		}else{
			header('location:'.base_url());
		}
	}
	
}

/* End of file profil.php */
/* Location: ./application/controllers/profil.php */