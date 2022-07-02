<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
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
      'judul' => 'Laporan Transaksi',
      'transaksi' => $this->db->get('transaksi')->result(),
      'pembukuan' => $this->db->get('pembukuan')->result(),
      'user' => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array()
    ];
    $this->load->view('Template/Header', $data);
    $this->load->view('Template/Sidebar', $data);
    $this->load->view('Template/Topbar', $data);
    $this->load->view('Laporan/Data', $data);
    $this->load->view('Template/Footer', $data);
  }
  public function servis()
  {
    $data = [
      'judul' => 'Laporan Servis',
      'servis' => $this->db->query('select * from servis_selesai order by id desc')->result(),
      'user' => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array()
    ];
    $this->load->view('Template/Header', $data);
    $this->load->view('Template/Sidebar', $data);
    $this->load->view('Template/Topbar', $data);
    $this->load->view('Laporan/Servis', $data);
    $this->load->view('Template/Footer', $data);
  }
  public function cari()
  {
    $dari = $this->input->post('dari');
    $sampai = $this->input->post('sampai');
    $laporan = $this->db->query('select * from transaksi where tanggal between "' . $dari . '" and "' . $sampai . '" order by id desc')->result();
    $kondisi = $this->db->get('pembukuan')->result();
    if (empty($kondisi)) {
      foreach ($laporan as $l) {
        $data = [
          'tanggal' => $l->tanggal,
          'invoice' => $l->invoice,
          'kostumer' => $l->kostumer,
          'motor' => $l->motor,
          'no_plat' => $l->no_plat,
          'mekanik' => $l->mekanik,
          'harga_servis' => $l->harga_servis,
          'nama_sparepart' => $l->nama_sparepart,
          'qty_sparepart' => $l->qty_sparepart,
          'sub_total' => $l->sub_total,
          'pembayaran' => $l->pembayaran,
          'kembalian' => $l->kembalian,
          'harga_jual_sparepart' => $l->harga_jual_sparepart,
          'harga_beli_sparepart' => $l->harga_beli_sparepart,
          'total' => $l->total,
        ];
        $this->db->insert('pembukuan', $data);
      }
    }
    $data = [
      'judul' => 'Laporan',
      'pembukuan' => $this->db->query(' select * from pembukuan group by invoice order by id desc')->result(),
      'user' => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array(),
    ];
    $this->load->view('Template/Header', $data);
    $this->load->view('Template/Sidebar', $data);
    $this->load->view('Template/Topbar', $data);
    $this->load->view('Laporan/Data', $data);
    $this->load->view('Template/Footer', $data);
  }
  public function hapus()
  {
    $this->db->empty_table('pembukuan');
    redirect('Laporan');
  }
  public function cetak()
  {
    $data = [
      'pembukuan' => $this->db->query(' select * from pembukuan group by invoice order by id desc')->result(),
      'judul' => 'Cetak Laporan',
    ];
    $this->load->view('Laporan/Cetak', $data);
  }
}
