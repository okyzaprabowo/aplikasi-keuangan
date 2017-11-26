<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	/**
	 * @author : Deddy Rusdiansyah,S.Kom
	 * @web : http://deddyrusdiansyah.blogspot.com
	 * @keterangan : Controller untuk halaman awal ketika aplikasi koperasi diakses
	 **/
	 
	public function index()
	{
			$d['judul'] = "ADMINISTRATOR";
			
			$d['prg']= $this->config->item('prg');
			$d['web_prg']= $this->config->item('web_prg');
			
			$d['nama_program']= $this->config->item('nama_program');
			$d['instansi']= $this->config->item('instansi');
			$d['alamat_instansi']= $this->config->item('alamat_instansi');
			
			
			$d['username'] = array('name' => 'username',
					'id' => 'username',
					'type' => 'text',
					'class' => 'input-teks-login',
					'autocomplete' => 'off',
					'size' =>'30',
					'placeholder' => 'Masukkan username.....'
			);
			$d['password'] = array('name' => 'password',
					'id' => 'password',
					'type' => 'password',
					'class' => 'input-teks-login',
					'autocomplete' => 'off',
					'size' =>'30',
					'placeholder' => 'Masukkan password.....'
			);
			$d['submit'] = array('name' => 'submit',
					'id' => 'submit',
					'type' => 'submit',
					'class' => 'easyui-linkbutton',
					'data-options' => 'iconCls:\'icon-lock_open\''
			);
			
			$this->form_validation->set_rules('username', 'Username', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');
	
			if ($this->form_validation->run() == FALSE){
				$this->load->view('login',$d);	
			}else{
				$u = $this->input->post('username');
				$p = $this->input->post('password');
				$this->app_model->getLoginData($u,$p);
			}
	}
	
	public function logout(){
		$cek = $this->session->userdata('logged_in');
		if(empty($cek))
		{
			header('location:'.base_url().'index.php');
		}else{
			$this->session->sess_destroy();
			header('location:'.base_url().'index.php');
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/koperasi.php */