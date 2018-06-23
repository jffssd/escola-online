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

    public function controle($id){

        $date = date('Y-m-d 00:00:00', time());
        $datex = $this->l_calendario->info_dia_semana($date);
        //$lista_chamadas = $this->M_Calendario->id_by_data($date);
        //$date = strtotime(date("Y-m-d", strtotime("-5 day")));
        die(var_dump($datex));
    }
}