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
		//$this->db->from('penjualan');
		//$this->db->join('master_barang', 'master_barang.id_barang = penjualan.id_barang');
		$this->db->where('tanggal >=', $from_date);
		$this->db->where('tanggal <=', $to_date);
		$data =  $this->db->get($this->table);
		return $data;
	}
}
