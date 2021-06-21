<?php
/* file master barang model */

defined('BASEPATH') or exit('No direct script access allowed');

class Barang_model extends CI_Model
{
    public $table = 'master_barang';
    public $id = 'id_barang';

    function __construct()
    {
        parent::__construct();
    }

    //untuk menampilkan semua data
    function get_all()
    {
        $this->db->select('*');
        $this->db->from('master_barang');
        $this->db->join('satuan', 'satuan.id_satuan = master_barang.id_satuan');
        $this->db->join('pemasok', 'pemasok.id_pemasok = master_barang.id_pemasok');
        $data = $this->db->get();
        return $data;
    }

    //untuk menampilkan data berdasarkan id
    function get_by_id($id)
    {
        $this->db->select('*');
        $this->db->from('master_barang');
        $this->db->join('satuan', 'satuan.id_satuan = master_barang.id_satuan');
        $this->db->join('pemasok', 'pemasok.id_pemasok = master_barang.id_pemasok');
        $this->db->where('master_barang.id_barang', $id);
        $data = $this->db->get();
        return $data;
    }

    //untuk mengedit data
    function put($data, $id)
    {
        $this->db->where('id_barang', $id);
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
        $this->db->where('id_barang', $id);
        $delete = $this->db->delete($this->table);
        return $delete;
    }
}
