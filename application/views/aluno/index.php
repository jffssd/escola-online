<h1> Aluno </h1>
<?php 
if(!$by_id){
    foreach($alunos as $aluno){
        echo $aluno['nome'].'<br>';
    }
}else{
    echo $alunos->nome;
}
?>

Conquistas: 

<?php foreach($conquistas as $conquista){
    echo '['.$conquista->icone.']  '.$conquista->id.' - '.$conquista->nome.'<br>';
}
?>
<br>
Todas as conquistas: <br><br>

<?php foreach($conquistas_all as $conquista_all){
    echo '['.$conquista_all->icone.']  '.$conquista_all->id.' - '.$conquista_all->nome.'<br>';
}
?>