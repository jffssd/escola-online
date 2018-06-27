<style>
.linha_chamada{
    border: solid 1px #555;
    width: 100%;
    height: 50px;
}

.chamada_container{
    margin-top: 8px;
}

.data_chamada_ext{
    padding-left: 30px;
    padding-top: 9px;
}
</style>

<div class="chamada_container col-md-12">


<!-- Button trigger modal -->
<a class="btn btn-lg btn-info" data-toggle="modal" data-turma="<?php echo $turma_id;?>" data-disciplina="<?php echo $disciplina_id;?>" data-target="#modalGerarDatasCalendario">Liberar datas no calendário</a>

<!-- Modal -->
<div class="modal fade" id="modalGerarDatasCalendario" tabindex="-1" role="dialog" aria-labelledby="modalGerarDatasCalendarioTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<?php
foreach($datas_chamada as $data){ ?>

<div class="row">
    <div class="linha_chamada">
        <div class="row">
            <div class="data_chamada_ext col-4"><?php echo $data->data;?></div>
            <?php if($data->status == 'A'){?>
                <div class="data_chamada col-4" id="ST_OPEN_<?php echo 'T'.$turma_id.'D'.$disciplina_id.'C'.$data->id;?>">Aguardando lançamento</div>
                <div class="data_chamada col-4" id="<?php echo 'T'.$turma_id.'D'.$disciplina_id.'C'.$data->id;?>"><a class="btn btn-sm btn-success" href="<?php echo base_url().'chamada/efetuar/turma/'.$turma_id.'/'.$disciplina_id.'/'.$data->id;?>">Realizar</a></div>
            <?php }elseif($data->status == 'F'){ ?>
                <div class="data_chamada col-4" id="ST_CLOSED_<?php echo 'T'.$turma_id.'D'.$disciplina_id.'C'.$data->id;?>">Chamada realizada</div>
                <div class="data_chamada col-4" id="<?php echo 'T'.$turma_id.'D'.$disciplina_id.'C'.$data->id;?>"><a class="btn btn-sm btn-secondary">Sem ações</a></div>
            <?php }elseif($data->status == 'P'){ ?>
                <div class="data_chamada col-4" id="ST_WAIT_<?php echo 'T'.$turma_id.'D'.$disciplina_id.'C'.$data->id;?>">Pendente</div>
                <div class="data_chamada col-4" id="<?php echo 'T'.$turma_id.'D'.$disciplina_id.'C'.$data->id;?>"><a class="btn btn-sm btn-warning" href="<?php echo base_url().'chamada/efetuar/turma/'.$turma_id.'/'.$disciplina_id.'/'.$data->id;?>'">Alterar</a></div>
            <?php }else{ ?>
                <div class="data_chamada col-4" id="ST_LISTEN_<?php echo 'T'.$turma_id.'D'.$disciplina_id.'C'.$data->id;?>">Pendente</div>
                <div class="data_chamada col-4" id="<?php echo 'T'.$turma_id.'D'.$disciplina_id.'C'.$data->id;?>"><button href="<?php echo base_url().'chamada/efetuar/gerar_chamada/'.$turma_id.'/'.$disciplina_id.'/'.$data->id;?>" class="btn-gerar btn btn-secondary btn-sm" data-turma="<?php echo 'T'.$turma_id;?>" data-disciplina="<?php echo 'D'.$disciplina_id;?>" data-dataid="<?php echo 'C'.$data->id;?>">Gerar</button></div>
            <?php } ?>
        </div>
    </div>
</div>

<?php } ?>
</div>
<a class="btn btn-sm btn-secondary" href="<?php echo base_url().'chamada/listar/todas';?>">Voltar</a>

<script>

$('#modalGerarDatasCalendario').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var turma = button.data('turma') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var disciplina = button.data('disciplina') // Extract info from data-* attributes
  var that_url = 'http://localhost/escola-online/chamada/listar/calendario/'+turma+'/'+disciplina;
  $(".modal-body").load(that_url);
  var modal = $(this)
})

$('#modalGerarDatasCalendario').on('hidden.bs.modal', function () {
 location.reload();
})

$(document).ready(function(){
    $(".btn-gerar").click(function(e){
        var that_url = $(this).attr("href");
        var turma = $(this).attr("data-turma");
        var disciplina = $(this).attr("data-disciplina");
        var data_id = $(this).attr("data-dataid");
        var gen_keyid = turma+disciplina+data_id;
        var status = 'ST_LISTEN_'+turma+disciplina+data_id;
        console.log(status);
     $.ajax({
         url: that_url, 
         dataType: "json",
         data: {},
         type: 'POST',
         encode: true,
         success: function(data){ 
            var t_id = turma.replace("T","");
            var d_id = disciplina.replace("D","");
            var dt_id = data_id.replace("C","");
            document.getElementById(gen_keyid).innerHTML = '<a class="btn btn-sm btn-success" href="http://localhost/escola-online/chamada/efetuar/turma/'+t_id+'/'+d_id+'/'+dt_id+'">Realizar</button>';
            document.getElementById(status).innerHTML = 'Aguardando lançamento';
         },
         error: function(data){ 
            console.log('Erro: Falha ao tentar criar uma base de chamada para a disciplina e turma indicadas.'); 
         },
      });
    });
});


</script>