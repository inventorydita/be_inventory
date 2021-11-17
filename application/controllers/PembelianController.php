<?php

defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class PembelianController extends REST_Controller
{

    function __construct($config = 'rest')
    {
        parent::__construct($config);
        $this->load->database();
        $this->load->model('Pembelian_model', 'pembelian');
    }

    //Menampilkan data pembelian
    function index_get()
    {
        $id = $this->get('id_pembelian');
        if ($id == '') {
            $tokodita = $this->pembelian->get_all()->result();
            $respon['status'] = true;
            $respon['message'] = "berhasil mengambil semua data";
            $respon['data'] = $tokodita;
            $this->response($respon, 200);
        } else {
            $tokodita = $this->pembelian->get_by_id($id)->result();
            $respon['status'] = true;
            $respon['message'] = "berhasil mengambil semua data";
            $respon['data'] = $tokodita;
            $respon['barang_yang_dibeli'] = $this->pembelian->get_detail_pembelian($id)->result();
            $this->response($respon, 200);

        }
    }

    //mengirim atau menambah data pembelian
    function index_post()
    {
        //AMBIL DATA JSON DARI REQUEST(EXFRONT END)
        $request = json_decode(file_get_contents("php://input"));
        $date = new DateTime();
        //ambil data pembelian
        $nomor_nota = $request->nomor_nota;
        $detail_pembelian = $request->detail_pembelian;
        $subtotal = $request->subtotal;
        $id_pemasok = $request->id_pemasok;

        $id_pembelian = $date->getTimestamp();
        $tanggal =  date("Y-m-d H:i:s");


        //  var_dump($id_pemasok);
        //ambil data detail pembelian

        //data yang disimpan ke db 
        $data = array(
            'id_pembelian' => $id_pembelian,
            'nomor_nota'   => $nomor_nota,
            'tanggal'      => $tanggal,
            'subtotal'     => $subtotal,
            'id_pemasok'   => $id_pemasok
        );
        //proses simpan data
        $insert = $this->pembelian->post($data);
        if ($insert) {
            $final_data = [];
            foreach ($detail_pembelian as $detail) {
                array_push(
                    $final_data,
                    array(
                        'id_barang' => $detail->id_barang,
                        'harga_modal' => $detail->harga_modal,
                        'harga_jual' => $detail->harga_jual,
                        'quantity' => $detail->quantity,
                        'id_pembelian' => $id_pembelian
                    )
                );
            }
            $insert_detail_pembelian = $this->pembelian->bulk_insert($final_data);
            if ($insert_detail_pembelian) {
                $respon['status'] = true;
                $respon['message'] = "berhasil menambahkan data";
                $respon['data'] = $data;
                $this->response($respon, 200);
            } else {
                $respon['status'] = false;
                $respon['message'] = "gagal menambahkan data detail";
                $respon['data'] = $data;
                $this->response($respon, 500);
            }
        } else {
            $respon['status'] = false;
            $respon['message'] = "gagal menambahkan data";
            $respon['data'] = $data;
            $this->response($respon, 500);
        }
    }

    //memperbarui data pembelian
    function index_put()
    {
        //Ambil data JSON dari request(exfront end)
        $request = json_decode(file_get_contents("php://input"));

        //ambil data pembelian json request
        $nomor_nota = $request->nomor_nota;
        $detail_pembelian = $request->detail_pembelian;
        $subtotal = $request->subtotal;
        $id_pemasok = $request->id_pemasok;
        $id_pembelian = $request->id_pembelian;
        $tanggal =  date("Y-m-d H:i:s");

        //siapkan data pembelian yang akan di update
        $data = array(
            'nomor_nota'   => $nomor_nota,
            'tanggal'      => $tanggal,
            'subtotal'     => $subtotal,
            'id_pemasok'   => $id_pemasok
        );
        //proses update
        $put = $this->pembelian->put($data, $id_pembelian);

        //jika update pembelian berhasil maka lanjut update detail pembelian
        if ($put) {
            
            //hapus data detail pembelian dengan id_pembelian yang diupdate 
            $delete_detail_pembelian = $this->pembelian->delete_detail_pembelian($id_pembelian);
            if($delete_detail_pembelian){

                $final_data = [];
                foreach ($detail_pembelian as $detail) {
                    array_push(
                        $final_data,
                        array(
                            'id_barang' => $detail->id_barang,
                            'harga_modal' => $detail->harga_modal,
                            'harga_jual' => $detail->harga_jual,
                            'quantity' => $detail->quantity,
                            'id_pembelian' => $id_pembelian
                        )
                    );
                }
                $update_detail_pembelian = $this->pembelian->bulk_insert($final_data);
                if ($update_detail_pembelian) {
                    $respon['status'] = true;
                    $respon['message'] = "berhasil menambahkan data";
                    $respon['data'] = $data;
                    $this->response($respon, 200);
                } else {
                    $respon['status'] = false;
                    $respon['message'] = "gagal menambahkan data detail";
                    $respon['data'] = $data;
                    $this->response($respon, 500);
                }
            }else{
                $respon['status'] = false;
                $respon['message'] = "Gagal merubah detail pembelian";
                $respon['data'] = $data;
                $this->response($respon, 500);
            }
           
        } else {
            $respon['status'] = false;
            $respon['message'] = "gagal mengubah data";
            $respon['data'] = $data;
            $this->response($respon, 500);
        }
    }

    //menghapus salah satu data pembelian
    function index_delete($id)
    {
       // $request = json_decode(file_get_contents("php://input"));
        //$id = $request->id_pembelian;
        $delete = $this->pembelian->delete($id);
        if ($delete) {
            $respon['status'] = true;
            $respon['message'] = "berhasil menghapus data";
            $respon['data'] = $delete;
            $this->response($respon, 200);
        } else {
            $respon['status'] = false;
            $respon['message'] = "gagal menghapus data";
            $respon['data'] = $delete;
            $this->response($respon, 500);
        }
        /*$id = $this->delete('id_detail_pembelian');
        $this->db->where('id_detail_pembelian', $id);
        $delete = $this->detail_pembelian->delete($id);
        if ($delete) {
            $respon['status'] = true;
            $respon['message'] = "berhasil menghapus data";
            $respon['data'] = $delete;
            $this->response($respon, 200);
        } else {
            $respon['status'] = false;
            $respon['message'] = "gagal menghapus data";
            $respon['data'] = $delete;
            $this->response($respon, 500);
        }*/
    }


    //Masukan function selanjutnya disini
    function search_get()
    {
        $nomor_nota = $this->get('nomor_nota');
        //var_dump($nama);
        //die();
        $data = $this->pembelian->search($nomor_nota);
        $respon['status'] = true;
        $respon['message'] = "berhasil mengambil data";
        $respon['data'] = $data->result();
        $this->response($respon, 200);
    }

}
