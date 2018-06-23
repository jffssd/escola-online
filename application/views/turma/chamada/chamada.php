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
<br>
<form method='post' id='userform' action="<?php echo base_url().'turma/processa_chamada';?>">
    <input type="hidden" id="turma_id" value="<?php echo $turmas->id;?>">
    <input type="hidden" id="disciplina_id" value="<?php echo $disciplina_id;?>">
    <input class="form-control" id="data_chamada" type="text" placeholder="<?php echo $data;?>" readonly>
    <br>
    <table id="tb_chamada">
        <thead>
            <tr><th>id</th><th>nome</th><th>falta</th></tr>
        </thead>
        <tbody>
        <?php    foreach($alunos as $aluno){ ?>
        </tbody>
            <tr><td><?php echo $aluno['id'];?></td><td><?php echo $aluno['nome'];?></td><td><input type="checkbox" name="aluno_chamada" class="alunos_chamada" value="<?php echo $aluno['id'];?>"></td></tr>
        <?php }?>
    </table>
    <br>
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
    Finalizar chamada
    </button>
</form>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="enviar" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModal1Label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModal1Label">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Sucesso!
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function(){
    $("#enviar").click(function(){
        var turma_id = $("#turma_id").val();
        var disciplina_id = $("#disciplina_id").val();
        var date = $("#data_chamada").val();
        var aluno_chamada = [];            
        $("input:checkbox[name=aluno_chamada]:checked").each(function(){
            aluno_chamada.push($(this).val());
        });

        console.log(aluno_chamada);
     $.ajax({
         url: "<?php echo base_url().'chamada/efetuar/processa_chamada';?>", 
         dataType: "json",
         data: {
                turma_id, 
                disciplina_id, 
                date,
                aluno_chamada
         },
         type: 'POST',
         encode: true,
         success: function(data){ 
            $('#exampleModal').modal('hide');
            $('#exampleModal1').modal('show')
         },
         error: function(data){ 
            console.log(2); 
         },
      });
    });
});
</script>

