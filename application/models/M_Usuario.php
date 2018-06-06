<?php
	class M_Usuario extends CI_Model{

	public function register($usuario, $email, $senha_encriptada, $permissao, $status){

		$data = array(
						'usuario' => $usuario,
						'email' => $email,
						'senha' => $senha_encriptada,
						'permissao' => $permissao,
						'status' => $status
					);

		return $this->db->insert('usuario', $data);
	}

	public function login($usuario, $senha_encriptada){

		$this->db->where('usuario', $usuario);
		$this->db->where('senha', $senha_encriptada);
		$result = $this->db->get('usuario');

		if ($result->num_rows() == 1) {
			return $result->row(0);
		}else{
			return false;
		}
	}

	public function check_username_exists($usuario){

		$query = $this->db->get_where('usuario', array('usuario' => $usuario));
		
		if(empty($query->row_array())){
			return true;
		}else{
			return false;
		}
	}

	public function check_email_exists($email){

		$query = $this->db->get_where('usuario', array('email' => $email));
		if(empty($query->row_array())){
			return true;
		}else{
			return false;
		}
	}

	public function usuario_login_log($id, $ip){

		$data = array(
			'usuario_id' => $id,
			'ip' => $ip,
			'tipo' => 'Ação',
			'msg' => 'O usuário realizou login com sucesso',
		);

		$this->db->insert('usuario_log', $data);
	}

	public function usuario_logout_log($id, $ip){

		$data = array(
			'usuario_id' => $id,
			'ip' => $ip,
			'tipo' => 'Ação',
			'msg' => 'O usuário realizou logout com sucesso'
		);

		$this->db->insert('usuario_log', $data);
	}

	/*	// Muda a senha do usuário
	public function change_password($nova_senha){

			$data = array(
			'senha' => md5($nova_senha)
		    );
		$this->db->where('id', $this->session->userdata('user_id'));
		return $this->db->update('usuario', $data);
	}

	// Compara o campo senha antiga com a cadastrada no banco
	public function match_old_password($senha){

		$id = $this->session -> userdata('user_id');
		if($id === FALSE){
			$query = $this->db->get('usuario');
			return $query->result_array(); 
		}

		$query = $this->db->get_where('usuario', array('senha' => $senha));
		return $query->row_array();
	}

	// Verifica se o e-mail informado existe
	public function email_exists(){
	
		$email = $this->input->post('email');
		$query = $this->db->query("SELECT email, senha FROM usuario WHERE email='$email'");    
		if($row = $query->row()){
			return TRUE;
		}else{
			return FALSE;
		}
	}

	// Verifica senha temporária
	public function temp_reset_password($temp_pass){

		date_default_timezone_set('America/Sao_Paulo');

		$data = array(
					'email' => $this->input->post('email'),
					'chave_temporaria' => $temp_pass,
					'data_solic_senha' => date("Y-m-d H:i:s"),
					'req_troca_senha' => 'SISTEMA'
					);

			$email = $data['email'];

		if($data){
			$this->db->where('email', $email);
			$this->db->update('usuario', $data);  
			return TRUE;
		}else{
			return FALSE;
		}
	}


	// Verifica se a senha temporária é valida
	public function is_temp_pass_valid($temp_pass, $email){
		$this->db->where('email', $email);
		$this->db->where('chave_temporaria', $temp_pass);
		$query = $this->db->get('usuario');
		if($query->num_rows() == 1){
			return TRUE;
		}else{
			return FALSE;
		} 
	}

	public function cadastrar_nova_senha($chave_temporaria, $email, $nova_senha){

		date_default_timezone_set('America/Sao_Paulo');

		$data = array(
					'chave_temporaria' => NULL,
					'senha' => $nova_senha
					);

		$this->db->where('email', $email);
		$this->db->where('chave_temporaria', $chave_temporaria);
		
		if($this->db->update('usuario', $data)){

			return TRUE;

		}else{

			return FALSE;

		}
	}

		// Logar como administrador
		public function adminLogin($email, $senha_encriptada){
		
			//Validação
			$this->db->where('email', $email);
			$this->db->where('senha', $senha_encriptada);
	
			$result = $this->db->get('usuario');
	
			if ($result->num_rows() == 1) {
				return $result->row(0);
			}else{
				return false;
			}
		}
	
		// Excluir usuário
		public function delete($id,$table){
	
			$this->db->where('id', $id);
			$this->db->delete($table);
			return true;
		}
	
		// Adicionar usuário comum
		public function add_user($post_image,$senha){
	
			$data = array(
							'usuario' => $this->input->post('usuario'),
							'email' => $this->input->post('email'),
							'senha' => $senha,
							'permissao' => '2',
							'status' => $this->input->post('status'),
							'imagem_perfil' => $post_image,
							'data_registro' => date("Y-m-d H:i:s")
						  );
	
			return $this->db->insert('usuario', $data);
		}
	
		// Busca lista de usuários cadastrados	
		public function get_users($username = FALSE, $limit = FALSE, $offset = FALSE){
	
				if ($limit) {
					$this->db->limit($limit, $offset);
				}
	
				if($username === FALSE){
				$this->db->order_by('usuario.id', 'DESC');
				$query = $this->db->get('usuario');
				return $query->result_array(); 
			}
			$query = $this->db->get_where('usuario', array('usuario' => $usuario));
			return $query->row_array();
		}
	
		public function get_user_logs($id){
	
			$this->db->where('usuario_id', $id);
			$this->db->order_by("data_hora", 'desc');
	
			return $this->db->get('usuario_log');
		}
	
		//Habilitar Usuário
		public function enable($id,$table){
		
			$data = array(
				'status' => 0
				);
			$this->db->where('id', $id);
			return $this->db->update($table, $data);
		}
		
		//  Desabilitar usuário
		public function disable($id,$table){
		
			$data = array(
				'status' => 1
				);
			$this->db->where('id', $id);
			return $this->db->update($table, $data);
		}
	
		// Busca lista de usuários
		public function get_user($id = FALSE){
	
			if($id === FALSE){
				$query = $this->db->get('usuario');
				return $query->result_array(); 
			}
	
			$query = $this->db->get_where('usuario', array('id' => $id));
			return $query->row_array();
		}
	
		// Atualiza dados do usuário
		public function update_user_data($post_image){
	
			$data = array(
							'usuario' => $this->input->post('usuario'),
							'email' => $this->input->post('email'),
							'status' => $this->input->post('status'),
							'permissao' => $this->input->post('permissao'),
							'imagem_perfil' => $post_image,
							'data_registro' => date("Y-m-d H:i:s")
						  );
	
			$this->db->where('id', $this->input->post('id'));
			$d = $this->db->update('usuario', $data);
		}
	
		// Busca configurações do site
		public function get_siteconfiguration($id = FALSE){
	
			if($id === FALSE){
				$query = $this->db->get('config_site');
				return $query->result_array(); 
			}
	
			$query = $this->db->get_where('config_site', array('id' => $id));
			return $query->row_array();
		}
	
		// Atualiza configurações do site
		public function update_siteconfiguration($id = FALSE){
	
			if($id === FALSE){
				$query = $this->db->get('config_site');
				return $query->result_array(); 
			}
	
			$query = $this->db->get_where('config_site', array('id' => $id));
			return $query->row_array();
		}
	
		// Realiza alteração nos dados de configuração do site
		public function update_siteconfiguration_data($post_image){
	
			$data = array('titulo_site' => $this->input->post('titulo_site'),
						  'nome_site' => $this->input->post('nome_site'),
						  'logo' => $post_image
						);
	
			$this->db->where('id', $this->input->post('id'));
			return $this->db->update('config_site', $data);
		}*/
}