<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class LoginController extends REST_Controller
{

    function __construct($config = 'rest')
    {
        parent::__construct($config);
        $this->load->database();
        $this->load->model('User_model', 'user');
    }

    function index_post()
    {
        //AMBIL DATA JSON DARI REQUEST(EXFRONT END)
        $request = json_decode(file_get_contents("php://input"));

        //ambil data 
        $username   = $request->username;
        $password   = $request->password;

        $data = array(
            'username' => $username,
            'password' => $password
        );
        $insert = $this->user->post($data);
        if ($insert) {
            $respon['status'] = true;
            $respon['message'] = "berhasil menambahkan data";
            $respon['data'] = $insert->result();
            $this->response($respon, 200);
        } else {
            $respon['status'] = false;
            $respon['message'] = "gagal menambahkan data";
            $respon['data'] = $insert->result();
            $this->response($respon, 500);
        }
    }
}
