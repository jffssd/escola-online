<?php
class Listar extends CI_Controller{

	public function __construct(){
        parent::__construct();
        $this->load->library('l_aluno');
        $this->load->library('l_turma');
        $this->load->library('l_calendario');
        if(!$this->session->userdata('professor')) {
            redirect('home');
        }
    }

    public function todas(){

        $professor_id = $this->session->userdata('usuario_id');
        $disciplinas = $this->M_Disciplina->disciplinas_by_professor($professor_id);

        foreach($disciplinas as $disciplina){
            $turmas = $this->M_Disciplina->turmas_disciplina_professor($disciplina->id ,$professor_id);
            $disciplina->turmas = $turmas;
        }
        
        $data['disciplina_turma'] = $disciplinas;
        $this->load->view('disciplina/turmas', $data);
    }

    public function calendario($turma_id, $disciplina_id){

        $professor_id = $this->session->userdata('usuario_id');
        
        //Verifica se professor é elegível para esta disciplina
        if(!$this->M_Disciplina->professor_elegivel_disciplina($professor_id, $disciplina_id)){
            redirect('chamada/listar/todas');
        }

        $calendario = $this->M_Turma->busca_lista_chamada($turma_id, $disciplina_id, $professor_id);

        $chamadas_geradas =  $this->M_Turma->busca_lista_chamadas_geradas($turma_id, $disciplina_id, $professor_id);

        $chamadas_ids = array();
        foreach($chamadas_geradas as $cham_ger){
            array_push($chamadas_ids, intval($cham_ger['data_id']));
        }

        foreach($calendario as $cal_datas){ 
            if(in_array(intval($cal_datas->id), $chamadas_ids)){
                $cal_datas->status = 'A';
            }else{
                $cal_datas->status = 'U';
            }
        }

        $data['turma_id'] = $turma_id;
        $data['disciplina_id'] = $disciplina_id;
        $data['datas_chamada'] = $calendario;
        $this->load->view('turma/chamada/calendario', $data);
    }

    public function turma($turma_id, $disciplina_id){

        $professor_id = $this->session->userdata('usuario_id');
        
        //Verifica se professor é elegível para esta disciplina
        if(!$this->M_Disciplina->professor_elegivel_disciplina($professor_id, $disciplina_id)){
            redirect('chamada/listar/todas');
        }

        $datas_chamada = $this->M_Turma->busca_chamadas_geradas($turma_id, $disciplina_id, $professor_id);
        foreach($datas_chamada as $datas){ 
            $datas->data = $this->l_calendario->formatar_data($datas->data);
        }

        $data['turma_id'] = $turma_id;
        $data['disciplina_id'] = $disciplina_id;
        $data['datas_chamada'] = $datas_chamada;
        $this->load->view('template/head', $data);
        $this->load->view('turma/chamada/listar', $data);
        $this->load->view('template/footer', $data);
    }
}