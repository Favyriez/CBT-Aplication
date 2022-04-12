<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Subject_model extends CI_Model { 
	
	function __construct(){
        parent::__construct();
    }


    function selectSubjects(){

        $query = $this->db->get('subject')->result_array();
        return $query;
    }


    function createSubjectFunction(){

        $page_data['name'] =  html_escape($this->input->post('name'));
        $page_data['teacher_id']=  html_escape($this->input->post('teacher_id'));
        $page_data['class_id']=  html_escape($this->input->post('class_id'));

        $this->db->insert('subject', $page_data);

    }

    function updateSubjectFunction($param2){

        $page_data['name'] =  html_escape($this->input->post('name'));
        $page_data['teacher_id']=  html_escape($this->input->post('teacher_id'));
        $page_data['class_id']=  html_escape($this->input->post('class_id'));

        $this->db->where('subject_id', $param2);
        $this->db->update('subject', $page_data);

    }



    function deleteSubjectFunction($param2){

        $this->db->where('subject_id', $param2);
        $this->db->delete('subject');

    }


}