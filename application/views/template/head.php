<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Escola Online - Jornada do Aluno</title>
	<meta name="description" content="Escola Online">
	<meta name="author" content="João Felipe">
	<link href="<?php echo base_url('assets/css/bootstrap/bootstrap.min.css');?>" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url('assets/css/font-awesome/fontawesome-all.css');?>" rel="stylesheet" type="text/css" />

</head>
<style>
.main-aluno{
	background-color: #eee;
	color: #222;
} 

.MY_breadcrumb{
	margin-top: 5px;
	color: #eee;
}
</style>
<body class="main-aluno">
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
	<a class="navbar-brand" href="#">[Logo-da-escola]</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="navbarNavDropdown">
		<ul class="navbar-nav mr-auto">
		<li class="nav-item active">
			<a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="#">Features</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="#">Pricing</a>
		</li>
		<li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			Dropdown link
			</a>
			<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
			<a class="dropdown-item" href="#">Action</a>
			<a class="dropdown-item" href="#">Another action</a>
			<a class="dropdown-item" href="#">Something else here</a>
			</div>
		</li>
		</ul>
		<form class="form-inline">
			<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
			<button class="btn btn-outline-info my-2 my-sm-0" type="submit">Search</button>
		</form>
	</div>
	</nav>
	<div class="container">
		<div class="content">

		<style>
		.MY_breadcrumb-item{
			text-align: center;
			align: center;
			vertical-align: middle;
			line-height: 40px;
		}

		.home-ponta-breadcrumb { 
			border-top: 20px solid #5600e8; 
			border-left: 25px solid #222; 
			border-bottom: 20px solid #5600e8; 
			width: 30px;
		}

		.prim-ponta-breadcrumb { 
			border-top: 20px solid #985eff; 
			border-left: 25px solid #5600e8; 
			border-bottom: 20px solid #985eff; 
			width: 30px;
		}

		.seg-ponta-breadcrumb { 
			border-top: 20px solid transparent; 
			border-left: 25px solid #985eff; 
			border-bottom: 20px solid transparent; 
			width: 30px;
		}

		.home-breadcrumb { 
			background-color: #222;
			width: 30px;
		}

		.verde { 
			background-color: #985eff;
			width: 15%;
		}

		.azul { 
			background-color: #5600e8;
			width: 20%;
		}

		</style>
		<div class="MY_breadcrumb">
			<div class="row">
				<div class="home-breadcrumb MY_breadcrumb-item"><i class="fas fa-home"></i>
				</div>
				<div class="home-ponta-breadcrumb">
				</div>
				<div class="azul MY_breadcrumb-item">Aluno
				</div>
				<div class="prim-ponta-breadcrumb">
				</div>
				<div class="verde MY_breadcrumb-item">Perfil
				</div>
				<div class="seg-ponta-breadcrumb">
				</div>
			</div>
		</div>