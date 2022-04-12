<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Class_model extends CI_Model { 
	
	function __construct(){
        parent::__construct();
    }


    function selectClasses(){

        $query = $this->db->get('class')->result_array();
        return $query;
    }


    function createClassFunction(){

        $page_data['name'] =  html_escape($this->input->post('name'));
        $page_data['name_numeric']=  html_escape($this->input->post('name_numeric'));
        $page_data['teacher_id']=  html_escape($this->input->post('teacher_id'));

        $this->db->insert('class', $page_data);

    }

    function updateClassFunction($param2){

        $page_data['name'] =  html_escape($this->input->post('name'));
        $page_data['name_numeric']=  html_escape($this->input->post('name_numeric'));
        $page_data['teacher_id']=  html_escape($this->input->post('teacher_id'));

        $this->db->where('class_id', $param2);
        $this->db->update('class', $page_data);

    }



    function deleteClassFunction($param2){

        $this->db->where('class_id', $param2);
        $this->db->delete('class');

    }


}