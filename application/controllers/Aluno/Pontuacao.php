<?php
class Pontuacao extends CI_Controller{
	public function __construct(){
		
        parent::__construct();
        if(!$this->session->userdata('aluno')) {
            redirect('home');
        }
    }

    
}