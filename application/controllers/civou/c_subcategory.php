<?php

class c_subcategory extends CI_Controller {

    function loadAddSubCategory() {
        if ($this->session->userdata('admin_logged_in')) {
            $this->load->view('civou/view_addsubcategory');
        } else {
            $this->load->view('civou/view_login');
        }
    }

    function addSubCategory() {
        $this->load->model('sitead');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('categoryid', 'Category Name Not Selected', 'required|trim|max_length[100]|xss_clean');
        $this->form_validation->set_rules('categoryname', 'Sub Category Name', 'required|trim|max_length[100]|xss_clean');

        if ($this->form_validation->run() == false) {
            $message = array("mes" => " لا تترك النص فارغ");
            $this->load->view('civou/view_addsubcategory', $message);
        } else {
            $categoryname = $this->input->post('categoryname');
            $categoryid = $this->input->post('categoryid');
            if ($categoryid == "none") {
                $message = array("mes" => "لم يتم اختيار القسم الرئيسى التابع له");
                $this->load->view('civou/view_addsubcategory', $message);
            } else {
                if ($this->sitead->addsubcategory($categoryname, $categoryid)) {
                    $message = array("mes" => "تم أضافة " . $categoryname . " .");
//                    redirect('civou/c_subcategory/addSubCategory');
                    redirect('civou/c_subcategory/showall');
                } else {
                    $message = array("mes" => "لقد حدثت مشكله فى الاضافه .");
                    $this->load->view('civou/view_addsubcategory', $message);
                }
            }
        }
    }

    function showall() {
        if ($this->session->userdata('admin_logged_in')) {
            $this->load->view('civou/view_allsubcategory');
        } else {
            $this->load->view('civou/view_login');
        }
    }

    function delete() {
        if ($this->session->userdata('admin_logged_in')) {
            $this->load->model('sitead');
            if ($this->uri->segment(4) != '') {
                $id = $this->uri->segment(4);
                if ($this->sitead->delete($id, 'sub_categ')) {
//                    $this->load->view('civou/view_allsubcategory');
                    redirect('civou/c_subcategory/showall');
                } else {
                    
                }
            }
        } else {
            $this->load->view('civou/view_login');
        }
    }

}

