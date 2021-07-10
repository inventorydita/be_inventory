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
        } else {
            $tokodita = $this->db->get_by_id('stok_barang')->result();
            $respon['status'] = false;
            $respon['message'] = "gagal menampilkan semua data";
            $respon['data'] = $tokodita;
        }
        $this->response($respon, 500);
    }

    //mengirim atau menambah data stok barang
    function index_post()
    {
        $this->load->helper('form', 'url');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('id_barang', 'ID Barang', 'required');
        $this->form_validation->set_rules('id_pemasok', 'ID Pemasok', 'required');
        $this->form_validation->set_rules('harga_jual', 'Harga Jual', 'required');
        $this->form_validation->set_rules('harga_modal', 'Harga Modal', 'required');
        $this->form_validation->set_rules('stok', 'Stok', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->response(array('status' => 'fail,isi sesuai format', 502));
        } else {
            $data = array(
                'id_barang'    => $this->post('id_barang'),
                'id_pemasok'   => $this->post('id_pemasok'),
                'harga_jual'   => $this->post('harga_jual'),
                'harga_modal'  => $this->post('harga_modal'),
                'stok'         => $this->post('stok')
            );
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
    }

    //memperbarui data master stok_barang
    function index_put()
    {
        $id = $this->put('id_stok_barang');
        $data = array(
            'id_barang'   => $this->post('id_barang'),
            'id_pemasok'  => $this->post('id_pemasok'),
            'harga_jual'  => $this->post('harga_jual'),
            'harga_modal'  => $this->post('harga_modal'),
            'stok'        => $this->post('stok')
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
    function index_delete()
    {
        $id = $this->delete('id_stok_barang');
        $this->db->where('id_stok_barang', $id);
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

}
