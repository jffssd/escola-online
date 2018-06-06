<?php
class Aluno extends CI_Controller{

	public function __construct(){
		
		parent::__construct();
	}

    public function inicio($id = NULL){

        $data['title'] = 'Aluno';
        $aluno = $this->M_Aluno->get_all($id);
        if($aluno){
            if($id){
                $data['by_id'] = TRUE;
            }else{
                $data['by_id'] = FALSE;
            }
            $data['alunos'] = $aluno;
            $this->load->view('aluno/index', $data);
        }else{
            die(var_dump('Erro'));
        }
    }
}