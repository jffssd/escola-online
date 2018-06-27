<?php
class Efetuar extends CI_Controller{

	public function __construct(){
		
        parent::__construct();
        $this->load->library('parse');
        $this->load->library('l_calendario');
        if(!$this->session->userdata('professor')) {
            redirect('home');
        }
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
            $data['data_id'] = $data_id;
            $this->load->view('template/head');
            $this->load->view('turma/chamada/chamada', $data);
            $this->load->view('template/footer');
        }else{
            die(var_dump('Erro'));
        }
    }

    public function processa_chamada(){

        $data_id = intval($this->input->post('data_id'));

        $disciplina_id = intval($this->input->post('disciplina_id'));

        $turma_id = intval($this->input->post('turma_id'));

        $chamada_id = $this->M_Turma->busca_id_chamada($data_id, $disciplina_id, $turma_id);

        $cham_id = $chamada_id->id;

        if($this->input->post('aluno_chamada') != NULL){

            $alunos = $this->parse->array_to_array_int($this->input->post('aluno_chamada'));

            //Verifica se todos os alunos desta chamada estão vinculados à turma
            if($this->M_Turma->verif_alunos_chamada($turma_id, $alunos) == count($alunos)){
                
                //Verifica se existe chamada em aberto
                if($this->M_Turma->verif_chamada_ativa($cham_id)){
                    
                    //Insere dados da chamada no banco
                    if($this->M_Turma->insere_chamada($alunos, $cham_id)){
                        
                        if($this->M_Turma->finaliza_chamada($cham_id)){
                            echo json_encode(TRUE);
                            exit;
                        }else{
                            echo json_encode(FALSE);
                            exit;
                        }
                    }else{
                        echo json_encode(FALSE);
                        exit;
                    }   
                }else{
                    echo json_encode(FALSE);
                    exit;
                }
            }else{
                echo json_encode(FALSE);
                exit;
            }
        }else{
        
            if($this->M_Turma->finaliza_chamada($cham_id)){
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