
<body class="adminbody">

<div id="main">

	<!-- top bar navigation -->
	<div class="headerbar">

		<!-- LOGO -->
        <div class="headerbar-left">
			<a href="#" class="logo"><img alt="Logo" src="<?php echo base_url('assets/img/ces_logo.png');?>" /></a>
        </div>

        <nav class="navbar-custom">

                    <ul class="list-inline float-right mb-0">

                        <?php if($this->session->userdata('login')): ?>
						<li class="list-inline-item dropdown notif">
                            <a class="nav-link dropdown-toggle arrow-none" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <i class="fa fa-fw fa-question-circle"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-arrow dropdown-arrow-success dropdown-lg">
                                <!-- item-->
                                <div class="dropdown-item noti-title">
                                    <h5><small>Ajuda e Suporte</small></h5>
                                </div>

                                <!-- item-->
                                <a target="_blank" href="#" class="dropdown-item notify-item">                                    
                                    <p class="notify-details ml-0">
                                        <b>Gostaria de ajudar a manter nosso site? (Custos do Servidor)</b>
                                        <span>Entre em contato!</span>
                                    </p>
                                </a>

                                <!-- item-->
                                <a target="_blank" href="#" class="dropdown-item notify-item">                                    
                                    <p class="notify-details ml-0">
                                        <b>Algum material neste site não está de acordo com suas políticas?</b>
                                        <span>Reporte aqui</span>
                                    </p>
                                </a>                               

                                <!-- All-->
                                <a title="Leia o nosso FAQ!" target="_blank" href="#" class="dropdown-item notify-item notify-all">
                                    <i class="fa fa-link"></i> Leia o nosso FAQ!
                                </a>

                            </div>
                        </li>
						
                        <li class="list-inline-item dropdown notif">
                            <a class="nav-link dropdown-toggle arrow-none" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <i class="fa fa-fw fa-envelope-o"></i><span class="notif-bullet"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-arrow dropdown-arrow-success dropdown-lg">
                                <!-- item-->
                                <div class="dropdown-item noti-title">
                                    <h5><small><span class="label label-danger badge badge-danger pull-xs-right">07</span>Mensagens Recebidas</small></h5>
                                </div>

                                <!-- item-->
                                <a href="#" class="dropdown-item notify-item">                                    
                                    <p class="notify-details ml-0">
                                        <b>John Doe</b>
                                        <span>Nova mensagem recebida!</span>
                                        <small class="text-muted">2 minutos atrás</small>
                                    </p>
                                </a>

                                <!-- item-->
                                <a href="#" class="dropdown-item notify-item">                                    
                                    <p class="notify-details ml-0">
                                        <b>Elizabeth Leez</b>
                                        <span>Nova mensagem recebida!</span>
                                        <small class="text-muted">15 minutos atrás</small>
                                    </p>
                                </a>

                                <!-- item-->
                                <a href="#" class="dropdown-item notify-item">                                    
                                    <p class="notify-details ml-0">
                                        <b>Christian Lao</b>
                                        <span>Nova mensagem recebida!</span>
                                        <small class="text-muted">Ontem, 13:35</small>
                                    </p>
                                </a>

                                <!-- All-->
                                <a href="#" class="dropdown-item notify-item notify-all">
                                    Ver todas mensagens...
                                </a>

                            </div>
                        </li>
                        
						<li class="list-inline-item dropdown notif">
                            <a class="nav-link dropdown-toggle arrow-none" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <i class="fa fa-fw fa-bell-o"></i><span class="notif-bullet"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-arrow dropdown-lg">
								<!-- item-->
                                <div class="dropdown-item noti-title">
                                    <h5><small><span class="label label-danger badge badge-danger pull-xs-right">5</span>Alertas</small></h5>
                                </div>
								
                                <!-- item-->
                                <a href="#" class="dropdown-item notify-item">
                                    <div class="notify-icon bg-faded">
                                        <img src="<?php echo base_url('assets/img/usuarios/default-profile.png');?>" alt="img" class="rounded-circle img-fluid">
                                    </div>
                                    <p class="notify-details">
                                        <b>John Doe</b>
                                        <span>Se registrou no sistema!</span>
                                        <small class="text-muted">3 minutos atrás</small>
                                    </p>
                                </a>

                                <!-- item-->
                                <a href="#" class="dropdown-item notify-item">
                                    <div class="notify-icon bg-faded">
                                        <img src="<?php echo base_url('assets/img/usuarios/default-profile.png');?>" alt="img" class="rounded-circle img-fluid">
                                    </div>
                                    <p class="notify-details">
                                        <b>Michael Fassbender</b>
                                        <span>Ganhou a Recompensa "Mãos de Ouro"!</span>
                                        <small class="text-muted">12 minutos atrás</small>
                                    </p>
                                </a>

                                <!-- item-->
                                <a href="#" class="dropdown-item notify-item">
                                    <div class="notify-icon bg-faded">
                                        <img src="<?php echo base_url('assets/img/usuarios/default-profile.png');?>" alt="img" class="rounded-circle img-fluid">
                                    </div>
                                    <p class="notify-details">
                                        <b>Bruce Benner</b>
                                        <span>Aposentou o jogador "Maverick"!</span>
                                        <small class="text-muted">35 minutos atrás</small>
                                    </p>
                                </a>

                                <!-- All-->
                                <a href="#" class="dropdown-item notify-item notify-all">
                                    Ver todos os Alertas...
                                </a>
                            </div>
                        </li>

                        <li class="list-inline-item dropdown notif">
                            <a class="nav-link dropdown-toggle nav-user" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                            <small><?php echo $this->session->userdata('usuario');?></small> <img src="<?php echo base_url('assets/img/usuarios/').$this->session->userdata('imagem_perfil');?>" alt="Profile image" class="avatar-rounded">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                                <!-- item-->
                                <div class="dropdown-item noti-title">
                                    <h5 class="text-overflow"><small>Opções</small> </h5>
                                </div>

                                <!-- item-->
                                <a href="<?php echo base_url('perfil');?>" class="dropdown-item notify-item">
                                    <i class="fa fa-user"></i> <span>Perfil</span>
                                </a>

                                <!-- item-->
                                <a href="<?php echo base_url('sair');?>" class="dropdown-item notify-item">
                                    <i class="fa fa-power-off"></i> <span>Sair</span>
                                </a>
							
                            </div>
                        </li>

                    </ul>
                    <?php endif; ?>

                    <?php if(!$this->session->userdata('login')): ?>

                        <li class="list-inline-item dropdown notif">
                            <a class="nav-link dropdown-toggle nav-user" href="<?php echo base_url('entrar');?>">
                                <span style="font-size: 0.90rem;"><i class="fa fa-fw fa-angle-right"></i> Entrar</span>
                            </a>
                        </li>
                        <li class="list-inline-item dropdown notif">
                            <a class="nav-link dropdown-toggle nav-user" href="<?php echo base_url('registrar');?>">
                                <span style="font-size: 0.90rem;"><i class="fa fa-fw fa-angle-right"></i> Registrar</span>
                            </a>
                        </li>
                    </ul>
                    <?php endif; ?>
                    
                    <ul class="list-inline menu-left mb-0">
                        <li class="float-left">
                            <button class="button-menu-mobile open-left">
								<i class="fa fa-fw fa-bars"></i>
                            </button>
                        </li>                        
                    </ul>
        </nav>
	</div>
