<html>
	<body>
		<?php echo form_open('usuario/cadastrar_nova_senha'); ?>
			<div class="form-group">
				<label for="senha">Seu e-mail</label>
				<input id="email" type="text" class="form-control" name="email" value="<?php echo $email;?>" readonly>
				<input id="chave_temporaria" type="hidden" name="chave_temporaria" value="<?php echo $chave_temporaria;?>">						
				<label for="senha">Digite sua nova senha</label>
				<input id="senha" type="password" class="form-control" name="senha" value="" required autofocus>
				<label for="senha2">Redigite a senha</label>
				<input id="senha2" type="password" class="form-control" name="senha2" value="" required autofocus>
				</div>

			<div class="form-group no-margin">
				<button type="submit" class="btn ces-main-color-bg btn-block">
					Definir nova senha
				</button>
			</div>
		</form>
	</body>
</html>