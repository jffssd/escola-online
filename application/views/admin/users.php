<script type="text/javascript">
 $(document).ready(function(){
        $(".delete").click(function(e){ alert('as');
            $this  = $(this);
            e.preventDefault();
            var url = $(this).attr("href");
            $.get(url, function(r){
                if(r.success){
                    $this.closest("tr").remove();
                }
            })
        });
    });

$(document).ready(function(){
        $(".enable").click(function(e){ alert('as');
            $this  = $(this);
            e.preventDefault();
            var url = $(this).attr("href");
            $.get(url, function(r){
                if(r.success){
                    $this.closest("tr").remove();
                }
            })
        });
    });

$(document).ready(function(){
        $(".disable").click(function(e){ alert('as');
            $this  = $(this);
            e.preventDefault();
            var url = $(this).attr("href");
            $.get(url, function(r){
                if(r.success){
                    $this.closest("tr").remove();
                }
            })
        });
    });
</script>

<h3>Home / Usuários</h3>

<table id="dom-jqry" class="table table-striped table-bordered nowrap">
    <thead>
        <tr>
            <th>Id</th>
            <th>Imagem</th>
            <th>Usuário</th>
            <th>E-mail</th>
            <th>Data Cad.</th>
            <th>Ação</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($usuarios as $usuario) : ?>
        <tr>
            <td><?php echo $usuario['id']; ?></td>
            <td><img width="20px;" src="<?php echo site_url();?>assets/img/usuarios/<?php echo $usuario['imagem_perfil']; ?> "></td>
            <td><?php echo $usuario['usuario']; ?></td>
            <td><?php echo $usuario['email']; ?></td>
            <td><?php echo date("M d,Y", strtotime($usuario['data_registro'])); ?></td>
            <td>
                <?php if($usuario['status'] == 1){ ?>
                <a class="btn btn-outline-success btn-sm enable" href='<?php echo base_url(); ?>admin/enable/<?php echo $usuario['id']; ?>?table=<?php echo base64_encode('usuario'); ?>'>Habilitado</a>
                <?php }else{ ?> 
                <a class="btn btn-outline-warning btn-sm disable" href='<?php echo base_url(); ?>admin/disable/<?php echo $usuario['id']; ?>?table=<?php echo base64_encode('usuario'); ?>'>Desabilitado</a>
                <?php } ?>
                <a class="btn btn-outline-info btn-sm" href='<?php echo base_url(); ?>admin/atualizar_usuario/<?php echo $usuario['id']; ?>'>Editar</a>
                <a class="btn btn-outline-secondary btn-sm" href='<?php echo base_url(); ?>admin/logs_usuario/<?php echo $usuario['id']; ?>'>Logs</a>
                <a class="btn btn-outline-danger btn-sm delete" href='<?php echo base_url(); ?>admin/delete/<?php echo $usuario['id']; ?>?table=<?php echo base64_encode('usuario'); ?>'>Excluir</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>