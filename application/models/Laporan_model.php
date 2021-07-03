<?php
/* file laporan */

defined('BASEPATH') or exit('No direct script access allowed');

class Laporan_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}

	//untuk menampilkan laporan
	function get_all()
	{
		$this->db->select('*');
		$this->db->from('penjualan');
		$this->db->join('master_barang', 'master_barang.id_barang = penjualan.id_barang');
		$data = $this->db->get();
		return $data;
	}

	function get_by_date()
	{
		$this->db->select('*');
		$this->db->from('penjualan');
		$this->db->join('master_barang', 'master_barang.id_barang = penjualan.id_barang');
		$this->db->from('(penjualan) where (tanggal) between ‘tanggal awal’ and ‘tanggal akhir');
		$data = $this->db->get();
		return $data;
	}
}
