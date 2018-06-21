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

    public function lista_chamadas_por_turma($id){

        $query = $this->db->get_where('chamada_turma', array('turma_id' => $id));
        $query->result_array();
    }

    public function abre_chamada($id, $disciplina_id, $data_id, $data){
        
        $data = array(
            'disciplina_id' => $disciplina_id,
            'turma_id' => $id,
            'horario_id' => $data_id,
            'data' => $data,
            'status' => 'A'
        );
    }

    public function insere_chamada($alunos, $turma_id, $disciplina_id){
        
        $count = 0;
        foreach($alunos as $aluno){
            $data = array(
                'aluno_id' => $aluno,
                'turma_id' => $turma_id,
                'disciplina_id' => $disciplina_id,
                'data' => '2018/06/19 00:00:00',
                'ano' => 2018,
                'status' => 'F'
            );
            if($this->db->insert('chamada', $data)){
                $count++;
            }
        }
        if(count($alunos) == $count){
            return TRUE;
        }else{
            return FALSE;
        }
    }
}