<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Login_model extends CI_Model
{

    public function get_user_login()
    {
        $email = $this->session->userdata('email');

        $this->db->select('*');
        $this->db->from('tb_user');
        $this->db->join('tb_user_role', 'tb_user.role_id=tb_user_role.id', 'left');
        $this->db->where('email', $email);
        $info = $this->db->get();
        return $info->row_array();
    }


    public function getLoginData($data)

    {

        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->db->get_where('tb_user', ['email' => $email])->row_array();

        //jika user ada
        if ($user) {
            //jika user aktif
            if ($user['is_active'] == 1) {
                // cek password

                if (password_verify($password, $user['password'])) {
                    $data = [
                        'email' => $user['email'],
                        'role_id' => $user['role_id']
                    ];

                    $this->session->set_userdata($data);
                    redirect('dashboard');


                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password Salah!</div>');
                    redirect('login');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email ini belum diaktivasi! Silahkan cek email anda </div>');
                redirect('login');
            }
        } else {

            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email belum terdaftar! </div>');
            redirect('login');
        }
    }
}
