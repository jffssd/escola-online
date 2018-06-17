<?php
	class M_Aluno extends CI_Model{

	public function get_all($id = NULL){

        if($id){
            $query = $this->db->get_where('usuario', array('id' => $id, 'aluno' => 'S'));
            if($query->result_id->num_rows > 0){
                return $query->row();
            }else{
                return FALSE;
            }
        }else{
            $query = $this->db->get_where('usuario', array('aluno' => 'S'));
            return $query->result_array(); 
        }
    }

    public function get_info($id){

        $query = $this->db->get_where('usuario', array('id' => $id, 'aluno' => 'S'));
        if($query->row() != NULL){
            return $query->row(); 
        }else{
            return FALSE;
        }
    }

    public function get_exp_lvl($id){
        $query = $this->db->get_where('aluno_exp', array('aluno_id' => $id));
        return $query->row(); 
    }

    public function get_next_lvl_exp($nivel){
        $query = $this->db->get_where('matriz_exp', array('nivel_base' => $nivel));
        return $query->row(); 
    }

    public function get_conquistas(){
        $query = $this->db->get_where('conquista', array('status' => 'A'));
        return $query->result();
    }

    public function get_conquistas_aluno($id){
        $this->db->select('conquista.id, conquista.nome, conquista.icone, conquista.descricao');
        $this->db->from('aluno_conquista');
        $this->db->join('conquista', 'aluno_conquista.conquista_id = conquista.id');
        $this->db->where('aluno_conquista.aluno_id', $id);
        $query = $this->db->get();
        return $query->result(); 
    }

    public function get_pontos_aluno($id){
        $query = $this->db->get_where('aluno_pontos', array('aluno_id' => $id));
        return $query->row();

    }
}