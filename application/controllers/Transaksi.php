<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('barang_model', 'barang');
        $this->load->model('transaksi_model', 'transaksi');
        $this->load->library('cart');
    }


    public function index()
    {
        $data = [
            'url' => 'transaksi/add', //url
            'title' => 'Transaksi Barang', //judul halaman
            'kode_barang' => $this->barang->set_kode_barang(), // generate kode barang otomatis
            'allBarang' => $this->barang->get_all_barang(), // ambil semua data 
            'allTransaksi' => $this->transaksi->get_all_transaksi(), //ambil semua data transaksi
        ];



        $this->render('transaksi/index', $data);
           
    }

    public function add()
    {
        $data = [
            'url' => "transaksi/add", // url
            'title' => 'Form Transaksi', // judul halaman
            'cart_contents' => $this->cart->contents(),
        ];

        $this->render('transaksi/transaksi-form', $data);           
    }


    public function add_barang_temp()
    {
        $this->form_validation->set_rules('nama', 'Nama Barang', 'trim|required', [ // validasi nama barang
            'required' => 'Nama Barang tidak Boleh Kosong!',
        ]);
        $this->form_validation->set_rules('qty', 'Quantity', 'trim|required', [ // validasi quantity
            'required' => 'Quantity tidak Boleh Kosong!',
        ]);

        if ($this->form_validation->run() == false) { // jika validasi gagal
            redirect('transaksi/add');
        } else {                                        //jika validasi berhasil

            $id = $this->input->post('id');
            $qty = $this->input->post('qty', true);

            $barang = $this->db->get_where('tb_barang', ['id' => $id])->row_array();

            if ($qty <= $barang['stock']) { // jika jumlah permintaan barang kecil = jumlah stock lanjut simpan

                $row = $this->transaksi->get_single_barang($id);

                $data = [
                    'id' => $row['id'],
                    'name' => $row['nama_barang'],
                    'price' => $row['harga'],
                    'qty' => $qty,
                ];

                $this->cart->insert($data);

                redirect('transaksi/add');
            } else {                                     // jika gagal, 

                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"> Jumlah Stock yang dinput tidak memadai di gudang!, silahkan masukkan ulang </div>');
                redirect('transaksi/add');
                
            }
        }

    }

    public function remove_barang() // hapus barang dari temp
    {

        $data = $this->input->post('rowid', true);
        $this->cart->remove($data);
        redirect('transaksi/add');
    }

    function get_autocomplete() // autocomplate barang
    {
        if (isset($_GET['term'])) {
            $result = $this->transaksi->search_blog($_GET['term']);
            if (count($result) > 0) {
                foreach ($result as $row)
                    $arr_result[] = array(
                        'kode'      => $row->kode_barang,
                        'stock'     => $row->stock,
                        'harga'     => number_format($row->harga_jual, "0", ".", "."),
                        'qty'       => '1',
                        'satuan'    => $row->satuan,
                        'value'     => $row->nama_barang,
                        'label'     => $row->nama_barang,
                        'id'        => $row->id

                    );
                echo json_encode($arr_result);
            }
        }
    }


    public function save_transaksi()
    {
        $no_resi =  $this->transaksi->get_no_resi();

        $odata = [
            'no_resi' => $no_resi,
            'total' => $this->cart->total(),
            'date_created' => date('Y-m-d')
        ];


        $this->transaksi->save_transaksi_info($odata); // save ke tabel transaksi

        $allbarang = $this->cart->contents(); // ambil semua barang di temporary

        foreach ($allbarang as $barang) { // foreach data barang di temporary

            $data = [
                'no_resi' => $no_resi,
                'barang_id' => $barang['id'],
                'qty' => $barang['qty'],
            ];

            $this->transaksi->save_sub_transaksi_info($data); // save ke tabel sub transaksi
        }

        $this->cart->destroy();


        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Transaksi berhasil ditambahkan!</div>');

        redirect('transaksi/add');
        
    }


    public function delete($id)
    {
        $this->transaksi->delete_transaksi_info($id);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Transaksi berhasil dihapus!</div>');
        redirect('transaksi');
    }

}
