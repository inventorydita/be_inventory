<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class SatuanController extends REST_Controller
{

    function __construct($config = 'rest')
    {
        parent::__construct($config);
        $this->load->database();
        $this->load->model('Satuan_model', 'satuan');
    }

    //Menampilkan data satuan
    function index_get()
    {

        $id = $this->get('id_satuan');
        if ($id == '') {
            $tokodita = $this->satuan->get_all()->result();
            $respon['status'] = true;
            $respon['message'] = "berhasil menampilkan semua data";
            $respon['data'] = $tokodita;
        } else {
            $this->db->where('id', $id);
            $tokodita = $this->db->get_by_id('satuan')->result();
            $respon['status'] = true;
            $respon['message'] = "berhasil menampilkan semua data";
            $respon['data'] = $tokodita;
        }
        $this->response($respon, 200);
    }

    //mengirim atau menambah data satuan
    function index_post()
    {
        $this->load->helper('form', 'url');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('nama_satuan', 'Nama Satuan', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->response(array('status' => 'fail,isi sesuai format', 502));
        } else {
            $data = array(
                'id_satuan'    => $this->post('id_satuan'),
                'nama_satuan'  => $this->post('nama_satuan')
            );
            $insert = $this->satuan->post($data);
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

    //memperbarui data master satuan
    function index_put()
    {
        /*$this->load->helper('form', 'url');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('nama_satuan', 'Nama Satuan', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->response(array('status' => 'fail,isi sesuai format', 502));
        } else { */
        $id = $this->put('id_satuan');
        $data = array(
            'id_satuan'    => $this->put('id_satuan'),
            'nama_satuan'  => $this->put('nama_satuan')
        );
        $put = $this->satuan->put($data, $id);
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

    //menghapus salah satu data satuan
    function index_delete()
    {

        $id = $this->delete('id_satuan');
        $this->db->where('id_satuan', $id);
        $delete = $this->satuan->delete($id);
        if ($delete) {
            $respon['status'] = true;
            $respon['message'] = "berhasil menghapus data";
            $respon['data'] = $delete;
            $this->response($respon, 200);
        } else {
            $respon['status'] = true;
            $respon['message'] = "berhasil menghapus data";
            $respon['data'] = $delete;
            $this->response($respon, 500);
        }
    }


    //Masukan function selanjutnya disini

}
