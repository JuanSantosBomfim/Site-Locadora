<?php 

	require_once('cms/funcoes.php');
	usuarioB();
	
	$sql = "select f.*,g.nome as generoFilme from tblfilme as f, tblgenero as g where f.genero = g.id and f.destaque=1";

	$select = mysql_query($sql);

	$rs = mysql_fetch_array($select);

	$caminho = "cms/";
	$caminhoAquivo = $rs['foto'];
	$foto = $caminho.$caminhoAquivo;
	
	$nome = $rs['nome'];
	$genero = $rs['generoFilme'];
	$detalhe = $rs['detalhe'];
	$destaque = $rs['destaque'];
	$preco = $rs['preco'];
	$promocao = $rs['promocao'];

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
					<h2>Filme em Destaque</h2>
				</div>
				
				<div id="conteudoProdutosDetalhes">
					<div class="caixaDetalhes">
						<img class="caixaDetalhes" src="<?php echo($foto);?>" alt="foto1">
					</div>
					<div class="detalhesProdutos">
						<p class="negrito">Nome: <?php echo($nome);?></p>
						<p class="negrito">Genero: <?php echo($genero);?></p>
					</div>					
				</div>
				
				<div id="subTitulo">
					Detalhes
				</div>

				<div id="detalhesProdutosDetalhados">
					<?php echo($detalhe);?>
				</div>
					
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