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
            $this->response($respon, 200);
        } else {
            $tokodita = $this->pemasok->get_by_id($id)->result();
            $respon['status'] = true;
            $respon['message'] = "berhasil mengambil semua data";
            $respon['data'] = $tokodita;
            $this->response($respon, 200);
        }
    }

    //mengirim atau menambah data pemasok baru
    function index_post()
    {
        //Ambil data JSON dari request(exfront end)
        $request = json_decode(file_get_contents("php://input"));

        //Ambil data pemasok
        $nama_pemasok = $request->nama_pemasok;
        $alamat = $request->alamat;
        $kota = $request->kota;
        $telepon = $request->telepon;

        $data = array(
            'nama_pemasok'  => $nama_pemasok,
            'alamat'        => $alamat,
            'kota'          => $kota,
            'telepon'       => $telepon
        );
        //proses simpan data
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

    //memperbarui data master pemasok
    function index_put()
    {
        //Ambil data JSON dari request(exfront end)
        $request = json_decode(file_get_contents("php://input"));

        //ammbil data pemasok
        $nama_pemasok = $request->nama_pemasok;
        $alamat = $request->alamat;
        $kota = $request->kota;
        $telepon = $request->telepon;


        $id = $request->id_pemasok;
        $data = array(
            'nama_pemasok'  => $nama_pemasok,
            'alamat'        => $alamat,
            'kota'          => $kota,
            'telepon'       => $telepon
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
    }


    //menghapus salah satu data pemasok
    function index_delete()
    {
        $request = json_decode(file_get_contents("php://input"));
        $id = $request->id_pemasok;
        $delete = $this->pemasok->delete($id);
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
