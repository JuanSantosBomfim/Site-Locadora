<!DOCTYPE html>

<?php

	require_once('cms/funcoes.php');
	usuarioB();

	if(isset($_GET['btnsalvar'])){
		
		$nome = $_GET['txtnome'];
		$telefone = $_GET['txttelefone'];
		$celular = $_GET['txtcelular'];
		$email = $_GET['txtemail'];
		$homepag = $_GET['txthomepag'];
		$linkface = $_GET['txtlinkface'];
		$sugestao = $_GET['txtsugestao'];
		$infoprodutos = $_GET['txtinfoprodutos'];
		$sexo = $_GET['txtsexo'];
		$profissao = $_GET['txtprofissao'];
		
		$sql = "insert into tblfaleconosco(nome,telefone,celular,email,homepag,linkface,sugestao,infoprodutos,sexo,profissao) 
		values('".$nome."','".$telefone."','".$celular."','".$email."','".$homepag."','".$linkface."','".$sugestao."','".$infoprodutos."','".$sexo."','".$profissao."')";
		
		mysql_query($sql);
		
		header('location:pg7.php');
		
	}

?>
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
		
		<div id="corpoF">	
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
			
			<div id="produtosFaleconosco">	
			
				<div id="divItem">
					<?php itens()?>
				</div>
				
				<div id="titulo">
					<h2>Fale Conosco</h2>
				</div>
				
				<div id="caixaFaleConosco">
					<form name="cadastro" method="get" action="pg7.php">
						<table>
							<tr>
								<td class="tdCaixa"><p class="texto">Nome*</p></td>
								<td><input class="campos" type="text" name="txtnome" placeholder="Digite seu Nome" maxlength="50"required></td>
							</tr>
							<tr>
								<td class="tdCaixa"><p class="texto">Telefone</p></td>
								<td><input class="campos" type="text" name="txttelefone" placeholder="Digite seu telefone" maxlength="24"></td>
							</tr>
							<tr>
								<td class="tdCaixa"><p class="texto">Celular*</p></td>
								<td><input class="campos" type="text" name="txtcelular" placeholder="Digite seu celular" maxlength="24"required></td>
							</tr>
							<tr>
								<td class="tdCaixa"><p class="texto">Email*</p></td>
								<td><input class="campos" type="email" name="txtemail" placeholder="Digite seu email" maxlength="100" required ></td>
							</tr>
							<tr>
								<td class="tdCaixa"><p class="texto">Home Page</p></td>
								<td><input class="campos" type="text" name="txthomepag" placeholder="Home Page" maxlength="100"></td>
							</tr>
							<tr>
								<td class="tdCaixa"><p class="texto">Link no FaceBook</p></td>
								<td><input class="campos" type="text" name="txtlinkface" placeholder="Link no FaceBook" maxlength="100"></td>
							</tr>
							<tr>
								<td class="tdCaixa"><p class="texto">Sugestão/Criticas</p></td>
								<td><textarea name="txtsugestao" rows="6" cols="29" maxlength="254"></textarea></td>
							</tr>
							<tr>
								<td class="tdCaixa"><p class="texto">Informações Produtos</p></td>
								<td><input class="campos" type="text" name="txtinfoprodutos" placeholder="Digite suas duvidas" maxlength="100"></td>
							</tr>
							<tr>
								<td class="tdCaixa"><p class="texto">Sexo*</p></td>
								<td><input class="campos" type="text" name="txtsexo" placeholder="Digite seu Sexo" maxlength="15" required></td>
							</tr>
							<tr>
								<td class="tdCaixa"><p class="texto">Profissão*</p></td>
								<td><input class="campos" type="text" name="txtprofissao" placeholder="Digite sua Profissão" maxlength="70"required ></td>
							</tr>
							<tr>
								<td><input class="butao" type="submit" name="btnsalvar" value="Enviar"></td>
								<td><input class="butao" type="submit" name="btnlimpar" value="Limpar"></td>
							</tr>
						</table>
					</form>
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