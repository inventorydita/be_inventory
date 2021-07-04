<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class LaporanController extends REST_Controller
{

    function __construct($config = 'rest')
    {
        parent::__construct($config);
        $this->load->database();
        $this->load->model('Laporan_model', 'laporan');
    }

    //Menampilkan laporan
    function index_get()
    {

        $id = $this->get('id_penjualan');
        if ($id == '') {
            $tokodita = $this->laporan->get_all()->result();
            $respon['status'] = true;
            $respon['message'] = "berhasil menampilkan laporan";
            $respon['data'] = $tokodita;
        } else {
            $tokodita = $this->db->get_by_id('penjualan')->result();
            $respon['status'] = false;
            $respon['message'] = "gagal menampilkan laporan";
            $respon['data'] = $tokodita;
        }
        $this->response($respon, 500);
    }
    function index_post()
    {
        $this->load->helper('form', 'url');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->response(array('status' => 'fail,isi sesuai format', 502));
        } else {
            $data = array(
                'tanggal'      => $this->post('tanggal')
            );
            $insert = $this->laporan->post($data);
            if ($insert) {
                $respon['status'] = true;
                $respon['message'] = "berhasil menampilkan laporan";
                $respon['data'] = $data;
                $this->response($respon, 200);
            } else {
                $respon['status'] = false;
                $respon['message'] = "gagal menampilkan laporan";
                $respon['data'] = $data;
                $this->response($respon, 500);
            }
        }
    }
}
