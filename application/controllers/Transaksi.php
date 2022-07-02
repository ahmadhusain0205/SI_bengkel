<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    if (!isset($_SESSION['id'])) {
      redirect('Auth');
    }
    if ($this->session->userdata('id_role') == 2 or $this->session->userdata('id_role') == 4) {
      redirect('Block');
    }
  }
  public function index()
  {
    $data = [
      'judul' => 'Servis',
      'servis' => $this->db->get('servis')->result(),
      'invoice' => $this->M_invoice->invoice_no(),
      'penjualan' => $this->db->query('select * from penjualan order by id DESC')->result(),
      'mekanik' => $this->db->get_where('user', ['id_role' => 4])->result(),
      'user' => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array()
    ];
    $this->load->view('Template/Header', $data);
    $this->load->view('Template/Sidebar', $data);
    $this->load->view('Template/Topbar', $data);
    $this->load->view('Transaksi/Data', $data);
    $this->load->view('Template/Footer', $data);
  }
  public function penjualan()
  {
    $data = [
      'judul' => 'Transaksi',
      'invoice' => $this->M_invoice->invoice_no(),
      'sparepart' => $this->db->query('select s.id, s.id_kategori, s.nama, s.harga_jual, s.harga_beli, s.stok, (select k.kategori from kategori k where k.id=s.id_kategori) as kategori from sparepart s')->result(),
      'penjualan' => $this->db->query('select * from penjualan order by id DESC')->result(),
      'servis' => $this->db->get('servis')->result(),
      'user' => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array()
    ];
    $this->load->view('Template/Header', $data);
    $this->load->view('Template/Sidebar', $data);
    $this->load->view('Template/Topbar', $data);
    $this->load->view('Transaksi/Penjualan', $data);
    $this->load->view('Template/Footer', $data);
  }
  public function add()
  {
    // ambil data input lalu tampung dalam variable
    $mekanikx = $this->input->post('mekanik');
    $mekanik = $mekanikx;
    $kostumer = $this->input->post('kostumer');
    $motor = $this->input->post('motor');
    $no_plat = $this->input->post('no_plat');
    $harga_servis = $this->input->post('harga_servis');
    $invoice = $this->M_invoice->invoice_no();
    // cek jika melakukan servis
    if ($mekanikx != null) {
      // masukan data inputan kedalam variable $data
      $data_servis = [
        'invoice' => $invoice,
        'kostumer' => $kostumer,
        'motor' => $motor,
        'no_plat' => $no_plat,
        'keterangan' => 0,
        'harga_servis' => $harga_servis,
        'mekanik' => $mekanik,
      ];
      // insert ke dalam table servis
      $this->db->insert('servis', $data_servis);
    }
    // jika tidak melakukan servis
    else {
      // masukan data inputan kedalam variable $data
      $data_servis = [
        'invoice' => $invoice,
        'kostumer' => $kostumer,
        'motor' => $motor,
        'no_plat' => $no_plat,
        'keterangan' => 1,
        'harga_servis' => $harga_servis,
        'mekanik' => $mekanik,
      ];
      // insert kedalam table servis
      $this->db->insert('servis', $data_servis);
    }
    // arahkan ke transaksi/penjualan
    redirect('Transaksi/penjualan');
  }
  public function add_penjualan()
  {
    // ambil data input lalu tampung dalam variable
    $qty = $this->input->post('qty');
    // jika qty di kosong kan
    if ($qty == null) {
      // secara otomatis akan diisi 1
      $qty_new = 1;
    }
    // jika qty diisi
    else {
      // maka isi akan sesuai dengan inputan qty
      $qty_new = $qty;
    }
    $sparepart = $this->input->post('nama');
    $invoice = $this->input->post('invoice');

    // cek data di table penjualan
    // ambil data penjualan
    $penjualan = $this->db->get('penjualan')->result();
    // mengambil satu baris data sparepart berdasarkan nama sparepart
    $jbs = $this->db->query('select harga_jual, harga_beli from sparepart where nama = "' . $sparepart . '"')->row_array();
    // mengambil satu baris data servis berdasarkan invoice
    $servis = $this->db->query('select invoice, kostumer, motor, no_plat, harga_servis, mekanik from servis where invoice = "' . $invoice . '"')->row_array();
    // cek kondisi table penjualan berdasarkan nama sparepart
    $kondisi = $this->db->query('select * from penjualan where nama_sparepart = "' . $sparepart . '"')->row_array();
    // jika nama sparepart dari table penjualan berbeda dengan nama sparepart pada inputan
    if ($kondisi['nama_sparepart'] != $sparepart) {
      // jika data penjualan ($kondisi) empty
      if (empty($penjualan)) {
        // tampung data kedalam variable $data
        $data = [
          'invoice' => $invoice,
          'nama_sparepart' => $sparepart,
          'qty_sparepart' => $qty_new,
          'kostumer' => $servis['kostumer'],
          'motor' => $servis['motor'],
          'no_plat' => $servis['no_plat'],
          'mekanik' => $servis['mekanik'],
          'harga_servis' => $servis['harga_servis'],
          'harga_jual_sparepart' => $jbs['harga_jual'],
          'harga_beli_sparepart' => $jbs['harga_beli'],
          'total' => $servis['harga_servis'] + ($jbs['harga_jual'] * $qty_new),
          'sub_total' => ($jbs['harga_jual'] * $qty_new),
        ];
        // insert kedalam table penjualan
        $this->db->insert('penjualan', $data);
      }
      // jika nama sparepart belum ada di table penjualan
      else {
        // tampung data kedalam variable $data
        $data = [
          'invoice' => $invoice,
          'nama_sparepart' => $sparepart,
          'qty_sparepart' => $qty_new,
          'kostumer' => $servis['kostumer'],
          'motor' => $servis['motor'],
          'no_plat' => $servis['no_plat'],
          'mekanik' => $servis['mekanik'],
          'harga_servis' => $servis['harga_servis'],
          'harga_jual_sparepart' => $jbs['harga_jual'],
          'harga_beli_sparepart' => $jbs['harga_beli'],
          'sub_total' => ($jbs['harga_jual'] * $qty_new + $kondisi['harga_jual_sparepart']),
        ];
        // insert kedalam table penjualan
        $this->db->insert('penjualan', $data);

        // update data total
        // ambil jumlah sub_total dari table penjualan lalu simpan dalam variable $totalx
        $totalx = $this->db->query('select sum(sub_total) as st from penjualan')->result();
        // lakukan perulangan untuk mengambil jumlah sub_total dari variable $totalx
        foreach ($totalx as $tx) {
          // simpan jumlah sub_total kedalam variable $totaly
          $totaly = $tx->st;
        }
        // aritmatuka total = jumlah sub_total + harga servis
        $total = $totaly + $servis['harga_servis'];
        // ubah data total ke data yang baru
        $this->db->set('total', $total);
        // berdasarkan invoice
        $this->db->where('invoice', $invoice);
        // dalam table penjualan
        $this->db->update('penjualan');
      }
    }
    // jika nama sparepart ada dalam table penjualaan
    else {
      redirect('Transaksi/penjualan');
    }
    // arahkan ke transaksi/penjualan
    redirect('Transaksi/penjualan');
  }
  public function hapus_data($id)
  {
    // ambil inputan dari foem lalu simpan dalam variable
    $invoice = $this->M_invoice->invoice_no();
    // ambil sub total dari table penjualan berdasarkan id kemudian simpan ke dalam variable harga
    $harga = $this->db->query('select sub_total from penjualan where id = "' . $id . '"')->row_array();
    // ambil total dari table penjualan berdasarkan invoice kemudian simpan ke dalam variable totalx
    $totalx = $this->db->query('select total from penjualan where invoice = "' . $invoice . '"')->row_array();
    // masukan aritmatika kedalam variable total
    $total = $totalx['total'] - $harga['sub_total'];
    // ubah data total ke data yang baru
    $this->db->set('total', $total);
    // berdasarkan invoice
    $this->db->where('invoice', $invoice);
    // dalam table penjualan
    $this->db->update('penjualan');

    // jika sudah diupdate, maka data penjualan akan di hapus berdasarkan data yang ingin dihapus
    // data berdasarkan kondisi id
    $this->db->where('id', $id);
    // hapus dari table penjualan
    $this->db->delete('penjualan');
    // arahkan ke transaksi/penjualan
    redirect('Transaksi/penjualan');
  }
  public function ubah_data()
  {
    // simpan inputan form kedalam variable
    $nama = $this->input->post('nama');
    $qty = $this->input->post('qty');
    // ambil data harga jual, harga beli dari table sparepart berdasarkan nama, kemudian simpan kedalam variable kondisi
    $kondisi = $this->db->query('select harga_jual, harga_beli from sparepart where nama = "' . $nama . '"')->row_array();
    // aritmatika sub total
    $sub_total = $qty * $kondisi['harga_jual'];
    // ubah qty sparepart ke data yang baru
    $this->db->set('qty_sparepart', $qty);
    // ubah sub total ke data yang baru
    $this->db->set('sub_total', $sub_total);
    // berdasarkan nama sparepart
    $this->db->where('nama_sparepart', $nama);
    // dalam table penjualan
    $this->db->update('penjualan');

    // lalu update juga total pada table penjualan
    // ambil invoice dari table transaksi
    $invoice = $this->M_invoice->invoice_no();
    // ambil data harga servis dari table servis berdasarkan invoice, lalu simpan kedalam varibale servis
    $servis = $this->db->query('select harga_servis from servis where invoice = "' . $invoice . '"')->row_array();
    // ambil data jumlah dari sub total pada table penjualan berdasarkan invoice, lalu simpan kedalam variable totalx
    $totalx = $this->db->query('select sum(sub_total) as st from penjualan where invoice = "' . $invoice . '"')->row_array();
    // aritmatika total
    $total = $totalx['st'] + $servis['harga_servis'];
    // ubah data total ke data yang baru
    $this->db->set('total', $total);
    // berdasarkan invoice
    $this->db->where('invoice', $invoice);
    // pada table penjualan
    $this->db->update('penjualan');
    // arahkan ke transaksi/penjualan
    redirect('Transaksi/penjualan');
  }
  public function bayar()
  {
    // masukan inputan form ke dalam variable
    $pembayaran = $this->input->post('bayar');
    $invoice = $this->input->post('invoice');
    // ambil data total dari table penjualan berdasarkan invoice, lalu simpan kedalam variable
    $total = $this->db->query('select total from penjualan where invoice = "' . $invoice . '"')->row_array();
    // mengatasi human error dalam pembayaran
    // jika pembayaran lebih dari total pembelanjaan
    if ($pembayaran >= $total['total']) {
      // aritmatika kembalian
      $kembalian = $pembayaran - $total['total'];
      // ubah data pembayaran ke data yang baru
      $this->db->set('pembayaran', $pembayaran);
      // ubah data kembalian ke data yang baru
      $this->db->set('kembalian', $kembalian);
      // berdasarkan invoice
      $this->db->where('invoice', $invoice);
      // pada table penjualan
      $this->db->update('penjualan');
    }

    $stokx = $this->db->query('SELECT qty_sparepart, nama_sparepart from penjualan WHERE nama_sparepart in (SELECT nama from sparepart)')->result();
    foreach ($stokx as $s) {
      $qty = $this->db->query('select stok from sparepart where nama = "' . $s->nama_sparepart . '"')->row_array();
      $stok = $qty['stok'] - $s->qty_sparepart;
      $this->db->set('stok', $stok);
      $this->db->where('nama', $s->nama_sparepart);
      $this->db->update('sparepart');
    }

    // arahkan ke transaksi/penjualan
    redirect('Transaksi/penjualan');
  }
  public function selesaikan($invoice)
  {
    // ambil semua data pada table penjualan
    $x = $this->db->get('penjualan')->result();
    // lakukan perulanag untuk mengambil semua data
    foreach ($x as $xx) {
      // simpan kedalam variable data
      $data = [
        'tanggal' => $xx->tanggal,
        'invoice' => $xx->invoice,
        'kostumer' => $xx->kostumer,
        'motor' => $xx->motor,
        'no_plat' => $xx->no_plat,
        'mekanik' => $xx->mekanik,
        'harga_servis' => $xx->harga_servis,
        'nama_sparepart' => $xx->nama_sparepart,
        'qty_sparepart' => $xx->qty_sparepart,
        'sub_total' => $xx->sub_total,
        'pembayaran' => $xx->pembayaran,
        'kembalian' => $xx->kembalian,
        'harga_jual_sparepart' => $xx->harga_jual_sparepart,
        'harga_beli_sparepart' => $xx->harga_beli_sparepart,
        'total' => $xx->total,
      ];
      // insert ke table transaksi
      $this->db->insert('transaksi', $data);
    }
    // bila status keterangan == 1
    $this->db->where('keterangan', 1);
    // hapus datanya dari table servis
    $this->db->delete('servis');
    // kosongkan table penjualan
    $this->db->empty_table('penjualan');
    // arahkan ke transaksi/index
    redirect('Transaksi');
  }
}
