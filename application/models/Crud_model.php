<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Crud_model extends CI_Model { 
	
	function __construct()
    {
        parent::__construct();
    }


    function get_type_name_by_id($type, $type_id = null, $field = 'name'){
        $this->db->where($type . '_id', $type_id);
        $query = $this->db->get($type);
        $result = $query->result_array();

        foreach ($result as $key => $row)
        return $row [$field];

    }

    function get_image_url ($type = null, $id = null){

        if(file_exists('uploads/' . $type . '_image/' . $id . '.jpg'))
            $image_url = base_url(). 'uploads/' . $type . '_image/' . $id . '.jpg';
        else
        $image_url = base_url(). 'uploads/default_image.jpg';

        return $image_url;
    }


    function get_subject_info($subject_id){

        $query = $this->db->get_where('subject', array('subject_id'=> $subject_id));
        return $query->result_array();

    }


    function get_total_mark($online_exam_id){

        $added_question_info = $this->db->get_where('question_bank', array('online_exam_id' => $online_exam_id))->result_array();
        $total_mark = 0;
        if(sizeof($added_question_info) > 0){
            foreach($added_question_info as $key => $single_question){
                $total_mark = $total_mark + $single_question['mark'];
            }
        }

        return $total_mark;
    }


    function create_online_exam(){
        $data['code']  = substr(md5(uniqid(rand(), true)), 0, 7);
        $data['title'] = $this->input->post('exam_title');
        $data['class_id'] = $this->input->post('class_id');
        $data['section_id'] = $this->input->post('section_id');
        $data['subject_id'] = $this->input->post('subject_id');
        $data['minimum_percentage'] = $this->input->post('minimum_percentage');
        $data['instruction'] = $this->input->post('instruction');
        $data['status'] = 'pending';
        $data['exam_date'] = strtotime($this->input->post('exam_date'));
        $data['time_start'] = $this->input->post('time_start');
        $data['time_end'] = $this->input->post('time_end');
        $data['duration'] = strtotime(date('Y-m-d', $data['exam_date']).' '.$data['time_end']) - strtotime(date('Y-m-d', $data['exam_date']).' '.$data['time_start']);
        $data['running_year'] =   $this->db->get_where('settings' , array('type'=>'session'))->row()->description;

        $this->db->insert('online_exam', $data);
    }

    function update_online_exam(){

        $data['title'] = $this->input->post('exam_title');
        $data['class_id'] = $this->input->post('class_id');
        $data['section_id'] = $this->input->post('section_id');
        $data['subject_id'] = $this->input->post('subject_id');
        $data['minimum_percentage'] = $this->input->post('minimum_percentage');
        $data['instruction'] = $this->input->post('instruction');
        $data['exam_date'] = strtotime($this->input->post('exam_date'));
        $data['time_start'] = $this->input->post('time_start');
        $data['time_end'] = $this->input->post('time_end');
        $data['duration'] = strtotime(date('Y-m-d', $data['exam_date']).' '.$data['time_end']) - strtotime(date('Y-m-d', $data['exam_date']).' '.$data['time_start']);

        $this->db->where('online_exam_id', $this->input->post('online_exam_id'));
        $this->db->update('online_exam', $data);
    }

    function delete_online_exam($param2){
        $this->db->where('online_exam_id', $param2);
        $this->db->delete('online_exam');
    }

    // multiple_choice_question crud functions
    function add_multiple_choice_question_to_online_exam($online_exam_id){
        if (sizeof($this->input->post('options')) != $this->input->post('number_of_options')) {
            $this->session->set_flashdata('error_message' , get_phrase('options can noy be blank'));
            return;
        }
        foreach ($this->input->post('options') as $key => $option) {
            if ($option == "") {
                $this->session->set_flashdata('error_message' , get_phrase('no_options_can_be_blank'));
                return;
            }
        }
        if (sizeof($this->input->post('correct_answers')) == 0) {
            $correct_answers = [""];
        }
        else{
            $correct_answers = $this->input->post('correct_answers');
        }
        $data['online_exam_id']     = $online_exam_id;
        $data['question_title']     = $this->input->post('question_title');
        $data['mark']               = $this->input->post('mark');
        $data['number_of_options']  = $this->input->post('number_of_options');
        $data['type']               = 'multiple_choice';
        $data['options']            = json_encode($this->input->post('options'));
        $data['correct_answers']    = json_encode($correct_answers);
        $this->db->insert('question_bank', $data);
        $this->session->set_flashdata('flash_message' , get_phrase('question added successfully'));
    }


    function update_multiple_choice_question($question_id){
        if (sizeof($this->input->post('options')) != $this->input->post('number_of_options')) {
            $this->session->set_flashdata('error_message' , get_phrase('options can noy be blank'));
            return;
        }
        foreach ($this->input->post('options') as $key => $option) {
            if ($option == "") {
                $this->session->set_flashdata('error_message' , get_phrase('no_options_can_be_blank'));
                return;
            }
        }
        if (sizeof($this->input->post('correct_answers')) == 0) {
            $correct_answers = [""];
        }
        else{
            $correct_answers = $this->input->post('correct_answers');
        }
        $data['question_title']     = $this->input->post('question_title');
        $data['mark']               = $this->input->post('mark');
        $data['number_of_options']  = $this->input->post('number_of_options');
        $data['options']            = json_encode($this->input->post('options'));
        $data['correct_answers']    = json_encode($correct_answers);

        $this->db->where('question_bank_id', $question_id);
        $this->db->update('question_bank', $data);
        $this->session->set_flashdata('flash_message' , get_phrase('question updated successfully'));
    }

    // true_false_question crud functions
    function add_true_false_question_to_online_exam($online_exam_id){

        $data['online_exam_id']     = $online_exam_id;
        $data['question_title']     = $this->input->post('question_title');
        $data['mark']               = $this->input->post('mark');
        $data['type']               = 'true_false';
        $data['correct_answers']    = $this->input->post('true_false_answer');

        $this->db->insert('question_bank', $data);
        $this->session->set_flashdata('flash_message' , get_phrase('question added successfully'));
    }

    function update_true_false_question($question_id){

        $data['question_title']     = $this->input->post('question_title');
        $data['mark']               = $this->input->post('mark');
        $data['correct_answers']    = $this->input->post('true_false_answer');

        $this->db->where('question_bank_id', $question_id);
        $this->db->update('question_bank', $data);
        $this->session->set_flashdata('flash_message' , get_phrase('question updated successfully'));
    }

     // fill_in_the_blanks_question crud functions
    function add_fill_in_the_blanks_question_to_online_exam($online_exam_id){

        $suitable_words_array = explode(',', $this->input->post('suitable_words'));
        $suitable_words = array();
        foreach($suitable_words_array as $key => $row){
            array_push($suitable_words, strtolower($row));
        }

        $data['online_exam_id']     = $online_exam_id;
        $data['question_title']     = $this->input->post('question_title');
        $data['mark']               = $this->input->post('mark');
        $data['type']               = 'fill_in_the_blanks';
        $data['correct_answers']    = json_encode(array_map('trim', $suitable_words));

        $this->db->insert('question_bank', $data);
        $this->session->set_flashdata('flash_message' , get_phrase('question added successfully'));

    }


    function update_fill_in_the_blanks_question($question_id){

        $suitable_words_array = explode(',', $this->input->post('suitable_words'));
        $suitable_words = array();
        foreach($suitable_words_array as $key => $row){
            array_push($suitable_words, strtolower($row));
        }

        $data['question_title']     = $this->input->post('question_title');
        $data['mark']               = $this->input->post('mark');
        $data['type']               = 'fill_in_the_blanks';
        $data['correct_answers']    = json_encode(array_map('trim', $suitable_words));

        $this->db->where('question_bank_id', $question_id);
        $this->db->update('question_bank', $data);
        $this->session->set_flashdata('flash_message' , get_phrase('question updated successfully'));

    }

    function delete_question_from_online_exam($question_id){
        $this->db->where('question_bank_id', $question_id);
        $this->db->delete('question_bank');
    }

    function manage_online_exam_status($online_exam_id = null, $status = null){

        $checker = array(

            'online_exam_id' => $online_exam_id
        );

        $updater = array(

            'status' => $status
        );

        $this->db->where($checker);
        $this->db->update('online_exam', $updater);
        $this->session->set_flashdata('flash_message' , get_phrase('exam').' '. $status);
    }



    function available_exams($student_id) {
        $running_year = get_settings('session');
        $class_id = $this->db->get_where('student', array('student_id' => $student_id))->row()->class_id;
        $section_id = $this->db->get_where('student', array('student_id' => $student_id))->row()->section_id;
        $match = array('running_year' => $running_year, 'class_id' => $class_id, 'section_id' => $section_id, 'status' => 'published');
        $this->db->order_by("exam_date", "dsc");
        $exams = $this->db->where($match)->get('online_exam')->result_array();
        return $exams;
    }

    


    function change_online_exam_status_to_attended_for_student($online_exam_id = ""){

        $checker = array(
            'online_exam_id' => $online_exam_id,
            'student_id' => $this->session->userdata('login_user_id')
        );

        if($this->db->get_where('online_exam_result', $checker)->num_rows() == 0){
            $inserted_array = array(
                'status' => 'attended',
                'online_exam_id' => $online_exam_id,
                'student_id' => $this->session->userdata('login_user_id'),
                'exam_started_timestamp' => strtotime("now")
            );
            $this->db->insert('online_exam_result', $inserted_array);
        }
    }

    function submit_online_exam($online_exam_id = null, $answer_script = null){

        $checker = array(
            'online_exam_id' => $online_exam_id,
            'student_id' => $this->session->userdata('login_user_id')
        );
        $updated_array = array(
            'status' => 'submitted',
            'answer_script' => $answer_script
        );

        $this->db->where($checker);
        $this->db->update('online_exam_result', $updated_array);

        $this->calculate_exam_mark($online_exam_id);
    }

    function calculate_exam_mark($online_exam_id) {

        $checker = array(
            'online_exam_id' => $online_exam_id,
            'student_id' => $this->session->userdata('login_user_id')
        );

        $obtained_marks = 0;
        $online_exam_result = $this->db->get_where('online_exam_result', $checker);
        if ($online_exam_result->num_rows() == 0) {

            $data['obtained_mark'] = 0;
        }
        else{
            $results = $online_exam_result->row_array();
            $answer_script = json_decode($results['answer_script'], true);
            foreach ($answer_script as $row) {

                if ($row['submitted_answer'] == $row['correct_answers']) {

                    $obtained_marks = $obtained_marks + $this->get_question_details_by_id($row['question_bank_id'], 'mark');
                }
            }
            $data['obtained_mark'] = $obtained_marks;
        }
        $total_mark = $this->get_total_mark($online_exam_id);
        $query = $this->db->get_where('online_exam', array('online_exam_id' => $online_exam_id))->row_array();
        $minimum_percentage = $query['minimum_percentage'];

        $minumum_required_marks = ($total_mark * $minimum_percentage) / 100;
        if ($minumum_required_marks > $obtained_marks) {
            $data['result'] = 'fail';
        }
        else {
            $data['result'] = 'pass';
        }
        $this->db->where($checker);
        $this->db->update('online_exam_result', $data);

    }



    function get_question_details_by_id($question_ban_id, $column_name = null){

        return $this->get_where('question_bank', array('question_bank_id' => $question_id))->row()->$column_name;
    }



    function check_availability_for_student($online_exam_id){
        $result = $this->db->get_where('online_exam_result', array('online_exam_id' => $online_exam_id, 'student_id' => $this->session->userdata('login_user_id')))->row_array();
        return $result['status'];
    }


    function get_online_exam_result($student_id){

        $match = array('student_id' => $student_id, 'status' => 'submitted');
        $exams = $this->db->where($match)->get('online_exam_result')->result_array();
        return $exams;
    }


    function get_correct_answer($question_bank_id = null){
        $question_details = $this->db->get_where('question_bank', array('question_bank_id' => $question_bank_id))->row_array();
        return $question_details['correct_answers'];
    }
    
    function select_all_messages(){
        $sql = $this->db->query("select * from general_message order by general_message_id asc");
        return $sql->result_array();
    }





    





















}