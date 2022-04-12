<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Student_model extends CI_Model { 
	
	function __construct(){
        parent::__construct();
    }



    function createStudentFunction(){

        $page_data['name'] =  html_escape($this->input->post('name'));
        $page_data['email']=  html_escape($this->input->post('email'));
        $page_data['phone']=  html_escape($this->input->post('phone'));
        $page_data['sex']=  html_escape($this->input->post('sex'));
        $page_data['class_id'] =  html_escape($this->input->post('class_id'));
        $page_data['section_id']=  html_escape($this->input->post('section_id'));
        $page_data['address']=  html_escape($this->input->post('address'));
        $page_data['password']=  sha1($this->input->post('password'));
        $page_data['session'] = $this->db->get_where('settings', array('type' => 'session'))->row()->description;

        $this->db->insert('student', $page_data);
        $student_id = $this->db->insert_id();
        move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/student_image/' . $student_id. '.jpg');

    }

    function updateStudentFunction($param2){

        $page_data['name'] =  html_escape($this->input->post('name'));
        $page_data['email']=  html_escape($this->input->post('email'));
        $page_data['phone']=  html_escape($this->input->post('phone'));
        $page_data['sex']=  html_escape($this->input->post('sex'));
        $page_data['class_id'] =  html_escape($this->input->post('class_id'));
        $page_data['section_id']=  html_escape($this->input->post('section_id'));
        $page_data['address']=  html_escape($this->input->post('address'));

        $this->db->where('student_id', $param2);
        $this->db->update('student', $page_data);
        move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/student_image/' . $param2. '.jpg');

    }

    function deleteStudentFunction($param2){

        $this->db->where('student_id', $param2);
        $this->db->delete('student');

    }


    function selectStudent(){
        $query = $this->db->get('student')->result_array();
        return $query;
    }



    function updateStudentInformation(){

        $page_data['name']  =   html_escape($this->input->post('name'));
        $page_data['email'] =   html_escape($this->input->post('email'));
        $page_data['phone'] =   html_escape($this->input->post('phone'));

        $this->db->where('student_id', $this->session->userdata('student_id'));
        $this->db->update('student', $page_data);

        move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/student_image/' . $this->session->userdata('student_id'). '.jpg');

    }


    function changeStudentPasswordInformation(){

        $page_data['password'] = sha1($this->input->post('password'));
        $confirm_password = sha1($this->input->post('confirm_password'));

        if($page_data['password'] == $confirm_password ){
            $this->db->where('student_id', $this->session->userdata('student_id'));
            $this->db->update('student', $page_data);
        }

        elseif($page_data['password'] != $confirm_password ){
            $this->session->set_flashdata('error_message', get_phrase('Password not the same'));
            redirect(base_url() . 'student/manage_profile', 'refresh');
        }

    }

    function select_student_information_from_student_table(){
        $query = $this->db->get_where('student', array('student_id' => $this->session->userdata('student_id')));
        return $query->result_array();
    }



}