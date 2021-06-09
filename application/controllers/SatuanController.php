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

    //Menampilkan data satuan
    function index_get()
    {
        $id = $this->get('id_satuan');
        if ($id == '') {
            $tokodita = $this->db->get('satuan')->result();
        } else {
            $this->db->where('id', $id);
            $tokodita = $this->db->get('satuan')->result();
        }
        $this->response($tokodita, 200);
    }

    //mengirim atau menambah data satuan
    function index_post()
    {
        $data = array(
            'id_satuan'     => $this->post('id_satuan'),
            'nama_satuan'   => $this->post('nama_satuan')
        );
        $insert = $this->db->insert('satuan', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    //memperbarui data master satuan
    function index_put()
    {
        $id = $this->put('id_satuan');
        $data = array(
            'id_satuan'     => $this->put('id_satuan'),
            'nama_satuan'   => $this->put('nama_satuan')
        );
        $this->db->where('id_satuan', $id);
        $update = $this->db->update('satuan', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    //menghapus salah satu data satuan
    function index_delete()
    {
        $id = $this->delete('id_satuan');
        $this->db->where('id_satuan', $id);
        $delete = $this->db->delete('satuan');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }


    //Masukan function selanjutnya disini

}
