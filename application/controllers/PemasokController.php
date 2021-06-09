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
    }

    //Menampilkan data master pemasok
    function index_get()
    {
        $id = $this->get('id_pemasok');
        if ($id == '') {
            $tokodita = $this->db->get('pemasok')->result();
        } else {
            $this->db->where('id', $id);
            $tokodita = $this->db->get('pemasok')->result();
        }
        var_dump($tokodita);
        $this->response($tokodita, 200);
    }

    //mengirim atau menambah data pemasok baru
    function index_post()
    {
        $data = array(
            'id_pemasok'     => $this->post('id_pemasok'),
            'nama_pemasok'   => $this->post('nama_pemasok'),
            'alamat'     => $this->post('alamat'),
            'kota'    => $this->post('kota'),
            'telepon'   => $this->post('telepon')
        );
        $insert = $this->db->insert('pemasok', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    //memperbarui data master pemasok
    function index_put()
    {
        $id = $this->put('id_pemasok');
        $data = array(
            'id_pemasok'     => $this->put('id_pemasok'),
            'nama_pemasok'   => $this->put('nama_pemasok'),
            'alamat'     => $this->put('alamat'),
            'kota'    => $this->put('kota'),
            'telepon'   => $this->put('telepon')
        );
        $this->db->where('id_pemasok', $id);
        $update = $this->db->update('pemasok', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    //menghapus salah satu data pemasok
    function index_delete()
    {
        $id = $this->delete('id_pemasok');
        $this->db->where('id_pemasok', $id);
        $delete = $this->db->delete('pemasok');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }


    //Masukan function selanjutnya disini

}
