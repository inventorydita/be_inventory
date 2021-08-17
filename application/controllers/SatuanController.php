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
            $this->response($respon, 200);
        } else {
            $tokodita = $this->satuan->get_by_id($id)->result();
            $respon['status'] = false;
            $respon['message'] = "gagal menampilkan semua data";
            $respon['data'] = $tokodita;
            $this->response($respon, 500);
        }
    }

    //mengirim atau menambah data satuan
    function index_post()
    {
        //Ambil data JSON dari request(exfront end)
        $request = json_decode(file_get_contents("php://input"));

        //ambil data satuan
        $nama_satuan = $request->nama_satuan;

        $data = array(
            'nama_satuan'  => $nama_satuan
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

    //memperbarui data master satuan
    function index_put()
    {
        //Ambil data JSON dari request(exfront end)
        $request = json_decode(file_get_contents("php://input"));

        //ambil data satuan
        $nama_satuan = $request->nama_satuan;

        $id = $request->id_satuan;
        $data = array(
            'nama_satuan'  => $nama_satuan
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
            $respon['status'] = false;
            $respon['message'] = "gagal menghapus data";
            $respon['data'] = $delete;
            $this->response($respon, 500);
        }
    }


    //Masukan function selanjutnya disini

}
