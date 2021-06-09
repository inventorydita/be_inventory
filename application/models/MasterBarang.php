<?php
/* file master barang model */

defined('BASEPATH') or exit('No direct script access allowed');

class MasterBarang extends CI_Model
{
    public $table = 'master_barang';
    public $id = 'id_barang';

    function __construct()
    {
        parent::__construct();
    }

    //untuk insert data
    function insert($data)
    {
        $this->db->insert($this->table, $data);
    }
}
