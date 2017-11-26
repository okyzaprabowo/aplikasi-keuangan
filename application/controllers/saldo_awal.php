<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Saldo_awal extends CI_Controller {

	/**
	 * @author : Deddy Rusdiansyah,S.Kom
	 * @web : http://deddyrusdiansyah.blogspot.com
	 * @keterangan : Controller untuk halaman profil
	 **/
	
	public function index()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			$cari = $this->input->post('periode');
			//if(empty($cari)){
			//	$where = "  ";
			//}else{
				$where = " WHERE a.periode='$cari'";
			//}
			
			$d['prg']= $this->config->item('prg');
			$d['web_prg']= $this->config->item('web_prg');
			
			$d['nama_program']= $this->config->item('nama_program');
			$d['instansi']= $this->config->item('instansi');
			$d['usaha']= $this->config->item('usaha');
			$d['alamat_instansi']= $this->config->item('alamat_instansi');

			
			$d['judul']="Saldo Awal Periode ".$cari;
			
			$d['periode'] = $cari;
			$d['no'] = 0;
			
			$text = "SELECT a.periode,b.no_rek,a.debet,a.kredit,
					b.nama_rek
					FROM saldo_awal as a
					RIGHT JOIN rekening as b
					ON a.no_rek=b.no_rek
					$where 
					ORDER BY b.no_rek ASC ";
			$d['data'] = $this->app_model->manualQuery($text);
						
			
			$d['content'] = $this->load->view('saldo_awal/view', $d, true);		
			$this->load->view('home',$d);
		}else{
			header('location:'.base_url());
		}
	}
	
	public function tambah()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			$d['prg']= $this->config->item('prg');
			$d['web_prg']= $this->config->item('web_prg');
			
			$d['nama_program']= $this->config->item('nama_program');
			$d['instansi']= $this->config->item('instansi');
			$d['usaha']= $this->config->item('usaha');
			$d['alamat_instansi']= $this->config->item('alamat_instansi');

			$d['judul']="Saldo Awal";	
			
			$d['periode']="";
			$d['no_rek']="";								
			$d['nama_rek']="";
			$d['debet']="";
			$d['kredit']="";
			
			
			$d['content'] = $this->load->view('saldo_awal/form', $d, true);		
			$this->load->view('home',$d);
		}else{
			header('location:'.base_url());
		}
	}
	
	public function edit()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			
			$d['prg']= $this->config->item('prg');
			$d['web_prg']= $this->config->item('web_prg');
			
			$d['nama_program']= $this->config->item('nama_program');
			$d['instansi']= $this->config->item('instansi');
			$d['usaha']= $this->config->item('usaha');
			$d['alamat_instansi']= $this->config->item('alamat_instansi');

			$d['judul']="Saldo Awal";	
				
			$id = $this->uri->segment(4);
			$periode = $this->uri->segment(3);
			$text = "SELECT * FROM saldo_awal WHERE periode='$periode' AND no_rek='$id'";
			$data = $this->app_model->manualQuery($text);
			//if($data->num_rows() > 0){
				foreach($data->result() as $db){
					$d['periode']	= $periode;
					$d['no_rek']	= $id;								
					$d['nama_rek']	= $this->app_model->CariNamaRek($id);
					$d['debet']		= $db->debet;
					$d['kredit']	= $db->kredit;
				}
			//}
			
						
			$d['content'] = $this->load->view('saldo_awal/form', $d, true);		
			$this->load->view('home',$d);
		}else{
			header('location:'.base_url());
		}
	}
	
	public function hapus()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){			
			$periode = $this->uri->segment(3);
			$id = $this->uri->segment(4);
			$this->app_model->manualQuery("DELETE FROM saldo_awal WHERE periode='$periode' AND no_rek='$id'");
			echo "<meta http-equiv='refresh' content='0; url=".base_url()."index.php/saldo_awal'>";			
		}else{
			header('location:'.base_url());
		}
	}
	
	public function simpan()
	{
		
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
				
				$up['periode']=$this->input->post('periode');
				$up['no_rek']=$this->input->post('no_rek');
				$up['debet']=str_replace(',','',$this->input->post('debet'));
				$up['kredit']=str_replace(',','',$this->input->post('kredit'));
				$up['tgl_insert']=date('Y-m-d h:m:s');
				$up['username']=$this->session->userdata('username');
				
				$id['periode']=$this->input->post('periode');
				$id['no_rek']=$this->input->post('no_rek');
				
				$data = $this->app_model->getSelectedData("saldo_awal",$id);
				if($data->num_rows()>0){
					$this->app_model->updateData("saldo_awal",$up,$id);
					echo 'Update data Sukses';
				}else{
					$this->app_model->insertData("saldo_awal",$up);
					echo 'Simpan data Sukses';		
				}
		}else{
				header('location:'.base_url());
		}
	
	}
	
}

/* End of file profil.php */
/* Location: ./application/controllers/profil.php */