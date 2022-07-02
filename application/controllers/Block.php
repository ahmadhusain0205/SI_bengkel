<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Block extends CI_Controller
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
      'judul' => 'Block',
      'user' => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array()
    ];
    $this->load->view('Template/Header', $data);
    $this->load->view('Template/Sidebar', $data);
    $this->load->view('Template/Topbar', $data);
    $this->load->view('Block/Data', $data);
    $this->load->view('Template/Footer', $data);
  }
}
