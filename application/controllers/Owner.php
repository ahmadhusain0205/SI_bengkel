<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Owner extends CI_Controller
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
    redirect('Admin');
  }
}
