<?php if (!defined('BASEPATH'))exit('No direct script access allowed');


class Login extends CI_Controller {

    function __construct() {
        parent::__construct();

		$this->load->database();
		$this->load->library('session');
    }


    public function index() {
        if($this->session->userdata('admin_login') == 1) redirect(base_url(). 'admin/dashboard', 'refresh');
        if($this->session->userdata('student_login') == 1) redirect(base_url(). 'student/dashboard', 'refresh');
        $this->load->view('backend/login');
    }

    function check_login() {
        $this->login_model->UserLoginFunction();
        
     }



     function logout(){

        $this->session->sess_destroy();
        redirect(base_url(). 'login', 'refresh');
     }

    
}
