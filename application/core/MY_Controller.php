<?php
    class MY_Controller extends CI_Controller{

    function __construct(){ 
        parent::__construct();
        $this->load->model('login_model','login');
        }

    function render ($view,$data){

        if ($this->session->has_userdata('role_id')) {

            $data['user'] = $this->login->get_user_login();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/top_nav', $data);
            $this->load->view('templates/sidebar');
            $this->load->view($view, $data);
            $this->load->view('chart', $data);
            $this->load->view('templates/footer');
           
        } else {
            redirect('login/logout');
        }

    }
}