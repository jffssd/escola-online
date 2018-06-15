<?php
class Calendario extends CI_Controller{

	public function __construct(){
		
        parent::__construct();
        $this->load->library('l_calendario');
	}

    public function inicio($id = NULL){
    
        $data['title'] = 'Calendario';
        $data['calendario'] = $this->M_Calendario->get_by_id($id);
        $this->load->view('calendario/index', $data);
    }

    public function gerar(){
        
        $var = $this->l_calendario->gerar_datas_calend();

        if($this->M_Calendario->inserir(1, $var)){
            var_dump('Success');
        }else{
            var_dump('Error');
        }
    }
}