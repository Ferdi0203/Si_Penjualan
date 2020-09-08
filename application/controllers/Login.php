<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('login_model','login');
    }
// ------------------------------------ login page ---------------------
    public function index()
    {
        if ($this->session->has_userdata('role_id')) redirect('dashboard');
        

         // cek apakah user sudah login

        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email', [
            'required' => 'Email tidak boleh kosong!',
            'valid_email' => 'Email tidak valid!'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'trim|required', [
            'required' => 'Password tidak boleh kosong!',
        ]);

        if ($this->form_validation->run()== false) {

            $data['title'] = 'Login Page';

            $this->load->view('login/login', $data);

        }else {

            $dt['email']     = $this->input->post('email');
            $dt['password']     = $this->input->post('password');

            $this->login->getLoginData($dt);
        }

    }

    // ------------------------------------ cek profile ------------------

    public function profile()
    {
        $data['title'] = 'Profile';

        $this->render('user/profil', $data);
    }

    // ------------------------ End cek profile---------------------------

    // ------------------------------------- logout---------------------------------
    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anda berhasil keluar!</div>');
        redirect('login');
    }

    // ---------------------------------  end logout ---------------------------------

}
