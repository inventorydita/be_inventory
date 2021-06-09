<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class MasterBarangController extends REST_Controller
{

    function __construct($config = 'rest')
    {
        parent::__construct($config);
        $this->load->database();
    }

    //Menampilkan data penjualan
    function index_get()
    {
        $id = $this->get('id_penjualan');
        if ($id == '') {
            $tokodita = $this->db->get('penjualan')->result();
        } else {
            $this->db->where('id', $id);
            $tokodita = $this->db->get('penjualan')->result();
        }
        $this->response($tokodita, 200);
    }

    //mengirim atau menambah data penjualan
    function index_post()
    {
        $data = array(
            'id_penjualan'     => $this->post('id_penjualan'),
            'id_barang'     => $this->post('id_barang'),
            'harga_jual'    => $this->post('harga_jual'),
            'quantity'    => $this->post('quantity'),
            'subtotal'    => $this->post('subtotal'),
            'tanggal'    => $this->post('tanggal')
        );
        $insert = $this->db->insert('penjualan', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    //memperbarui data penjualan
    function index_put()
    {
        $id = $this->put('id_penjualan');
        $data = array(
            'id_penjualan'     => $this->put('id_penjualan'),
            'id_barang'     => $this->put('id_barang'),
            'harga_jual'    => $this->put('harga_jual'),
            'quantity'    => $this->put('quantity'),
            'subtotal'    => $this->put('subtotal'),
            'tanggal'    => $this->put('tanggal')
        );
        $this->db->where('id_penjualan', $id);
        $update = $this->db->update('penjualan', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    //menghapus salah satu data penjualan
    function index_delete()
    {
        $id = $this->delete('id_penjualan');
        $this->db->where('id_penjualan', $id);
        $delete = $this->db->delete('penjualan');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }


    //Masukan function selanjutnya disini

}
