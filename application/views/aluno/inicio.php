<head>
    <link rel="stylesheet" type="text/css" href="<?php echo site_url();?>assets/css/bootstrap.css">
</head>
<body>

<h1><?php echo $title; ?></h1>

Nome: <?php echo $aluno->nome.' '.$aluno->sobrenome; ?><br><br>

Email: <?php echo $aluno->email;?><br><br>

Idade: <?php echo $aluno->data_nasc; ?> anos<br><br>

Nível: <?php echo $exp->nivel; ?> <br><br>

Experiência: <?php echo $exp->exp.'/'.$exp_prox_nivel; ?><br><br>

Pontos: <?php echo $pontos->pontos; ?> <br><br>

Conquistas: <br><br>

<?php foreach($conquistas as $conquista){
    echo '['.$conquista->icone.']  '.$conquista->id.' - '.$conquista->nome.'<br>';
}
?>
<br>
Todas as conquistas: <br><br>

<?php foreach($conquistas_all as $conquista_all){
    echo '['.$conquista_all->icone.']  '.$conquista_all->id.' - '.$conquista_all->nome.'<br>';
}
?>
</body>