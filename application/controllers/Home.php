<?php
class Home extends CI_Controller{

	public function __construct(){
		
		parent::__construct();
	}

	public function index(){
		
        $data['title'] = 'Home Page';
		$this->load->view('pages/home', $data);
	}
}