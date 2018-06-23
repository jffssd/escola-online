<style>
.linha_chamada{
    border: solid 1px #555;
    width: 100%;
    height: 50px;
}

.chamada_container{
    margin-top: 8px;
}
</style>

<div class="chamada_container col-md-12">

<?php
foreach($datas_chamada as $data){ ?>

<div class="row">
    <div class="linha_chamada">
        <div class="row">
            <div class="data_chamada col-3"><?php echo $data->data;?></div>
            <div class="data_chamada col-3">Pendente</div>
            <div class="data_chamada col-3"><button href="<?php echo base_url().'chamada/efetuar/gerar_chamada/1/1/'.$data->id;?>" id="gerar">Gerar</button></div>
            <div class="data_chamada col-3"><a href="<?php echo base_url().'chamada/efetuar/turma/1/1/'.$data->id;?>">Info</a></div>
        </div>
    </div>
</div>

<?php } ?>
</div>

<script>
$(document).ready(function(){
    $("#gerar").click(function(e){
        alert('as');
        $this  = $(this);
        e.preventDefault();
        var that_url = $(this).attr("href");

     $.ajax({
         url: that_url, 
         dataType: "json",
         data: {},
         type: 'POST',
         encode: true,
         success: function(data){ 
            $(this).innerHTML = "Gerado";
            console.log(1); 
         },
         error: function(data){ 
            console.log(2); 
         },
      });
    });
});


</script>