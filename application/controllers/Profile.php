<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    if (!isset($_SESSION['id'])) {
      redirect('Auth');
    }
  }
  public function index()
  {
    $data = [
      'judul' => 'Profile',
      'user' => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array()
    ];
    $this->load->view('Template/Header', $data);
    $this->load->view('Template/Sidebar', $data);
    $this->load->view('Template/Topbar', $data);
    $this->load->view('Profile/Data', $data);
    $this->load->view('Template/Footer', $data);
  }
  public function ubah()
  {
    $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
    $alamat = $this->input->post('alamat');
    $nama = $this->input->post('nama');
    $telepon = $this->input->post('telepon');
    $username = $this->input->post('username');
    // cek jika ada gambar baru
    $upload_image = $_FILES['gambar']['name'];
    if ($upload_image) {
      $config['allowed_types'] = 'jpg|png';
      $config['max_size'] = '2048';
      $config['upload_path'] = './assets/img/user/';
      $this->load->library('upload', $config);
      if ($this->upload->do_upload('gambar')) {
        $old_image = $data['user']['gambar'];
        if ($old_image != 'default.png') {
          unlink(FCPATH . 'assets/img/user/' . $old_image);
        }
        $new_image = $this->upload->data('file_name');
        // var_dump($new_image);
        $this->db->set('gambar', $new_image);
      } else {
        echo $this->upload->display_errors();
      }
    }
    $this->db->set('nama', $nama);
    $this->db->set('alamat', $alamat);
    $this->db->set('telepon', $telepon);
    $this->db->where('username', $username);
    $this->db->update('user');
    redirect('Profile');
  }
  public function password()
  {
    $this->form_validation->set_rules('password', 'password baru', 'required|trim|min_length[3]');
    $this->form_validation->set_rules('konfirmasi', 'konfirmasi password baru', 'required|trim|min_length[3]|matches[password]', [
      'matches' => 'sandi baru harus sama dengan password diatas'
    ]);
    $this->form_validation->set_message('required', '%s tidak boleh kosong');
    if ($this->form_validation->run() == false) {
      $data = [
        'judul' => 'Ubah Password',
        'user' => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array()
      ];
      $this->load->view('Template/Header', $data);
      $this->load->view('Template/Sidebar', $data);
      $this->load->view('Template/Topbar', $data);
      $this->load->view('Profile/Password', $data);
      $this->load->view('Template/Footer', $data);
    } else {
      $password = md5($this->input->post('password'));
      $username = $this->input->post('username');
      $this->db->set('password', $password);
      $this->db->where('username', $username);
      $this->db->update('user');
      redirect('Profile');
    }
  }
}
