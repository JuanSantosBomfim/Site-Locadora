<?php

	/*inclui um arquivo externo e não deixa incluir novamente caso ja exista*/
	require_once('funcoes.php');
//chama a função do arquivo externa
	cms();

	//variaveis ultilizadas
	$estado = "";
	$cidade = "";
	$rua = "";
	$telefone = "";
	
	$botao="Salvar";
   
   //verifica se existe um modo
   if(isset($_GET['modo'])){

		$modo = $_GET['modo'];

		if($modo == 'excluir'){

			$id = $_GET['id'];

			$sql = "delete from tblnossasloja where id =".$id;

			mysql_query($sql);
			//recarrega a pagina
			header('location:admnossaloja.php');

		}elseif($modo == 'editar'){

			$id = $_GET['id'];

			$_SESSION['idItem'] = $id;

			$sql = "select * from tblnossasloja where id=".$id;

			$select = mysql_query($sql);

			$rs = mysql_fetch_array($select);

			$estado = $rs['estado'];
			$cidade = $rs['cidade'];
			$rua = $rs['rua'];
			$telefone = $rs['telefone'];

			$botao = "Atualizar";

		}
		
	}

	if(isset($_POST['btnSalvar'])){
		
		$estado = $_POST['sltestado'];
		$cidade = $_POST['txtcidade'];
		$rua = $_POST['txtrua'];
		$telefone = $_POST['txttelefone'];

		if($_POST['btnSalvar'] == "Salvar"){

			//salva na variavel o codigo sql para dar inserir no banco
			$sql = "INSERT INTO	tblnossasloja(estado,cidade,rua,telefone)
			values('".$estado."','".$cidade."','".$rua."','".$telefone."')";

			mysql_query($sql);
			//recarrega a pagina
			header('location:admnossaloja.php');
		
		}elseif($_POST['btnSalvar'] =="Atualizar"){
//salva na variavel o codigo sql para dar update no banco
			$sql = "update tblnossasloja set estado='".$estado."',cidade='".$cidade."',rua='".$rua."',telefone='".$telefone."' where id=".$_SESSION['idItem'];

			mysql_query($sql);
			//recarrega a pagina
			header('location:admnossaloja.php');

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
							<A href="admnossaloja.php?modo=sair">Logout</A>
						</div>
					</div>
				</div>

			</header>

			<nav id="navAutor">

				<div class="titulo">Administração Filmes em Destaque</div>

				<div id="admNossaLoja">

					<form name="salvar" method="post" action="admnossaloja.php">
							<table>
								<tr>
									<td><div class="negrito">Estado:</div></td>
									<td><select name="sltestado" id="select">
									
									<?php $sql = "select * from tblestado";
										$select = mysql_query($sql);
										
										while($rs = mysql_fetch_array($select)){?>
										
											<option value ="<?php echo($rs['id']);  ?>">
												<?php echo($rs['nome']); ?>
											</option>
										
										<?php
										}
										?>
										
									</select></td>
								</tr>						
								<tr>
									<td><div class="negrito">Cidade:</div></td>
									<td><input class="camposSalvar" name="txtcidade" type="text" placeholder="Digite a cidade" required value="<?php echo($cidade); ?>"></td>
								</tr>
								<tr>
									<td><div class="negrito">Rua:</div></td>
									<td><input class="camposSalvar" name="txtrua" type="text" placeholder="Digite a rua" required value="<?php echo($rua); ?>"></td>
								</tr>
								<tr>
									<td><div class="negrito">Telefone:</div></td>
									<td><input class="camposSalvar" name="txttelefone" type="text" placeholder="Digite o telefone" required value="<?php echo($telefone); ?>"></td>
								</tr>
								<tr>
									<td><input class="butao" type="submit" name="btnSalvar" value="<?php echo($botao);?>"></td>
									<td><input class="butao" type="submit" name="btnLimpar" value="Limpar"></td>
								</tr>
							</table>
					</form>
					
				</div>

					<div id="consultaFilme">
						<div class="titulo">Consulta de Filmes</div>

						<?php

							$sql = "select n.*,e.nome as nomeEstado from tblnossasloja as n, tblestado as e where n.estado = e.id ";

							$select = mysql_query($sql);

							while($rs = mysql_fetch_array($select)){

						?>
							<div class="lojas">

								<div class="descricaoLojas">
									<p>Estado: <?php echo($rs['nomeEstado']);?></p>
									<p>Cidade: <?php echo($rs['cidade']);?></p>
									<p>Telefone: <?php echo($rs['telefone']);?></p>
								</div>

								<div class="opcao">
								
									<table >
									
										<tr>
											<td class="nomeOp">
												Editar
											</td>
											<td class="nomeOp">
												Excluir
											</td>
										</tr>									
											<td class="imagensOp">
												<a href="admnossaloja.php?modo=editar&id=<?php echo($rs['id'])?>"><img class="img" src="imagem/ed1.jpg"></a>
											</td>
											<td class="imagensOp">
												<a href="admnossaloja.php?modo=excluir&id=<?php echo($rs['id'])?>"><img class="img" src="imagem/d1.jpg"> </a>
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