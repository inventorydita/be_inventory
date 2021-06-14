<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class PembelianController extends REST_Controller
{

    function __construct($config = 'rest')
    {
        parent::__construct($config);
        $this->load->database();
    }

    //Menampilkan data pembelian
    function index_get()
    {
        $id = $this->get('id_pembelian');
        if ($id == '') {
            $tokodita = $this->db->get('pembelian')->result();
        } else {
            $this->db->where('id', $id);
            $tokodita = $this->db->get('pembelian')->result();
        }
        $this->response($tokodita, 200);
    }

    //mengirim atau menambah data pembelian
    function index_post()
    {
        $this->load->helper('form', 'url');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('id_pemasok', 'Pemasok', 'required');
        $this->form_validation->set_rules('id_barang', 'Barang', 'required');
        $this->form_validation->set_rules('nomor_nota', 'Nomor Nota', 'required');
        $this->form_validation->set_rules('harga_modal', 'Harga Modal', 'required');
        $this->form_validation->set_rules('harga_jual', 'Harga Jual', 'required');
        $this->form_validation->set_rules('quantity', 'Quantity', 'required');
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->response(array('status' => 'fail,isi sesuai format', 502));
        } else {
            $data = array(
                'id_pembelian' => $this->post('id_pembelian'),
                'id_pemasok'   => $this->post('id_pemasok'),
                'id_barang'    => $this->post('id_barang'),
                'nomor_nota'   => $this->post('nomor_nota'),
                'harga_modal'  => $this->post('harga_modal'),
                'harga_jual'   => $this->post('harga_jual'),
                'quantity'     => $this->post('quantity'),
                'tanggal'      => $this->post('tanggal')
            );
            $insert = $this->db->insert('pembelian', $data);
            if ($insert) {
                $this->response($data, 200);
            } else {
                $this->response(array('status' => 'fail', 502));
            }
        }
    }

    //memperbarui data pembelian
    function index_put()
    {
        $this->load->helper('form', 'url');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('id_pemasok', 'Pemasok', 'required');
        $this->form_validation->set_rules('id_barang', 'Barang', 'required');
        $this->form_validation->set_rules('nomor_nota', 'Nomor Nota', 'required');
        $this->form_validation->set_rules('harga_modal', 'Harga Modal', 'required');
        $this->form_validation->set_rules('harga_jual', 'Harga Jual', 'required');
        $this->form_validation->set_rules('quantity', 'Quantity', 'required');
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->response(array('status' => 'fail,isi sesuai format', 502));
        } else {
            $id = $this->put('id_pembelian');
            $data = array(
                'id_pembelian' => $this->put('id_pembelian'),
                'id_pemasok'   => $this->put('id_pemasok'),
                'id_barang'    => $this->put('id_barang'),
                'nomor_nota'   => $this->put('nomor_nota'),
                'harga_modal'  => $this->put('harga_modal'),
                'harga_jual'   => $this->put('harga_jual'),
                'quantity'     => $this->put('quantity'),
                'tanggal'      => $this->put('tanggal')
            );
            $this->db->where('id_pembelian', $id);
            $update = $this->db->update('pembelian', $data);
            if ($update) {
                $this->response($data, 200);
            } else {
                $this->response(array('status' => 'fail', 502));
            }
        }
    }

    //menghapus salah satu data pembelian
    function index_delete()
    {
        $id = $this->delete('id_pembelian');
        $this->db->where('id_pembelian', $id);
        $delete = $this->db->delete('pembelian');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }


    //Masukan function selanjutnya disini

}
