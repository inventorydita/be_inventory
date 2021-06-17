<?php
/* file master barang model */

defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
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
        $this->db->insert($this->table, $data);
    }

    //untuk edit data
    function update($data)
    {
    }

    //untuk delete data
    function delete($data)
    {
    }

    //untuk menampilkan semua data
    function get_all($data)
    {
    }

    //untuk menampilkan data berdasarkan id
    function get_by_id($data)
    {
    }

    //untuk login user
    function login($data)
    {
    }
}
