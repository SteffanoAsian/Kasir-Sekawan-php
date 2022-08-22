<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model([
            "Barang_model" => "Barang", 
            "Kategori_model" => "Kategori"
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

    public function action()
    {
        // ambil data dari form dan masukkan ke variable $data
        $data = $this->input->post();

        $opr = false;
        $message = "";

        $dataIns = array(
            "barang_nama" => $data['Nama'],
            "barang_kode" => $data['kode'],
            "barang_kategori_id" => $data['kategori'],
            "barang_harga" =>$data['harga'],
            "barang_stock" =>$data['stok'],
            "barang_isaktif" => $data['status'],
        );

        $validation = $this->form_validation;
        $validation->set_rules($this->Barang->rules());
        if ($validation->run() && $message == "") {
            $opr = $this->Barang->save($dataIns);
            if ($opr == true) {
                $message = "Data berhasil diinput";
            } else {
                $message = "Data gagal diinput";
            }
        }
        if ($opr) {
            $this->table($message);
        } else {
            $this->add($message);
        }
    }

    public function add()
    {
        $kategori = $this->Kategori->getWhere([
            "kategori_isaktif" => 1,
        ]);
        $title ="Input data Barang";

        $this->load->view('templates/header', $title);
        $this->load->view('templates/navbar');
        $this->load->view('barang/form_add', [$title, "abc" => $kategori] );
        $this->load->view('templates/footer');
    }

    public function table()
    {
        $data["title"] = "List Data Barang";
        $data["data_barang"] = $this->Barang->getAll();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('barang/table', $data);
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
            "barang_stock" => $this->input->post('stok'),
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

    public function getWhere($where = null)
    {
        return $this->db->get_where($this->table, $where)->result();
    }

    public function delete($id)
    {
        $barang = $this->Barang->getById($id);
        $this->Barang->delete($id);
        redirect('index.php/barang/table');
    }
}