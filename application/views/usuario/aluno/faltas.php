<br>
<?php
foreach($faltas_disciplinas as $falta_disc){?>

    <div class="alert alert-primary" role="alert">
        <?php echo $falta_disc->nome;?> <span class="float-right">Faltas: <?php echo $falta_disc->faltas;?></span>
    </div>
<?php
}?>
<div class="alert alert-secondary" role="alert">
    <strong>Total de Faltas: </strong><?php echo $falta_disc->faltas;?>
</div>
<div class="row">
    <div class="col-md-12 notas_disc_buttons">
        <a class="btn btn-lg btn-secondary btn-block" href="<?php echo base_url().'usuario/dashboard';?>">Voltar</a>
    </div>
</div>