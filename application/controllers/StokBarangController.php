<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class StokBarangController extends REST_Controller
{

    function __construct($config = 'rest')
    {
        parent::__construct($config);
        $this->load->database();
        $this->load->model('Stokbarang_model', 'stok_barang');
    }

    //Menampilkan data stok barang
    function index_get()
    {
        $id = $this->get('id_stok_barang');
        if ($id == '') {
            $tokodita = $this->stok_barang->get_all()->result();
            $respon['status'] = true;
            $respon['message'] = "berhasil menampilkan semua data";
            $respon['data'] = $tokodita;
            $this->response($respon, 200);
        } else {
            $tokodita = $this->stok_barang->get_by_id($id)->result();
            $respon['status'] = true;
            $respon['message'] = "berhasil menampilkan semua data";
            $respon['data'] = $tokodita;
            $this->response($respon, 200);
        }
    }

    //mengirim atau menambah data stok barang
    function index_post()
    {
        //Ambil data JSON dari request(exfront end)
        $request = json_decode(file_get_contents("php://input"));

        //Ambil data stokbarang
        $id_barang = $request->id_barang;
        $harga_jual = $request->harga_jual;
        $harga_modal = $request->harga_modal;
        $stok = $request->stok;

        $data = array(
            'id_barang'   => $id_barang,
            'harga_jual'   => $harga_jual,
            'harga_modal'  => $harga_modal,
            'stok'         => $stok
        );
        //proses simpan data
        $insert = $this->stok_barang->post($data);
        if ($insert) {
            $respon['status'] = true;
            $respon['message'] = "berhasil menambahkan data";
            $respon['data'] = $data;
            $this->response($respon, 200);
        } else {
            $respon['status'] = false;
            $respon['message'] = "gagal menambahkan data";
            $respon['data'] = $data;
            $this->response($respon, 500);
        }
    }

    //memperbarui data master stok_barang
    function index_put()
    {
        //Ambil data JSON dari request(exfront end)
        $request = json_decode(file_get_contents("php://input"));

        //Ambil data stokbarang    
        $id_barang = $request->id_barang;
        $harga_jual = $request->harga_jual;
        $harga_modal = $request->harga_modal;
        $stok = $request->stok;

        $id = $request->id_stok_barang;
        $data = array(
            'id_barang'   => $id_barang,
            'harga_jual'   => $harga_jual,
            'harga_modal'  => $harga_modal,
            'stok'         => $stok
        );
        $put = $this->stok_barang->put($data, $id);
        if ($put) {
            $respon['status'] = true;
            $respon['message'] = "berhasil mengubah data";
            $respon['data'] = $data;
            $this->response($respon, 200);
        } else {
            $respon['status'] = false;
            $respon['message'] = "gagal mengubah data";
            $respon['data'] = $data;
            $this->response($respon, 500);
        }
    }

    //menghapus salah satu data stok barang
    function index_delete($id)
    {
       // $request = json_decode(file_get_contents("php://input"));
       // $id = $request->id_stok_barang;
        //$id = $this->delete('id_stok_barang');
        //$this->db->where('id_stok_barang', $id);
        $delete = $this->stok_barang->delete($id);
        if ($delete) {
            $respon['status'] = true;
            $respon['message'] = "berhasil menghapus data";
            $respon['data'] = $delete;
            $this->response($respon, 200);
        } else {
            $respon['status'] = false;
            $respon['message'] = "gagal menghapus data";
            $respon['data'] = $delete;
            $this->response($respon, 500);
        }
    }


    //Masukan function selanjutnya disini
    function search_get()
    {
        $nama = $this->get('nama_barang');
        $data = $this->stok_barang->search($nama);
        $respon['status'] = true;
        $respon['message'] = "berhasil mengambil data";
        $respon['data'] = $data->result();
        $this->response($respon, 200);
    }

}
