<?php

class c_b_subcategory extends CI_Controller {

    function loadAddbSubCategory() {
        if ($this->session->userdata('admin_logged_in')) {
            $this->load->view('civou/view_addblogsubcategory');
        } else {
            $this->load->view('civou/view_login');
        }
    }

    function addbSubCategory() {
        $this->load->model('sitead');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('categoryid', 'Category Name Not Selected', 'required|trim|max_length[100]|xss_clean');
        $this->form_validation->set_rules('categoryname', 'Sub Category Name', 'required|trim|max_length[100]|xss_clean');

        if ($this->form_validation->run() == false) {
            $message = array("mes" => " لا تترك النص فارغ");
            $this->load->view('civou/view_addblogsubcategory', $message);
        } else {
            $categoryname = $this->input->post('categoryname');
            $categoryid = $this->input->post('categoryid');
            if ($categoryid == "none") {
                $message = array("mes" => "لم يتم اختيار القسم الرئيسى التابع له" );
                $this->load->view('civou/view_addblogsubcategory', $message);
            } else {
                if ($this->sitead->addbsubcategory($categoryname, $categoryid)) {
                    $message = array("mes" => "تم أضافة " . $categoryname . " .");
                    $this->load->view('civou/view_addblogsubcategory', $message);
                } else {
                    $message = array("mes" => "لقد حدثت مشكله فى الاضافه .");
                    $this->load->view('civou/view_addblogsubcategory', $message);
                }
            }
        }
    }

}

