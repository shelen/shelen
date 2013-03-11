<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Site extends CI_Controller {

    public function index() {
        if ($this->session->userdata('logged_in')) {
            redirect('user/profile');
        } else {
            $this->load->view('view_index');
        }
    }

    ///////////////////////////
    function market() {
        $this->load->view('index_market');
    }

    ///////////////////////////
    function market_deatils() {
        $this->load->view('market_details');
    }

    function order() {
        if ($this->session->userdata('logged_in')) {
            if ($this->uri->segment(3) != '') {
                $this->load->view('view_order');
            } else {
                redirect("site/market");
            }
        } else {
            redirect("user/profile");
        }
    }

    function confirm_order() {
        $this->load->model('sitead');
        if ($this->session->userdata('logged_in')) {
            if ($this->input->post('order_id')) {
                $order_id=$this->input->post('order_id');
                echo 'Heree' . $this->input->post('order_id') . "</br>";
                echo "Price : " . $this->input->post('order_price') . "</br>";
                $user_id = $this->session->userdata('user_id');
                $order_point = $this->input->post('order_price');
                ///valid price
                $amount = $this->sitead->vaild_amount_point($user_id);
                echo $amount;
                if ($amount < $order_point) {
                    //redirect
                    echo 'Not Engh';
                } else {
                    // decrimint from user point and insert in orders
                    $amount = $this->sitead->do_buy_process($user_id,$order_id,$order_point,$amount);
                    //
                }
                ///
            } else {
                redirect("site/market");
            }
        } else {
            redirect("user/profile");
        }
    }

    ///////////////////////////
    function user_register() {
        $this->load->view('user_register');
    }

    //////////////////////////////////////// user registration /////////////////////////////////////////////
    ///////////////////////////////////////////////////////////////////////////////////// validate user
    public function sign_user_validation() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'username', 'required|max_length[25]|trim|xss_clean');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|xss_clean|valid_email|max_length[100]|is_unique[user_temp.email]|is_unique[user.email]
											 ');
        $this->form_validation->set_rules('country', 'Country', 'required|trim|xss_clean');
        $this->form_validation->set_rules('city', 'city', 'required|max_length[30]|trim|xss_clean');
        $this->form_validation->set_rules('zip_code', 'Zip code', 'required|max_length[30]|trim|xss_clean|numeric');


        $this->form_validation->set_rules('address', 'Address', 'required|max_length[100]|trim|xss_clean');
        $this->form_validation->set_rules('phone', 'Phone', 'required|max_length[20]|trim|xss_clean|numeric');
        $this->form_validation->set_rules('parent_link', 'parent link', 'required|max_length[500]|trim|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'required|md5|max_length[250]|trim');

        $this->form_validation->set_rules('c_password', 'Confirm Password', 'required|matches[password]|md5|max_length[250]|trim');

        $this->form_validation->set_message('is_unique', "هذا البريد الالكتروني استخدم مره قبل ذلك ");
        $this->form_validation->set_message('valid_email', "البريد الالكتروني الذي تم ادخاله غير صحيح ");
        $this->form_validation->set_message('matches', "كلمتين السر اللذان تم ادخالهما غير متشابهاش ");



        if ($this->form_validation->run()) {
            //generate a rundom key
            $key = md5(uniqid());
//			$this->load->library('email', array('mailtype'=>'html'));
//			$this->email->from('me@website.com',"temraz");
//			$this->email->to($this->input->post('email'));
//			$this->email->subject("تفعيل حسابك");
//	        $message="<p> شكرا للتسجيل معنا لتفعيل حسابك اضغط علي الرابط التالي من فضلك </p>";
//			$message.="<p><a href='".base_url()."site/register_user/$key' >اضغط هنا</a>تفعيل حسابك</p>";
//			$this->email->message($message);
//			if($this->email->send()){
//				echo " تم ارسال الرساله بنجاح";
//				}else{
//					echo "غير قادر علي ارسال الرساله حاليا حاول مره اخري من فضلك";
//					}
//			
            //send email to the user			
            //add them ti the temp_users db
            $this->load->model('site_model');

            if ($this->site_model->add_temp_user($key)) {
                //$data['regist']='تم التسجيل بنجاح, من فضلك اذهب الي بريدك الالكتروني لتفعيل حسابك ,شكرا لك';
                //$this->load->view('user_register',$data);
                $data['key'] = $key;
                $this->load->view("activation", $data);
            }
        } else {

            $this->load->view('user_register');
        }
    }

    ///////////////////////////   email activation ////////////////////////////////// 
    public function register_user($key2) {
        $this->load->model('site_model');

        if ($this->site_model->is_key_valid_user($key2)) {
            if ($newmail = $this->site_model->add_user($key2)) {

                //$data=array(
                //'email'=>$newmail,
                //'is_logged_in'=>1
                //);
                //$this->session->set_userdata($data);
                redirect('site/');
            } else {

                echo"فشل في تفعيل الحساب ,من فضلك حاول مره اخري";
            }
        } else {
            echo "رابط التفعيل غير صحيح";
        }
    }

    /////////////////////////////////////////////// end of user registration /////////////////////////////////////////				
    //function login_user_valied(){
    //		$username=$this->input->post("username", true);
    //	    $password=md5($this->input->post("password", true));
    //		$this->load->model('site_model');
    //		if($this->site_model->check_can_log_in($username, $password)){
    //			redirect('site/market');
    //			}else{
    //				echo "اسم المستخدم او كلمه المرور غير صحيحه";
    //				}
    //	}
    ///////////////////////////////////////////////////////////////////////////
    ///////////////////////////////
    public function login_validation() {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('username', 'username', 'required|trim|xss_clean|callback_validate_credentials');
        $this->form_validation->set_rules('password', 'Password', 'required|md5|xss_clean|trim');

        if ($this->form_validation->run() == FALSE) {

            $this->load->view('view_index');
        } else {

            $this->load->model('site_model');

            $username = $this->input->post('username');
            $password = $this->input->post('password');
            if ($this->site_model->check_can_log_in($username, $password)) {
                $username = $this->input->post('username');
                $password = $this->input->post('password');

                $user = $this->site_model->check_can_log_in($username, $password);

                $login_data = array("logged_in" => true, "user_id" => $user['id'], "user_email" => $user['email']);
                $this->session->set_userdata($login_data);
                redirect('user/profile');
            } else {

                redirect('site/load_404');
            }
        }
    }

    /////////////////////////////
    public function validate_credentials() {
        $this->load->model('site_model');

        if ($this->site_model->can_log_in()) {
            return true;
        } else {
            $this->form_validation->set_message('validate_credentials', 'اسم المستخدم او كلمه السر غير صحيحه');
            return false;
        }
    }

    //////////////////////////////////////////
    function blog() {
        $this->load->view('view_blog');
    }

    //////////////////////////////////////////	
    function blog_details() {
        $this->load->view('blog_details');
    }

    ///////////////////////////////////////
    function logout() {
        $this->session->sess_destroy();
        $this->load->view('view_index');
    }

}
