<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ref_json extends CI_Controller {

	/**
	 * @author : Deddy Rusdiansyah,S.Kom
	 * @web : http://deddyrusdiansyah.blogspot.com
	 * @keterangan : Controller untuk halaman profil
	 **/
	
	public function CariNoJurnal()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			$data['nojurnal'] = $this->app_model->MaxNoJurnal();
			$data['tgl'] = date('d-m-Y');
			echo json_encode($data);
			
		}else{
			header('location:'.base_url());
		}
	}
	
	public function CariNoAJP()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			$data['nojurnal'] = $this->app_model->MaxNoAJP();
			$data['tgl'] = date('d-m-Y');
			echo json_encode($data);
			
		}else{
			header('location:'.base_url());
		}
	}
	
	public function CariNamaRek()
	{
		$cek = $this->session->userdata('logged_in');
		if(!empty($cek)){
			$no_rek = $this->input->post('no_rek');
			
			$text = "SELECT * FROM rekening WHERE no_rek='$no_rek'";
			$tabel = $this->app_model->manualQuery($text);
			$row = $tabel->num_rows();
			if($row>0){
				foreach($tabel->result() as $t){
					$data['nama_rek'] = $t->nama_rek;
					echo json_encode($data);
				}
			}else{
				$data['nama_rek'] ='';
				echo json_encode($data);
			}
		}else{
			header('location:'.base_url());
		}
	}
	
}

/* End of file profil.php */
/* Location: ./application/controllers/profil.php */