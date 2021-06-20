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
            $tokodita = $this->db->get_all()->result();
        } else {
            $this->db->where('id', $id);
            $tokodita = $this->db->get('penjualan')->result();
        }
        $this->response($tokodita, 200);
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
                $this->response($data, 200);
            } else {
                $this->response(array('status' => 'fail', 502));
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
        $put = $this->penjualan->put($data . $id);
        if ($put) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
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
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }


    //Masukan function selanjutnya disini
}
