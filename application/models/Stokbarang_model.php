<?php
/* file stok barang model */

defined('BASEPATH') or exit('No direct script access allowed');

class Stokbarang_model extends CI_Model
{
    public $table = 'stok_barang';
    public $id = 'id_stok_barang';

    function __construct()
    {
        parent::__construct();
    }

    //untuk menampilkan semua data
    function get_all()
    {
        $this->db->select('*');
        $this->db->from('stok_barang');
        $this->db->join('master_barang', 'master_barang.id_barang = stok_barang.id_barang');
        $data = $this->db->get();
        return $data;
    }

    //untuk menampilkan data berdasarkan id
    function get_by_id($id)
    {
        $this->db->select('*');
        $this->db->from('stok_barang');
        $data = $this->db->get();
        return $data;
    }
}
