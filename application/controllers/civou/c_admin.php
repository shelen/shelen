<?php

class c_admin extends CI_Controller {

    function loadAddAdmin() {
        if ($this->session->userdata('admin_logged_in')) {
            $this->load->view('civou/view_addadmin');
        } else {
            $this->load->view('civou/view_login');
        }
    }

    function addAdmin() {
        $this->load->model('sitead');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Admin User Name', 'required|trim|max_length[100]|xss_clean');
        $this->form_validation->set_rules('pass', 'Admin User Name', 'required|trim|max_length[100]|xss_clean');

        if ($this->form_validation->run() == false) {
            $message = array("mes" => " لا تترك النص فارغ");
            $this->load->view('civou/view_addadmin', $message);
//            $this->loadAddCategory();
        } else {
            $username = $this->input->post('username');
            $pass = $this->input->post('pass');
            $data = array(
                'username' => $username,
                'pass' => md5($pass)
            );
            if ($this->sitead->addadmin($data)) {
                $message = array("mes" => "تم أضافة " . $username . " .");
//                unset($this->input->post('categoryname'));
//                $this->load->view('civou/view_alladmins');
                redirect('civou/c_admin/alladmin');
//                $this->load->view('civou/view_addadmin', $message);
//                $this->loadAddCategory();
            } else {
                $message = array("mes" => "لقد حدثت مشكله فى الاضافه .");
                $this->load->view('civou/view_addadmin', $message);
//                $this->loadAddCategory($message);
            }
        }
    }

    function allAdmin() {
        if ($this->session->userdata('admin_logged_in')) {
            $this->load->view('civou/view_alladmins');
        } else {
            $this->load->view('civou/view_login');
        }
    }

    function delete() {
        if ($this->session->userdata('admin_logged_in')) {
            $this->load->model('sitead');
            if ($this->uri->segment(4) != '') {
                $id = $this->uri->segment(4);
                if ($this->sitead->delete($id, 'civou')) {
//                    $this->load->view('civou/view_alladmins');
                    redirect('civou/c_admin/alladmin');
                } else {
                    
                }
            }
        } else {
            $this->load->view('civou/view_login');
        }
    }

}