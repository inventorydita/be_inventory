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
		$data = $this->db->get();
		return $data;
	}
}
