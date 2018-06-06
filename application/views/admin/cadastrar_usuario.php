<h3>Home / Usuário / Cadastro</h3>

<?php echo form_open_multipart('admin/cadastrar_usuario'); ?>
<label>Usuario</label>
<input type="text" name="usuario" class="form-control" placeholder="Usuario">

<br>
<label>E-mail</label>
<input type="text"  name="email" class="form-control" placeholder="E-mail">

<br>
<label>Permissão</label>
<input type="number"  name="permissao" class="form-control">

<br>
<label>Imagem do Perfil</label>
<input type="file" name="userfile" class="form-control">

<br>
<label>Habilitado</label>
<input type="checkbox" value="1" name="status" checked />

<br>
<button type="submit" name="submit" class="btn btn-primary">Adicionar</button>

<textarea id="description" style="visibility: hidden;"></textarea>
                                    
</form>