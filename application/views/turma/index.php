<h1> Turma </h1>
<?php 
if(!$by_id){
    foreach($turmas as $turma){
        echo $turma['id'].' - '.$turma['turno'].' - '.$turma['ano'].'<br>';
    }
}else{
    echo '<h2>'.$turmas->id.' - '.$turmas->turno.' - '.$turmas->ciclo.' - '.$turmas->serie.' - '.$turmas->codigo.' - '.$turmas->ano.'</h2>';
    echo '<h3>Alunos</h3>';
    foreach($alunos as $aluno){
        echo $aluno['id'].' - '.$aluno['nome'].'<br>';
    }
}
?>
<table>
<?php 
foreach ($horario as $item) {
    echo '<td>'.$item->dia_semana.'</td>';
}
?>
</table>