<?php
class Efetuar extends CI_Controller{

	public function __construct(){
		
        parent::__construct();
        $this->load->library('parse');
        $this->load->library('l_calendario');
    }
    
    public function turma($turma_id, $disciplina_id, $data_id){

        $data['title'] = 'Turma';
        $turmas = $this->M_Turma->get_all($turma_id);
        $data['disciplina_id'] = $disciplina_id;


        $data_calendario = $this->M_Calendario->data_by_id($data_id);

        $data['data'] = $this->l_calendario->formatar_data($data_calendario->data);

        $data['dia_semana'] = $this->l_calendario->info_dia_semana($data['data']);
        if($turmas){
            $data['by_id'] = TRUE;
            $data['alunos'] = $this->M_Turma->alunos_by_turma($turma_id);
            $data['turmas'] = $turmas;
            $this->load->view('template/head');
            $this->load->view('turma/chamada/chamada', $data);
            $this->load->view('template/footer');
        }else{
            die(var_dump('Erro'));
        }
    }

    public function processa_chamada(){
        $alunos = $this->input->post('aluno_chamada');
        $alunos = $this->parse->array_to_array_int($this->input->post('aluno_chamada'));
        $turma_id = intval($this->input->post('turma_id'));
        $disciplina_id = intval($this->input->post('disciplina_id'));
        $data_chamada = str_replace('-','/',$this->input->post('data_chamada').' 00:00:00');
        if($this->M_Turma->verif_alunos_chamada($turma_id, $alunos) == count($alunos)){
            if($this->M_Turma->gera_chamada($alunos, $turma_id, $disciplina_id)){
                echo json_encode(TRUE);
                exit;
            }else{
                echo json_encode(FALSE);
                exit;
            }
        }
    }

    public function gerar_chamada($turma_id, $disciplina_id, $data_id){

        $data_plain = $this->M_Calendario->data_by_id($data_id);
        
        if($this->M_Turma->gera_chamada($data_id, $turma_id, $disciplina_id, $data_plain->data)){
            echo json_encode(TRUE);
            exit;
        }else{
            echo json_encode(FALSE);
            exit;
        }
    }
}

?>