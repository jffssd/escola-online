<pre>

<?php
	class M_Disciplina extends CI_Model{

    public function by_id($id){

        $query = $this->db->get_where('disciplina', array('id' => $id));
        return $query->row(); 
    }

    public function disciplinas_by_professor($id){

        $this->db->select('disciplina.id, disciplina.nome');
        $this->db->from('professor_disciplina');
        $this->db->join('disciplina', 'professor_disciplina.disciplina_id = disciplina.id');
        $this->db->where('professor_disciplina.professor_id', $id);
        $this->db->where('professor_disciplina.status', 'A');
        $query = $this->db->get();
        return $query->result(); 
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

    public function turmas_disciplina_professor($disciplina_id, $professor_id){

        $this->db->select('turma.*');
        $this->db->from('professor_disciplina');
        $this->db->join('disciplina', 'professor_disciplina.disciplina_id = disciplina.id');
        $this->db->join('disciplina_turma', 'professor_disciplina.disciplina_id = disciplina_turma.disciplina_id');
        $this->db->join('turma', 'disciplina_turma.turma_id  = turma.id');
        $this->db->where('professor_disciplina.disciplina_id', $disciplina_id);
        $this->db->where('professor_disciplina.professor_id', $professor_id);
        $this->db->where('professor_disciplina.status', 'A');
        $query = $this->db->get();
        return $query->result(); 
    }

    public function professor_elegivel_disciplina($professor_id, $disciplina_id){
        $this->db->select('disciplina_id');
        $this->db->from('professor_disciplina');
        $this->db->where('disciplina_id', $disciplina_id);
        $this->db->where('professor_id', $professor_id);
        $this->db->where('status', 'A');
        $query = $this->db->get();
        if($query->result_id->num_rows < 1){
            return FALSE;
        }else{
            return TRUE;
        }
    }
}