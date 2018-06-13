<head>
    <link rel="stylesheet" type="text/css" href="<?php echo site_url();?>assets/css/bootstrap.css">
</head>
<body>
<div class="container">
<h1> Turma </h1>
<?php 
if(!$by_id){
    foreach($turmas as $turma){
        echo $turma['id'].' - '.$turma['turno'].' - '.$turma['ano'].'<br>';
}
}
?>

 
<?php
if($by_id){
?>
<h2><?php echo $turmas->id.' - '.$turmas->turno.' - '.$turmas->ciclo.' - '.$turmas->serie.' - '.$turmas->codigo.' - '.$turmas->ano.'</h2>';?>
<h3>Alunos</h3>
    <div class="col-md-12">
        <table class="table">
            <thead>
                <tr>
                    <th> - </th>
                    <th> - </th>
                    <th>Nome</th>
                    <th>Idade</th>
                </tr>
            </thead>
            <tbody>
            <?php
            foreach($alunos as $aluno){?>
                <tr>
                    <td><?php echo $aluno['id'];?></td>
                    <td></td>
                    <td><?php echo $aluno['nome'].' '.$aluno['sobrenome'];?></td>
                    <td>10<td>
                </tr>
            <?php
            }
            ?>
            </tbody>
        </table>
    </div>
<?php 
}
?>
<h3>Horário</h3>
<div class="col-md-12">
<table class="table">
    <thead>
        <tr>
            <th>Seg.</th>
            <th>Ter.</th>
            <th>Qua.</th>
            <th>Qui.</th>
            <th>Sex.</th>
        </tr>
    <thead>
    <tbody>
        <?php 
        foreach ($horario as $item) {
            if($item->posicao == 1){
                echo '<tr>';
            }?>

            <td><a href="<?php echo site_url().'disciplina/visualizar/'.$item->disciplina_id;?>"><?php echo $item->nome;?></a></td>
            
            <?php
            if(($item->posicao % 5) == 0){
                if($item->posicao == 20){
                    echo '</tr>';
                }else{
                    echo '</tr><tr>';
                }
            }
        }
        ?>
    <tbody>
</table>
</div>
</div>
</body>