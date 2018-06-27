<?php
    foreach($disciplina_turma as $disciplina){?>

        <h1><?php echo $disciplina->nome;?></h1>

        <?php
        foreach($disciplina->turmas as $turma_disc){?>
            <a href="<?php echo base_url().'chamada/listar/turma/'.$turma_disc->id.'/'.$disciplina->id;?>"><?php echo $turma_disc->turno.$turma_disc->ciclo.$turma_disc->serie.'1'.$turma_disc->codigo;?></a><br>
        <?php } 
    } ?>