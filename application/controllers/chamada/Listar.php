<?php
class Listar extends CI_Controller{

	public function __construct(){
        parent::__construct();
        $this->load->library('l_aluno');
        $this->load->library('l_turma');
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
}