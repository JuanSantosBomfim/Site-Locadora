<?php

	/*inclui um arquivo externo e não deixa incluir novamente caso ja exista*/
	require_once('funcoes.php');
	//chama a função do arquivo externa
	cms();
	
	//variaveis ultilizadas
	$nome = "";
	$senha = "";
	$nivel = 0;
	$botao="Salvar";
	
	$_SESSION['descontoS'] = 0;
	

?>

<!DOCTYPE HTML SYSTEM>

<html>


	<head>
		<title>Locadora</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<script src="//code.jquery.com/jquery-1.12.4.js"></script>
		<script src="//code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
	</head>
	
	<body>
	
		<section  id="corpo">
		
			<header id="header">
				<div id="cabecalho1">
					<div id="texto">
						<b>CMS</b> - Sistema De Gerenciamento Do Site
					</div>
					<div id="img">
						<img src="imagem/1.png">
					</div>
				</div>
				<div id="cabecalho2">					
					<div id="fundoCaixas">
						<div class="caixasOpcoes">
							<div class="imagem">
								<A href="admconteudo.php"><img src="imagem/2.png" height="130px" width="130px"></A>
							</div>
							<div class="detalhes">
								Adm.Conteudo
							</div>
						</div>
						<div class="caixasOpcoes">
							<div class="imagem">
								<A href="admfale.php"><img src="imagem/3.png" height="130px" width="130px"></A>
							</div>
							<div class="detalhes">
								Adm.Fale Conosco
							</div>
						</div>
						<div class="caixasOpcoes">
							<div class="imagem">
								<A href="admproduto.php"><img src="imagem/4.png" height="130px" width="130px"></A>
							</div>
							<div class="detalhes">
								Adm.Produtos
							</div>
						</div>
						<div class="caixasOpcoes">
							<div class="imagem">
								<A href="admusuario.php"><img src="imagem/5.png" height="130px" width="130px"></A>
							</div>
							<div class="detalhes">
								Adm.Usuarios
							</div>
						</div>
	
					</div>
					<div id="infoLogin">					
						<div id="bemvindoInfo">
							Bem Vindo, <?php echo($_SESSION['UsuarioNome'])?>.
						</div>
						<div id="logoutInfo">
							<A href="admconteudo.php?modo=sair">Logout</A>
						</div>
					</div>
				</div>
			
			</header>
			
			<nav id="nav">

				<div id="admConteudo">
				
					<div class="titulo">Administração Conteudo</div>
					
					<table>
						<tr>
							<td>
								<div class="pgs">
					
									<A href="admator.php"><img src="imagem/usuarios.png" width="120px" height="120px"></A>
									<p>Atores em Destaque</p>
									
								</div>
							</td>
						</tr>
						<tr>
							<td>
								<div class="pgs">
						
									<A href="admfilme.php"><img src="imagem/filme.png" width="120px" height="120px">
									<p>FILMES em Destaque</p></A>
								</div>
							</td>
						</tr>
						<tr>
							<td>
								<div class="pgs">
						
									<A href="admlocadora.php"><img src="imagem/info.png" width="120px" height="120px">
									<p>Sobre a Locadora</p></A>
								</div>
							</td>
						</tr>		
						<tr>
							<td>
								<div class="pgs">
						
									<A href="admnossaloja.php"><img src="imagem/lista.jpg" width="120px" height="120px">
									<p>Nossas Lojas</p></A>
								</div>
							</td>
						</tr>						
					</table>				
				</div>
			</nav>
			
			<footer id="footer">
				<span id="">Desenvolvido por : Juan</span>
			</footer>
		
		</section>
	
	</body>
	
</html>