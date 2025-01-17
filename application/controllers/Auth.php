<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        if (!empty($this->input->post('username')) || !empty($this->input->post('password'))) {
            $this->_login();
        }

        $data['title'] = 'LDK Ishlah - Login';
        $this->load->view('admin/auth/login', $data);
    }

    private function _login()
    {
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        if ($this->form_validation->run() == false) {
            // $this->session->set_flashdata('message', 'Harap masukkan data dengan benar !');
            $this->session->set_flashdata('message', '<script>alert("Harap masukkan data dengan benar !")</script>');
            redirect('auth');
        } else {

            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $user = $this->db->get_where('user', ['username' => $username])->row_array();

            if ($user) {
                //cek password
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'username' => $user['username'],
                        'level' => $user['level']
                    ];
                    $this->session->set_flashdata('message', '<script>alert("Selamat Anda Berhasil Login")</script>');
                    $this->session->set_userdata($data);
                    redirect('dashboard');
                } else {
                    $this->session->set_flashdata('message', '<script>alert("Password yang Anda Masukan Salah !")</script>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<script>alert("Email is not registered !")</script>');
                redirect('auth');
            }
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('username');

        $this->session->set_flashdata('message', '<script>alert("You have been Logout")</script>');
        redirect('auth');
    }

    public function index1()
    {

        $data["judul"] = "Halaman Login";
        $this->load->view('templates/auth_header', $data);
        $this->load->view('auth/login');
        $this->load->view('templates/auth_footer');
    }
}
