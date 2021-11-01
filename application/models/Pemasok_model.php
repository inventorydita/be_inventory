<?php
/* file pemasok model */

defined('BASEPATH') or exit('No direct script access allowed');

class Pemasok_model extends CI_Model
{
    public $table = 'pemasok';
    public $id = 'id_pemasok';

    function __construct()
    {
        parent::__construct();
    }

    //untuk menampilkan semua data
    function get_all()
    {
        $this->db->select('*');
        $this->db->from('pemasok');
        $data = $this->db->get();
        return $data;
    }

    //untuk menampilkan data berdasarkan id
    function get_by_id($id)
    {
        $this->db->select('*');
        $this->db->from('pemasok');
        $this->db->where('id_pemasok', $id);
        $data = $this->db->get();
        return $data;
    }

    //untuk mengedit data
    function put($data, $id)
    {
        $this->db->where('id_pemasok', $id);
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
        $this->db->where('id_pemasok', $id);
        $delete = $this->db->delete($this->table);
        return $delete;
    }

    function search($katakunci)
    {
        $this->db->select('*');
        $this->db->from('pemasok');
        $this->db->like('nama_pemasok', $katakunci);
        $data = $this->db->get();
        return $data;
    }
}
