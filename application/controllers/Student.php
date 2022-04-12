<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Student extends CI_Controller { 

    function __construct() {
        parent::__construct();
        		$this->load->database();                        
                $this->load->library('session');	
                $this->load->model('admin_model');
                $this->load->model('class_model');
                $this->load->model('teacher_model');
                $this->load->model('section_model');	
                $this->load->model('subject_model');	
                $this->load->model('student_model');
                
                /********** *Set your default time zone here **********/
                timezone();
        
    }

    public function index() {
        if($this->session->userdata('student_login') != 1) redirect(base_url(). 'login', 'refresh');
        if($this->session->userdata('student_login') == 1) redirect(base_url(). 'student/dashboard', 'refresh');
    
    }

    function dashboard() {

        if($this->session->userdata('student_login') != 1) redirect(base_url(). 'login', 'refresh');
        
       	$page_data['page_name'] = 'dashboard';
        $page_data['page_title'] =  get_phrase('Student Dashboard');
        $this->load->view('backend/index', $page_data);
    }

    function manage_profile($param1 = null, $param2 = null, $param3 = null){

        if($param1 == 'update'){
            $this->student_model->updateStudentInformation();
            $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
            redirect(base_url() . 'student/manage_profile', 'refresh');
        }

        if($param1 == 'changePassword'){

            $this->admin_model->changeStudentPasswordInformation();
            $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
            redirect(base_url() . 'student/manage_profile', 'refresh');

        }

        $page_data['page_name'] = 'manage_profile';
        $page_data['page_title'] =  get_phrase('Manage Profile');
        $this->load->view('backend/index', $page_data);
    }


    function online_exam($param1 = null, $param2 = null) {
        
        if ($param1 == '') {
            $page_data['data'] = 'active';
            $page_data['exams'] = $this->crud_model->available_exams($this->session->userdata('login_user_id'));
        }

        $page_data['page_name'] = 'online_exam';
        $page_data['page_title'] = get_phrase('online_exams');
        $this->load->view('backend/index', $page_data);
    }

    function online_exam_result($param1 = null, $param2 = null) {
       
        if ($param1 == '') {
            $page_data['data2'] = 'active';
            $page_data['exams'] = $this->crud_model->available_exams($this->session->userdata('login_user_id'));
        }

        $page_data['page_name'] = 'online_exam_result';
        $page_data['page_title'] = get_phrase('online_exam_results');
        $this->load->view('backend/index', $page_data);
    }


    function take_online_exam($online_exam_code) {

        $online_exam_id = $this->db->get_where('online_exam', array('code' => $online_exam_code))->row()->online_exam_id;
        $student_id = $this->session->userdata('login_user_id');
        // check if the student has already taken the exam
        $check = array('student_id' => $student_id, 'online_exam_id' => $online_exam_id);
        $taken = $this->db->where($check)->get('online_exam_result')->num_rows();

        $this->crud_model->change_online_exam_status_to_attended_for_student($online_exam_id);

        $status = $this->crud_model->check_availability_for_student($online_exam_id);

        if ($status == 'submitted') {
            $page_data['page_name']  = 'page_not_found';
        }
        else{
            $page_data['page_name']  = 'online_exam_take';
        }
        $page_data['page_title'] = get_phrase('online_exam');
        $page_data['online_exam_id'] = $online_exam_id;
        $page_data['exam_info'] = $this->db->get_where('online_exam', array('online_exam_id' => $online_exam_id));
        $this->load->view('backend/index', $page_data);
    }


    function submit_online_exam($online_exam_id = null){

        $answer_script = array();
        $question_bank = $this->db->get_where('question_bank', array('online_exam_id' => $online_exam_id))->result_array();

        foreach ($question_bank as $question) {

          $correct_answers  = $this->crud_model->get_correct_answer($question['question_bank_id']);
          $container_2 = array();
          if (isset($_POST[$question['question_bank_id']])) {

              foreach ($this->input->post($question['question_bank_id']) as $row) {
                  $submitted_answer = "";
                  if ($question['type'] == 'true_false') {
                      $submitted_answer = $row;
                  }
                  elseif($question['type'] == 'fill_in_the_blanks'){
                    $suitable_words = array();
                    $suitable_words_array = explode(',', $row);
                    foreach ($suitable_words_array as $key) {
                      array_push($suitable_words, strtolower($key));
                    }
                    $submitted_answer = json_encode(array_map('trim',$suitable_words));
                  }
                  else{
                      array_push($container_2, strtolower($row));
                      $submitted_answer = json_encode($container_2);
                  }
                  $container = array(
                      "question_bank_id" => $question['question_bank_id'],
                      "submitted_answer" => $submitted_answer,
                      "correct_answers"  => $correct_answers
                  );
              }
          }
          else {
              $container = array(
                  "question_bank_id" => $question['question_bank_id'],
                  "submitted_answer" => "",
                  "correct_answers"  => $correct_answers
              );
          }

          array_push($answer_script, $container);
        }
        $this->crud_model->submit_online_exam($online_exam_id, json_encode($answer_script));
        redirect(base_url() . 'student/online_exam', 'refresh');
    }





}
