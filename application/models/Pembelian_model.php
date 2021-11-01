<?php
/* file pembelian model */

defined('BASEPATH') or exit('No direct script access allowed');

class Pembelian_model extends CI_Model
{
    public $table = 'pembelian';
    public $id = 'id_pembelian';

    function __construct()
    {
        parent::__construct();
    }

    //untuk menampilkan semua data
    function get_all()
    {
        $this->db->select('*');
        $this->db->from('pembelian');
        $this->db->join('pemasok', 'pemasok.id_pemasok = pembelian.id_pemasok');
        $data = $this->db->get();
        return $data;
    }

    function get_detail_pembelian()
    {
        $this->db->select('*');
        $this->db->from('detail_pembelian');
        $this->db->join('pembelian','pembelian.id_pembelian = detail_pembelian.id_detail_pembelian');
        $this->db->join('master_barang', 'master_barang.id_barang = detail_pembelian.id_detail+pembelian');
        $this->db->where('pembelian.id_pembelian', $id);
        $data = $this->db->get();
        return $data;
    }
    //untuk menampilkan data berdasarkan id
    function get_by_id($id)
    {
        $this->db->select('*');
        $this->db->from('pembelian');
        $this->db->join('pemasok', 'pemasok.id_pemasok = pembelian.id_pemasok');
        $this->db->where('pembelian.id_pembelian', $id);
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

    //menyimpan banyak barang sekaligus
    function bulk_insert($data)
    {
        return $this->db->insert_batch('detail_pembelian', $data);
    }

    //untuk menghapus data
    function delete($id)
    {
        $this->db->where('id_pembelian', $id);
        $delete = $this->db->delete($this->table);
        return $delete;
    }

    //search
    function search($katakunci)
    {
        $this->db->select('*');
        $this->db->from('pembelian');
        $this->db->like('nomor_nota', $katakunci);
        $data = $this->db->get();
        return $data;
    }
}
