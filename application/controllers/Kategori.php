<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kategori extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model([
            "Kategori_model" => "Kategori"
        ]); //load model
        if(!$this->session->userdata('id')){
            redirect('index.php/login');
        }
    }

    public function index()
    {
        $data["title"] = "List Data Barang";
        print_r($data);
    }

    public function action()
    {
        // ambil data dari form dan masukkan ke variable $data
        $data = $this->input->post();

        $opr = false;
        $message = "";

        $dataIns = array(
            "kategori_nama" => $data['Nama'],
            "kategori_kode" => $data['kode'],
            "kategori_isaktif" => $data['status']
        );
        $validation = $this->form_validation;
        $validation->set_rules($this->Kategori->rules());
        if ($validation->run() && $message == "") {
            $opr = $this->Kategori->save($dataIns);
            if ($opr == true) {
                $message = "Data berhasil diinput";
            } else {
                $message = "Data gagal diinput";
            }
        }
        $this->session->set_flashdata('message', $message);
        if ($opr) {
            redirect('index.php/kategori/table');
        } else {
            redirect('index.php/kategori/add/' . $this->input->post('kategori_id'));
        }
    }

    public function add()
    {
        $title ="Input Data Kategori";
        $this->load->view('templates/header', $title);
        $this->load->view('templates/navbar');
        $this->load->view('Kategori/form_add', $title);
        $this->load->view('templates/footer');
    }


    public function table()
    {
        $data["title"] = "List Kategori Barang";
        $data["data_kategori"] = $this->Kategori->getAll();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('kategori/table', $data);
    }

    public function edit($id = null)
    {
        if (!isset($id)) redirect('kategori');
        $data["title"] = "Edit Data Kategori";
        $data["data_kategori"] = $this->Kategori->getById($id);
        if (!$data["data_kategori"]) show_404();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('kategori/form_edit', $data);
        $this->load->view('templates/footer');
    }

    public function actionEdit()
    {
        $opration = false;
        $message = "";

        $data = array(
            "kategori_nama" => $this->input->post('Nama'),
            "kategori_kode" => $this->input->post('kode'),
            "kategori_isaktif" => $this->input->post('status')
        );

        $validation = $this->form_validation;
        $validation->set_rules($this->Kategori->rules());
        if ($validation->run()) {
            $opration = $this->Kategori->update(array('kategori_id' => $this->input->post('kategori_id')), $data);
            if ($opration == true) {
                $message = "Data berhasil diinput";
            } else {
                $message = "Data gagal diinput";
            }
        }

        $this->session->set_flashdata('message', $message);
        if ($opration) {
            redirect('index.php/kategori/table');
        } else {
            redirect('index.php/kategori/edit/' . $this->input->post('kategori_id'));
        }
    }

    public function delete($id)
    {
        $kategori = $this->Kategori->getById($id);
        $this->Kategori->delete($id);
        redirect('index.php/kategori/table');
    }
}
