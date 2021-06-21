<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class PenjualanController extends REST_Controller
{

    function __construct($config = 'rest')
    {
        parent::__construct($config);
        $this->load->database();
        $this->load->model('Penjualan_model', 'penjualan');
    }

    //Menampilkan data penjualan
    function index_get()
    {
        $id = $this->get('id_penjualan');
        if ($id == '') {
            $tokodita = $this->penjualan->get_all()->result();
            $respon['status'] = true;
            $respon['message'] = "berhasil menampilkan semua data";
            $respon['data'] = $tokodita;
        } else {
            $this->db->where('id', $id);
            $tokodita = $this->db->get_by_id('penjualan')->result();
            $respon['status'] = true;
            $respon['message'] = "berhasil menampilkan semua data";
            $respon['data'] = $tokodita;
        }
        $this->response($respon, 200);
    }

    //mengirim atau menambah data penjualan
    function index_post()
    {
        $this->load->helper('form', 'url');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('id_barang', 'Barang', 'required');
        $this->form_validation->set_rules('harga_jual', 'Harga Jual', 'required');
        $this->form_validation->set_rules('quantity', 'Quantity', 'required');
        $this->form_validation->set_rules('subtotal', 'Subtotal', 'required');
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required');


        if ($this->form_validation->run() == FALSE) {
            $this->response(array('status' => 'fail,isi sesuai format', 502));
        } else {
            $data = array(
                'id_penjualan' => $this->post('id_penjualan'),
                'id_barang'    => $this->post('id_barang'),
                'harga_jual'   => $this->post('harga_jual'),
                'quantity'     => $this->post('quantity'),
                'subtotal'     => $this->post('subtotal'),
                'tanggal'      => $this->post('tanggal')
            );
            $insert = $this->penjualan->post($data);
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

    //memperbarui data penjualan
    function index_put()
    {
        /*$this->load->helper('form', 'url');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('id_barang', 'Barang', 'required');
        $this->form_validation->set_rules('harga_jual', 'Harga Jual', 'required');
        $this->form_validation->set_rules('quantity', 'Quantity', 'required');
        $this->form_validation->set_rules('subtotal', 'Subtotal', 'required');
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required');


        if ($this->form_validation->run() == FALSE) {
            $this->response(array('status' => 'fail,isi sesuai format', 502));
        } else { */
        $id = $this->put('id_penjualan');
        $data = array(
            'id_penjualan' => $this->put('id_penjualan'),
            'id_barang'    => $this->put('id_barang'),
            'harga_jual'   => $this->put('harga_jual'),
            'quantity'     => $this->put('quantity'),
            'subtotal'     => $this->put('subtotal'),
            'tanggal'      => $this->put('tanggal')
        );
        $put = $this->penjualan->put($data, $id);
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
        //}
    }

    //menghapus salah satu data penjualan
    function index_delete()
    {
        $id = $this->delete('id_penjualan');
        $this->db->where('id_penjualan', $id);
        $delete = $this->penjualan->delete($id);
        if ($delete) {
            $respon['status'] = true;
            $respon['message'] = "berhasil menghapus data";
            $respon['data'] = $delete;
            $this->response($respon, 200);
        } else {
            $respon['status'] = true;
            $respon['message'] = "berhasil menghapus data";
            $respon['data'] = $delete;
            $this->response($respon, 200);
        }
    }


    //Masukan function selanjutnya disini
}
