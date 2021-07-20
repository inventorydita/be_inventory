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
        /* $this->load->library('pdf');
        $html = $this->load->view('GeneratePdfView', [], true);
        $this->pdf->createPDF($html, 'mypdf', false); */

        $daritanggal = $this->get('daritanggal');
        $sampaitanggal = $this->get('sampaitanggal');
        //var_dump($daritanggal);
        //die();
        $data = $this->laporan->get_by_date($daritanggal, $sampaitanggal);
        if ($data) {
            $respon['status'] = true;
            $respon['message'] = "berhasil menampilkan laporan";
            $respon['data'] = $data->result();
            $this->response($respon, 200);
        } else {
            $respon['status'] = false;
            $respon['message'] = "gagal menampilkan laporan";
            $respon['data'] = $data;
            $this->response($respon, 500);
        }
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
