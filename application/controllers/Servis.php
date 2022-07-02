<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Servis extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    if (!isset($_SESSION['id'])) {
      redirect('Auth');
    }
    if ($this->session->userdata('id_role') == 3 or $this->session->userdata('id_role') == 2) {
      redirect('Block');
    }
  }
  public function index()
  {
    $data = [
      'judul' => 'Servis',
      'servis' => $this->db->query('select s.id, s.invoice, s.harga_servis, s.tanggal_masuk, s.tanggal_keluar, s.kostumer, s.motor, s.no_plat, s.keterangan, s.mekanik from servis s order by s.id desc')->result(),
      'user' => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array()
    ];
    $this->load->view('Template/Header', $data);
    $this->load->view('Template/Sidebar', $data);
    $this->load->view('Template/Topbar', $data);
    $this->load->view('Servis/Data', $data);
    $this->load->view('Template/Footer', $data);
  }
  public function selesai($id)
  {
    $tanggal_keluar = date("Y-m-d H:i:s");
    // var_dump($tanggal_keluar);
    $this->db->set('tanggal_keluar', $tanggal_keluar);
    $this->db->where('id', $id);
    $this->db->update('servis');

    $servis = $this->db->get('servis')->result();
    foreach ($servis as $s) {
      $data = [
        'invoice' => $s->invoice,
        'tanggal_masuk' => $s->tanggal_masuk,
        'tanggal_keluar' => $tanggal_keluar,
        'kostumer' => $s->kostumer,
        'motor' => $s->motor,
        'no_plat' => $s->no_plat,
        'harga_servis' => $s->harga_servis,
        'mekanik' => $s->mekanik,
      ];
      $this->db->insert('servis_selesai', $data);
    }
    $this->db->empty_table('servis');
    redirect('Servis');
  }
}
