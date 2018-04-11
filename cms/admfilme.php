<?php

	/*inclui um arquivo externo e não deixa incluir novamente caso ja exista*/
	require_once('funcoes.php');
	//chama a função do arquivo externa
	cms();

	//variaveis ultilizadas
	$foto = "";
	$nome = "";
	$descricao = "";
	$detalhe = "";
	$destaque=0;
	$preco="";
	$promocao=0;
	$desconto =0;
	
	$botao="Salvar";
   
   //verifica se existe um modo
   if(isset($_GET['modo'])){

		$modo = $_GET['modo'];

		if($modo == 'destaque'){
			
			$id = $_GET['id'];

			$_SESSION['idItem'] = $id;

			$sql = "select * from tblfilme where id=".$id;

			$select = mysql_query($sql);

			$rs = mysql_fetch_array($select);
			
			$foto = $rs['foto'];
			$nome = $rs['nome'];
			$genero = $rs['genero'];
			$detalhe = $rs['detalhe'];
			$destaque = $rs['destaque'];
			$preco = $rs['preco'];
			$promocao = $rs['promocao'];
			
			if($destaque == 0){
				
				$destaque = 1;
				
				
			}else{
				
				$destaque = 0;			
				
			}

			//salva na variavel o codigo sql para dar update no banco
			$sql = "update tblfilme set nome='".$nome."',genero='".$genero."',detalhe='".$detalhe."',foto='".$foto."',destaque='".$destaque."',preco='".$preco."',promocao='".$promocao."' where id=".$_SESSION['idItem'];
			
			mysql_query("update tblfilme set destaque= 0 where destaque <> 0;");
			
			mysql_query($sql);
			
			header('location:admfilme.php');
			
		}	
		
	}

?>

<!DOCTYPE HTML SYSTEM>

<html>

	<head>
		<title>Locadora</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">

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
							<A href="admfilme.php?modo=sair">Logout</A>
						</div>
					</div>
				</div>

			</header>

			<nav id="navAutor">

				<div class="titulo">Administração Filmes em Destaque</div>
			
					<div id="consultaFilme">
						<div class="titulo">Consulta de Filmes</div>

						<?php

							$sql = "select *,preco *(promoporcent/100) as totalDesc from tblfilme";

							$select = mysql_query($sql);

							while($rs = mysql_fetch_array($select)){

						?>
							<div class="filmes">
								<div class="foto">
									<img height="140px" width="140px" src="<?php echo($rs['foto'])?>">
								</div>

								<div class="descricao">
									Nome: <?php echo($rs['nome']);?><p></p>
									Preço: <?php echo($rs['preco'] - $rs['totalDesc']);?>
								</div>

								<div class="opcao">
								
									<table >
									
										<tr>
											<td class="nomeOp">
												Destaque
											</td>										
										</tr>
										<tr>
											<td class="imagensOp">
												<a href="admfilme.php?modo=destaque&id=<?php echo($rs['id'])?>"><img class="img" src="<?php   if($rs['destaque'] == 0){
											
				$img = "imagem/alert1.png";
			
			}elseif($rs['destaque'] == 1){
		   
				$img = "imagem/alert.png";
		   
			}
			echo($img);?>"></a>
											</td>											
										</tr>
									
									</table>
								
								</div>

							</div>
						<?php
							}

						?>
					</div>

				

			</nav>

			<footer id="footer">
				<span id="">Desenvolvido por : Juan</span>
			</footer>

		</section>

	</body>

</html>