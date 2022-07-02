<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kasir extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    if (!isset($_SESSION['id'])) {
      redirect('Auth');
    }
    if ($this->session->userdata('id_role') == 4) {
      redirect('Block');
    }
  }
  public function index()
  {
    redirect('Transaksi');
  }
}
