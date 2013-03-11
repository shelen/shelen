<?php

class sitead extends CI_Model {

    public function valid_user_pass($user, $pass) {

        $this->db->select('id,username,pass');
        $this->db->from('civou');
        $this->db->where('username', $user);
        $this->db->where('pass', $pass);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->row(0)->id;
        } else {
            return false;
        }
    }

    function valid_user_pin($user, $pin) {
        $this->db->select('id,username,pincode');
        $this->db->from('sitead');
        $this->db->where('username', $user);
        $this->db->where('pincode', $pin);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->row(0)->id;
        } else {
            return false;
        }
    }

    function addcategory($categoryname) {
        $data = array("name" => $categoryname);
        $insert = $this->db->insert('category', $data);
        return $insert;
    }

    function addbcategory($categoryname) {
        $data = array("name" => $categoryname);
        $insert = $this->db->insert('blog_category', $data);
        return $insert;
    }

    function SelectbCategory() {
        $query = $this->db->get('blog_category');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    function SelectCategory() {
        $query = $this->db->get('category');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    function addsubcategory($categoryname, $categoryid) {
        $data = array("name" => $categoryname, "c_id" => $categoryid);
        $insert = $this->db->insert('sub_categ', $data);
        return $insert;
    }

    function addbsubcategory($categoryname, $categoryid) {
        $data = array("name" => $categoryname, "b_c_id" => $categoryid);
        $insert = $this->db->insert('blog_sub_categ', $data);
        return $insert;
    }

    function do_upload() {
        $gallery_path = realpath(APPPATH . '../imagesService/');
        $config = array(
            'allowed_types' => 'jpg|png|jpeg|gif',
            'upload_path' => $gallery_path,
        );
        $this->load->library('upload', $config);
        $this->upload->do_upload('userfile');
        //***********************************
        $image_data = $this->upload->data(); //get image data

        $config = array(
            'source_image' => $image_data['full_path'], //get original image
            'new_image' => $gallery_path . '/thumb', //save as new image //need to create thumbs first
            'maintain_ratio' => true,
            'width' => 300,
            'height' => 160
        );

        $this->load->library('image_lib', $config); //load library
        $this->image_lib->resize(); //do whatever specified in config
        $pic_name = $image_data['file_name'];
        return $pic_name;
    }

    function addservice($data) {
        $insert = $this->db->insert('service', $data);
        return $insert;
    }

    function addemployee($data) {
        $insert = $this->db->insert('employee', $data);
        return $insert;
    }

    function addadmin($data) {
        $insert = $this->db->insert('civou', $data);
        return $insert;
    }

    function selectAllService() {
        $query = $this->db->get('service');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    function selectSercive_by_C($c_id) {
        $this->db->from('service');
        $this->db->from('c_id', $c_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    function delete($id, $tablename) {
        $this->db->where('id', $id);
        return $this->db->delete($tablename);
    }

//------------------------------------------/
    function vaild_amount_point($user_id) {
        $this->db->from('user');
        $this->db->where('id', $user_id);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $rows = $query->result();
            foreach ($rows as $row) {
                
            }
        }
        return $row->amount_point;
    }

//------------------------------------------/
    function do_buy_process($user_id, $order_id, $order_point, $amount) {
        //transaction to commet tow sql statement
        $this->db->trans_start();
        $this->db->insert('order', array('s_id' => $order_id, 'u_id' => $user_id));
        $this->db->where('id', $user_id);
        $amount-=$order_point;
        $this->db->update('user', array('amount_point' => $amount));
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            //redirect
            $data = array(
                'title' => 'خطاء',
                'mesg' => 'خطاء أثناء  العملية'
            );
            $this->load->view('message', $data);
//            echo 'Error';
        } else {
            //redirect
//            echo 'Goooooooooooooood';
            $data = array(
                'title' => 'تم بنجاح',
                'mesg' => 'تمت عملية الشراء بنجاح'
            );
            $this->load->view('message', $data);
        }
    }

//--------------------------------------------/
}

?>
