<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class UserController extends REST_Controller
{

    function __construct($config = 'rest')
    {
        parent::__construct($config);
        $this->load->database();
        $this->load->model('User_model', 'user');
    }

    //Menampilkan data user
    function index_get()
    {
        $id = $this->get('id_user');
        if ($id == '') {
            $tokodita = $this->user->get_all()->result();
            $respon['status'] = true;
            $respon['message'] = "berhasil menampilkan semua data";
            $respon['data'] = $tokodita;
            $this->response($respon, 200);
        } else {
            $this->db->where('id', $id);
            $tokodita = $this->db->get_by_id('user')->result();
            $respon['status'] = true;
            $respon['message'] = "berhasil menampilkan semua data";
            $respon['data'] = $tokodita;
            $this->response($respon, 500);
        }
    }

    //mengirim atau menambah data user
    function index_post()
    {
        //Ambil data JSON dari request(exfront end)
        $request = json_decode(file_get_contents("php://input"));

        //Ambil data user
        $username = $request->username;
        $email = $request->email;
        $password = $request->password;
        $level = $request->level;

        $data = array(
            'username'   => $username,
            'email'      => $email,
            'password'   => $password,
            'level'      => $level
        );

        //proses simpan data
        $insert = $this->user->post($data);
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

    //memperbarui data user
    function index_put()
    {
        $id = $this->put('id_user');
        $data = array(
            'id_user'    => $this->put('id_user'),
            'username'   => $this->put('username'),
            'email'      => $this->put('email'),
            'password'   => $this->put('password'),
            'level'      => $this->put('level')
        );
        $put = $this->user->put($data, $id);
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

    //menghapus salah satu data user
    function index_delete()
    {
        $id = $this->delete('id_user');
        $delete = $this->user->delete($id);
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
