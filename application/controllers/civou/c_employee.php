<?php

class c_employee extends CI_Controller {

    function loadAddemployee() {
        if ($this->session->userdata('admin_logged_in')) {
            $this->load->view('civou/view_addemployee');
        } else {
            $this->load->view('civou/view_login');
        }
    }

    function addEmployee() {
        $this->load->model('sitead');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Employee User Name', 'required|trim|max_length[100]|xss_clean');
        $this->form_validation->set_rules('pass', 'Employee Password', 'required|trim|max_length[100]|xss_clean');
        $this->form_validation->set_rules('name', 'Employee Name', 'required|trim|max_length[100]|xss_clean');
        $this->form_validation->set_rules('search_category', 'Category ', 'required|trim|max_length[100]|xss_clean');
        $this->form_validation->set_rules('sub_category', 'Sub Category ', 'required|trim|max_length[100]|xss_clean');
        //c_id 	sc_id
        if ($this->form_validation->run() == false) {
            $message = array("mes" => " لا تترك النص فارغ");
            $this->load->view('civou/view_addemployee', $message);
//            $this->loadAddCategory();
        } else {
            $username = $this->input->post('username');
            $pass = $this->input->post('pass');
            $name = $this->input->post('name');
            $c_id = $this->input->post('search_category');
            $sc_id = $this->input->post('sub_category');
            $data = array(
                'username' => $username,
                'pass' => md5($pass),
                'name' => $name,
                'c_id' => $c_id,
                'sc_id' => $sc_id
            );
            if ($this->sitead->addemployee($data)) {
                $message = array("mes" => "تم أضافة " . $username . " .");
//                unset($this->input->post('categoryname'));
//                $this->load->view('civou/view_allemployee');
                redirect('civou/c_employee/allemployee');
//                $this->load->view('civou/view_addadmin', $message);
//                $this->loadAddCategory();
            } else {
                $message = array("mes" => "لقد حدثت مشكله فى الاضافه .");
                $this->load->view('civou/view_addemployee', $message);
//                $this->loadAddCategory($message);
            }
        }
    }

    function allemployee() {
        if ($this->session->userdata('admin_logged_in')) {
            $this->load->view('civou/view_allemployee');
        } else {
            $this->load->view('civou/view_login');
        }
    }

    function delete() {
        if ($this->session->userdata('admin_logged_in')) {
            $this->load->model('sitead');
            if ($this->uri->segment(4) != '') {
                $id = $this->uri->segment(4);
                if ($this->sitead->delete($id, 'employee')) {
//                    $this->load->view('civou/view_allemployee');
                    redirect('civou/c_employee/allemployee');
                } else {
                    
                }
            }
        } else {
            $this->load->view('civou/view_login');
        }
    }

}