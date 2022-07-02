<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
  }
  public function index()
  {
    // validasi
    $this->form_validation->set_rules('username', 'nama panggilan', 'required|trim|min_length[3]');
    $this->form_validation->set_rules('password', 'sandi', 'required|trim|min_length[3]');
    $this->form_validation->set_message('required', '%s tidak boleh kosong');
    $this->form_validation->set_message('min_length', '%s minimal 3 huruf/angka');
    // judul halaman
    $data['judul'] = 'Selamat Datang';
    // proses validasi
    // jika validasi gagal
    if ($this->form_validation->run() == false) {
      $this->load->view('Template/Header_login', $data);
      $this->load->view('Auth/Login', $data);
      $this->load->view('Template/Footer_login', $data);
    }
    // jika berhasil
    else {
      // inputan dari form login
      $username = $this->input->post('username');
      $password = md5($this->input->post('password'));
      // cek user menggunakan username
      $user = $this->db->get_where('user', ['username' => $username])->row_array();
      // cek user
      // jika user ada
      if ($user) {
        // cek kecocokan password
        // jika password sama
        if ($password == $user['password']) {
          // simpan data user kedalam variable $data
          $data = [
            'id' => $user['id'],
            'username' => $user['username'],
            'password' => $user['password'],
            'gambar' => $user['gambar'],
            'nama' => $user['nama'],
            'alamat' => $user['alamat'],
            'telepon' => $user['telepon'],
            'id_role' => $user['id_role'],
          ];
          // simpan data user login ke dalam variable $data['user']
          $data['user'] = $this->db->get_where('user', ['username' => $username])->row_array();
          // simpan data user login ke dalam session
          $this->session->set_userdata($user);
          // cek status user
          // jika sebagai admin
          if ($user['id_role'] == 1) {
            redirect('Admin');
          }
          // jika sebagai owner
          else if ($user['id_role'] == 2) {
            redirect('Owner');
          }
          // jika sebagi kasir
          else if ($user['id_role'] == 3) {
            redirect('Kasir');
          }
          // jika sebagi mekanik
          else {
            redirect('Mekanik');
          }
        }
        // jika password berbeda
        else {
          $this->load->view('Template/Header_login', $data);
          $this->load->view('Auth/Login', $data);
          $this->load->view('Template/Footer_login', $data);
        }
      }
      // jika user tidak ada
      else {
        $this->load->view('Template/Header_login', $data);
        $this->load->view('Auth/Login', $data);
        $this->load->view('Template/Footer_login', $data);
      }
    }
  }
  public function register()
  {
    // validasi
    $this->form_validation->set_rules('username', 'nama panggilan', 'required|trim|min_length[3]|is_unique[user.username]', [
      'is_unique' => 'username sudah digunakan'
    ]);
    $this->form_validation->set_rules('password', 'sandi', 'required|trim|min_length[3]');
    $this->form_validation->set_rules('nama', 'nama', 'required|trim|min_length[3]');
    $this->form_validation->set_rules('telepon', 'telepon', 'required|trim|min_length[3]');
    $this->form_validation->set_rules('id_role', 'status', 'required|trim');
    $this->form_validation->set_message('required', '%s tidak boleh kosong');
    $this->form_validation->set_message('min_length', '%s minimal 3 huruf/angka');
    // judul halaman
    $data['judul'] = 'Daftar Segera';
    // inputan form register
    $username = $this->input->post('username');
    $id_role = $this->input->post('id_role');
    $password = md5($this->input->post('password'));
    $nama = $this->input->post('nama');
    $alamat = $this->input->post('alamat');
    $telepon = $this->input->post('telepon');
    $gambar = 'default.png';
    // cek validasi
    // jika validasi gagal
    if ($this->form_validation->run() == false) {
      $this->load->view('Template/Header_login', $data);
      $this->load->view('Auth/Register', $data);
      $this->load->view('Template/Footer_login', $data);
    }
    // jika berhasil validasi
    else {
      // simpan inputan register kedalam variable $data
      $data = [
        'username' => $username,
        'password' => $password,
        'nama' => $nama,
        'alamat' => $alamat,
        'telepon' => $telepon,
        'gambar' => $gambar,
        'id_role' => $id_role,
      ];
      // masukan data ke dalam database pada table user
      $this->db->insert('user', $data);
      // arahkan ke dalam halaman login
      redirect('Auth');
    }
  }
  public function logout()
  {
    // menghapus sermua session user login
    $this->session->sess_destroy();
    // arahkan ke dalam halaman login
    redirect('Auth');
  }
}
