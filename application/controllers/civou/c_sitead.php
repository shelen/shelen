<?php

class c_sitead extends CI_Controller {

    public function index() {
        $this->is_loged_in();
    }

    public function login() {
        if ($this->session->userdata('admin_logged_in')) {
            $this->load->view('civou/view_admin');
        } else {
            $this->load->view('civou/view_login');
        }
    }

    public function addservice() {
        $this->load->view('civou/view_addService');
    }

    public function is_loged_in() {
        if ($this->session->userdata('admin_logged_in')) {
            $this->load->view('civou/view_admin');
        } else {
            $this->load->view('civou/view_login');
        }
    }

    function valid_loign() {
        $this->load->model('sitead');
        $this->load->library('form_validation');

        $this->form_validation->set_rules('username', 'Username', 'required|trim|max_length[100]|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'required|trim|max_length[32]|xss_clean');
        if ($this->form_validation->run() == false) {
            $this->load->view('civou/view_login');
        } else {
            $username = $this->input->post('username');
            $password = md5($this->input->post('password'));
            $user_id = $this->sitead->valid_user_pass($username, $password);
            if (!$user_id) {
                $login_data = array("login_error" => true);
                $this->load->view('civou/view_login', $login_data);
            } else {
                $login_data = array("admin_logged_in" => true, "user_id" => $user_id);
                $this->session->set_userdata($login_data);
                $this->is_loged_in();
            }
        }
    }

    /////////////////////////////////////////////////////////////////////////////
}

?>
