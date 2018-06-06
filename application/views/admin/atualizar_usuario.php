<h3>Home / Usuários / Atualizar</h3>

<?php echo form_open_multipart('admin/atualizar_dados_usuario'); ?>

<input type="hidden" name="id" class="form-control" value="<?php echo $usuario['id']; ?>">
<label class="col-sm-2 col-form-label">Usuário</label>
<input type="text" name="usuario" class="form-control" value="<?php echo $usuario['usuario']; ?>" placeholder="Usuário">
<br>

<label class="col-sm-2 col-form-label">E-mail</label>
<input type="text"  name="email" class="form-control" value="<?php echo $usuario['email']; ?>" placeholder="E-mail">
<br>

<label class="col-sm-2 col-form-label">Permissão</label>
<input type="number"  name="permissao" class="form-control" value="<?php echo $usuario['permissao']; ?>" placeholder="2">
<br>

<label class="col-sm-2 col-form-label">Imagem de perfil</label>
<img src="<?php echo base_url().'assets/img/usuarios/'.$usuario['imagem_perfil']; ?>" width="70px">
<br>

<label class="col-sm-2 col-form-label">Atualizar imagem de perfil</label>
<input type="file" name="userfile" class="form-control">
<br>

<label class="col-sm-2 col-form-label">Want to make Enable?</label>
<input type="checkbox" value="<?php echo $usuario['status']; ?>" name="status" <?php if($usuario['status'] == '1'){ echo "checked"; } ?> />
<br>

<button type="submit" name="submit" class="btn btn-primary">Atualizar</button>

<textarea id="description" style="visibility: hidden;"></textarea>

</form>