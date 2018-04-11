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
	
	$sql = "select * from tbllocadora";

	$select = mysql_query($sql);

	$rs = mysql_fetch_array($select);

	$foto = $rs['foto'];
	$nome = $rs['nome'];
	$descricao = $rs['descricao'];
	$detalhe = $rs['detalhe'];

	if($rs['nome'] != null){
		
		$botao = "Atualizar";
		
	}else{
		
		$botao="Salvar";
		
	}

	if(isset($_POST['btnSalvar'])){

		$nome = $_POST['txtnome'];
		$descricao = $_POST['txtdescricao'];
		$detalhe = $_POST['txatdetalhesSalvar'];

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

					$sql = "INSERT INTO	tbllocadora(nome,descricao,detalhe,foto)
					values('".$nome."','".$descricao."','".$detalhe."','".$uploadflie."')";

					mysql_query($sql);
					
					header('location:admlocadora.php');

				}

			}else{

				echo("Arquivo invalido!");
				
				header('location:admlocadora.php');

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
					
					$sql = "update tbllocadora set nome='".$nome."',descricao='".$descricao."',detalhe='".$detalhe."',foto='".$uploadflie."'";

					mysql_query($sql);

				}

			}else{

				echo("Arquivo invalido!");
				

			}
			//recarrega a pagina
			header('location:admlocadora.php');
			
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
								<A href="admconteudo.php"><img src="imagem/2.png" height="130px" width="130px" alt="admconteudo"></A>
							</div>
							<div class="detalhes">
								Adm.Conteudo
							</div>
						</div>
						<div class="caixasOpcoes">
							<div class="imagem">
								<A href="admfale.php"><img src="imagem/3.png" height="130px" width="130px" alt="admfale"></A>
							</div>
							<div class="detalhes">
								Adm.Fale Conosco
							</div>
						</div>
						<div class="caixasOpcoes">
							<div class="imagem">
								<A href="admproduto.php"><img src="imagem/4.png" height="130px" width="130px" alt="admproduto"></A>
							</div>
							<div class="detalhes">
								Adm.Produtos
							</div>
						</div>
						<div class="caixasOpcoes">
							<div class="imagem">
								<A href="admusuario.php"><img src="imagem/5.png" height="130px" width="130px" alt="admusuario"></A>
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
							<A href="admlocadora.php?modo=sair">Logout</A>
						</div>
					</div>
				</div>

			</header>

			<nav id="navAutor">

				<div class="titulo">Administração Sobre a Locadora</div>

				<div id="admFilme">

					<form name="salvar" method="post" enctype="multipart/form-data" action="admlocadora.php">
						<table>
							<tr>
								<td><div class="negrito">Logo:</div></td>
								<td><input class="camposSalvar" type="file" name="flefoto" value="<?php echo($foto); ?>"></td>
							</tr>
							<tr>
								<td><div class="negrito">Nome:</div></td>
								<td><input class="camposSalvar" name="txtnome" type="text" placeholder="Digite o nome" value="<?php echo($nome); ?>" required></td>
							</tr>
							<tr>
								<td><div class="negrito">Descrição:</div></td>
								<td><input class="camposSalvar" name="txtdescricao" type="text" placeholder="Digite a descrição" value="<?php echo($descricao); ?>" required></td>
							</tr>
							<tr>
								<td><div class="negrito">Detalhes:</div></td>
								<td><textarea class="textareaSalvar" name="txatdetalhesSalvar" rows="6" cols="29" maxlength="500" ><?php echo($detalhe); ?></textarea></td>
							</tr>
							<tr>
								<td><input class="butao" type="submit" name="btnSalvar" value="<?php echo($botao);?>"></td>
								<td><input class="butao" type="submit" name="btnLimpar" value="Limpar"></td>
							</tr>
						</table>
					</form>
				
				</div>
				
					<div id="consultaAutor">	

						<div class="titulo">Consulta Sobre a Locadora</div>					

						<?php

							$sql = "select * from tbllocadora";

							$select = mysql_query($sql);

							while($rs = mysql_fetch_array($select)){

						?>
							<table>
								<tr>
									<td><div class="negrito">Logo:</div></td>
									<td><img height="140px" width="120px" src="<?php echo($rs['foto'])?>"></td>
								</tr>
								<tr>
									<td><div class="negrito">Nome:</div></td>
									<td><?php echo($rs['nome']); ?></td>
								</tr>
								<tr>
									<td><div class="negrito">Descrição:</div></td>
									<td><?php echo($rs['descricao']); ?></td>
								</tr>
								<tr>
									<td><div class="negrito">Detalhes:</div></td>
									<td><?php echo($rs['detalhe']); ?></td>
								</tr>
							</table>
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