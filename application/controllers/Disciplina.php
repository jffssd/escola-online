<?php
class Disciplina extends CI_Controller{

	public function __construct(){
		
        parent::__construct();
        $this->load->library('blacksmith');
    }

    public function visualizar($id){
    
        $data['title'] = 'Calendario';
        $data['disciplina'] = $this->M_Disciplina->by_id($id);
        $data['professores'] = $this->M_Disciplina->professores_by_id($id);
        $this->load->view('disciplina/index', $data);
    }
}