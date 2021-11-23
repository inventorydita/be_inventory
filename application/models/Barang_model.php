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
        $data = $this->db->get();
        return $data;
    }

    //untuk menampilkan data berdasarkan id
    function get_by_id($id)
    {
        $this->db->select('*');
        $this->db->from('master_barang');
        $this->db->join('satuan', 'satuan.id_satuan = master_barang.id_satuan');
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

    //untuk menambah kode
    function kode_barang()
    {
        $this->db->select('RIGHT(master_barang.kode_barang,5) as kode_barang', FALSE);
        $this->db->order_by('kode_barang', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('master_barang');
        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $kode = intval($data->kode_barang) + 1;
        } else {
            $kode = 1;
        }
        $batas = str_pad($kode, 5, "0", STR_PAD_LEFT);
        $kodetampil = "TD" . $batas;
        return $kodetampil;
    }

    //untuk menghapus data
    function delete($id)
    {
        $this->db->where('id_barang', $id);
        $delete = $this->db->delete($this->table);
        return $delete;
    }

    //untuk stok barang
    function stok_barang()
    {
    }

    //function search
    function search($katakunci)
    {
        $this->db->select('*');
        $this->db->from('master_barang');
        $this->db->like('nama_barang', $katakunci);
        $data = $this->db->get();
        return $data;
    }

    function count_get()
    {
        $sql = "SELECT *, COUNT(id_barang) FROM master_barang";
        $result = $this->db->query($sql);
        return $result;
    }
}
