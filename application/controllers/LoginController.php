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

    //Menampilkan data user
    function index_get()
    {
        $id = $this->get('id_user');
        if ($id == '') {
            $tokodita = $this->user->get_all()->result();
        } else {
            $this->db->where('id', $id);
            $tokodita = $this->db->get('user')->result();
        }
        $this->response($tokodita, 200);
    }

    //mengirim atau menambah data user
    function index_post()
    {
        /* $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required', array('required' => 'You must provide a %s.'));
        $this->form_validation->set_rules('level', 'Level', 'required');


        if ($this->form_validation->run() == FALSE) {
            $this->response(array('status' => 'fail, isi sesuai format', 502));
        } else {*/
        $data = array(
            'id_user'    => $this->post('id_user'), -'username'   => $this->post('username'),
            'email'      => $this->post('email'),
            'password'   => $this->post('password'),
            'level'      => $this->post('level')
        );
        $insert = $this->user->insert($data); //$this->db->insert('login', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
        //}
    }

    //memperbarui data user
    function index_put()
    {
        $this->load->helper(array('form', 'url'));

        $this->load->library('form_validation');

        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('level', 'Level', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->response(array('status' => 'fail, isi sesuai format', 502));
        } else {
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
                $this->response($data, 200);
            } else {
                $this->response(array('status' => 'fail', 502));
            }
        }
    }

    //menghapus salah satu data user
    function index_delete()
    {
        $id = $this->delete('id_user');
        $this->db->where('id_user', $id);
        $delete = $this->user->delete('login');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }


    //Masukan function selanjutnya disini

}
