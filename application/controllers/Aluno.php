<?php
class Aluno extends CI_Controller{

	public function __construct(){
		
        parent::__construct();
        $this->load->library('l_aluno');
        $this->load->library('l_turma');
	}

    public function todos(){

        $data['title'] = 'Aluno';
        $data['alunos'] = $this->M_Aluno->get_all();
        $this->load->view('aluno/index', $data);
    }

    public function visualizar($id){

        $data['title'] = 'Aluno';
        $data['alunos'] = $this->M_Aluno->get_all($id);
        $this->load->view('aluno/index', $data);
    }

    public function inicio($id){

        $data['title'] = 'Meu Perfil';
    
        $data['aluno'] = $this->M_Aluno->get_info($id);
        
        if($data['aluno']){

            $date = new DateTime($data['aluno']->data_nasc);
    
            $data_nasc = $date->format('Y-m-d');

            $turma = $this->M_Turma->turma_by_aluno($id);
            $data['turma'] = $this->l_turma->format_alias($turma);
  
            $data['aluno']->data_nasc = $this->l_aluno->idade_by_data_nasc($data_nasc);
    
            $data['exp'] = $this->M_Aluno->get_exp_lvl($id);
    
            $nivel_atual = $data['exp']->nivel + 1;
    
            $matriz_nivel = $this->M_Aluno->get_next_lvl_exp($nivel_atual);
    
            $data['exp_prox_nivel'] = $matriz_nivel->exp_padrao;
    
            $data['conquistas'] = $this->M_Aluno->get_conquistas_aluno($id);
    
            $data['conquistas_all'] = $this->M_Aluno->get_conquistas();
    
            $data['pontos'] = $this->M_Aluno->get_pontos_aluno($id);
    
            $this->load->view('template/head');
            $this->load->view('aluno/inicio', $data);
            $this->load->view('template/footer');

        }else{
            $data['heading'] = 'E_0388';
            $data['message'] = 'Aluno especificado não foi encontrado.';
            $this->load->view('errors/cli/error_404', $data);
        }
    }
}