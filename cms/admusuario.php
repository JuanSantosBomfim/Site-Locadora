<?php

	/*inclui um arquivo externo e não deixa incluir novamente caso ja exista*/
	require_once('funcoes.php');
	//chama a função do arquivo externa
	cms();
	
	//variaveis ultilizadas
	$nome = "";
	$senha = "";
	$nivel = "";
	$botao="Salvar";
      
	//verifica se existe um modo
	if(isset($_GET['modo'])){
		
		$modo = $_GET['modo'];
		
		if($modo == 'excluir'){
			
			$id = $_GET['id'];
			
			$sql = "delete from tblusuario where id =".$id;
			//executa um comando sql
			mysql_query($sql);
			
		}elseif($modo == 'editar'){
			
			$id = $_GET['id'];
			
			$_SESSION['idItem'] = $id;
			
			$sql = "select * from tblusuario where id=".$id;
			//executa um comando sql
			$select = mysql_query($sql);
			
			$rs = mysql_fetch_array($select);
			
			$nome = $rs['nome'];
			$senha = $rs['senha'];
			$nivel = $rs['nivel'];
			
			$botao = "Atualizar";
			
		}
		if($modo == 'excluirNivel'){
			
			$nivel = $_GET['id'];
		
			$sql = "delete from tblnivel where nivel =".$nivel;
			//executa um comando sql
			mysql_query($sql);
			//recarrega a pagina
			header('location:admusuario.php');
			
		}
		
		
		
	}
	
	//Cadastro de usuarios
	if(isset($_GET['btnCadastrar'])){
		
		$nome = $_GET['txtnome'];
		$senha = $_GET['txtsenha'];
		
		$nivel = $_GET['slt'];
			
		if($_GET['btnCadastrar'] == "Salvar"){
			
			$sql = "insert into tblusuario(nivel,nome,senha) 
			values('".$nivel."','".$nome."','".$senha."')";
			
		}elseif($_GET['btnCadastrar'] =="Atualizar"){
			
			$sql = "update tblusuario set nivel='".$nivel."',nome='".$nome."',senha='".$senha."' where id=".$_SESSION['idItem'];
			
		}
		//execulta um comando sql
		mysql_query($sql);
		//recarrega a pagina
		header('location:admusuario.php');
		
	}
	
	if(isset($_GET['btnLimpar'])){
		//recarrega a pagina
		header('location:admusuario.php');
		
	}
	
	if(isset($_GET['btnCadastrarNivel'])){
		
		$nomeNivel = $_GET['txtnomenivel'];
		
		$sql = "insert into tblnivel(nome)
		values('".$nomeNivel."')";
		//execulta um comando sql
		mysql_query($sql);
		//recarrega a pagina
		header('location:admusuario.php');
	}
	

?>

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
							<A href="admusuario.php?modo=sair">Logout</A>
						</div>
					</div>
				</div>
			
			</header>
			
			<nav id="nav">		
				
				<div id="admUsuarios">

					<div id = "cadastroUsuario">
					
						<div class ="titulo">Cadastro de Usuarios</div>
						
						<form name="cadastroUsers" method="get" action="admusuario.php">
							<table>					
								<tr>
									<td><div class="negrito">Id:</div></td>
									<td><input class="campos" name="txtnome" type="text" placeholder="Digite o nome" required value="<?php echo($nome); ?>"></td>
								</tr>
								<tr>
									<td><div class="negrito">Senha:</div></td>
									<td><input class="campos" name="txtsenha" type="text" placeholder="Digite a senha" required value="<?php echo($senha); ?>"></td>
								</tr>
								<tr>
									<td><div class="negrito">Nivel:</div></td>									
									<td><select name="slt" id="select">
									
									<?php $sql = "select * from tblnivel";
										$select = mysql_query($sql);
										
										while($rs = mysql_fetch_array($select)){?>
										
											<option value ="<?php echo($rs['nivel']);  ?>">
												<?php echo($rs['nome']); ?>
											</option>
										
										<?php
										}
										?>
										
									</select></td>															
								</tr>						
								<tr>
									<td><input class="butao" type="submit" name="btnCadastrar" value="<?php echo($botao);?>"></td>
									<td><input class="butao" type="submit" name="btnLimpar" value="Limpar"></td>
								</tr>							
							</table>
						</form>
					</div>
					
					<div id="consultaUsuario">
					
					
						<div class="titulo">Consulta de Usuarios</div>
						
						<table>								
							<tr>
								<td class="tabelaConsulta0">Id</td>
								<td class="tabelaConsulta0">Nome</td>
								<td class="tabelaConsulta0">Senha</td>
								<td class="tabelaConsulta0">Nivel</td>
								<td class="tabelaConsulta0">Opções</td>
							</tr>
							<?php			
								
								$sql = "select u.id,u.nome,u.senha,n.nome as nomenivel from tblusuario as u, tblnivel as n where u.nivel = n.nivel;";													
								
								$select = mysql_query($sql);						
								
								while($rs = mysql_fetch_array($select)){								
									
							?>
							
							<tr>
								<td class="tabelaConsulta"><?php echo($rs['id']);?></td>
								<td class="tabelaConsulta"><?php echo($rs['nome']);?></td>
								<td class="tabelaConsulta"><?php echo($rs['senha']);?></td>
								<td class="tabelaConsulta"><?php echo($rs['nomenivel']);?></td>
								
								<td class="tabelaConsulta">
									<a href="admusuario.php?modo=editar&id=<?php echo($rs['id'])?>"><img class="img" src="imagem/e1.png"></a>
									<a href="admusuario.php?modo=excluir&id=<?php echo($rs['id'])?>"><img class="img" src="imagem/d1.png"> </a>								
								</td>
								
							</tr>
							
							<?php
								}
							
							?>
						</table>
					</div>
					
					<div id = "cadastroNivel">
						<div class ="titulo">Adicionar Novo Nivel</div>
						
						<form name="cadastro" method="get" action="admusuario.php">
							<table>					
								<tr>
									<td><input class="campos" name="txtnomenivel" type="text" placeholder="Digite o Nome do Nivel" required></td>
									<td><input class="butao" type="submit" name="btnCadastrarNivel" value="Add"></td>
								</tr>										
							</table>
						</form>
						
						<div id="consultaNivel">
							<table>								
								<tr>
									<td class="tabelaConsulta1">Nivel</td>
									<td class="tabelaConsulta1">Nome</td>
								</tr>
								<?php
								
									$sql = "select * from tblnivel";
									
									$selectNivel = mysql_query($sql);
									
									while($rs = mysql_fetch_array($selectNivel)){
										
								?>
								
									<tr>
									
										<form name="cadastroNivel" method="get" action="admusuario.php">
									
											<td class="tabelaConsulta"><?php echo($rs['nivel']);?></td>
											<td class="tabelaConsulta"><?php echo($rs['nome']);?></td>														
										
											<td class="tabelaConsulta">
												<a href="admusuario.php?modo=excluirNivel&id=<?php echo($rs['nivel'])?>"><img class="img" src="imagem/d1.png"> </a>						
											</td>
											
										</form>
										
									</tr>
								
								<?php
									}
								
								?>
							</table>
						</div>
						
					</div>
					
					
				</div>
				
			</nav>
			
			<footer id="footer">
				<span id="">Desenvolvido por : Juan</span>
			</footer>
		
		</section>
	
	</body>
	
</html>