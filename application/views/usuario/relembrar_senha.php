<html>
<body>
	<?php if($this->session->flashdata('erro')){ 
	} ?>
	<?php echo form_open('usuario/forget_password_mail'); ?>
		<div class="form-group">
			<label for="email">Seu e-mail</label>
			<input id="email" type="email" class="form-control" name="email" value="" required autofocus>
			<div class="form-text text-muted">
				Ao clicar no botão "Lembrar senha", nós lhe enviaremos um e-mail com um link para cadastrar uma nova senha
			</div>
		</div>

		<div class="form-group no-margin">
			<button type="submit" class="btn ces-main-color-bg btn-block">
				Lembrar senha
			</button>
		</div>
	</form>
</body>
</html>