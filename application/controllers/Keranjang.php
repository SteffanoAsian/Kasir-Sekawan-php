<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Keranjang extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model([
            "Barang_model" => "Barang",
            "Keranjang_model" => "Keranjang",
            "Transaksi_model" => "Transaksi"
        ]); //load model

        if(!$this->session->userdata('id')){
            redirect('index.php/login');
        }
    }
    
    public function edit($id = null)
    {
        // if (!isset($id)) redirect('keranjang');
        $data_keranjang= $this->Keranjang->getById($id);
        // $barang = $this->Barang->getByID($data_keranjang->keranjang_barang_id);

        $data=[
            "data_keranjang" => $data_keranjang,
            "data_barang" => $this->Barang->getByID($data_keranjang->keranjang_barang_id)
        ];
        // print_r($data);exit;

        $this->load->view('templates/header');
        $this->load->view('templates/navbar');
        $this->load->view('keranjang/form_edit', $data);
        $this->load->view('templates/footer');
    }

    public function actionEdit()
    {
        $opration = false;
        $message = "";
        
        $data = array(
            "keranjang_jml_beli" => $this->input->post('jml')
        );
        // print_r($data);exit;

            $opration = $this->Keranjang->update(array('keranjang_id' => $this->input->post('keranjang_id')), $data);
            if ($opration == true) {
                $message = "Keranjang berhasil di-edit";
            } else {
                $message = "Keranjang gagal di-edit";
            }

        $this->session->set_flashdata('message', $message);
            redirect('index.php/transaksi/layout');
    }

    public function delete($id)
    {
        $message="";
        $keranjang = $this->Keranjang->getById($id);
        $barang = $this->Barang->getbyId($keranjang->keranjang_barang_id);

        $dataup = array(
            "barang_stock" => (float) $barang->barang_stock + $keranjang->keranjang_jml_beli
        );

        if ($dataup==true) {
            $opr =$this->Barang->update(array(
                'barang_id' => $keranjang->keranjang_barang_id
            ), $dataup);
            
            if ($opr == true) {
                $message = "Keranjang berhasil di-update";
                $this->Keranjang->delete($id);
            } else {
                $message = "Keranjang gagal di-update";
            }
        }
        $this->session->set_flashdata('message', $message);
        redirect('index.php/transaksi/layout');
    }

    public function action()
    {
        // ambil data dari form dan masukkan ke variable $data
        $data = $this->input->post();

        $opr = false;
        $message = "";
        $barang =$this->Barang->getByID($data['namaBarang']);
        // print_r($barang);exit;
        $dataIns = array(
            "keranjang_barang_id" => $data['namaBarang'],
            "keranjang_jml_beli" => $data['jumlah'],
            "keranjang_harga" =>$barang->barang_harga,
            "keranjang_user_id" => $this->session->userdata('id'),
        );

        $dataup = array(
            "barang_stock" => (float) $barang->barang_stock - $data['jumlah']
        );


        // print_r($dataIns);exit;

        $validation = $this->form_validation;
        $validation->set_rules($this->Transaksi->rules());
        if ($message == "") {
            /** ambil dari table keranjang by id barang
             *  jika datanya ada, maka update data keranjang by keranjang id
             *  jika tidak maka tambah
             **/
            $cekbarang= $this->Keranjang->getWhere(['keranjang_barang_id' => $barang->barang_id]);
            if(count($cekbarang) > 0){
                if($data['keranjang_id']){
                    $dataup['barang_stock'] += (int) $cekbarang[0]->keranjang_jml_beli;
                    $upKeranjang = array(
                        "keranjang_jml_beli" => $data['jumlah']
                    );
                }else{
                    $upKeranjang = array(
                        "keranjang_jml_beli" => (float)$cekbarang[0]->keranjang_jml_beli  + $data['jumlah']
                    );
                }
                
                $opr=$this->Keranjang->update(array(
                    'keranjang_barang_id'=>$barang->barang_id
                ), $upKeranjang);
            }else{
                $opr = $this->Keranjang->save($dataIns);
            }

            if ($opr == true) {
                $message = "Keranjang berhasil di-update";
                $this->Barang->update(array(
                    'barang_id' => $data['namaBarang']
                ), $dataup);
            } else {
                $message = "Keranjang gagal di-update";
            }
        }
        $this->session->set_flashdata('message', $message);
            redirect('index.php/transaksi/layout');
    }
}
