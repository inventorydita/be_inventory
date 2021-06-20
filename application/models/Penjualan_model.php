<?php
/* file penjualan */

defined('BASEPATH') or exit('No direct script access allowed');

class PenjualanController extends CI_Model
{
    public $table = 'penjualan';
    public $id = 'id_penjualan';

    function __construct()
    {
        parent::__construct();
    }

    //untuk menampilkan semua data
    function get_all()
    {
        $this->db->select('*');
        $this->db->from('penjualan');
        $this->db->join('master_barang', 'master_barang.id_barang = penjualan.id_barang');
        $data = $this->db->get();
        return $data;
    }

    //untuk menampilkan data berdasarkan id
    function get_by_id($id)
    {
        $this->db->select('*');
        $this->db->from('penjualan');
        $this->db->join('master_barang', 'master_barang.id_barang = penjualan.id_barang');
        $this->db->where('penjualan.id_penjualan', $id);
        $data = $this->db->get();
        return $data;
    }

    //untuk mengedit data
    function put($data, $id)
    {
        $this->db->where('id_pembelian', $id);
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
        $this->db->where('id_pembelian', $id);
        $delete = $this->db->delete($this->table);
        return $delete;
    }
}
