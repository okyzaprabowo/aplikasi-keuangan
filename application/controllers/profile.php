<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Profile extends CI_Controller {

  /**
   * @author : Deddy Rusdiansyah,S.Kom
   * @web : http://deddyrusdiansyah.blogspot.com
   * @keterangan : Controller untuk halaman profil
   **/



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

      $d['judul']="Edit Profile";

      $id = $this->uri->segment(3);
      $text = "SELECT * FROM users WHERE username='$id'";
      $data = $this->app_model->manualQuery($text);

        foreach($data->result() as $db){
          $d['username']		=$db->username;
          $d['nama']	=$db->nama_lengkap;
            $d['level']	=$db->level;
            $d['pwd']	=' ';

        }
      $d['content'] = $this->load->view('profile/form', $d, true);
      $this->load->view('home',$d);
    }else{
      header('location:'.base_url());
    }
  }


  public function simpan()
  {

    $cek = $this->session->userdata('logged_in');
    if(!empty($cek)){

        $pwd = $this->input->post('pwd');
        $username = $this->input->post('username');

        $foto = $_FILES['foto'];

        $config['upload_path'] = './asset/foto_profil';
		$config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['overwrite']	= TRUE;
		$config['max_size']	= '2000*2';

		$this->load->library('upload', $config);

		if($this->upload->do_upload('foto')){
            $this->upload->data();
            $up['foto'] = $foto['name'];
            $error = 'upload sukses';
            $this->session->set_flashdata('error',$error);
		}else{
            $error = 'Error Upload Foto : '.$this->upload->display_errors();
            $this->session->set_flashdata('error',$error);
        }


        if(!empty($pwd)){
          $up['password']= md5($pwd);

        }

        $up['username']     = $username;
        $up['nama_lengkap'] =$this->input->post('nama');
        $id['username']     =$this->input->post('username');

        $data = $this->app_model->getSelectedData("users",$id);
        if($data->num_rows()>0){
          $this->app_model->updateData("users",$up,$id);
            $this->session->set_flashdata('info','Data sukses di Update');
        }else{
          $this->app_model->insertData("users",$up);
          $this->session->set_flashdata('info','Data sukses di Simpan');
        }

        redirect('profile/edit/'.$username);

    }else{
        header('location:'.base_url());
    }

  }

}

/* End of file profil.php */
/* Location: ./application/controllers/profil.php */
