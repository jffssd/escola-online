<h2> Turma -> Chamada -> {turma_id}</h2>
<?php 
    echo '<h2>'.$turmas->id.' - '.$turmas->turno.' - '.$turmas->ciclo.' - '.$turmas->serie.' - '.$turmas->codigo.' - '.$turmas->ano.'</h2>';
?>
<h3>Alunos</h3>

<style>
#tb_chamada {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

#tb_chamada td, #tb_chamada th {
    border: 1px solid #ddd;
    padding: 8px;
}

#tb_chamada tr:nth-child(even){background-color: #f2f2f2;}

#tb_chamada tr:hover {background-color: #ddd;}

#tb_chamada th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #4CAF50;
    color: white;
}
</style>
<form method='post' id='userform' action="<?php echo base_url().'turma/processa_chamada';?>">
    <input type="hidden" id="turma_id" name="turma_id" value="<?php echo $turmas->id;?>">
    <table id="tb_chamada">
        <thead>
            <tr><th>id</th><th>nome</th><th>falta</th></tr>
        </thead>
        <tbody>
        <?php    foreach($alunos as $aluno){ ?>
        </tbody>
            <tr><td><?php echo $aluno['id'];?></td><td><?php echo $aluno['nome'];?></td><td><input type="checkbox" name="aluno_chamada[]" value="<?php echo $aluno['id'];?>"></td></tr>
        <?php }?>
    </table>
    <input type="submit" value="Submit">
</form>