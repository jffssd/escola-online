<html>
<body>
	<?php if($this->session->flashdata('sucesso')){ ?>
	<?php
	} ?>
	<?php if($this->session->flashdata('erro')){ ?>
	<?php
	} ?>
	<?php if($this->session->flashdata('falha_login')){ ?>
	<?php
	} ?>
	<?php if($this->session->flashdata('usuario_cadastrado')){ ?>
	<?php
	} ?>

	<?php echo form_open('usuario/processa_login'); ?>
		
		<div class="form-group">
			<label for="email">Nome de usuário</label>
			<input id="usuario" type="text" class="form-control" name="usuario" value="" required autofocus>
		</div>

		<div class="form-group">
			<label for="password">Senha
				<a href="<?php echo base_url().'usuario/relembrar_senha';?>" class="float-right ces-main-color-link">
					Esqueceu a senha?
				</a>
			</label>
			<input id="senha" type="password" class="form-control" name="senha" required data-eye>
		</div>

		<div class="form-group">
			<label>
				<input type="checkbox" name="remember"> Mantenha-me conectado
			</label>
		</div>

		<div class="form-group no-margin">
			<button type="submit" class="btn ces-main-color-bg btn-block">
				Entrar
			</button>
		</div>
		<div class="margin-top20 text-center ">
			Não possui uma conta? <a class="ces-main-color-link" href="<?php echo base_url().'registrar';?>">Cadastre-se aqui</a>
		</div>
	</form>
</body>
</html>