<style>
    .aluno-profile-pic{
        max-width: 100px;
        max-height: 100px;
        border-radius: 50%;
    }

    .card-aluno-profile{
        margin-top: 8px;
        align: center;
        text-align: center;
        width: 100%;
    }

    .aluno-info-box{
        margin-top: 10px;
    }
</style>
<div class="col-md-12">
    <div class="row">
        <div class="col-md-4">
            <div class="card card-aluno-profile">
                <div class="card-body">
                    <h4 class="card-title"><?php echo $aluno->nome.' '.$aluno->sobrenome; ?></h4>
                    <img class="aluno-profile-pic" src="<?php echo base_url().'assets/img/perfil/aluno/default-profile.jpg';?>">
                    <div class="aluno-info-box">
                        <div class="row">
                            <div class="col-12"><?php echo $aluno->email;?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12"><?php echo $aluno->data_nasc;?> anos
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12"><?php echo $turma;?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card card-aluno-profile">
                <div class="card-body">
                    <h4 class="card-title">Atributos</h4>

                    Nível: <?php echo $exp->nivel; ?> <br>

                    Experiência: <?php echo $exp->exp.'/'.$exp_prox_nivel; ?><br>

                    Pontos: <?php echo $pontos->pontos; ?> <br><br>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card card-aluno-profile">
                <div class="card-body">
                    <h4 class="card-title">Conquistas</h4>

                    <br><br>

                </div>
            </div>
        </div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-12 notas_disc_buttons">
        <a class="btn btn-lg btn-secondary btn-block" href="<?php echo base_url().'usuario/dashboard';?>">Voltar</a>
    </div>
</div>
<br><br><br>