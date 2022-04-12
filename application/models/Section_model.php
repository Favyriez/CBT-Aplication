<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Section_model extends CI_Model { 
	
	function __construct(){
        parent::__construct();
    }


    function selectSections(){

        $query = $this->db->get('section')->result_array();
        return $query;
    }


    function createSectionFunction(){

        $page_data['name'] =  html_escape($this->input->post('name'));
        $page_data['nick_name']=  html_escape($this->input->post('nick_name'));
        $page_data['teacher_id']=  html_escape($this->input->post('teacher_id'));
        $page_data['class_id']=  html_escape($this->input->post('class_id'));

        $this->db->insert('section', $page_data);

    }

    function updateSectionFunction($param2){

        $page_data['name'] =  html_escape($this->input->post('name'));
        $page_data['nick_name']=  html_escape($this->input->post('nick_name'));
        $page_data['teacher_id']=  html_escape($this->input->post('teacher_id'));
        $page_data['class_id']=  html_escape($this->input->post('class_id'));

        $this->db->where('section_id', $param2);
        $this->db->update('section', $page_data);

    }



    function deleteSectionFunction($param2){

        $this->db->where('section_id', $param2);
        $this->db->delete('section');

    }


}