<a href="<?php echo base_url(); ?>administrator/dashboard"></a><br>
<?php if($this->session->userdata('imagem_perfil') != ""){ ?>
    <?php echo $this->session->userdata('imagem_perfil'); ?><br>
<?php }else{ ?>
    <?php echo base_url(); ?>admintemplate/assets/images/logo.png<br>
<?php } ?>
<br>
<a href="#!" onclick="javascript:toggleFullScreen()">
    Fullscreen
</a>
<br>
    <span><?php echo $this->session->userdata('usuario'); ?></span>
<br>
<hr>