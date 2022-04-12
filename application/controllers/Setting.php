<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Setting extends CI_Controller { 

    function __construct() {
        parent::__construct();
        		$this->load->database();                        
                $this->load->library('session');	
                $this->load->model('setting_model');				  
               
    }



    function system_settings($param1 = null, $param2 = null, $param3 = null){

        if($param1 == 'update'){
            $this->setting_model->updateSystemInformation();
            $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
            redirect(base_url() . 'setting/system_settings', 'refresh');
        }

        if($param1 == 'logo'){
            $this->setting_model->updateSystemLogo();
            $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
            redirect(base_url() . 'setting/system_settings', 'refresh');
        }

        if($param1 == 'theme'){
            $this->setting_model->updateSystemTheme();
            $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
            redirect(base_url() . 'setting/system_settings', 'refresh');
        }

        $page_data['page_name'] = 'system_settings';
        $page_data['page_title'] =  get_phrase('system_settings');
        $this->load->view('backend/index', $page_data);
    }




}