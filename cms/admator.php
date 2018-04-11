<?php

	/*inclui um arquivo externo e não deixa incluir novamente caso ja exista*/
	require_once('funcoes.php');
	//chama a função do arquivo externa
	cms();
	
	//variaveis ultilizadas
	$nome = "";
	$dataNasc = "";
	$sexo = "";
	$biografia = "";
	$participacao = "";
	$foto = "";
	$destaque = "";

	$botao="Salvar";
   
   //verifica se existe um modo
   if(isset($_GET['modo'])){

		$modo = $_GET['modo'];

		if($modo == 'excluir'){

			$id = $_GET['id'];

			$sql = "delete from tblator where id =".$id;

			mysql_query($sql);
			
			//recarrega a pagina
			header('location:admator.php');

		}elseif($modo == 'editar'){

			$id = $_GET['id'];

			$_SESSION['idItem'] = $id;

			$sql = "select * from tblator where id=".$id;

			$select = mysql_query($sql);

			$rs = mysql_fetch_array($select);

			$nome = $rs['nome'];
			$dataNasc = $rs['dataNasc'];
			$sexo = $rs['sexo'];
			$biografia = $rs['biografia'];
			$participacao = $rs['participacao'];
			$foto = $rs['foto'];
			$destaque = $rs['destaque'];

			$botao = "Atualizar";

		}elseif($modo == 'destaque'){
			
			$id = $_GET['id'];

			$_SESSION['idItem'] = $id;

			$sql = "select * from tblator where id=".$id;

			$select = mysql_query($sql);

			$rs = mysql_fetch_array($select);
			
			$nome = $rs['nome'];
			$dataNasc = $rs['dataNasc'];
			$sexo = $rs['sexo'];
			$biografia = $rs['biografia'];
			$participacao = $rs['participacao'];
			$foto = $rs['foto'];
			$destaque = $rs['destaque'];
			
			if($destaque == 0){
				
				$destaque = 1;
				
				
			}else{
				
				$destaque = 0;			
				
			}
			//salva na variavel o codigo sql para dar update no banco
			$sql = "update tblator set nome='".$nome."',dataNasc='".$dataNasc."',sexo='".$sexo."',biografia='".$biografia."',participacao='".$participacao."',foto='".$foto."',destaque='".$destaque."' where id=".$_SESSION['idItem'];
			
			mysql_query("update tblator set destaque= 0 where destaque <> 0;");
			
			mysql_query($sql);
			
			//recarrega a pagina
			header('location:admator.php');
			
		}	
		
	}

	if(isset($_POST['btnSalvar'])){

		$nome = $_POST['txtnome'];
		$dataNasc = $_POST['txtdtnasc'];
		$sexo = $_POST['sexo'];
		$biografia = $_POST['txatbio'];
		$participacao = $_POST['participacao'];
		$destaque = 0;

		if($_POST['btnSalvar'] == "Salvar"){
			/*Permite obter apenas o nome e extenção do arquivo*/
			$nome_arq = basename($_FILES['flefoto']['name']);

			/*variavel que cotem o caminho eo nome do arquivo e a mesma será salva no banco*/
			$uploaddir = "arquivos/";

			/*variavel que contem o caminho e nome do arquivo*/
			$uploadflie = $uploaddir.$nome_arq;

			/*Decisão para validar os tipos de extensão valida para o upload de arquivos*/
			if(strstr($nome_arq,'.jpg') || strstr($nome_arq,'.png')){

				/*Copia o arquivo local na maquina do usuario para o servidor na pasta arquivos,
				se a copia acontecer com sucesso realizamos o insert no banco de dados*/
				if(move_uploaded_file($_FILES['flefoto']['tmp_name'],$uploadflie)){

					$sql = "INSERT INTO	tblator(nome,dataNasc,sexo,biografia,participacao,foto,destaque)
					values('".$nome."','".$dataNasc."','".$sexo."','".$biografia."','".$participacao."','".$uploadflie."','".$destaque."')";

					mysql_query($sql);
					
					header('location:admator.php');

				}

			}else{

				echo("Arquivo invalido!");
				//recarrega a pagina
				header('location:admator.php');

			}
		
		}elseif($_POST['btnSalvar'] =="Atualizar"){
				
			/*Permite obter apenas o nome e extenção do arquivo*/
			$nome_arq = basename($_FILES['flefoto']['name']);

			/*variavel que cotem o caminho eo nome do arquivo e a mesma será salva no banco*/
			$uploaddir = "arquivos/";

			/*variavel que contem o caminho e nome do arquivo*/
			$uploadflie = $uploaddir.$nome_arq;

			/*Decisão para validar os tipos de extensão valida para o upload de arquivos*/
			if(strstr($nome_arq,'.jpg') || strstr($nome_arq,'.png')){

				/*Copia o arquivo local na maquina do usuario para o servidor na pasta arquivos,
				se a copia acontecer com sucesso realizamos o insert no banco de dados*/
				if(move_uploaded_file($_FILES['flefoto']['tmp_name'],$uploadflie)){
					//salva na variavel o codigo sql para dar update no banco
					$sql = "update tblator set nome='".$nome."',dataNasc='".$dataNasc."',sexo='".$sexo."',biografia='".$biografia."',participacao='".$participacao."',foto='".$uploadflie."',destaque='".$destaque."' where id=".$_SESSION['idItem'];

					mysql_query($sql);

				}

			}else{

				echo("Arquivo invalido!");
				

			}
			//recarrega a pagina
			header('location:admator.php');
			
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
							<A href="admator.php?modo=sair">Logout</A>
						</div>
					</div>
				</div>

			</header>

			<nav id="navAutor">

				<div class="titulo">Administração Atores em Destaque</div>

				<div id="admAtor">
				
					<form name="salvar" method="post" enctype="multipart/form-data" action="admator.php">
							<table>
								<tr>								
									<td><div class="negrito">Foto:</div></td>
									<td><input class="camposSalvar" type="file" name="flefoto" value="<?php echo($foto); ?>"></td>
								</tr>
								<tr>
									<td><div class="negrito">Nome:</div></td>
									<td><input class="camposSalvar" name="txtnome" type="text" placeholder="Digite o nome" required value="<?php echo($nome); ?>"></td>
								</tr>
								<tr>
									<td><div class="negrito">Data de Nascimento:</div></td>
									<td><input class="camposSalvar" name="txtdtnasc" type="text" placeholder="Digite a Data de Nascimento" required value="<?php echo($dataNasc); ?>"></td>
								</tr>
								<tr>
									<td><div class="negrito">Sexo:</div></td>
									<td>
										<input type="radio" name="sexo" value="Masculino">Masculino
										<input type="radio" name="sexo" value="Feminino">Feminino
										<input type="radio" name="sexo" value="Outro">Outro
									</td>
								</tr>
								<tr>
									<td><div class="negrito">Biografia:</div></td>
									<td><textarea class="textareaSalvar" name="txatbio" rows="6" cols="29" maxlength="500" ><?php echo($biografia); ?></textarea></td>
								</tr>
								<tr>
									<td><div class="negrito">Participação:</div></td>
									<td><select name="participacao" id="select">

									<option value ="0">
										Nenhum Filme
									</option>
									
									<?php $sql = "select * from tblfilme";
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
									<td><input class="butao" type="submit" name="btnSalvar" value="<?php echo($botao);?>"></td>
									<td><input class="butao" type="submit" name="btnLimpar" value="Limpar"></td>
								</tr>
							</table>
					</form>
					
				</div>


					<div id="consultaAutor">
						<div class="titulo">Consulta de Atores</div>

						<?php

							$sql = "select * from tblator;";	

							$select = mysql_query($sql);

							while($rs = mysql_fetch_array($select)){

						?>
							<div class="atores">
								<div class="foto">
									<img height="140px" width="140px" src="<?php echo($rs['foto'])?>">
								</div>

								<div class="descricao">
									<?php echo($rs['nome']);?><p></p>
									Data de Nascimento: <?php echo($rs['dataNasc']);?>
								</div>

								<div class="opcao">
								
									<table >
									
										<tr>
											<td class="nomeOp">
												Destaque
											</td>
											<td class="nomeOp">
												Editar
											</td>
											<td class="nomeOp">
												Excluir
											</td>
										</tr>
										<tr>
											<td class="imagensOp">
												<a href="admator.php?modo=destaque&id=<?php echo($rs['id'])?>"><img class="img" src="<?php   if($rs['destaque'] == 0){
											
				$img = "imagem/alert1.png";
			
			}elseif($rs['destaque'] == 1){
		   
				$img = "imagem/alert.png";
		   
			}
			echo($img);?>"></a>
											</td>
											<td class="imagensOp">
												<a href="admator.php?modo=editar&id=<?php echo($rs['id'])?>"><img class="img" src="imagem/ed1.jpg"></a>
											</td>
											<td class="imagensOp">
												<a href="admator.php?modo=excluir&id=<?php echo($rs['id'])?>"><img class="img" src="imagem/d1.jpg"> </a>
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