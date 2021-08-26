<?php
/* file penjualan */

defined('BASEPATH') or exit('No direct script access allowed');

class Penjualan_model extends CI_Model
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
        //$this->db->join('master_barang', 'master_barang.id_barang = penjualan.id_barang');
        $data = $this->db->get();
        return $data;
    }

    //untuk menampilkan data berdasarkan id
    function get_by_id($id)
    {
        //ambil data penjualannya
        $penjualan = $this->db->select('*');
        $penjualan = $this->db->from('penjualan');
        $penjualan = $this->db->where('id_penjualan',$id);
        $penjualan = $this->db->get()->result()


        //ambil barang apa aja sih yang dibeli ?
        $list_yang_dibeli = $this->db->select('*');
        $list_yang_dibeli = $this->db->from('detail_penjualan');
        $list_yang_dibeli = $this->db->join('penjualan', 'penjualan.id_penjualan = detail_penjualan.id_penjualan');
        $list_yang_dibeli = $this->db->join('master_barang', 'master_barang.id_barang = detail_penjualan.id_barang');
        $list_yang_dibeli = $this->db->where('penjualan.id_penjualan', $id);
        $list_yang_dibeli = $this->db->get()->result();

        $data['penjualan'] = $penjualan;
        $data['barang_yang_dibeli'] = $list_yang_dibeli;
        return $data;
    }

    //untuk mengedit data
    function put($data, $id)
    {
        $this->db->where('id_penjualan', $id);
        $update = $this->db->update($this->table, $data);
        return $update;
    }

    //untuk menambah data
    function post($data)
    {
        $insert = $this->db->insert($this->table, $data);
        return $insert;
    }
    //bulk insert
    function bulk_insert($data)
    {
        return $this->db->insert_batch('detail_penjualan', $data);
    }

    //untuk menghapus data
    function delete($id)
    {
        $this->db->where('id_penjualan', $id);
        $delete = $this->db->delete($this->table);
        return $delete;
    }
}
