<?php 
echo $disciplina->id.' - '.$disciplina->nome.' - '.$disciplina->sigla;
?>
<br><br>
<?php 
foreach($professores as $professor){
    echo $professor['id'].' - '.$professor['nome'].'<br>';
}
?>