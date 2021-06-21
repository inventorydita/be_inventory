<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class PemasokController extends REST_Controller
{

    function __construct($config = 'rest')
    {
        parent::__construct($config);
        $this->load->database();
        $this->load->model('Pemasok_model', 'pemasok');
    }

    //Menampilkan data master pemasok
    function index_get()
    {
        $id = $this->get('id_pemasok');
        if ($id == '') {
            $tokodita = $this->pemasok->get_all()->result();
            $respon['status'] = true;
            $respon['message'] = "berhasil mengambil semua data";
            $respon['data'] = $tokodita;
        } else {
            $this->db->where('id', $id);
            $tokodita = $this->db->get_by_id('pemasok')->result();
            $respon['status'] = true;
            $respon['message'] = "berhasil mengambil semua data";
            $respon['data'] = $tokodita;
        }
        $this->response($respon, 200);
    }

    //mengirim atau menambah data pemasok baru
    function index_post()
    {
        $this->load->helper('form', 'url');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('nama_pemasok', 'Nama Pemasok', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('kota', 'Kota', 'required');
        $this->form_validation->set_rules('telepon', 'Telepon', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->response(array('status' => 'fail,isi sesuai format', 502));
        } else {
            $data = array(
                'id_pemasok'    => $this->post('id_pemasok'),
                'nama_pemasok'  => $this->post('nama_pemasok'),
                'alamat'        => $this->post('alamat'),
                'kota'          => $this->post('kota'),
                'telepon'       => $this->post('telepon')
            );
            $insert = $this->pemasok->post($data);
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

    //memperbarui data master pemasok
    function index_put()
    {
        /*$this->load->helper('form', 'url');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('nama_pemasok', 'Nama Pemasok', 'required');
        $this->form_validation->set_rules($this->put('alamat'), 'Alamat', 'required');
        $this->form_validation->set_rules('kota', 'Kota', 'required');
        $this->form_validation->set_rules('telepon', 'Telepon', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->response(array('status' => 'fail,isi sesuai format', 502));
        } else {*/
        $id = $this->put('id_pemasok');
        $data = array(
            'id_pemasok'     => $this->put('id_pemasok'),
            'nama_pemasok'   => $this->put('nama_pemasok'),
            'alamat'         => $this->put('alamat'),
            'kota'           => $this->put('kota'),
            'telepon'        => $this->put('telepon')
        );
        $put = $this->pemasok->put($data, $id);
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


    //menghapus salah satu data pemasok
    function index_delete()
    {

        $id = $this->delete('id_pemasok');
        $delete = $this->pemasok->delete($id);
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
