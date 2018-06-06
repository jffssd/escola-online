<html>
<body>
	<?php echo validation_errors(); ?>
	<?php echo form_open_multipart('usuario/register'); ?>
		<div class="form-group">
			<label for="usuario">Nome de usuário:</label>
			<input id="usuario" type="text" class="form-control" name="usuario" required autofocus>
		</div>

		<div class="form-group">
			<label for="email">Seu e-mail</label>
			<input id="email" type="email" class="form-control" name="email" required>
		</div>

		<div class="form-group">
			<label for="senha">Senha:</label>
			<input id="senha" type="password" class="form-control" name="senha" required data-eye>
		</div>

		<div class="form-group">
			<label for="senha2">Repita a senha:</label>
			<input id="senha2" type="password" class="form-control" name="senha2">
		</div>

		<div class="form-group">
			<label>
				<input type="checkbox" name="aceito" value="1"> Eu aceito os <a class="ces-main-color-link" href="#"><strong>Termos de Condições</strong></a>
			</label>
		</div>

		<div class="form-group no-margin">
			<button type="submit" class="btn ces-main-color-bg btn-block">
				Cadastrar
			</button>
		</div>
		<div class="margin-top20 text-center">
			Já possui uma conta? <a class="ces-main-color-link" href="<?php echo base_url().'entrar';?>">Entrar</a>
		</div>
	</form>
	</div>
</body>
</html>