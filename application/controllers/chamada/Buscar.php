<?php
class Buscar extends CI_Controller{

	public function __construct(){
        parent::__construct();
        $this->load->library('l_aluno');
        $this->load->library('l_turma');
        if(!$this->session->userdata('professor')) {
            redirect('home');
        }
    }

    public function turma($turma_id, $disciplina_id){


        $professor_id = $this->session->userdata('usuario_id');
        
        //Verifica se professor é elegível para esta disciplina
        if(!$this->M_Disciplina->professor_elegivel_disciplina($professor_id, $disciplina_id)){
            redirect('chamada/listar/todas');
        }

        
    }
}