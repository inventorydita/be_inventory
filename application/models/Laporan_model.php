<?php
/* file laporan */

defined('BASEPATH') or exit('No direct script access allowed');

class Laporan_model extends CI_Model
{
	public $table = 'penjualan';
	public $id = 'id_penjualan';

	function __construct()
	{
		parent::__construct();
	}

	//untuk menampilkan laporan
	function get_all()
	{
		$this->db->select('*');
		$this->db->from('penjualan');
		//$this->db->join('master_barang', 'master_barang.id_pembelian = penjualan.id_pembelian');
		$data = $this->db->get();
		return $data;
	}

	function get_by_date($from_date, $to_date)
	{
		$this->db->select('*');
		$this->db->from('detail_penjualan');
		$this->db->join('penjualan as p', 'p.id_penjualan = detail_penjualan.id_penjualan');
		$this->db->join('master_barang', 'master_barang.id_barang = detail_penjualan.id_barang');
		$this->db->join('satuan', 'satuan.id_satuan = master_barang.id_satuan');
		$this->db->where('p.tanggal >=', $from_date);
		$this->db->where('p.tanggal <=', $to_date);
		$data =  $this->db->get($this->table);
		return $data;
	}
}
