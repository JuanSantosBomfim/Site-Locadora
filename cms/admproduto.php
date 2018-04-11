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
	$nomeCat="";
	$nomesubCat="";
	$botaoCat="Salvar";
	$botao="Salvar";
	$botaosubCat = "Salvar";
   
   //verifica se existe um modo
   if(isset($_GET['modo'])){

		$modo = $_GET['modo'];

		if($modo == 'excluir'){

			//pega o id que vem com o modo
			$id = $_GET['id'];

			//salva um codigo sql para excluir uma linha do banco
			$sql = "delete from tblfilme where id =".$id;

			//exculta o codigo
			mysql_query($sql);
			
			//recarrega a pagina
			header('location:admproduto.php');
			
		}elseif($modo == 'editar'){

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
			$categoria = $rs['categoria'];
			$subcategoria = $rs['subcategoria'];

			$botao = "Atualizar";

		}elseif($modo == 'promocao'){
			
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
			$categoria = $_POST['categoria'];
			$subcategoria = $_POST['subcategoria'];
			
			if($promocao == 0){
				
				$promocao = 1;	
				
				$desconto = $_SESSION['descontoS'];	
				
			}else{
				
				$promocao = 0;
				
			}

			//salva na variavel o codigo sql para dar update no banco
			$sql = "update tblfilme set nome='".$nome."',genero='".$genero."',detalhe='".$detalhe."',foto='".$foto."',destaque='".$destaque."',preco='".$preco."',promocao='".$promocao."',promoporcent='".$desconto."' where id=".$_SESSION['idItem'];	
			
			mysql_query($sql);
			
			header('location:admproduto.php');
			
		}elseif($modo == "editarCat"){
			
			$id = $_GET['id'];
			
			$_SESSION['idCat'] = $id;
			
			$sql="select * from tblcategoria where id=".$id;
			
			$select = mysql_query($sql);
			
			$rs = mysql_fetch_array($select);							
			
			$nomeCat = $rs['nome'];
			
			$botaoCat = "AtualizarCat";
			
		}elseif($modo == "excluirCat"){
			
			$id = $_GET['id'];
			
			$sql="delete from tblcategoria where id=".$id;
			
			mysql_query($sql);
			
		}elseif($modo == "editarSubCat"){
			
			$id = $_GET['id'];
			
			$_SESSION['idsubCat'] = $id;
			
			$sql="select * from tblsubcategoria where id=".$id;
			
			$select = mysql_query($sql);
			
			$rs = mysql_fetch_array($select);							
			
			$nomesubCat = $rs['nome'];
			
			$botaosubCat = "AtualizarSubCat";
			
		}elseif($modo == "excluirSubCat"){
			
			$id = $_GET['id'];
			
			$sql="delete from tblsubcategoria where id=".$id;
			
			mysql_query($sql);
			
		}
		
	}
	
	if(isset($_GET['btnSalvarDesconto'])){
		
		$_SESSION['descontoS'] = $_GET['txtdesconto'];			
		
	}

	if(isset($_POST['btnSalvar'])){

		$nome = $_POST['txtnome'];
		$genero = $_POST['genero'];
		$detalhe = $_POST['txatdetalhesSalvar'];
		$destaque = 0;
		$preco = $_POST['txtpreco'];
		$promocao=0;
		$categoria = $_POST['categoria'];
		$subcategoria = $_POST['subcategoria'];

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

					$sql = "INSERT INTO	tblfilme(nome,genero,detalhe,foto,destaque,preco,promocao,categoria,subcategoria)
					values('".$nome."','".$genero."','".$detalhe."','".$uploadflie."','".$destaque."','".$preco."','".$promocao."','".$categoria."','".$subcategoria."')";

					mysql_query($sql);
					
					header('location:admproduto.php');

				}

			}else{

				echo("Arquivo invalido!");
				
				header('location:admproduto.php');

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
					
					$sql = "update tblfilme set nome='".$nome."',genero='".$genero."',detalhe='".$detalhe."',foto='".$uploadflie."',destaque='".$destaque."',preco='".$preco."',promocao='".$promocao."',categoria='".$categoria."',subcategoria='".$subcategoria."' where id=".$_SESSION['idItem'];

					mysql_query($sql);

				}

			}else{

				echo("Arquivo invalido!");
				

			}
			
			header('location:admproduto.php');
			
		}
		

	}
	
	if(isset($_POST['btnSalvarCategoria'])){
		
		$nomeatt = $_POST['txtnomeCategoria'];
		
		if($_POST['btnSalvarCategoria'] == "Salvar"){
			
			$sql = "INSERT INTO tblcategoria(nome) values('".$nomeatt."')";
			
			mysql_query($sql);
			
			header('location:admproduto.php');			
			
			
		}elseif($_POST['btnSalvarCategoria'] == "AtualizarCat"){
		
			$sql = "update tblcategoria set nome='".$nomeatt."' where id=".$_SESSION['idCat'];
			
			mysql_query($sql);
			
			header('location:admproduto.php');
			
		}
		
	}
	
	if(isset($_POST['btnSalvarSubCategoria'])){
		
		$nomeat = $_POST['txtnomeSubCategoria'];
		$subCategoria = $_POST['SubCategoria'];
		
		if($_POST['btnSalvarSubCategoria'] == "Salvar"){
			
			$sql = "INSERT INTO tblsubcategoria(nome,categoria) values('".$nomeat."','".$subCategoria."');";
			
			mysql_query($sql);
			
			header('location:admproduto.php');
			
		}elseif($_POST['btnSalvarSubCategoria'] == "AtualizarSubCat"){
			
			$sql = "update tblsubcategoria set nome ='".$nomeat."',categoria='".$subCategoria."' where id=".$_SESSION['idsubCat'];
			
			mysql_query($sql);
			
			header('location:admproduto.php');
			
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
							<A href="admproduto.php?modo=sair">Logout</A>
						</div>
					</div>
				</div>

			</header>

			<nav id="navAutor">

				<div class="titulo">Administração de Produtos</div>

				<div id="admFilme">

					<form name="salvar" method="post" enctype="multipart/form-data" action="admproduto.php">
							<table>							
								<tr>
									<td><div class="negrito">Nome:</div></td>
									<td><input class="camposSalvar" name="txtnome" type="text" placeholder="Digite o nome" required value="<?php echo($nome); ?>"></td>
								</tr>
								<tr>
									<td><div class="negrito">Genero:</div></td>
									<td><select name="genero" id="select">
									
									<?php $sql = "select * from tblgenero";
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
									<td><div class="negrito">Foto:</div></td>
									<td><input class="camposSalvar" type="file" name="flefoto" value="<?php echo($foto); ?>"></td>
								</tr>
								<tr>
									<td><div class="negrito">Categoria:</div></td>
									<td><select name="categoria" id="select">
									
									<?php $sql = "select * from tblcategoria";
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
									<td><div class="negrito">SubCategoria:</div></td>
									<td><select name="subcategoria" id="select">
									
									<?php $sql = "select * from tblsubcategoria";
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
									<td><div class="negrito">Detalhes:</div></td>
									<td><textarea class="textareaSalvar" name="txatdetalhesSalvar" rows="6" cols="29" maxlength="500" ><?php echo($detalhe); ?></textarea></td>
								</tr>
								<tr>
									<td><div class="negrito">Preço:</div></td>
									<td><input class="camposSalvar" name="txtpreco" type="text" placeholder="Digite o Preço" required value="<?php echo($preco); ?>"></td>
								</tr>
								<tr>
									<td><input class="butao" type="submit" name="btnSalvar" value="<?php echo($botao);?>"></td>
									<td><input class="butao" type="submit" name="btnLimpar" value="Limpar"></td>
								</tr>
							</table>
					</form>
					
				</div>
				
				<div id="definirPromocao">
					<form name="salvarPromocao" method="get" action="admproduto.php">
						<table>
						
							<tr>
								<td>Desconto:</td>
								<td><input class="camposSalvarMenor" name="txtdesconto" type="text" placeholder="Digite o Desconto" required></td>
								<td><input class="butao" type="submit" name="btnSalvarDesconto" value="Salvar"></td>
								<td><?php 					
									echo($_SESSION['descontoS']."%");
									?>
								</td>
							</tr>
						
						</table>
					</form>
				</div>

					<div id="consultaFilme">
						<div class="titulo">Consulta de Produtos</div>

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
									Preco: <?php echo($rs['preco'] - $rs['totalDesc']."R$");?><p></p>
									Categoria: <?php echo($rs['categoria']);?>
									SubCategoria: <?php echo($rs['subcategoria']);?>
								</div>

								<div class="opcao">
								
									<table >
									
										<tr>
											<td class="nomeOp">
												Promoção
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
												<a href="admproduto.php?modo=promocao&id=<?php echo($rs['id'])?>"><img class="img" src="<?php   if($rs['promocao'] == 0){
											
				$img = "imagem/alert1.png";
			
			}elseif($rs['promocao'] == 1){
		   
				$img = "imagem/alert.png";
		   
			}
			echo($img);?>"></a>
											</td>
											<td class="imagensOp">
												<a href="admproduto.php?modo=editar&id=<?php echo($rs['id'])?>"><img class="img" src="imagem/ed1.jpg"></a>
											</td>
											<td class="imagensOp">
												<a href="admproduto.php?modo=excluir&id=<?php echo($rs['id'])?>"><img class="img" src="imagem/d1.jpg"> </a>
											</td>
										</tr>
									
									</table>
								
								</div>

							</div>
						<?php
							}

						?>
					</div>
					
					<div id="cat">

						<div id="cadastroCategoria">
						
							<div class="titulo">Cadastro de Categoria</div>
						
							<form name="salvar" method="post" enctype="multipart/form-data" action="admproduto.php">
								<table>							
									<tr>
										<td><div class="negrito">Nome:</div></td>
										<td><input class="camposSalvarMenor" name="txtnomeCategoria" type="text" placeholder="Digite o nome" required value="<?php echo($nomeCat); ?>"></td>
									</tr>								
									<tr>
										<td><input class="butao" type="submit" name="btnSalvarCategoria" value="<?php echo($botaoCat);?>"></td>
										<td><input class="butao" type="submit" name="btnLimpar" value="Limpar"></td>
									</tr>
								</table>
							</form>
						</div>
						
						<div id="consultaCategoria">
						
							<div class="titulo">Consulta de Categoria</div>
							
							<table>
								<tr>
									<td class="tabelaConsulta">Id</td>	
									<td class="tabelaConsulta">Categoria</td>		
									<td class="tabelaConsulta">Opcoes</td>
								</tr>
							</table>
						
							<?php
								$sql = "select * from tblcategoria";
								
								$select = mysql_query($sql);
								
								while($rs = mysql_fetch_array($select)){
									
							?>
							<div class="consulcat">
								<table>
									<tr>
										<td class="tabelaConsulta"><?php echo($rs['id']);?></td>
										<td class="tabelaConsulta"><?php echo($rs['nome']);?></td>
										
										<td class="tabelaConsulta">
											<a href="admproduto.php?modo=editarCat&id=<?php echo($rs['id'])?>">editar</a>
											<a href="admproduto.php?modo=excluirCat&id=<?php echo($rs['id'])?>">excluir </a>								
										</td>
										
									</tr>
								</table>
							</div>
							<?php
								}
							?>
							
						</div>
					
					</div>
					
					<div id="subCat">
					
						<div id="cadastroCategoria">
						
							<div class="titulo">Cadastro de SubCategoria</div>
						
							<form name="salvar" method="post" enctype="multipart/form-data" action="admproduto.php">
								<table>							
									<tr>
										<td><div class="negrito">Nome:</div></td>										
										<td><input class="camposSalvarMenor" name="txtnomeSubCategoria" type="text" placeholder="Digite o nome" required value="<?php echo($nomesubCat); ?>"></td>									
									</tr>
									<tr>
										<td><div class="negrito">Pertence a Categoria:</div></td>
										<td><select name="SubCategoria" id="select">
										
										<?php $sql = "select * from tblcategoria";
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
										<td><input class="butao" type="submit" name="btnSalvarSubCategoria" value="<?php echo($botaosubCat);?>"></td>
										<td><input class="butao" type="submit" name="btnLimpar" value="Limpar"></td>
									</tr>
								</table>
							</form>
						</div>
					
						<div id="consultaCategoria">
						
							<div class="titulo">Consulta de SubCategoria</div>
							
							<table>
								<tr>
									<td class="tabelaConsulta">SubCategoria</td>
									<td class="tabelaConsulta">Categoria</td>		
									<td class="tabelaConsulta">Opcoes</td>
								</tr>
							</table>
						
							<?php
								$sql = "select * from tblsubcategoria";
								
								$select = mysql_query($sql);
								
								while($rs = mysql_fetch_array($select)){
									
							?>
							<div class="consulcat">
								<table>
									<tr>
										<td class="tabelaConsulta"><?php echo($rs['nome']);?></td>
										<td class="tabelaConsulta"><?php echo($rs['categoria']);?></td>
										
										<td class="tabelaConsulta">
											<a href="admproduto.php?modo=editarSubCat&id=<?php echo($rs['id'])?>">editar</a>
											<a href="admproduto.php?modo=excluirSubCat&id=<?php echo($rs['id'])?>">excluir </a>								
										</td>
										
									</tr>
								</table>
							</div>
							<?php
								}
							?>
							
						</div>
					
					</div>
					
			</nav>

			<footer id="footer">
				<span id="">Desenvolvido por : Juan</span>
			</footer>

		</section>

	</body>

</html>