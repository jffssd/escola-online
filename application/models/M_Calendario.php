<?php
	class M_Calendario extends CI_Model{

    public function get_all(){

        $query = $query = $this->db->get('calendario');
        return $query->result_array(); 
    }

    public function get_by_id($id){

        $query = $this->db->get_where('calendario', array('id' => $id));
        return $query->result_array(); 
    }

    public function inserir($id, $datas){
        $count = 0;
        foreach($datas as $data){
            $dados = array(
                'calendario_id' => $id,
                'data' => $data,
                'feriado' => 'N',
                'reposicao' => 'N',
                'semestre' => 0,
            );
            if($this->db->insert('calendario_datas', $dados)){
                continue;
            }else{
                return FALSE;
            }
        }
        return TRUE;
    }

    public function id_by_data($data){

        $query = $this->db->get_where('calendario_datas', array('data' => $data));
        return $query->row(); 
    }
}