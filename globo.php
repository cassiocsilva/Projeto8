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
        
        <!-- WorldWindJS Custom styles -->
        <link href="./css/custom.css" rel="stylesheet">
        
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
                                <button class="botao_nav p-2" onclick="redirecionar('awesomePRO8.php')"><i class="fas fa-mobile-alt"></i></button>
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
		<div class="barra-titulo">Globo WorldWindJS</div>
	</div>
        

        
        
        
  <main role="main" class="container-fluid p-0" style='position:relative; top:0px; left:0px;'>    
    
    <!-- Globe -->
    <div id="globe" class="globe">
      
      <!--.d-block ensures the size is correct (prevents a scrollbar from appearing)-->
      <canvas id="globe-canvas" class="d-block" style="width: 100%; height: 100%; background-color: #E8E8E8;"    
                        data-bind="style: { cursor: dropIsArmed() ? 'crosshair' : 'default' }">
                        Try Chrome or FireFox.
  
        <script type="text/javascript">
          var latitude_js = "<?php echo $latitude;?>";
          var longitude_js = "<?php echo $longitude;?>";
        </script>
      </canvas>
    </div>
      
    <div style='position:absolute; top:47.5%; left:48.5%;'>
      <img src="img/favicon_pro8_vd-removebg.ico"</div>

  </main> 
        
        




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
	<script src="./js/redirecionar.js"></script>
        
        <!-- WorldWindJS Globe Scripts -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="https://unpkg.com/worldwindjs@1.5.90/build/dist/worldwind.min.js"></script>
        <script src="./js/app_globo.js"></script>
</body>
</html>