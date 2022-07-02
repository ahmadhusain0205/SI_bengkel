<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Sparepart extends CI_Controller
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
  // produk
  public function index()
  {
    $data = [
      'judul' => 'Sparepart',
      'kategori' => $this->db->get('kategori')->result(),
      'produk' => $this->db->query('select s.id, s.id_kategori, s.nama, s.harga_jual, s.harga_beli, s.stok, (select k.kategori from kategori k where k.id=s.id_kategori) as kategori from sparepart s')->result(),
      'user' => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array()
    ];
    $this->load->view('Template/Header', $data);
    $this->load->view('Template/Sidebar', $data);
    $this->load->view('Template/Topbar', $data);
    $this->load->view('Sparepart/Produk', $data);
    $this->load->view('Template/Footer', $data);
  }
  public function tambah_produk()
  {
    // validasi
    $this->form_validation->set_rules('nama', 'nama sparepart', 'required|trim|min_length[3]|is_unique[sparepart.nama]', [
      'is_unique' => 'nama sparepart sudah digunakan'
    ]);
    if ($this->form_validation->run() == false) {
      redirect('Sparepart');
    } else {
      $data = [
        'nama' => $this->input->post('nama'),
        'id_kategori' => $this->input->post('id_kategori'),
        'stok' => $this->input->post('stok'),
        'harga_beli' => $this->input->post('harga_beli'),
        'harga_jual' => $this->input->post('harga_jual'),
      ];
      $this->db->insert('sparepart', $data);
      redirect('Sparepart');
    }
  }
  public function hapus_produk($id)
  {
    $this->db->where('id', $id);
    $this->db->delete('sparepart');
    redirect('Sparepart');
  }
  public function ubah_produk()
  {
    $id = $this->input->post('id');
    $nama = $this->input->post('nama');
    $stok = $this->input->post('stok');
    $harga_jual = $this->input->post('harga_jual');
    $harga_beli = $this->input->post('harga_beli');
    $id_kategori = $this->input->post('id_kategori');
    $this->db->set('nama', $nama);
    $this->db->set('stok', $stok);
    $this->db->set('harga_jual', $harga_jual);
    $this->db->set('harga_beli', $harga_beli);
    $this->db->set('id_kategori', $id_kategori);
    $this->db->where('id', $id);
    $this->db->update('sparepart');
    redirect('Sparepart');
  }
  // kategori
  public function kategori()
  {
    $data = [
      'judul' => 'Kategori',
      'kategori' => $this->db->get('kategori')->result(),
      'user' => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array()
    ];
    $this->load->view('Template/Header', $data);
    $this->load->view('Template/Sidebar', $data);
    $this->load->view('Template/Topbar', $data);
    $this->load->view('Sparepart/Kategori', $data);
    $this->load->view('Template/Footer', $data);
  }
  public function tambah_kategori()
  {
    $data = [
      'kategori' => $this->input->post('kategori'),
    ];
    $this->db->insert('kategori', $data);
    redirect('Sparepart/kategori');
  }
  public function hapus_kategori($id)
  {
    $this->db->where('id', $id);
    $this->db->delete('kategori');
    redirect('Sparepart/kategori');
  }
  public function ubah_kategori()
  {
    $id = $this->input->post('id');
    $kategori = $this->input->post('kategori');
    $this->db->set('kategori', $kategori);
    $this->db->where('id', $id);
    $this->db->update('kategori');
    redirect('Sparepart/kategori');
  }
}
