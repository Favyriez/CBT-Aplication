<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Teacher_model extends CI_Model { 
	
	function __construct(){
        parent::__construct();
    }



    function createTeacherFunction(){

        $page_data['name'] =  html_escape($this->input->post('name'));
        $page_data['email']=  html_escape($this->input->post('email'));
        $page_data['phone']=  html_escape($this->input->post('phone'));

        $this->db->insert('teacher', $page_data);
        $teacher_id = $this->db->insert_id();
        move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/teacher_image/' . $teacher_id. '.jpg');

    }

    function updateTeacherFunction($param2){

        $page_data['name'] =  html_escape($this->input->post('name'));
        $page_data['email']=  html_escape($this->input->post('email'));
        $page_data['phone']=  html_escape($this->input->post('phone'));

        $this->db->where('teacher_id', $param2);
        $this->db->update('teacher', $page_data);
        move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/teacher_image/' . $param2. '.jpg');

    }

    function deleteTeacherFunction($param2){

        $this->db->where('teacher_id', $param2);
        $this->db->delete('teacher');

    }


    function selectTeacher(){

        $query = $this->db->get('teacher')->result_array();
        return $query;
    }


}