<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model([
            "User_model" => "User"
        ]); //load model

        if (!$this->session->userdata('id')) {
            redirect('index.php/login');
        }
    }

    public function index()
    {
        $data["title"] = "List Data User";
        $data["data_user"] = $this->User->getAll();
        $this->load->view('templates/header');
        $this->load->view('templates/navbar');
        $this->load->view('content', $data);
    }

    public function add()
    {
        $title = "Input Data User";
        $this->load->view('templates/header', $title);
        $this->load->view('templates/navbar');
        $this->load->view('User/form_add', $title);
        $this->load->view('templates/footer');
    }

    public function action()
    {
        // ambil data dari form dan masukkan ke variable $data
        $data = $this->input->post();

        $opr = false;
        $message = "";

        $dataIns = array(
            "user_name" => $data['Nama'],
            "user_username" => $data['Username'],
            "user_role" => $data['Role'],
            "user_password" => password_hash($data['Password'], PASSWORD_DEFAULT),
        );

        // upload foto
        $config['upload_path']          = './uploads/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 2048;
        $config['encrypt_name'] = TRUE;
        $this->load->library('upload', $config);

        // jika salah
        if (!$this->upload->do_upload('photo')) {
            $error = $this->upload->display_errors();
            $message = strip_tags($error);
        } else {
            $file = $this->upload->data();
            $dataIns['user_image'] = $file['file_name'];
        }

        $validation = $this->form_validation;
        $validation->set_rules($this->User->rules());
        if ($validation->run() && $message == "") {
            $opr = $this->User->save($dataIns);
            if ($opr == true) {
                $message = "Data berhasil diinput";
            } else {
                $message = "Data gagal diinput";
            }
        }

        $this->session->set_flashdata('message', $message);
        if ($opr) {
            redirect('index.php/user/table');
        } else {
            redirect('index.php/user/add/' . $this->input->post('usser_id'));
        }
    }

    public function table()
    {
        $data["title"] = "List Data User";
        $data["data_user"] = $this->User->getAll();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('user/table', $data);
    }

    public function edit($id = null)
    {
        if (!isset($id)) redirect('user');

        $data["title"] = "Edit Data User";
        $data["data_user"] = $this->User->getById($id);
        if (!$data["data_user"]) show_404();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/navbar');
        $this->load->view('user/form_edit', $data);
        $this->load->view('templates/footer');
    }

    public function actionEdit()
    {
        $opration = false;
        $message = "";

        $old = $this->input->post('fotolama');

        $data = array(
            "user_name" => $this->input->post('Nama'),
            "user_role" => $this->input->post('Role'),
            "user_username" => $this->input->post('Username')
        );
        // print_r($data);exit;
        if ($_FILES['photo']['name']) {
            $path = './uploads/' . $old;
            if (file_exists($path)) {

                # hapus file lama
                unlink($path);
            }
            // print_r($path);exit;

            // upload foto
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'jpg|png|gif';
            $config['max_size'] = 2048;
            $config['encrypt_name'] = TRUE;
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('photo')) {
                $error = $this->upload->display_errors();
                $message = strip_tags(($error));
            } else {
                $file = $this->upload->data();
                $data['user_image'] = $file['file_name'];
            }
        }

        if ($this->input->post('Password')) {
            $pass = $this->input->post('Password');
            $hash = password_hash($pass, PASSWORD_DEFAULT);
            $data['user_password'] = $hash;
        }

        $validation = $this->form_validation;
        $validation->set_rules($this->User->rules());
        if ($validation->run()) {
            $opration = $this->User->update(array('user_id' => $this->input->post('user_id')), $data);
            if ($opration == true) {
                $message = "Data berhasil diinput";
            } else {
                $message = "Data gagal diinput";
            }
        }

        $this->session->set_flashdata('message', $message);
        if ($opration) {
            redirect('index.php/user/table');
        } else {
            redirect('index.php/user/edit/' . $this->input->post('user_id'));
        }
    }

    public function delete($id)
    {
        $user = $this->User->getById($id);
        $path = '../uploads/' . $user->user_image;
        if (file_exists($path)) {
            # hapus file lama
            unlink($path);
        }

        $this->User->delete($id);
        redirect('index.php/user/table');
    }
}
