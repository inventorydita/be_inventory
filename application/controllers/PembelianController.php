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
        $this->load->model('Pembelian_model', 'pembelian');
    }

    //Menampilkan data pembelian
    function index_get()
    {
        $id = $this->get('id_pembelian');
        if ($id == '') {
            $tokodita = $this->pembelian->get_all()->result();
            $respon['status'] = true;
            $respon['message'] = "berhasil mengambil semua data";
            $respon['data'] = $tokodita;
        } else {
            $this->db->where('id', $id);
            $tokodita = $this->db->get_by_id('pembelian')->result();
            $respon['status'] = false;
            $respon['message'] = "gagal mengambil semua data";
            $respon['data'] = $tokodita;
        }
        $this->response($respon, 200);
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
            $insert = $this->pembelian->post($data);
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

    //memperbarui data pembelian
    function index_put()
    {
        /*$this->load->helper('form', 'url');
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
        } else { */
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
        $put = $this->pembelian->put($data, $id);
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

    //menghapus salah satu data pembelian
    function index_delete()
    {
        $id = $this->delete('id_pembelian');
        $this->db->where('id_pembelian', $id);
        $delete = $this->pembelian->delete($id);
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
