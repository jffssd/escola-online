<strong>Atividades</strong><br><br>
<?php 
if(count($atividades) > 0){
    foreach($atividades as $at){
?>
        <?php if($at->status == 'A'){
            echo '<div class="alert alert-success" role="alert">';
        }elseif($at->status == 'F'){
            echo '<div class="alert alert-primary" role="alert">';
        }elseif($at->status == 'P'){
            echo '<div class="alert alert-warning" role="alert">';
        }?>
        
            <?php echo '<strong>'.$at->nome.'</strong>:<br> Nota: '.$at->nota_aluno.'/'.$at->pontuacao_max;?>
        
        <?php if($at->status == 'A'){
            echo '<span class="float-right">Em aberto</span>';
        }elseif($at->status == 'F'){
            echo '<span class="float-right">Lançado</span>';
        }elseif($at->status == 'P'){
            echo '<span class="float-right">Pendente</span>';
        }?>
        </div>
<?php
    }
}else{?>
        <div class="alert alert-secondary" role="alert" style="text-align:center;">
            Sem atividades no momento
        </div>
<?php
}
?>
