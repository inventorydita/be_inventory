<?php
/* file user model */

defined('BASEPATH') or exit('No direct script access allowed');

class LoginController extends CI_Model
{
    public $table = 'user';
    public $id = 'id_user';

    function __construct()
    {
        parent::__construct();
    }

    //untuk insert data user
    function insert($data)
    {
        $this->db->select('*');
        $this->db->from('user');
        $data = $this->db->get();
        return $data;
    }
    //untuk menampilkan data berdasarkan id
    function get_by_id($id)
    {
        $this->db->select('*');
        $this->db->from('user');
        $data = $this->db->get();
        return $data;
    }

    //untuk mengedit data
    function put($data, $id)
    {
        $this->db->where('id_user', $id);
        $update = $this->db->update($this->table, $data);
        return $update;
    }

    //untuk menambah data
    function post($data)
    {
        $insert = $this->db->insert($this->table, $data);
        return $insert;
    }

    //untuk menghapus data
    function delete($id)
    {
        $this->db->where('id_user', $id);
        $delete = $this->db->delete($this->table);
        return $delete;
    }
}
