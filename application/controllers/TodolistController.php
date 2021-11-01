<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class TodolistController extends REST_Controller
{

    function __construct($config = 'rest')
    {
        parent::__construct($config);
        $this->load->database();
        $this->load->model('Todolist_model', 'todolist');
    }

    //Menampilkan data Todolist
    function index_get()
    {

        $id = $this->get('id_todolist');
        if ($id == '') {
            $tokodita = $this->todolist->get_all()->result();
            $respon['status'] = true;
            $respon['message'] = "berhasil menampilkan semua data";
            $respon['data'] = $tokodita;
            $this->response($respon, 200);
        } else {
            $tokodita = $this->todolist->get_by_id($id)->result();
            $respon['status'] = true;
            $respon['message'] = "berhasil menampilkan semua data";
            $respon['data'] = $tokodita;
            $this->response($respon, 200);
        }
    }

    //mengirim atau menambah data Todolist
    function index_post()
    {
        //Ambil data JSON dari request(exfront end)
        $request = json_decode(file_get_contents("php://input"));

        //ambil data Todolist
        $nama = $request->nama;
        $selesai = 0;

        $data = array(
            'nama'  => $nama,
            'selesai' => $selesai
        );

        $insert = $this->todolist->post($data);
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

    //memperbarui data master Todolist
    function index_put()
    {
        //Ambil data JSON dari request(exfront end)
        $request = json_decode(file_get_contents("php://input"));

        //ambil data Todolist
        $nama = $request->nama;
        
        $id = $request->id_todolist;
        $data = array(
            'nama'  => $nama
        );
        $put = $this->todolist->put($data, $id);
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

    function selesai_put()
    {
        $request = json_decode(file_get_contents("php://input"));

        //ambil data Todolist
       
        $selesai = 1;
        
        $id = $request->id_todolist;
        $data = array(
            'selesai' => $selesai
        );
        $selesai_put = $this->todolist->selesai_put($data, $id);
        if ($selesai_put) {
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

    //menghapus salah satu data Todolist
    function index_delete($id)
    {
        //$request = json_decode(file_get_contents("php://input"));
        //$id = $request->id_Todolist;
        $delete = $this->todolist->delete($id);
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