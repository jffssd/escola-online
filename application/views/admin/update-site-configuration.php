<h3>Home / Site / Atualizar</h3>

<?php echo form_open_multipart('admin/update_siteconfiguration_data'); ?>
<input class="form-control" value="<?php echo $siteconfiguration['id']; ?>" name="id" type="hidden">


<label class="col-sm-2 col-form-label">Nome do Site</label>
<input class="form-control" value="<?php echo $siteconfiguration['nome_site']; ?>" name="nome_site" placeholder="Nome do Site" type="text">
<br>

<label class="col-sm-2 col-form-label">Titulo do Site</label>
<input class="form-control" value="<?php echo $siteconfiguration['titulo_site']; ?>" placeholder="Título do Site" name="titulo_site" type="text">
<br>
                                                        
<label class="col-sm-2 col-form-label">Logo Atual</label>
<img src="<?php echo base_url(); ?>assets/images/<?php echo $siteconfiguration['logo']; ?>" width="100px">
<br>

<label class="col-sm-2 col-form-label">Logo Nova</label>
<input type="file" name="userfile" class="form-control">
<br>
                                                         
<button type="submit" class="btn btn-primary waves-effect waves-light">Atualizar</button>

</form>