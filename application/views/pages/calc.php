
<script src="<?php echo base_url('assets/js/jquery-3.3.1.min.js');?>"></script>

<div class="col-md-12">
<img id="profile-pic" src="<?php echo base_url().'assets/img/bg.jpg';?>" height="100" width="100">
	<div class="form-row">
		<div class="form-group col-md-4">
			<label for="nome">Nick do Jogador</label>
			<div class="input-group mb-2">
				<div class="input-group-addon"><i class="fa fa-pencil" aria-hidden="true"></i>
				</div>
				<input type="text" class="form-control" name="jogador_nick" id="jogador_nick" placeholder="Nick do Jogador" readonly>
			</div>
		</div>
	</div>

	<div class="form-row">
		<div class="form-group col-md-4">
			<label for="nome">Função</label>
			<div class="input-group mb-2">
				<div class="input-group-addon"><i class="fa fa-pencil" aria-hidden="true"></i>
				</div>
				<input type="text" class="form-control" name="jogador_funcao" id="jogador_funcao" placeholder="Função" readonly>
			</div>
		</div>
	</div>

	<select class="form-control form-control-lg col-md-4" name="id" id="id">
	<?php
	foreach($jogadores -> result() as $jogador){?>
	  <option value="<?php echo $jogador->id;?>"><?php echo $jogador->nick;?></option>
	<?php } ?>
</select>

</div>


<script type="text/javascript">
$('#id').change(function(){
	var id = $('#id').val();
	var url_img = '<?php echo base_url('assets/img/profiles/thumb/');?>'
	if(isNaN(id)){
		console.log('O id deve ser um número');
	}else{
		$.ajax({
			type: 'POST',
			data: {id: id},
			url: '<?php echo base_url('calc/pfl');?>',
			success: function(result){
				console.log(result);
				var jogador = JSON.parse(result);
				console.log(jogador.nick);
				console.log(jogador.foto);
				$('#jogador_nick').val(jogador.nick);
				$('#jogador_funcao').val(jogador.fnome);
				$('#profile-pic').attr('src', url_img+jogador.foto);
			}
		});
	}
});

</script>


<script type="text/javascript">
$('#btnCalcular').click(function(){
	var numero1 = $('#numero1').val();
	var numero2 = $('#numero2').val();
	if(isNaN(numero1) || isNaN(numero2)){
		alert('Número 1 ou Número deve ser um número');
	}else{
		
		$.ajax({
			type: 'POST',
			data: {numero1: numero1, numero2: numero2},
			url: '<?php echo base_url('calc/soma');?>',
			success: function(result){
				$('#result').val(result);
			}
		});
	}
});
</script>