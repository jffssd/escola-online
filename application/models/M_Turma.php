<?php
	class M_Turma extends CI_Model{

	public function get_all($id = NULL){

        if($id){
            $query = $this->db->get_where('turma', array('id' => $id));
            if($query->result_id->num_rows > 0){
                return $query->row();
            }else{
                return FALSE;
            }
        }else{
            $query = $query = $this->db->get('turma');
            return $query->result_array(); 
        }
    }

    public function alunos_by_turma($id){

        $this->db->select('usuario.id, usuario.nome');
        $this->db->from('turma_alunos');
        $this->db->join('usuario', 'usuario.id = turma_alunos.id');
        $this->db->where('turma_alunos.turma_id', $id);
        $this->db->where('turma_alunos.status', 'A');
        $query = $this->db->get();
        return $query->result_array(); 
    }
}