<?php
    foreach($disciplina_turma as $disciplina){
        echo $disciplina->nome.'[<br>';
        foreach($disciplina->turmas as $turma_disc){
            echo $turma_disc->id.'<br>';
        }
        echo ']<br>';
    }
?>