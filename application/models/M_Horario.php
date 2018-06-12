<?php
	class M_Horario extends CI_Model{

    public function by_turma_id($id){

        $query = $this->db->get_where('horario', array('turma_id' => $id, 'status' => 'A'));
        return $query->result(); 
    }
}