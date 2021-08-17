<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class MasterBarangController extends REST_Controller
{

    function __construct($config = 'rest')
    {
        parent::__construct($config);
        $this->load->database();
        $this->load->model('Barang_model', 'barang');
    }

    //Menampilkan data master barang
    function index_get()
    {
        $id = $this->get('id_barang');
        if ($id == '') {
            $tokodita = $this->barang->get_all()->result();
            $respon['status'] = true;
            $respon['message'] = "berhasil mengambil semua data";
            $respon['data'] = $tokodita;
            $this->response($respon, 200);
        } else {
            //$this->db->where('id', $id);
            $tokodita = $this->barang->get_by_id($id)->result();
            $respon['status'] = true;
            $respon['message'] = "berhasil mengambil semua data";
            $respon['data'] = $tokodita;
            $this->response($respon, 200);
        }
    }

    //mengirim atau menambah data master barang baru
    function index_post()
    {
        //Ambil data JSON dari request(exfront end)
        $request = json_decode(file_get_contents("php://input"));

        //Ambil data barang
        $nama_barang = $request->nama_barang;
        $id_satuan = $request->id_satuan;
        $harga_modal = $request->harga_modal;
        $harga_jual = $request->harga_jual;


        $data = array(
            'nama_barang' => $nama_barang,
            'id_satuan' => $id_satuan,
            'harga_modal' => $harga_modal,
            'harga_jual' => $harga_jual,
            'kode_barang'   => $this->barang->kode_barang()
        );
        //proses simpan data
        $insert = $this->barang->post($data);
        if ($insert) {
            $respon['status'] = true;
            $respon['message'] = "berhasil menambahkan data";
            $respon['data'] = $data;
            $this->response($respon, 200);
        } else {
            $respon['status'] = false;
            $respon['message'] = "gagal menambahkan data";
            $respon['data'] = $data;
            $this->response($respon, 500);
        }
    }

    //memperbarui data master barang/edit
    function index_put()
    {
        //Ambil data JSON dari request(exfront end)
        $request = json_decode(file_get_contents("php://input"));

        //Ambil data barang
        $nama_barang = $request->nama_barang;
        $id_satuan = $request->id_satuan;
        $harga_modal = $request->harga_modal;
        $harga_jual = $request->harga_jual;

        $id = $request->id_barang;
        $data = array(
            'nama_barang' => $nama_barang,
            'id_satuan' => $id_satuan,
            'harga_modal' => $harga_modal,
            'harga_jual' => $harga_jual
        );
        $put = $this->barang->put($data, $id);
        if ($put) {
            $respon['status'] = true;
            $respon['message'] = "berhasil mengubah data";
            $respon['data'] = $data;
            $this->response($respon, 200);
        } else {
            $respon['status'] = false;
            $respon['message'] = "gagal mengubah data";
            $respon['data'] = $data;
            $this->response($respon, 500);
        }
    }

    //menghapus salah satu data master barang
    function index_delete()
    {
        $id = $this->delete('id_barang');
        $delete = $this->barang->delete($id);
        if ($delete) {
            $respon['status'] = true;
            $respon['message'] = "berhasil mengubah data";
            $respon['data'] = $delete;
            $this->response($respon, 200);
            //$this->response(array('status' => 'success'), 201);
        } else {
            $respon['status'] = false;
            $respon['message'] = "gagal mengubah data";
            $respon['data'] = $delete;
            $this->response($respon, 500);
            //$this->response(array('status' => 'fail', 502));
        }
    }


    //Masukan function selanjutnya disini

}
