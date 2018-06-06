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
}