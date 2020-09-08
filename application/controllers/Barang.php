<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('barang_model', 'barang');
    }


    public function index()
    {

        // ------------------------------ form validasi -------------------

        $this->form_validation->set_rules('kode_barang', 'Kode Barang', 'trim|required|is_unique[tb_barang.kode_barang]', [
            'is_unique' => 'Kode Barang sudah terdaftar!',
            'required' => 'Kode Barang tidak boleh kosong!',
            'numeric' => 'Kode Barang tidak valid!'
        ]);
        $this->form_validation->set_rules('nama_barang', 'Nama Barang', 'trim|required', [
            'required' => 'Nama Barang tidak Boleh Kosong!'
        ]);

        $this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required', [
            'required' => 'Keterangan tidak Boleh Kosong!'
        ]);
        $this->form_validation->set_rules('stock', 'Stock', 'trim|required|numeric', [
            'required' => 'Stock tidak Boleh Kosong!',
            'numeric' => 'Stock harus berupa angka!'
        ]);
        $this->form_validation->set_rules('harga', 'Harga', 'trim|required|numeric', [
            'required' => 'Harga tidak Boleh Kosong!',
            'numeric' => 'Harga harus berupa angka!'
        ]);

		// --------- end Validasi -----------

        if ($this->form_validation->run() == false) {

            $search = $this->input->get('search');
            $date = $this->input->get('date');



            if ($search || $date) {

                $data = [
                    'title' => 'Stock Barang', //judul halaman
                    'kode_barang' => $this->barang->set_kode_barang(), // generate kode barang otomatis
                    'allBarang' => $this->barang->get_all_barang(), // ambil semua data 
                    'allDateBarang' => $this->barang->get_date_barang(), //ambil tanggal barang
                    'allSatuan' => $this->barang->get_all_satuan() // ambil semua data satuan
                ];

                $this->render('barang/stok', $data);

            } else {

                $data = [
                    'title' => 'Stock Barang', //judul halaman
                    'kode_barang' => $this->barang->set_kode_barang(), // generate kode barang otomatis
                    'allBarang' => $this->barang->get_all_barang(), // ambil semua data barang
                    'allDateBarang' => $this->barang->get_date_barang(), //ambil tanggal barang
                    'allSatuan' => $this->barang->get_all_satuan() // ambil semua data satuan
                ];

                $this->render('barang/stok', $data);

                
            }
        } else {

            // ambil harga beli dan harga jual

            $hargaBeli = htmlspecialchars($this->input->post('harga', true));
            $hargaJual = htmlspecialchars($this->input->post('harga_jual', true));

            //menghilangkan titik ribuan
            $angka1 = str_replace(".", "", $hargaBeli);
            $angka2 = str_replace(".", "", $hargaJual);

            // simpan data ke database
            $data = [
                'kode_barang' => htmlspecialchars($this->input->post('kode_barang', true)),
                'nama_barang' => htmlspecialchars($this->input->post('nama_barang', true)),
                'satuan_id' => htmlspecialchars($this->input->post('satuan_id', true)),
                'keterangan' => htmlspecialchars($this->input->post('keterangan', true)),
                'stock' => htmlspecialchars($this->input->post('stock', true)),
                'harga' => $angka1,
                'harga_jual' =>$angka2,
                'date_created' => time()
            ];

            $this->barang->save_barang_info($data); //simpan data dengan memanggil fungsi simpan di model

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"> Selamat!, Barang anda berhasil didaftarkan. </div>');
            redirect('barang');
        }

       
    }

    public function update($id)
    {

        // ------------------------------ form validasi -------------------
        $this->form_validation->set_rules('nama_barang', 'Nama Barang', 'trim|required', [
            'required' => 'Nama Barang tidak Boleh Kosong!'
        ]);

        $this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required', [
            'required' => 'Keterangan tidak Boleh Kosong!'
        ]);
        $this->form_validation->set_rules('stock', 'Stock', 'trim|required|numeric', [
            'required' => 'Stock tidak Boleh Kosong!',
            'numeric' => 'Stock harus berupa angka!'
        ]);
        $this->form_validation->set_rules('harga', 'Harga', 'trim|required|numeric', [
            'required' => 'Harga Beli tidak Boleh Kosong!',
            'numeric' => 'Harga Beli harus berupa angka!'
        ]);
        $this->form_validation->set_rules('satuan_id', 'satuan', 'trim|required|numeric', [
            'required' => 'Satuan tidak Boleh Kosong!',
            'numeric' => 'Satuan harus berupa angka!'
        ]);
        $this->form_validation->set_rules('harga_jual', 'Harga Jual', 'trim|required|numeric', [
            'required' => 'Harga Jual tidak Boleh Kosong!',
            'numeric' => 'Harga Jual harus berupa angka!'
        ]);

		// --------- end Validasi -----------

        if ($this->form_validation->run() == false) {

            $data = [
                'title' => 'Update Barang', //judul halaman
                'barang' => $this->barang->get_single_barang($id), //get barang berdasarkan id
                'allSatuan' => $this->barang->get_all_satuan() // ambil semua data satuan
            ];

            $this->render('barang/edit', $data);

        } else {

            // ambil harga beli dan harga jual

            $hargaBeli = htmlspecialchars($this->input->post('harga', true));
            $hargaJual = htmlspecialchars($this->input->post('harga_jual', true));

            //menghilangkan titik ribuan
            $angka1 = str_replace(".", "", $hargaBeli);
            $angka2 = str_replace(".", "", $hargaJual);

            $data = [
                'nama_barang' => htmlspecialchars($this->input->post('nama_barang', true)),
                'satuan_id' => htmlspecialchars($this->input->post('satuan_id', true)),
                'keterangan' => htmlspecialchars($this->input->post('keterangan', true)),
                'stock' => htmlspecialchars($this->input->post('stock', true)),
                'harga' => $angka1,
                'harga_jual' => $angka2,
            ];

            $this->barang->update_barang_info($data, $id);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Barang berhasil diperbaharui!</div>');
            redirect('barang');
        }
    }

    public function delete($id)
    {
        $this->barang->delete_barang_info($id);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Barang berhasil dihapus!</div>');
        redirect('barang');
    }
}
