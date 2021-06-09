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

    //Menampilkan data master barang
    function index_get()
    {
        $id = $this->get('id_barang');
        if ($id == '') {
            $tokodita = $this->db->get('master_barang')->result();
        } else {
            $this->db->where('id', $id);
            $tokodita = $this->db->get('master_barang')->result();
        }
        $this->response($tokodita, 200);
    }

    //mengirim atau menambah data master barang baru
    function index_post()
    {
        $data = array(
            'id_barang'     => $this->post('id'),
            'nama_barang'   => $this->post('nama_barang'),
            'id_satuan'     => $this->post('id_satuan'),
            'id_pemasok'    => $this->post('id_pemasok'),
            'harga_modal'   => $this->post('harga_modal'),
            'harga_jual'    => $this->post('harga_jual')
        );
        $insert = $this->db->insert('master_barang', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    //memperbarui data master barang/edit
    function index_put()
    {
        $id = $this->put('id_barang');
        $data = array(
            'id_barang'     => $this->put('id_barang'),
            'nama_barang'   => $this->put('nama_barang'),
            'id_satuan'     => $this->put('id_satuan'),
            'id_pemasok'    => $this->put('id_pemasok'),
            'harga_modal'   => $this->put('harga_modal'),
            'harga_jual'    => $this->put('harga_jual')
        );
        $this->db->where('id_barang', $id);
        $update = $this->db->update('master_barang', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    //menghapus salah satu data master barang
    function index_delete()
    {
        $id = $this->delete('id_barang');
        $this->db->where('id_barang', $id);
        $delete = $this->db->delete('master_barang');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }


    //Masukan function selanjutnya disini

}
