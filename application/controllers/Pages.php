<?php 
	class Pages extends CI_Controller{
	
	public function __construct(){
			
		parent::__construct();
	
		$data['usuario_nome'] = $this->session->userdata('usuario');
		$data['usuario_email'] = $this->session->userdata('email');
	}
	public function view($page = 'home'){
		if (!file_exists(APPPATH.'views/pages/'.$page.'.php')) {
			show_404();
		}
		$data['title'] = ucfirst($page);
		$this->load->view('pages/'.$page, $data);
	}
}	