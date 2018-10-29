<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller {

    public function __construct() {
        parent::__construct();
		$this->load->library('Origami');
        $this->load->model('Origami_Model');
    }

    public function backup() {

        $postData = $this->input->post();
        
		$form_data = array();
		$form_data[] = array(
			"group_data_name" => "log_task_details",
			"data"            => array(
                array(
                    "log_task_details_title" => $postData['post_data']['name'],
                    "log_task_details_date" => strtotime($postData['post_data']['date']),
                    "log_task_details_description" => $postData['post_data']['desc'],
                    "log_task_details_created_by" => "Mikel",
                ),
            ),
        
        );
        
        $res = $this->Origami_Model->create("log", $form_data);
        
        if($res['success'] == 'ok') {
            $this->send(array('result' => 'success'));
        } else {
            $this->send(array('result' => 'failure'));
        }
    }

    private function send($array) {

        if (!is_array($array)) return false;

        $send = array('token' => $this->security->get_csrf_hash()) + $array;

        if (!headers_sent()) {
            header('Cache-Control: no-cache, must-revalidate');
            header('Expires: ' . date('r'));
            header('Content-type: application/json');
        }

        exit(json_encode($send, JSON_FORCE_OBJECT));

    }

}