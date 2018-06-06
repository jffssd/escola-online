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