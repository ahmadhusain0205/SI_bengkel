<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    if (!isset($_SESSION['id'])) {
      redirect('Auth');
    }
    if ($this->session->userdata('id_role') == 3 or $this->session->userdata('id_role') == 4) {
      redirect('Block');
    }
  }
  public function index()
  {
    $data = [
      'judul' => 'Beranda',
      'c_kasir' => $this->db->query('select * from user where id_role = 3')->num_rows(),
      'c_mekanik' => $this->db->query('select * from user where id_role = 4')->num_rows(),
      'c_sparepart' => $this->db->get('sparepart')->num_rows(),
      'c_penjualan' => $this->db->query('select* from transaksi group by invoice')->num_rows(),
      'c_keuntungan_service' => $this->db->query('select sum(harga_servis) as benefit from servis_selesai where tanggal_keluar like "%' . date('Y-m-d') . '%"')->result(),
      'c_keuntungan_jual' => $this->db->query('SELECT sum(sub_total) as benefit FROM transaksi where tanggal like "%' . date('Y-m-d') . '%"')->result(),
      'c_keuntungan_all' => $this->db->query('SELECT sum(total) as benefit FROM transaksi where tanggal like "%' . date('Y-m-d') . '%"')->result(),
      'qty_s' => $this->db->query('SELECT sum(qty_sparepart) as benefit FROM transaksi where tanggal between "' . date('Y-m-d') . '" and "' . date('Y-m-d') . '"')->result(),
      'user' => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array()
    ];
    $this->load->view('Template/Header', $data);
    $this->load->view('Template/Sidebar', $data);
    $this->load->view('Template/Topbar', $data);
    $this->load->view('Admin/Beranda', $data);
    $this->load->view('Template/Footer', $data);
  }
  // admin
  public function admin()
  {
    $data['judul'] = 'Data Admin';
    $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
    $data['admin'] = $this->db->get_where('user', ['id_role' => 1])->result();
    $this->load->view('Template/Header', $data);
    $this->load->view('Template/Sidebar', $data);
    $this->load->view('Template/Topbar', $data);
    $this->load->view('Admin/Admin', $data);
    $this->load->view('Template/Footer', $data);
  }
  public function tambah_admin()
  {
    $data = [
      'username' => $this->input->post('username'),
      'password' => md5($this->input->post('password')),
      'nama' => $this->input->post('nama'),
      'alamat' => $this->input->post('alamat'),
      'telepon' => $this->input->post('telepon'),
      'gambar' => 'default.png',
      'id_role' => 1
    ];
    $this->db->insert('user', $data);
    redirect('Admin/admin');
  }
  public function ubah_admin()
  {
    $username = $this->input->post('username');
    $nama = $this->input->post('nama');
    $alamat = $this->input->post('alamat');
    $telepon = $this->input->post('telepon');
    $this->db->set('nama', $nama);
    $this->db->set('alamat', $alamat);
    $this->db->set('telepon', $telepon);
    $this->db->where('username', $username);
    $this->db->update('user');
    redirect('Admin/admin');
  }
  public function hapus_admin($id)
  {
    $this->db->where('id', $id);
    $this->db->delete('user');
    redirect('Admin/admin');
  }
  // owner
  public function owner()
  {
    $data['judul'] = 'Data Owner';
    $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
    $data['owner'] = $this->db->get_where('user', ['id_role' => 2])->result();
    $this->load->view('Template/Header', $data);
    $this->load->view('Template/Sidebar', $data);
    $this->load->view('Template/Topbar', $data);
    $this->load->view('Admin/Owner', $data);
    $this->load->view('Template/Footer', $data);
  }
  public function tambah_owner()
  {
    $data = [
      'username' => $this->input->post('username'),
      'password' => md5($this->input->post('password')),
      'nama' => $this->input->post('nama'),
      'alamat' => $this->input->post('alamat'),
      'telepon' => $this->input->post('telepon'),
      'gambar' => 'default.png',
      'id_role' => 2
    ];
    $this->db->insert('user', $data);
    redirect('Admin/owner');
  }
  public function ubah_owner()
  {
    $username = $this->input->post('username');
    $nama = $this->input->post('nama');
    $alamat = $this->input->post('alamat');
    $telepon = $this->input->post('telepon');
    $this->db->set('nama', $nama);
    $this->db->set('alamat', $alamat);
    $this->db->set('telepon', $telepon);
    $this->db->where('username', $username);
    $this->db->update('user');
    redirect('Admin/owner');
  }
  public function hapus_owner($id)
  {
    $this->db->where('id', $id);
    $this->db->delete('user');
    redirect('Admin/owner');
  }
  // kasir
  public function kasir()
  {
    $data['judul'] = 'Data Kasir';
    $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
    $data['kasir'] = $this->db->get_where('user', ['id_role' => 3])->result();
    $this->load->view('Template/Header', $data);
    $this->load->view('Template/Sidebar', $data);
    $this->load->view('Template/Topbar', $data);
    $this->load->view('Admin/Kasir', $data);
    $this->load->view('Template/Footer', $data);
  }
  public function tambah_kasir()
  {
    $data = [
      'username' => $this->input->post('username'),
      'password' => md5($this->input->post('password')),
      'nama' => $this->input->post('nama'),
      'alamat' => $this->input->post('alamat'),
      'telepon' => $this->input->post('telepon'),
      'gambar' => 'default.png',
      'id_role' => 3
    ];
    $this->db->insert('user', $data);
    redirect('Admin/kasir');
  }
  public function ubah_kasir()
  {
    $username = $this->input->post('username');
    $nama = $this->input->post('nama');
    $alamat = $this->input->post('alamat');
    $telepon = $this->input->post('telepon');
    $this->db->set('nama', $nama);
    $this->db->set('alamat', $alamat);
    $this->db->set('telepon', $telepon);
    $this->db->where('username', $username);
    $this->db->update('user');
    redirect('Admin/kasir');
  }
  public function hapus_kasir($id)
  {
    $this->db->where('id', $id);
    $this->db->delete('user');
    redirect('Admin/kasir');
  }
  // mekanik
  public function mekanik()
  {
    $data['judul'] = 'Data Mekanik';
    $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
    $data['mekanik'] = $this->db->get_where('user', ['id_role' => 4])->result();
    $this->load->view('Template/Header', $data);
    $this->load->view('Template/Sidebar', $data);
    $this->load->view('Template/Topbar', $data);
    $this->load->view('Admin/Mekanik', $data);
    $this->load->view('Template/Footer', $data);
  }
  public function tambah_mekanik()
  {
    $data = [
      'username' => $this->input->post('username'),
      'password' => md5($this->input->post('password')),
      'nama' => $this->input->post('nama'),
      'alamat' => $this->input->post('alamat'),
      'telepon' => $this->input->post('telepon'),
      'gambar' => 'default.png',
      'id_role' => 4
    ];
    $this->db->insert('user', $data);
    redirect('Admin/mekanik');
  }
  public function ubah_mekanik()
  {
    $username = $this->input->post('username');
    $nama = $this->input->post('nama');
    $alamat = $this->input->post('alamat');
    $telepon = $this->input->post('telepon');
    $this->db->set('nama', $nama);
    $this->db->set('alamat', $alamat);
    $this->db->set('telepon', $telepon);
    $this->db->where('username', $username);
    $this->db->update('user');
    redirect('Admin/mekanik');
  }
  public function hapus_mekanik($id)
  {
    $this->db->where('id', $id);
    $this->db->delete('user');
    redirect('Admin/mekanik');
  }
}
