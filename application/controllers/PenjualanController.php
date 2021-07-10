<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class PenjualanController extends REST_Controller
{

    function __construct($config = 'rest')
    {
        parent::__construct($config);
        $this->load->database();
        $this->load->model('Penjualan_model', 'penjualan');
    }

    //Menampilkan data penjualan
    function index_get()
    {
        $id = $this->get('id_penjualan');
        if ($id == '') {
            $tokodita = $this->penjualan->get_all()->result();
            $respon['status'] = true;
            $respon['message'] = "berhasil menampilkan semua data";
            $respon['data'] = $tokodita;
        } else {
            $this->db->where('id', $id);
            $tokodita = $this->db->get_by_id('penjualan')->result();
            $respon['status'] = false;
            $respon['message'] = "gagal menampilkan semua data";
            $respon['data'] = $tokodita;
        }
        $this->response($respon, 200);
    }

    //mengirim atau menambah data penjualan
    function index_post()
    {
        //AMBIL DATA JSON DARI REQUEST(EXFRONT END)
        $request = json_decode(file_get_contents("php://input"));
        $date = new DateTime();
        //ambil data penjualan
        $id_penjualan = $date->getTimestamp();
        $nomor_nota = $request->nomor_nota;
        $tanggal = date("Y-m-d H:i:s");
        $subtotal = $request->subtotal;
        $detail_penjualan = $request->detail_penjualan;

        $data = array(
            'nomor_nota'     => $nomor_nota,
            'subtotal'     => $subtotal,
            'tanggal'      => $tanggal,
            'id_penjualan' => $id_penjualan
        );
        $insert = $this->penjualan->post($data);
        if ($insert) {
            $final_data = [];
            //masukkan masing-masing data ke object untuk ke database
            foreach ($detail_penjualan as $detail) {
                array_push(
                    $final_data,
                    array(
                        'id_penjualan' => $id_penjualan,
                        'id_barang' => $detail->id_barang,
                        'harga_jual' => $detail->harga_jual,
                        'quantity' => $detail->quantity
                    )
                );
            }
            $insert_detail = $this->penjualan->bulk_insert($final_data);
            if ($insert_detail) {
                $respon['status'] = true;
                $respon['message'] = "berhasil menambahkan data";
                $respon['data'] = $data;
                $this->response($respon, 200);
            }else{
                $respon['status'] = true;
                $respon['message'] = "berhasil menambahkan data";
                $respon['data'] = $data;
                $this->response($respon, 200);
            }
        } else {
            $respon['status'] = false;
            $respon['message'] = "gagal menambahkan data";
            $respon['data'] = $data;
            $this->response($respon, 500);
        }
        
    }

    //memperbarui data penjualan
    function index_put()
    {
         $request = json_decode(file_get_contents("php://input"));
         var_dump($request);
         die();
        $id = $this->put('id_penjualan');
        $data = array(
            'nomor_nota'     => $this->post('nomor_nota'),
            'subtotal'     => $this->post('subtotal'),
            'tanggal'      => $this->post('tanggal')
        );
        $put = $this->penjualan->put($data, $id);
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
        $put = $this->detail_penjualan->put($data, $id);
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

    //menghapus salah satu data penjualan
    function index_delete()
    {
        $id = $this->delete('id_penjualan');
        $delete = $this->penjualan->delete($id);
        if ($delete) {
            $respon['status'] = true;
            $respon['message'] = "berhasil menghapus data";
            $respon['data'] = $delete;
            $this->response($respon, 200);
        } else {
            $respon['status'] = false;
            $respon['message'] = "gagal menghapus data";
            $respon['data'] = $delete;
            $this->response($respon, 200);
        }
        $id = $this->delete('id_detail_penjualan');
        $delete = $this->detail_penjualan->delete($id);
        if ($delete) {
            $respon['status'] = true;
            $respon['message'] = "berhasil menghapus data";
            $respon['data'] = $delete;
            $this->response($respon, 200);
        } else {
            $respon['status'] = false;
            $respon['message'] = "gagal menghapus data";
            $respon['data'] = $delete;
            $this->response($respon, 200);
        }
    }


    //Masukan function selanjutnya disini
}
