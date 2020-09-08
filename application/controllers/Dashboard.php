<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {


	public function __construct()
	{
		parent::__construct();
		$this->load->model('barang_model', 'barang');
		$this->load->model('transaksi_model', 'transaksi');
	}

	public function index()
	{
		$data = [
			'title' => 'Dashboard',
			'barang' => $this->barang->get_all_barang(),
			'transaksi' => $this->transaksi->get_transaksi(),

		];


		$this->render('index', $data);
	}

	public function laporan ()
	{

		$data = [
			'url' => 'dashboard/laporan',
			'title' => 'Dashboard Laporan',
			'allTransaksi' => $this->transaksi->getTransaksi(),

		];

		if ($this->input->post('laporan')) {
			$this->load->library('pdf');
			$this->pdf->load_view('laporan/laporan', $data);
			$this->pdf->setPaper('A4', 'portrait');
			$this->pdf->render();
			$this->pdf->stream("laporan penjualan.pdf");
		} else {

			$this->render('laporan/index', $data);
			
		}
	}
}
