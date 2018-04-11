<?php

	require_once('cms/funcoes.php');
	usuarioB();
	
	$sql = "select n.*,e.nome as nomeEstado from tblnossasloja as n, tblestado as e where n.estado = e.id ";
	
	$select = mysql_query($sql);

	$rs = mysql_fetch_array($select);
	
	$estado = $rs['nomeEstado'];
	$cidade = $rs['cidade'];
	$rua = $rs['rua'];
	$telefone = $rs['telefone'];

?>
<!DOCTYPE html>
<html lang="pt">

<head>
	<title>Locadora</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	
</head>

<body>

	<section id="principal">
		<header id="cabecalho">
			
			<div id="logo">
				
			</div>
			
			<div id="caixaLogin1">
				<form name="login" method="get">
					<p class="negrito">Usuario e Senha</p>
					<input type="text" name="txtnome" placeholder="Digite seu NomeID">					
					<input type="password" name="txtsenha" placeholder="Digite sua Senha">	
					<input type="submit"  name="btnlogin" value="Login">
				</form>					
			</div>
			
			<nav id="menu">
				<ul class="menuDeitadoDeLado">
					<li><A href="index.php">Home</A></li>
					<li>Promoção
						<ul class="subMenuDeitadoDeLado">
							<li><A href="pg3.php">Filmes em Promoção</A></li>
						</ul>
					</li>					
					<li>Destaque
						<ul class="subMenuDeitadoDeLado">
							<li><A href="pg2.php">Filmes em Destaque</A></li>
							<li><A href="pg4.php">Atores em Destaque</A></li>
						</ul>
					</li>					
					<li><A href="pg5.php">Nossas Lojas</A></li>					
				</ul>
			</nav>
			
			<nav id="menuMobile">
				<?php menuResponsivo()?>
			</nav>
			
		</header>
		
		<div id="corpoDetalhes">	
			<div id="slider">
				<div class="w3content">
				  <img class="mySlides" src="imagem/slider1.jpg" alt="Imagem1">
				  <img class="mySlides" src="imagem/slider2.jpg" alt="Imagem2">
				  <img class="mySlides" src="imagem/slider3.jpg" alt="Imagem3">
				  <img class="mySlides" src="imagem/slider3.jpg" alt="Imagem4">
				</div>

				<script>
				var myIndex = 0;
				carousel();

				function carousel() {
					var i;
					var x = document.getElementsByClassName("mySlides");
					for (i = 0; i < x.length; i++) {
					   x[i].style.display = "none";
					}
					myIndex++;
					if (myIndex > x.length) {myIndex = 1}
					x[myIndex-1].style.display = "block";
					setTimeout(carousel, 1000); // Change image every 2 seconds
				}
				</script>
			</div>
			
			<div id="produtosDetalhes">	
				
				
				<div id="divItem">
					<?php itens()?>
				</div>
				
				<div id="titulo">
					<h2>Nossas Locadoras : Acme Tunes SA</h2>
				</div>					

				<?php $sql = "select n.*,e.nome as nomeEstado from tblnossasloja as n, tblestado as e where n.estado = e.id ";
				
					$select = mysql_query($sql);
					
					while($rs = mysql_fetch_array($select)){?>
					
					<div class="listaProdutos">	
					
						<div class="contLoja">
							<p>Estado: <?php echo($rs['nomeEstado']);?></p>
							<p>Cidade: <?php echo($rs['cidade']);?></p>
							<p>Endereço: <?php echo($rs['rua']);?></p>
							Telefone: <?php echo($rs['telefone']);?>				
						</div>
						
					</div>
					
					<?php
					}
					?>												
					
			</div>
			
			<footer id="rodape">
				<?php mobileFlutuante()?>
				<p class="negrito"><A href="pg6.php">Sobre a Locadora</A></p>
				<p class="negrito"><A href="pg7.php">Fale Conosco</A></p>
				<p>Copyright © 2016.</p>
			</footer>
		</div>	
	</section>
	
</body>

</html>