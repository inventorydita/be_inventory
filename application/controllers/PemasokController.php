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
        } else {
            $this->db->where('id', $id);
            $tokodita = $this->db->get('pemasok')->result();
        }
        $this->response($tokodita, 200);
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
            $insert = $this->pemasok->insert($data);
            if ($insert) {
                $this->response($data, 200);
            } else {
                $this->response(array('status' => 'fail', 502));
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
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
        //} 
    }


    //menghapus salah satu data pemasok
    function index_delete()
    {

        $id = $this->delete('id_pemasok');
        $this->db->where('id_pemasok', $id);
        $delete = $this->pemasok->delete('pemasok');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }


    //Masukan function selanjutnya disini

}
