<?php
/* file satuan model */

defined('BASEPATH') or exit('No direct script access allowed');

class Todolist_model extends CI_Model
{
    public $table = 'todolist';
    public $id = 'id_todolist';

    function __construct()
    {
        parent::__construct();
    }

    //untuk menampilkan semua data
    function get_all()
    {
        $this->db->select('*');
        $this->db->from('todolist');
        $data = $this->db->get();
        return $data;
    }

    //untuk menampilkan data berdasarkan id
    function get_by_id($id)
    {
        $this->db->select('*');
        $this->db->from('todolist');
        $this->db->where('id_todolist', $id);
        $data = $this->db->get();
        return $data;
    }

    //untuk mengedit data
    function put($data, $id)
    {
        $this->db->where('id_todolist', $id);
        $update = $this->db->update($this->table, $data);
        return $update;
    }

    function selesai_put($data, $id)
    {
        $this->db->where('id_todolist', $id);
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
        $this->db->where('id_todolist', $id);
        $delete = $this->db->delete($this->table);
        return $delete;
    }

}
