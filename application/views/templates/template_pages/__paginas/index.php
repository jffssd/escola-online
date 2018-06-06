<html>
	<head>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

	</head>
	<style>
	
	.dropdown-menu.show.dropdown-menu-success {
		background-color: #28a745; 

	}
	
	.dropdown-divider.dropdown-divider-success{
		
		border-top: 1px solid #4db665 !important;
	}
	
	.dropdown-item.dropdown-item-success{
		color: #ffffff; 
	}
	
	.dropdown-item.dropdown-item-success:hover{
		background-color: #4db665; 
	}
	
	.moeda-jogador-numero{
		font-weight: bold;
		color: #e6bb39;
	}
	
	.energia-jogador-icone{
		margin-top:-3px;
	}

	.moeda-jogador-navbar{
		margin-left:10px; 
		height: 40px; 
		padding-top:7px;
	}

	.moeda-jogador-icone{
		margin-top:-4px;
	}

	</style>
		<body>
		
		
		
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item dropdown">
				<div class="btn-group">
				<button type="button" class="btn btn-success">Próximo Jogo</button>
				<button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<span class="sr-only">Toggle Dropdown</span>
				</button>
				<div class="dropdown-menu dropdown-menu-success">
					<a class="dropdown-item dropdown-item-success" href="#">Simular na reserva</a>
				<div class="dropdown-divider dropdown-divider-success"></div>
					<a class="dropdown-item dropdown-item-success" href="#">Avançar Semana</a>
					<a class="dropdown-item dropdown-item-success" href="#">Avançar Mês</a>
				</div>
				</div>
			</li>
			<li class="nav-text">
        <a class="nav-link" href="javascript:void(null)">John "Link" Doe</a>
      </li>
	  <li class="nav-item">
		<div class="moeda-jogador-navbar">
        <img class="moeda-jogador-icone" src="img/moeda.png" width="30" height="30"> <span class="moeda-jogador-numero">9</span>
		</div>
	  </li>

	  <li class="nav-item">
		<div class="moeda-jogador-navbar">
        <img class="moeda-jogador-icone" src="img/nivel.png" width="25" height="25"> <span class="moeda-jogador-numero">Nv.5</span>
		</div>
	  </li>


      <li class="nav-item">
			<div style="padding-top:10px;">
				<div style="float:left; margin-right:5px; margin-left:10px;"><img class="energia-jogador-icone" src="img/energia.png" width="25" height="25">
				</div>
				<div class="progress" style="width:100px; height:20px;">
					<div class="progress-bar bg-danger" role="progressbar" style="width: 75%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
					</div>
				</div>
			</div>
			</li>


      <li class="nav-item">
			<div style="padding-top:8px;">
				<div style="float:left; margin-right:5px; margin-left:10px;"><img class="moeda-jogador-icone" src="img/nivel.png" width="25" height="25">
				</div>
				<div class="progress" style="width:100px; height:20px;">
					<div class="progress-bar progress-bar-striped bg-warning" role="progressbar" style="width: 75%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
					</div>
				</div>
			</div>
			</li>




    </ul>
	
	


	
	

	
	
	
	
	
	
	
	
	
	
	<ul class="navbar-nav mr-left">
			<li class="nav-item">
			<div class="moeda-jogador-navbar">
					<img class="moeda-jogador-icone" src="img/picture-default-male.jpg" width="30" height="30">
			</div>
			</li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Usuário_teste
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Perfil</a>
          <a class="dropdown-item" href="#">Configs</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Sair</a>
        </div>
      </li>
    </ul>

  </div>
</nav>
		
		
		
		
		
		
		
		
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
		</body>
</html>