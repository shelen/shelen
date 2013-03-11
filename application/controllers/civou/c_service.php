<?php

class c_service extends CI_Controller {

    function loadAddService() {
        if ($this->session->userdata('admin_logged_in')) {
            $this->load->view('civou/view_addservice');
        } else {
            $this->load->view('civou/view_login');
        }
    }

    function addservice() {
        $this->load->model('sitead');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('servicename', 'Service Name ', 'required|trim|max_length[100]|xss_clean');
        $this->form_validation->set_rules('serviceprice', 'Service Price', 'required|numeric|trim|max_length[10]|xss_clean');
        $this->form_validation->set_rules('search_category', 'Category ', 'required|trim|max_length[100]|xss_clean');
        $this->form_validation->set_rules('sub_category', 'Sub Category ', 'required|trim|max_length[100]|xss_clean');
        $this->form_validation->set_rules('discription', 'Discription ', 'required|trim|xss_clean');
        $this->form_validation->set_rules('instruction', 'Instruction ', 'required|trim|xss_clean');
//        $this->form_validation->set_rules('userfile', 'Photo ', 'required|trim|xss_clean');

        if ($this->form_validation->run() == false) {
            $message = array("mes" => " لا تترك النص فارغ");
            $this->load->view('civou/view_addservice', $message);
        } else {
            $name = $this->input->post('servicename');
            $price_point = $this->input->post('serviceprice');
            $c_id = $this->input->post('search_category');
            $sc_id = $this->input->post('sub_category');
            $detail = $this->input->post('discription');
            $instruction = $this->input->post('instruction');
            //**********8
            $photo = $this->sitead->do_upload();
            //**********8
            $data = array(
                'name' => $name,
                'price_point' => $price_point,
                'c_id' => $c_id,
                'sc_id' => $sc_id,
                'detail' => $detail,
                'instruction' => $instruction,
                'photo_name'=>$photo
            );
            if ($this->sitead->addservice($data)) {
                $message = array("mes" => "تم أضافة الخدمة");
                $this->load->view('civou/view_addservice', $message);
                redirect("civou/c_service/loadaddservice");
            } else {
                $message = array("mes" => "لقد حدثت مشكله فى الاضافه .");
                $this->load->view('civou/view_addservice', $message);
            }
        }
    }

}