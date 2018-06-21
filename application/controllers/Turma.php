<?php
class Turma extends CI_Controller{

	public function __construct(){
		
        parent::__construct();
        $this->load->library('parse');
        $this->load->library('l_calendario');
	}

    public function inicio($id = NULL){

        $data['title'] = 'Turma';
        $turmas = $this->M_Turma->get_all($id);
        if($turmas){
            if($id){
                $data['by_id'] = TRUE;
                $data['alunos'] = $this->M_Turma->alunos_by_turma($id);
                $data['horario'] = $this->M_Horario->by_turma_id($id);
                $data['data'] = $date = date('d/m/Y', time());
                $data['dia_sem'] = $this->l_calendario->info_dia_semana($data['data']);
            }else{
                $data['by_id'] = FALSE;
            }
            $data['turmas'] = $turmas;
            $this->load->view('template/head');
            $this->load->view('turma/index', $data);
            $this->load->view('template/footer');
        }else{
            die(var_dump('Erro'));
        }
    }

    public function chamada($id, $disciplina_id){

        $data['title'] = 'Turma';
        $turmas = $this->M_Turma->get_all($id);
        $data['disciplina_id'] = $disciplina_id;
        $data['data'] = $date = date('d/m/Y', time());
        $data['dia_semana'] = $this->l_calendario->info_dia_semana($data['data']);
        die(var_dump($data['dia_semana']));

        if($turmas){
            $data['by_id'] = TRUE;
            $data['alunos'] = $this->M_Turma->alunos_by_turma($id);
            $data['turmas'] = $turmas;
            $this->load->view('template/head');
            $this->load->view('turma/chamada', $data);
            $this->load->view('template/footer');
        }else{
            die(var_dump('Erro'));
        }
    }

    public function controle($id){

        $date = date('Y-m-d 00:00:00', time());
        $datex = $this->l_calendario->info_dia_semana($date);
        //$lista_chamadas = $this->M_Calendario->id_by_data($date);
        //$date = strtotime(date("Y-m-d", strtotime("-5 day")));
        die(var_dump($datex));
    }

    public function processa_chamada(){
        $alunos = $this->input->post('aluno_chamada');
        $alunos = $this->parse->array_to_array_int($this->input->post('aluno_chamada'));
        $turma_id = $this->input->post('turma_id');
        $disciplina_id = $this->input->post('disciplina_id');
        $data_chamada = str_replace('-','/',$this->input->post('data_chamada').' 00:00:00');
        if($this->M_Turma->verif_alunos_chamada($turma_id, $alunos) == count($alunos)){
            if($this->M_Turma->insere_chamada($alunos, $turma_id, $disciplina_id)){
                echo json_encode(TRUE);
                exit;
            }else{
                echo json_encode(FALSE);
                exit;
            }
        }
    }
}