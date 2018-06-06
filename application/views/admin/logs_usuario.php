<table class="table table-striped">
	<thead>
		<th>Data/Hora</th>
		<th>Usuario ID</th>
		<th>IP associado</th>
		<th>Tipo</th>
		<th>Mensagem</th>
	</thead>
	<tbody>
	<?php
	    foreach($usuario_logs -> result() as $l_u){
	?>
	<tr>
		<td><?php echo $l_u->data_hora;?></td>
		<td><?php echo $l_u->usuario_id;?></td>
		<td><?php echo $l_u->ip;?></td>
		<td><?php echo $l_u->tipo;?></td>
		<td><?php echo $l_u->msg;?></td>
	</tr>
	<?php
	}
	?>
	</tbody>
</table>