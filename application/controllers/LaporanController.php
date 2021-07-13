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
        /*$id = $this->get('id_penjualan');
        //pdf
        
        if ($id == '') {
            $tokodita = $this->laporan->get_all()->result();
            $respon['status'] = true;
            $respon['message'] = "berhasil menampilkan laporan";
            $respon['data'] = $tokodita;
            $this->response($respon, 200);
        } else {
            $tokodita = $this->db->get_by_id('penjualan')->result();
            $respon['status'] = false;
            $respon['message'] = "gagal menampilkan laporan";
            $respon['data'] = $tokodita;
            $this->response($respon, 500);
        } */
        $this->load->library('pdf');
        $html = $this->load->view('GeneratePdfView', [], true);
        $this->pdf->createPDF($html, 'mypdf', false);
    }

    //menambah data laporan
    function index_post()
    {
        //Ambil data JSON dari request(exfront end)
        $request = json_decode(file_get_contents("php://input"));

        //ambil data laporan
        $id_penjualan = $request->id_penjualan;
        //$tanggal = date("Y-m-d H:i:s");

        $data = array(
            'id_penjualan'  => $id_penjualan
        );
        //proses simpan data
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
