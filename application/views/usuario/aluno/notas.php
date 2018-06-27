<style>
.notas_disc_buttons{
    margin-top: 8px;
    color: white;
}
</style>

<div class="col-md-12">
<?php
foreach($disciplinas as $disc){?>
    <div class="row">
        <div class="col-md-12 notas_disc_buttons">
            <a class="btn btn-lg btn-success btn-block" data-toggle="modal" data-turma="<?php echo $turma_id;?>" data-disciplina="<?php echo $disc->disciplina_id;?>" data-discnome="<?php echo $disc->nome;?>" data-target="#infoNotasDisciplina"><?php echo $disc->nome;?></a>
        </div>
    </div>
<?php
}
?>
    <div class="row">
        <div class="col-md-12 notas_disc_buttons">
            <a class="btn btn-lg btn-secondary btn-block" href="<?php echo base_url().'usuario/dashboard';?>">Voltar</a>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="infoNotasDisciplina" tabindex="-1" role="dialog" aria-labelledby="infoNotasDisciplina" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-header" style="height: 50px;">
            <strong>Pontuação total:</strong> <strong>NULL/100</strong>
      </div>
    </div>
  </div>
</div>






<script>
$('#infoNotasDisciplina').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var turma = button.data('turma') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var disciplina = button.data('disciplina') // Extract info from data-* attributes
  var discnome = button.data('discnome') // Extract info from data-* attributes
  var that_url = 'http://localhost/escola-online/aluno/notas_por_disciplinas/'+turma+'/'+disciplina;
  $(".modal-body").load(that_url);
  $(".modal-title").text(discnome);
  var modal = $(this)
})
</script>