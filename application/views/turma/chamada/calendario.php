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

<?php
foreach($datas_chamada as $data){ ?>

<div class="row">
    <div class="linha_chamada">
        <div class="row">
            <div class="data_chamada_ext col-4"><?php echo $data->data;?></div>
            <?php if($data->status == 'A'){?>
                <div class="data_chamada col-4" id="ST_OPEN_<?php echo 'T'.$turma_id.'D'.$disciplina_id.'C'.$data->id;?>">Aguardando lançamento</div>
                <div class="data_chamada col-4" id="<?php echo 'T'.$turma_id.'D'.$disciplina_id.'C'.$data->id;?>"><a class="btn btn-sm btn-success">Gerado</a></div>
            <?php }elseif($data->status == 'F'){ ?>
                <div class="data_chamada col-4" id="ST_CLOSED_<?php echo 'T'.$turma_id.'D'.$disciplina_id.'C'.$data->id;?>">Chamada realizada</div>
                <div class="data_chamada col-4" id="<?php echo 'T'.$turma_id.'D'.$disciplina_id.'C'.$data->id;?>"><a class="btn btn-sm btn-secondary">Sem ações</button></div>
            <?php }elseif($data->status == 'P'){ ?>
                <div class="data_chamada col-4" id="ST_WAIT_<?php echo 'T'.$turma_id.'D'.$disciplina_id.'C'.$data->id;?>">Pendente</div>
                <div class="data_chamada col-4" id="<?php echo 'T'.$turma_id.'D'.$disciplina_id.'C'.$data->id;?>"><a class="btn btn-sm btn-warning">Alterar</a></div>
            <?php }else{ ?>
                <div class="data_chamada col-4" id="ST_LISTEN_<?php echo 'T'.$turma_id.'D'.$disciplina_id.'C'.$data->id;?>">Pendente</div>
                <div class="data_chamada col-4" id="<?php echo 'T'.$turma_id.'D'.$disciplina_id.'C'.$data->id;?>"><button href="<?php echo base_url().'chamada/efetuar/gerar_chamada/'.$turma_id.'/'.$disciplina_id.'/'.$data->id;?>" class="btn-gerar btn btn-secondary btn-sm" data-turma="<?php echo 'T'.$turma_id;?>" data-disciplina="<?php echo 'D'.$disciplina_id;?>" data-dataid="<?php echo 'C'.$data->id;?>">Gerar</button></div>
            <?php } ?>
        </div>
    </div>
</div>

<?php } ?>
</div>


<script>
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
            document.getElementById(gen_keyid).innerHTML = '<a class="btn btn-sm btn-success">Gerado</button>';
            document.getElementById(status).innerHTML = 'Aguardando lançamento';
         },
         error: function(data){ 
            console.log('Erro: Falha ao tentar criar uma base de chamada para a disciplina e turma indicadas.'); 
         },
      });
    });
});


</script>