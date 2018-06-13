<?php
	class M_Disciplina extends CI_Model{

    public function by_id($id){

        $query = $this->db->get_where('disciplina', array('id' => $id));
        return $query->row(); 
    }

    public function professores_by_id($id){

        $this->db->select('usuario.id, usuario.nome');
        $this->db->from('professor_disciplina');
        $this->db->join('usuario', 'professor_disciplina.professor_id = usuario.id');
        $this->db->where('professor_disciplina.disciplina_id', $id);
        $this->db->where('professor_disciplina.status', 'A');
        $query = $this->db->get();
        return $query->result_array(); 
    }
}
