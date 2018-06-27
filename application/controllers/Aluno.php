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

    public function perfil(){

        $aluno_id = intval($this->session->userdata('usuario_id'));
    
        $data['aluno'] = $this->M_Aluno->get_info($aluno_id);
        
        if($data['aluno']){

            $date = new DateTime($data['aluno']->data_nasc);
    
            $data_nasc = $date->format('Y-m-d');

            $turma = $this->M_Turma->turma_by_aluno($aluno_id);
            $data['turma'] = $this->l_turma->format_alias($turma);
  
            $data['aluno']->data_nasc = $this->l_aluno->idade_by_data_nasc($data_nasc);
    
            $data['exp'] = $this->M_Aluno->get_exp_lvl($aluno_id);
    
            $nivel_atual = $data['exp']->nivel + 1;
    
            $matriz_nivel = $this->M_Aluno->get_next_lvl_exp($nivel_atual);
    
            $data['exp_prox_nivel'] = $matriz_nivel->exp_padrao;
    
            $data['conquistas'] = $this->M_Aluno->get_conquistas_aluno($aluno_id);
    
            $data['conquistas_all'] = $this->M_Aluno->get_conquistas();
    
            $data['pontos'] = $this->M_Aluno->get_pontos_aluno($aluno_id);
    
            $this->load->view('template/head');
            $this->load->view('aluno/inicio', $data);
            $this->load->view('template/footer');

        }else{
            $data['heading'] = 'E_0388';
            $data['message'] = 'Aluno especificado não foi encontrado.';
            $this->load->view('errors/cli/error_404', $data);
        }
    }


    public function faltas(){

        $aluno_id = intval($this->session->userdata('usuario_id'));

        $turma = $this->M_Aluno->get_turma_by_aluno($aluno_id);

        $total = $this->M_Aluno->get_faltas_aluno_total($aluno_id);

        $data['faltas_total'] = intval($total['faltas_total']);

        $disciplinas = $this->M_Turma->busca_disciplina_turma($turma->id);

        $faltas_disciplinas = $this->M_Aluno->get_faltas_aluno_por_disciplina($aluno_id, $turma->id);
        
        foreach($disciplinas as $disc){
            $disc->faltas = 0;
        }

        foreach($disciplinas as $disc){
            
            foreach($faltas_disciplinas as $falta_disc){
                if($disc->disciplina_id == $falta_disc->id){
                    $disc->faltas = intval($falta_disc->faltas);
                    break;
                }else{
                    $disc->faltas = 0;
                }
            }
        }

        $data['faltas_disciplinas'] = $disciplinas;
        $this->load->view('template/head');
        $this->load->view('usuario/aluno/faltas', $data);
        $this->load->view('template/footer');
    }

    public function notas(){

        $aluno_id = intval($this->session->userdata('usuario_id'));

        $turma = $this->M_Aluno->get_turma_by_aluno($aluno_id);

        $disciplinas = $this->M_Turma->busca_disciplina_turma($turma->id);

        foreach($disciplinas as $disc){
            $disc->turma_id = intval($turma->id);
        }

        $data['turma_id'] = $turma->id;
        $data['disciplinas'] = $disciplinas;
        $this->load->view('template/head');
        $this->load->view('usuario/aluno/notas', $data);
        $this->load->view('template/footer');
    }

    public function notas_por_disciplinas($turma_id, $disciplina_id){

        $aluno_id = intval($this->session->userdata('usuario_id'));

        $atividades = $this->M_Turma->atividades_por_param($turma_id, $disciplina_id);
        
        $disciplina = $this->M_Disciplina->by_id($disciplina_id);

        $notas_aluno = $this->M_Turma->notas_aluno($aluno_id);

        foreach($atividades as $ativ){
            foreach($notas_aluno as $notas){
                if($ativ->id == $notas->id){
                    $ativ->nota_aluno = intval($notas->nota);
                    break;
                }else{
                    $ativ->nota_aluno = 0;
                }
            }
        }

        $data['disciplina'] = $disciplina;
        $data['atividades'] = $atividades;
        $data['turma_id'] = $turma_id;

        $this->load->view('disciplina/nota_disciplina', $data);

    }
}