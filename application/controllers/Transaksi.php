<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model([
            "Transaksi_model" => "Transaksi",
            "Barang_model" => "Barang",
            "Keranjang_model" => "Keranjang",
            "Detail_model" =>"TransaksiDetail"
        ]); //load model

        if(!$this->session->userdata('id')){
            redirect('index.php/login');
        }
    }

    public function index()
    {
        $data["title"] = "List Data Barang";
        $data["data_barang"] = $this->Barang->getAll();
        $this->load->view('templates/header');
        $this->load->view('templates/navbar');
        $this->load->view('content', $data);
    }

    public function action() {
        $opration = false;
        

        // ambil data dari form dan masukkan ke variable $data
        $data = $this->input->post();
        $dataIns = array(
            "transaksi_total" => $data['total'],
            "transaksi_uang" => $data['jumlah'],
            "transaksi_kembalian" =>$data['kembali'],
            "transaksi_user_id"=>$this->session->userdata('id')
        );
        
        if($data['total'] > $data['jumlah']){
            $message = "Uang anda tidak Mencukupi";
            $this->session->set_flashdata('message',$message);
            redirect('index.php/transaksi/layout/');
        }else{
            $parent_id = $this->Transaksi->save($dataIns);
            $keranjang = $this->Keranjang->getAll([
                "keranjang_user_id"=> $this->session->userdata('id')
            ]);

            foreach($keranjang as $row){
                // print_r($row);exit;
               $save =  $this->TransaksiDetail->save([
                    "transaksi_parent_id"=>$parent_id,
                    "transaksi_barang_id"=>$row->keranjang_barang_id,
                    "transaksi_jml_beli"=>$row->keranjang_jml_beli,
                    "transaksi_harga"=>$row->keranjang_harga, 
                    "transaksi_subtotal"=>($row->keranjang_harga * $row->keranjang_jml_beli)
                ]);
            }

            $message = "Transaksi Berhasil";
            $this->session->set_flashdata('message',$message);
            $this->Keranjang->deleteAll();
            redirect('index.php/transaksi/layout/');
        }
    }

    public function add()
    {
        $kategori = $this->Kategori->getWhere([
            "kategori_isaktif" => 1,
        ]);

        $this->load->view('templates/header');
        $this->load->view('templates/navbar');
        $this->load->view('barang/form_add', ["abc" => $kategori] );
        $this->load->view('templates/footer');
    }

    public function layout()
    {
        $barang = $this->Barang->getWhere([
            "barang_isaktif" => 1,
        ]);
        $data["title"] = "Halaman Kasir";
        $data["data_keranjang"] = $this->Keranjang->getAll([
            "keranjang_user_id"=> $this->session->userdata('id')
        ]);
        $data["data_barang"] = $this->Barang->getAll();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('transaksi/layout',$data);
    }

    public function edit($id = null)
    {
        
        $kategori = $this->Kategori->getWhere([
            "kategori_isaktif" => 1,
        ]);
        
        if (!isset($id)) redirect('barang');
        $data["title"] = "Edit Data Barang";
        $data["data_barang"] = $this->Barang->getById($id);

        if(!$data["data_barang"]) show_404();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('barang/form_edit', [$data, "kategori" => $kategori]);
        $this->load->view('templates/footer');
    }

    public function actionEdit()
    {
        $opration = false;
        $message = "Data tidak lengkap";

        $data = array(
            "barang_nama" => $this->input->post('Nama'),
            "barang_kode" => $this->input->post('kode'),
            "barang_kategori_id" => $this->input->post('kategori'),
            "barang_harga" => $this->input->post('harga'),
            "barang_isaktif" => $this->input->post('status')
        );
        $validation = $this->form_validation;
        $validation->set_rules($this->Barang->rules());
        if ($validation->run()) {
            $opration = $this->Barang->update(array('barang_id' => $this->input->post('barang_id')), $data);
            if ($opration == true) {
                $message = "Data berhasil Di-edit";
            } else {
                $message = "Pengeditan data GAGAL";
            }
        }
        $this->session->set_flashdata('message',$message);  
        if ($opration) {
            redirect('index.php/barang/table');
        } else {
            redirect('index.php/barang/edit/'.$this->input->post('barang_id'));
        }
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
}