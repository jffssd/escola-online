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

        $this->db->select('usuario.id, usuario.nome, usuario.sobrenome');
        $this->db->from('turma_alunos');
        $this->db->join('usuario', 'turma_alunos.aluno_id = usuario.id');
        $this->db->where('turma_alunos.turma_id', $id);
        $this->db->where('turma_alunos.status', 'A');
        $query = $this->db->get();
        return $query->result_array(); 
    }

    public function turma_by_aluno($id){

        $this->db->select('turma.turno, turma.ciclo, turma.serie, turma.codigo');
        $this->db->from('turma_alunos');
        $this->db->join('turma', 'turma_alunos.turma_id = turma.id');
        $this->db->where('turma_alunos.aluno_id', $id);
        $this->db->where('turma_alunos.status', 'A');
        $query = $this->db->get();
        return $query->row(); 
    }

    public function verif_alunos_chamada($id, $id_alunos){
        $this->db->select('aluno_id');
        $this->db->from('turma_alunos');
        $this->db->where('turma_id', $id);
        $this->db->where('status', 'A');
        $this->db->where_in('aluno_id', $id_alunos);
        $query = $this->db->get();
        return count($query->result_array());
    }
}