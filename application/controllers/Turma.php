<?php
class Turma extends CI_Controller{

	public function __construct(){
		
        parent::__construct();
        $this->load->library('parse');
	}

    public function inicio($id = NULL){

        $data['title'] = 'Turma';
        $turmas = $this->M_Turma->get_all($id);
        if($turmas){
            if($id){
                $data['by_id'] = TRUE;
                $data['alunos'] = $this->M_Turma->alunos_by_turma($id);
                $data['horario'] = $this->M_Horario->by_turma_id($id);
            }else{
                $data['by_id'] = FALSE;
            }
            $data['turmas'] = $turmas;
            $this->load->view('turma/index', $data);
        }else{
            die(var_dump('Erro'));
        }
    }

    public function chamada($id){

        $data['title'] = 'Turma';
        $turmas = $this->M_Turma->get_all($id);
        if($turmas){
            $data['by_id'] = TRUE;
            $data['alunos'] = $this->M_Turma->alunos_by_turma($id);
            $data['turmas'] = $turmas;
            $this->load->view('turma/chamada', $data);
        }else{
            die(var_dump('Erro'));
        }
    }

    public function processa_chamada(){

        $alunos = $this->parse->array_to_array_int($this->input->post('aluno_chamada'));
        $turma_id = $this->input->post('turma_id');
        if($this->M_Turma->verif_alunos_chamada($turma_id, $alunos) == count($alunos)){
            
        }else{
            
        }
    }
}