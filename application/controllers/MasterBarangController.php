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
        $this->load->model('Barang_model', 'barang');
    }

    //Menampilkan data master barang
    function index_get()
    {
        $id = $this->get('id_barang');
        if ($id == '') {
            $tokodita = $this->barang->get_all()->result();
            $respon['status'] = true;
            $respon['message'] = "berhasil mengambil semua data";
            $respon['data'] = $tokodita;
        } else {
            $this->db->where('id', $id);
            $tokodita = $this->db->get_by_id()->result();
            $respon['status'] = false;
            $respon['message'] = "gagal mengambil semua data";
            $respon['data'] = $tokodita;
        }
        $this->response($respon, 200);
    }

    //mengirim atau menambah data master barang baru
    function index_post()
    {
        $this->load->helper('form', 'php');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('nama_barang', 'Nama Barang', 'required');
        $this->form_validation->set_rules('id_satuan', 'Satuan', 'required');
        $this->form_validation->set_rules('id_pemasok', 'Pemasok', 'required');
        $this->form_validation->set_rules('harga_modal', 'Harga Modal', 'required');
        $this->form_validation->set_rules('harga_jual', 'Harga Jual', 'required');



        if ($this->form_validation->run() == FALSE) {
            $this->response(array('status' => 'fail,isi sesuai format', 502));
        } else {
            $data = array(
                'id_barang'     => $this->post('id'),
                'nama_barang'   => $this->post('nama_barang'),
                'id_satuan'     => $this->post('id_satuan'),
                'id_pemasok'    => $this->post('id_pemasok'),
                'harga_modal'   => $this->post('harga_modal'),
                'harga_jual'    => $this->post('harga_jual'),
                'kode_barang'   => $this->post('kode_barang')
            );
            $insert = $this->barang->post($data);
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

    //memperbarui data master barang/edit
    function index_put()
    {

        /*$this->load->helper('form', 'url');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('nama_barang', 'Nama Barang', 'required');
        $this->form_validation->set_rules('id_satuan', 'Satuan', 'required');
        $this->form_validation->set_rules('id_pemasok', 'Pemasok', 'required');
        $this->form_validation->set_rules('harga_modal', 'Harga Modal', 'required');
        $this->form_validation->set_rules('harga_jual', 'Harga Jual', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->response(array('status' => 'fail,isi sesuai format', 502));
        } else {*/
        $id = $this->put('id_barang');
        $data = array(
            'id_barang'     => $this->put('id_barang'),
            'nama_barang'   => $this->put('nama_barang'),
            'id_satuan'     => $this->put('id_satuan'),
            'id_pemasok'    => $this->put('id_pemasok'),
            'harga_modal'   => $this->put('harga_modal'),
            'harga_jual'    => $this->put('harga_jual')
        );
        $put = $this->barang->put($data, $id);
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

    //menghapus salah satu data master barang
    function index_delete()
    {
        $id = $this->delete('id_barang');
        $delete = $this->barang->delete($id);
        if ($delete) {
            $respon['status'] = true;
            $respon['message'] = "berhasil mengubah data";
            $respon['data'] = $delete;
            $this->response(array('status' => 'success'), 201);
        } else {
            $respon['status'] = false;
            $respon['message'] = "gagal mengubah data";
            $respon['data'] = $delete;
            $this->response(array('status' => 'fail', 502));
        }
    }


    //Masukan function selanjutnya disini

}
