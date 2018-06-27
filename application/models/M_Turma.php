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

    public function busca_lista_chamada($id_turma, $id_disciplina, $id_professor){
        
        $query =  $this->db->query("SELECT id, data, dia_semana
                                    FROM calendario_datas
                                    WHERE letivo = 'S'
                                    AND feriado = 'N'
                                    AND calendario_datas.dia_semana IN (SELECT dia_semana
                                                                        FROM horario 
                                                                        WHERE disciplina_id = {$id_disciplina}
                                                                        AND professor_id = {$id_professor}
                                                                        AND turma_id = {$id_turma})
                                    AND calendario_datas.data > CURRENT_DATE();");
        return $query->result();
    }

    public function busca_lista_chamadas_geradas($id_turma, $id_disciplina, $id_professor){
        
        $query =  $this->db->query("SELECT chamada_turma.data_id
                                    FROM chamada_turma
                                    JOIN calendario_datas on chamada_turma.data_id = calendario_datas.id
                                    WHERE chamada_turma.turma_id = {$id_turma}
                                    AND chamada_turma.disciplina_id = {$id_disciplina}
                                    AND calendario_datas.dia_semana IN (SELECT dia_semana
                                                                        FROM horario 
                                                                        WHERE disciplina_id = {$id_disciplina}
                                                                        AND professor_id = {$id_professor}
                                                                        AND turma_id = {$id_turma})");
        return $query->result_array();
    }

    public function busca_chamadas_geradas($id_turma, $id_disciplina, $id_professor){
        
        $query =  $this->db->query("SELECT calendario_datas.id, calendario_datas.data, calendario_datas.dia_semana, chamada_turma.status, chamada_turma.turma_id, chamada_turma.disciplina_id
                                    FROM chamada_turma
                                    LEFT JOIN calendario_datas ON chamada_turma.data_id = calendario_datas.id
                                    WHERE calendario_datas.dia_semana IN    (SELECT dia_semana
                                                                            FROM horario 
                                                                            WHERE disciplina_id = {$id_disciplina}
                                                                            AND professor_id = {$id_professor}
                                                                            AND turma_id = {$id_turma})
                                    AND chamada_turma.disciplina_id = {$id_disciplina}
                                    AND chamada_turma.turma_id = {$id_turma}
                                    AND calendario_datas.letivo = 'S'
                                    AND calendario_datas.feriado = 'N'
                                    AND calendario_datas.data > CURRENT_DATE();");
        return $query->result();
    }

    public function gera_chamada($data_id, $turma_id, $disciplina_id, $data_plain){

        $data = array(
            'data_id' => $data_id,
            'turma_id' => $turma_id,
            'disciplina_id' => $disciplina_id,
            'data' => $data_plain,
            'status' => 'A'
        );

        if($this->db->insert('chamada_turma', $data)){
            return TRUE;
        }else{
            return FALSE;
        }

    }

    public function insere_chamada($alunos, $chamada_id){
        
        $count = 0;
        foreach($alunos as $aluno){
            $data = array(
                'aluno_id' => $aluno,
                'chamada_turma_id' => $chamada_id,
                'falta' => TRUE,
                'status' => 'F'
            );
            if($this->db->insert('chamada_turma_aluno', $data)){
                $count++;
            }
        }
        if(count($alunos) == $count){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    public function busca_id_chamada($data_id, $disciplina_id, $turma_id){
        $query = $this->db->get_where('chamada_turma', array('data_id' => $data_id, 'disciplina_id' => $disciplina_id, 'turma_id' => $turma_id));
        return $query->row();
    }

    public function verif_chamada_ativa($cham_id){
        $query = $this->db->get_where('chamada_turma', array('status' => 'A', 'id' => $cham_id));

        if($query->row() != NULL){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    public function finaliza_chamada($cham_id){

        $data = array(
            'status' => 'F'
        );
        
        $this->db->where('id', $cham_id);
        if($this->db->update('chamada_turma', $data)){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    public function busca_disciplina_turma($turma_id){

        $this->db->select('disciplina.nome, disciplina_turma.disciplina_id');
        $this->db->from('disciplina_turma');
        $this->db->join('disciplina', 'disciplina_turma.disciplina_id = disciplina.id');
        $this->db->where('disciplina_turma.turma_id', $turma_id);
        $this->db->where('disciplina_turma.status', 'A');
        $query = $this->db->get();
        return $query->result();
    }

    public function atividades_por_param($turma_id, $disciplina_id){
        $this->db->select('atividade.*');
        $this->db->from('atividade');
        $this->db->join('atividade_tipo', 'atividade.tipo_id = atividade_tipo.id');
        $this->db->join('atividade_notas', 'atividade_notas.atividade_id = atividade.id', 'left');
        $this->db->where('atividade.turma_id', $turma_id);
        $this->db->where('atividade.disciplina_id', $disciplina_id);
        $query = $this->db->get();
        return $query->result();
    }

    public function notas_aluno($aluno_id){
        $this->db->select('id, nota, status');
        $this->db->from('atividade_notas');
        $this->db->where('aluno_id', $aluno_id);
        $query = $this->db->get();
        return $query->result(); 
    }
}