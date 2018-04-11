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
      
   
	//verifica se existe um modo
	if(isset($_GET['modo'])){
		
		$modo = $_GET['modo'];
		
		if($modo == 'excluir'){
			
			$id = $_GET['id'];
			
			$sql = "delete from tblfaleconosco where id =".$id;
			
			mysql_query($sql);
			//recarrega a pagina
			header('location:admfale.php');
			
		}
		
	}
	

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
							<A href="admfale.php?modo=sair">Logout</A>
						</div>
					</div>
				</div>
			
			</header>
			
			<nav id="nav">

				<div id="admFaleConosco">
				
					<div class="titulo">Administração Fale Conosco</div>
						
					<table>								
						<tr>
							<td class="tabelaConsulta2">Nome</td>
							<td class="tabelaConsulta2">Telefone</td>
							<td class="tabelaConsulta2">Celular</td>
							<td class="tabelaConsulta2">Home Page</td>
							<td class="tabelaConsulta2">Link Face</td>
							<td class="tabelaConsulta2">Sugestão</td>
							<td class="tabelaConsulta2">Informações</td>
							<td class="tabelaConsulta2">Sexo</td>
							<td class="tabelaConsulta2">Profissão</td>
						</tr>
						<?php			
							
							$sql = "select * from tblfaleconosco";													
							
							$select = mysql_query($sql);											
							
							while($rs = mysql_fetch_array($select)){								
							
						?>
						
						<tr>
							<td class="tabelaConsulta21"><?php echo($rs['nome']);?></td>
							<td class="tabelaConsulta21"><?php echo($rs['telefone']);?></td>
							<td class="tabelaConsulta21"><?php echo($rs['celular']);?></td>
							<td class="tabelaConsulta21"><?php echo($rs['homepag']);?></td>
							<td class="tabelaConsulta21"><?php echo($rs['linkface']);?></td>
							<td class="tabelaConsulta21"><?php echo($rs['sugestao']);?></td>
							<td class="tabelaConsulta21"><?php echo($rs['infoprodutos']);?></td>
							<td class="tabelaConsulta21"><?php echo($rs['sexo']);?></td>
							<td class="tabelaConsulta21"><?php echo($rs['profissao']);?></td>

							
							<td class="tabelaConsulta">
								<a href="admfale.php?modo=excluir&id=<?php echo($rs['id'])?>"><img class="img" src="imagem/d1.jpg"> </a>								
							</td>
							
						</tr>
						
						<?php
							}
						
						?>
					</table>
				
				</div>
				
				
			</nav>
			
			<footer id="footer">
				<span id="">Desenvolvido por : Juan</span>
			</footer>
		
		</section>
	
	</body>
	
</html>