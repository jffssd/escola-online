<?php
	class M_Horario extends CI_Model{

    public function by_turma_id($id){

        $this->db->select('horario.ordem, horario.posicao, horario.disciplina_id, disciplina.nome');
        $this->db->from('horario');
        $this->db->join('disciplina', 'horario.disciplina_id = disciplina.id');
        $this->db->where('horario.turma_id', $id);
        $this->db->where('horario.status', 'A');
        $query = $this->db->get();
        return $query->result(); 
    }
}