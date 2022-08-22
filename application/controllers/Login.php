<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model([
            "User_model" => "User",
        ]); //load model
    }

    public function action()
    {
        // ambil data dari form dan masukkan ke variable $data
        $data = $this->input->post();
        $message = "";

        $where = array(
            'user_username' => $data['username'],
        );

        $cek = $this->User->getWhere($where);
        if (count($cek) > 0) {
            $validasi = $cek[0];
            if (password_verify($data['pass'], $validasi->user_password)) {
                $data_session = array(
                    'id' => $validasi->user_id,
                    'nama' => $validasi->user_name,
                    'username' => $validasi->user_username,
                    'role' => $validasi->user_role,
                    'profile' => $validasi->user_image,
                    'status' => "login"
                );

                $this->session->set_userdata($data_session);
                redirect(base_url("index.php/welcome"));
            } else {
                $message = "Password Salah";
                $this->session->set_flashdata('message', $message);
                redirect('index.php/login');
            }
        } else {
            $message = "Username dan Password Salah";
            $this->session->set_flashdata('message', $message);
            redirect('index.php/login');
        }
    }

    public function index()
    {
        $data["data_user"] = $this->User->getAll();
        $this->load->view('login/main', $data);
    }

    function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url('index.php/login'));
    }
}
