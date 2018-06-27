<?php
	class Usuario extends CI_Controller{


		public function __construct(){
			
			parent::__construct();

		}

		public function dashboard(){

			if(!$this->session->userdata('login')) {
				redirect('entrar');
			}
			$data['title'] = 'Dashboard';

			if($this->session->userdata('professor')){
				$this->load->view('template/head');
				$this->load->view('usuario/professor/dashboard', $data);
				$this->load->view('template/footer');
			}

			if($this->session->userdata('aluno')){
				$this->load->view('template/head');
				$this->load->view('usuario/aluno/dashboard', $data);
				$this->load->view('template/footer');
			}
		}

		public function perfil(){

			if(!$this->session->userdata('login')) {
				redirect('entrar');
			}
			$data['title'] = 'Perfil';
			$this->load->view('usuario/perfil', $data);
		}

		public function register(){

			if($this->session->userdata('login')) {
				redirect('index');
			}

			$data['title'] = 'Cadastrar';

			$this->form_validation->set_rules('usuario', 'Usuario', 'required|callback_check_username_exists');
			$this->form_validation->set_rules('email', 'E-mail', 'required|callback_check_email_exists');
			$this->form_validation->set_rules('senha', 'Senha', 'required');
			$this->form_validation->set_rules('senha2', 'Confirme a Senha', 'matches[senha]');

			if($this->form_validation->run() === FALSE){

				$this->load->view('usuario/registrar', $data);

			}else{

				$usuario = $this->input->post('usuario');
				$email = $this->input->post('email');
				$senha_encriptada = md5($this->input->post('senha'));
				$permissao = 2;
				$status = 1;
				$this->M_Usuario->register($usuario, $email, $senha_encriptada, $permissao, $status);

				//Set Message
				$this->session->set_flashdata('usuario_cadastrado', 'Olá '.$this->input->post('usuario').'! Você foi registrado com sucesso e já pode se conectar!');
				redirect('usuario/login');
			}
		}

		public function login(){

			if($this->session->userdata('login')) {
				redirect('inicio');
			}

			$data['title'] = 'Conectar-se';
			$this->load->view('usuario/login', $data);
		}

		// Login do usuário
		public function processa_login(){

			if($this->session->userdata('login')) {
				redirect('inicio');
			}

			$data['title'] = 'Conectar-se';

			$this->form_validation->set_rules('usuario', 'Usuário', 'required');
			$this->form_validation->set_rules('senha', 'Senha', 'required');

			if($this->form_validation->run() === FALSE){
			
				$this->session->set_flashdata('falha_login', 'Login ou senha inválidos');

				$this->load->view('usuario/login', $data);

			}else{

				// Obtém usuário e senha encriptada
				$usuario = $this->input->post('usuario');
				$senha_encriptada = md5($this->input->post('senha'));

				$usuario_id = $this->M_Usuario->login($usuario, $senha_encriptada);
				
				if ($usuario_id) {
					
					// Cria sessão
					$user_data = array(
								'usuario_id' => $usuario_id->id,
				 				'usuario' => $usuario,
				 				'email' => $usuario_id->email,
								'login' => true,
								'permissao' => $usuario_id->permissao,
								'imagem_perfil' => $usuario_id->imagem_perfil
					 );
					
					if($usuario_id->aluno == 'S'){
						$user_data['aluno'] = TRUE;
					}

					if($usuario_id->professor == 'S'){
						$user_data['professor'] = TRUE;
					}

				 	$this->session->set_userdata($user_data);

					 $ip = $this->input->ip_address();
					 $id = $this->session->userdata('usuario_id');
					 
					 try {
		 
						 $this->M_Usuario->usuario_login_log($id, $ip);
		 
					 } catch (Exception $e) {
						 
					 }

					// Define mensagem
					$this->session->set_flashdata('user_loggedin', 'Bem vindo!.');
					redirect('usuario/dashboard');
				}else{

					$this->session->set_flashdata('falha_login', 'E-mail ou senha inválidos!');
					redirect('usuario/login');
				}
			}
		}

		// log user out
		public function logout(){

			if(!$this->session->userdata('login')) {
				redirect('home');
			}
			// unset user data
			$ip = $this->input->ip_address();
			$id = $this->session->userdata('usuario_id');
			
			try {

				$this->M_Usuario->usuario_logout_log($id, $ip);

			} catch (Exception $e) {
				
			}
			$this->session->unset_userdata('login');
			$this->session->unset_userdata('usuario_id');
			$this->session->unset_userdata('usuario');
			$this->session->unset_userdata('email');
			$this->session->unset_userdata('permissao');
			$this->session->unset_userdata('imagem_perfil');
			$this->session->unset_userdata('professor');
			$this->session->unset_userdata('aluno');

			//Set Message
			$this->session->set_flashdata('user_loggedout', 'You are logged out.');
			redirect(base_url());
		}

		public function check_username_exists($username){
			$this->form_validation->set_message('check_username_exists', 'O nome de usuário <strong>'.$username.'</strong> já foi utilizado. Por favor, tente um diferente.');

			if ($this->M_Usuario->check_username_exists($username)) {
				return true;
			}else{
				return false;
			}
		}

		public function check_email_exists($email){
			$this->form_validation->set_message('check_email_exists', 'O e-mail <strong>'.$email.'</strong> já foi cadastrado anteriormente.');

			if ($this->M_Usuario->check_email_exists($email)) {
				return true;
			}else{
				return false;
			}
		}

	public function reset_password($temp_pass, $email){
		
		$this->load->model('Administrator_Model');
		
		//$this->session->set_userdata['temp_email'] = '';

		$plain_temp_email = base64_decode($email);

		if($this->Administrator_Model->is_temp_pass_valid($temp_pass, $plain_temp_email)){
		
			$data['email'] = $plain_temp_email;
			$data['chave_temporaria'] = $temp_pass;
			$this->load->view('usuario/submeter_nova_senha', $data);

		}else{
			echo "the key is not valid";    
		}
	}

	public function cadastrar_nova_senha(){
		
		$this->load->model('Administrator_Model');

		$data['title'] = 'Cadastrar nova Senha';

		$this->form_validation->set_rules('senha', 'Senha', 'required');
		$this->form_validation->set_rules('senha2', 'Confirme a Senha', 'matches[senha]');

		if($this->form_validation->run() === FALSE){

			$this->load->view('usuario/submeter_nova_senha', $data);

		}else{

			$chave_temporaria = $this->input->post('chave_temporaria');
			$email = $this->input->post('email');
			$nova_senha_encriptada = md5($this->input->post('senha'));

			if($this->Administrator_Model->cadastrar_nova_senha($chave_temporaria, $email, $nova_senha_encriptada)){

				$this->session->set_flashdata('sucesso', 'Sua senha foi alterada com êxito!');
				redirect('login');
				
			}else{
				
				$this->session->set_flashdata('erro', 'Houve um erro ao tentar processar sua solicitação');
				redirect('login');
			}
		}
	}

	public function relembrar_senha($page = 'relembrar_senha'){

		$data['title'] = ucfirst($page);
		$this->load->view('usuario/login/'.$page, $data);
	}

	public function forget_password_mail(){
    	$this->load->library('form_validation');
    	
    	$this->form_validation->set_rules('email', 'Email', 'required|trim|xss_clean|callback_validate_credentials');

        //check if email is in the database
        $this->load->model('Administrator_Model');
        if($this->Administrator_Model->email_exists()){

            //$them_pass is the varible to be sent to the user's email
            $temp_pass = md5(uniqid());

            $email_key = str_replace("=","", base64_encode($this->input->post('email')));
 
             //send email with #temp_pass as a link
            $config = Array(
            	'protocol' => 'smtp',
            	'smtp_host' => 'ssl://smtp.googlemail.com',
            	'validation' => TRUE,
            	'smtp_port' => 465,
            	'smtp_user' => '',
            	'smtp_pass' => '',
            	'mailtype' => 'html',
            	'charset' => 'utf-8',
            	'wordwrap' => TRUE,
            	'newline' => "\r\n"
            );

			$this->load->library('email', $config);
            $this->email->from('jffssd@gmail.com', 'Centro e-Sports!');
            $this->email->to($this->input->post('email'));
            $this->email->subject('Centro e-Sports! - Redefinir sua senha');

            $message = "<p>Este e-mail foi enviado devido a uma requisição de redefinição de senha no site Centro e-Sports!</p>";
            $message .= "<p><a href='".base_url()."usuario/reset_password/$temp_pass/$email_key'>Clique aqui </a> para redefinir sua senha, se não tiver conhecimento sobre esta ação, ignore-a.</p>";
            $this->email->message($message);

            if($this->email->send()){

                $this->load->model('Administrator_Model');
                if($this->Administrator_Model->temp_reset_password($temp_pass)){

                echo '</pre>';
                $data['msg_tipo'] = "Mensagem";
            	$data['mensagem'] = "Enviamos um e-mail para <strong>".$this->input->post('email')."</strong> contendo as instruções para a alteração da sua senha, caso não receba, verifique sua caixa de spam.";
				$this->load->view('usuario/recuperar_senha_info', $data);

                }
            }else{

                echo '</pre>';
            	$data['msg_tipo'] = "Erro";
            	$data['mensagem'] = "Houve um erro ao tentar enviar o e-mail, entre em contato com o administrador do sistema e reporte o ocorrido.";
				$this->load->view('usuario/recuperar_senha_info', $data);
            }
        }else{

            $this->session->set_flashdata('erro', 'O e-mail informado não está cadastrado');
				redirect('usuario/relembrar_senha');
        }
	}


	/*public function cadastrar_usuario($page = 'cadastrar_usuario'){

		if (!file_exists(APPPATH.'views/admin/'.$page.'.php')) {
			show_404();
	    }
		// Se não estiver logado, envia para a página de login.
		if(!$this->session->userdata('login')) {
			redirect('admin/index');
		}
		
		$data['title'] = 'Criar Usuário';
		$referencia['item'] = '';
		$referencia['sub-item'] = '';

		// Define as regras de validação
		$this->form_validation->set_rules('usuario', 'Usuario', 'required|callback_check_username_exists');
		$this->form_validation->set_rules('email', 'Email', 'required|callback_check_email_exists');

		// Se não rodar, envia para a página de cadastro novamente.
		if($this->form_validation->run() === FALSE){


   			 $this->load->view('admin/'.$page, $data);

		}else{
			//Faz upload da imagem
			$config['upload_path'] = './assets/img/usuarios';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size'] = '2048';
			$config['max_width'] = '2000';
			$config['max_height'] = '2000';
			//Carrega a bibliote ca de upload com os dados informados
			$this->load->library('upload', $config);

			// Se não conseguir fazer o upload, define mensagen de erro e atribui imagem padrão.
			// Se conseguir, define dados do upload
			if(!$this->upload->do_upload()){
				$errors =  array('error' => $this->upload->display_errors());
				$post_image = 'default-profile.png';
			}else{
				$data =  array('upload_data' => $this->upload->data());
				$post_image = $_FILES['userfile']['name'];
			}

			//???
			$senha = md5('Test@123');

			$this->Administrator_Model->add_user($post_image,$senha);

			//Define Mensagem
			$this->session->set_flashdata('success', 'User has been created Successfull.');
			redirect('admin/usuarios');
		}
	}

		// Excluir usuário
	public function delete($id){

		$table = base64_decode($this->input->get('table'));
		$this->Administrator_Model->delete($id,$table);       
		$this->session->set_flashdata('success', 'Dados excluídos com sucesso!');
		header('Location: ' . $_SERVER['HTTP_REFERER']);
	}

	// Habilitar usuário
	public function enable($id){

		$table = base64_decode($this->input->get('table'));
		$this->Administrator_Model->enable($id,$table);       
		$this->session->set_flashdata('success', 'Desabilitado com sucesso!');
		header('Location: ' . $_SERVER['HTTP_REFERER']);
	}

	// Desabilitar usuário
	public function disable($id){

		$table = base64_decode($this->input->get('table'));
		//$table = $this->input->post('table');
		$this->Administrator_Model->disable($id,$table);       
		$this->session->set_flashdata('success', 'Habilitado com sucesso!');
		header('Location: ' . $_SERVER['HTTP_REFERER']);
	}

	public function get_siteconfiguration($page = 'site-configuration'){

		if (!file_exists(APPPATH.'views/admin/'.$page.'.php')) {
	    	show_404();
	   	}
		$data['siteconfiguration'] = $this->Administrator_Model->get_siteconfiguration();

		$data['title'] = 'Site Configuration';
		$this->load->view('admin/update-site-configuration', $data);
	}

	public function update_siteconfiguration_data($page = 'update-site-configuration'){

		if (!file_exists(APPPATH.'views/admin/'.$page.'.php')) {
		    show_404();
	    }
		// Check login
		if(!$this->session->userdata('login')) {
			redirect('admin/index');
		}
		$data['title'] = 'Update Configuration';

		$this->form_validation->set_rules('site_title', 'Site Title', 'required');
		$this->form_validation->set_rules('site_name', 'Site Name', 'required');
			
		if($this->form_validation->run() === FALSE){
			 $this->load->view('admin/header-script');
	 	 	 $this->load->view('admin/header');
	  		 $this->load->view('admin/header-bottom');
	   		 $this->load->view('admin/'.$page, $data);
	  		 $this->load->view('admin/footer');
		}else{

			//Upload Image
			$config['upload_path'] = './assets/img';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size'] = '2048';
			$config['max_width'] = '2000';
			$config['max_height'] = '2000';

			$this->load->library('upload', $config);

			if(!$this->upload->do_upload()){
				$errors =  array('error' => $this->upload->display_errors());
				$data['logo_imgs'] = $this->Administrator_Model->update_siteconfiguration($this->input->post('id'));
				$post_image = $data['logo_imgs']['logo_img'];
			}else{
				$data =  array('upload_data' => $this->upload->data());
				$post_image = $_FILES['userfile']['name'];
			}
				
			 $this->Administrator_Model->update_siteconfiguration_data($post_image);
			//Set Message
			$this->session->set_flashdata('success', 'site configuration Details has been Updated Successfull.');
			redirect('admin/site-configuration/update/1');
		}
	}

	public function change_password($page = 'change-password'){

		if (!file_exists(APPPATH.'views/admin/'.$page.'.php')) {
		    show_404();
		}
		// Check login
		if(!$this->session->userdata('login')) {
			redirect('admin/index');
		}

		$data['title'] = 'Change password';

		//$data['add-user'] = $this->Administrator_Model->get_categories();

		$this->form_validation->set_rules('old_password', 'Old Password', 'required|callback_match_old_password');
		$this->form_validation->set_rules('new_password', 'New Password Field', 'required');
		$this->form_validation->set_rules('confirm_new_password', 'Confirm New Password', 'matches[new_password]');

		if($this->form_validation->run() === FALSE){

			$data['title'] = 'Change Password';
			$referencia['item'] = '';

			$this->load->view('admin/'.$page, $data);

		}else{
			$this->Administrator_Model->change_password($this->input->post('new_password'));
			//Set Message
			$this->session->set_flashdata('success', 'Sua senha foi alterada com sucesso!');
			redirect('admin/home');
		}
	}

	// Check user name exists
	public function match_old_password($old_password){
			
		$this->form_validation->set_message('match_old_password', 'Current Password Does not matched, Please Try Again.');
		$password = md5($old_password);
		$que = $this->Administrator_Model->match_old_password($password);
		if ($que) {
			return true; 
		}else{
			return false;
		}
	}

	public function update_password(){
		$this->load->library('form_validation');
		$this->form_validation->set_rules('password', 'Password', 'required|trim');
		$this->form_validation->set_rules('cpassword', 'Confirm Password', 'required|trim|matches[password]');
        if($this->form_validation->run()){
            echo "passwords match";
       }else{
            echo "passwords do not match";  
        }
	}*/
}