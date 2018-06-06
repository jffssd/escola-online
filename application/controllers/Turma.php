<?php
class Turma extends CI_Controller{

	public function __construct(){
		
		parent::__construct();
	}

    public function inicio($id = NULL){

        $data['title'] = 'Turma';
        $turmas = $this->M_Turma->get_all($id);
        if($turmas){
            if($id){
                $data['by_id'] = TRUE;
                $data['alunos'] = $this->M_Turma->alunos_by_turma($id);
            }else{
                $data['by_id'] = FALSE;
            }
            $data['turmas'] = $turmas;
            $this->load->view('turma/index', $data);
        }else{
            die(var_dump('Erro'));
        }
    }
}