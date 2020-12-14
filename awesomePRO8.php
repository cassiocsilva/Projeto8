<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: index.html');
	exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="./img/favicon_pro8_vd-removebg.ico" type="image/x-icon" />        
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
		integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">
	<link type="text/css" rel="stylesheet" href="./css/estilo.css">
	<title>PRO-8 Rastreamento</title>
</head>

<body>

	<div class="barra_topo"></div>
        <header class="barra_nav">
		<a href="home.php"><img src="img/logo_pro8-removebg-preview.png"></img></a>
		<nav>
			<div class="barra_nav_menu">
				<button class="botao_nav p-2" onclick="redirecionar('home.php')"><i class="fas fa-home"></i></button>
				<button class="botao_nav p-2" onclick="redirecionar('selecionar.php')"><i class="fas fa-map-marked"></i></button>
                                <button class="botao_nav p-2" onclick="redirecionar('globo.php')"><i class="fas fa-globe-americas"></i></button>
				<!--
                                <button class="botao_nav p-2" onclick="redirecionar('perfil.php')"><i class="fas fa-user-edit"></i></button>
				-->
                                <button class="botao_nav p-2" onclick="redirecionar('p8.php')">P8</button>
			</div>
		</nav>
	</header>
	<div class="barra_topo"></div>
	<div class="barra-degrade1"></div>

	<div>
		<div class="barra-titulo">AwesomePRO8</div>
	</div>
        
        <div class="info_p8">
                Como parte do projeto PRO8, o aplicativo "AwesomePRO8" foi desenvolvido para enviar os </br>
                dados de rastreamento de um telefone celular Android para o banco de dados do projeto.</br>
                Para mais informações acesse 
                https://github.com/cassiocsilva/AwesomePRO8.</a>
        </div>
        
	<div class="barra-app d-flex justify-content-around">
                <!-- width="305" height="324" -->
		<img src="img/app_login.png" width="144" height="304">
                <img src="img/app_Registrar.png" width="144" height="304">
                <img src="img/app_bem-vindo.png" width="144" height="304">
                <img src="img/app_permissão-acesso-localização.png" width="144" height="304">
                <img src="img/app_rastreador-habilitado.png" width="144" height="304">
	</div>

	<div class="info_p8">
		<div>
			PRO-8 é uma Solução em Rastreamento desenvolvido pela <a target="_blank"
				href="https://fatecitu.edu.br/portal/institucional/">
				Faculdade de Tecnologia de Itu</a>, sob a orientação da <a target="_blank"
				href="http://lattes.cnpq.br/5423211915001101">
				Profª. Ms. Angelina Vitorino de Souza Melaré</a>.</br>
			O projeto oferece além da plataforma para monitoramento, aplicação para transformar um smartphone
			em um rastreador, possibilitando monitoramento logístico, de cargas, monitoramento de pessoas
			como crianças e idosos, e muito mais. 
			<div class="figura-cps">
				<a target="_blank" href="https://www.cps.sp.gov.br/"><img src="img/csp2.png" width="236" height="54"
						alt="www.cps.sp.gov.br/"></a>
			</div>
		</div>
	</div>
	<div class="barra-degrade2"></div>
	<footer class="rodape">
		<div class="rodape_links">
			<a target="_blank" href="https://fatecitu.edu.br/portal/">Fatec Itu</a>
			<a target="_blank" href="http://www.vestibularfatec.com.br/home/">Vestibular</a>
			<a target="_blank" href="https://fatecitu.edu.br/portal/contato/">Contato</a>
		</div>
		<div class="rodape_direitos"> © 2020 Fatec Itu. Todos os direitos reservados.
			Desenvolvido por Cássio Costa da Silva.
		</div>
	</footer>
	<script src="js/redirecionar.js"></script>
</body>
</html>