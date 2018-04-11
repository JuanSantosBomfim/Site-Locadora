<?php

	$conexao = mysql_connect('localhost','root','bcd127');
	
	mysql_select_db('dblocadora');
	
	session_start();
	
	$nome = "";
	$senha = "";
	$nivel = "";
	$botao="Salvar";
      
    // Verifica se não há a variável da sessão que identifica o usuário
    if (!isset($_SESSION['UsuarioID'])) {
        // Destrói a sessão por segurança
       session_destroy();
        // Redireciona o visitante de volta pro login
       header('location: pg1.php'); 
		exit;
    }
	
	
	if(isset($_GET['modo'])){
		
		$modo = $_GET['modo'];
		
		if($modo == 'excluir'){
			
			$id = $_GET['id'];
			
			$sql = "delete from tblusuario where id =".$id;
			
			mysql_query($sql);
			
		}elseif($modo == 'editar'){
			
			$id = $_GET['id'];
			
			$_SESSION['idItem'] = $id;
			
			$sql = "select * from tblusuario where id=".$id;
			
			$select = mysql_query($sql);
			
			$rs = mysql_fetch_array($select);
			
			$nome = $rs['nome'];
			$senha = $rs['senha'];
			$nivel = $rs['nivel'];
			
			$botao = "Atualizar";
			
		}
		
	}
	
	//Cadastro de usuarios
	if(isset($_GET['btnCadastrar'])){
		
		$nome = $_GET['txtnome'];
		$senha = $_GET['txtsenha'];
		$nivel = $_GET['txtnivel'];
		
		if($_GET['btnCadastrar'] == "Salvar"){
			
			$sql = "insert into tblusuario(nome,senha,nivel) 
			values('".$nome."','".$senha."','".$nivel."')";
			
		}elseif($_GET['btnCadastrar'] =="Atualizar"){
			
			$sql = "update tblusuario set nome='".$nome."',senha='".$senha."',nivel='".$nivel."' where id=".$_SESSION['idItem'];
			
		}
		mysql_query($sql);
		
		header('location:pg1.php');
		
	}
	
	if(isset($_GET['btnLimpar'])){
		
		header('location:pg1.php');
		
	}
	

?>

<script>

function Mostra(el) {
	var display = document.getElementById(el).style.display;
	if(display == "block")
		document.getElementById(el).style.display = 'none';
	else
        document.getElementById(el).style.display = 'block';
}

</script>
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
						<div class="caixasOpcoes" onclick="Mostra('admConteudo')">
							<div class="imagem">
								<img src="imagem/2.png" height="130px" width="130px">
							</div>
							<div class="detalhes">
								Adm.Conteudo
							</div>
						</div>
						<div class="caixasOpcoes">
							<div class="imagem">
								<img src="imagem/3.png" height="130px" width="130px">
							</div>
							<div class="detalhes">
								Adm.Fale Conosco
							</div>
						</div>
						<div class="caixasOpcoes">
							<div class="imagem">
								<img src="imagem/4.png" height="130px" width="130px">
							</div>
							<div class="detalhes">
								Adm.Produtos
							</div>
						</div>
						<div class="caixasOpcoes" onclick="Mostra('admUsuarios')">
							<div class="imagem">
								<img src="imagem/5.png" height="130px" width="130px">
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
							Logout
						</div>
					</div>
				</div>
			
			</header>
			
			<nav id="nav">				
				<div id="admUsuarios">
					<div id = "cadastroUsuario">
					
						<div class ="titulo">Cadastro de Usuarios</div>
						
						<form name="cadastro" method="get" action="pg1.php">
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
									<td><select id="select">
									
										<option value =""></option>
										
									</select></td>															
								</tr>						
								<tr>
									<td><input class="butao" type="submit" name="btnCadastrar" value="<?php echo($botao);?>"></td>
									<td><input class="butao" type="submit" name="btnLimpar" value="Limpar"></td>
								</tr>							
							</table>
						</form>
					</div>
					
					<div id = "cadastroNivel">
					
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
							
								$sql = "select * from tblusuario order by id desc";
								
								$select = mysql_query($sql);
								
								while($rs = mysql_fetch_array($select)){
									
							?>
							
							<tr>
								<td class="tabelaConsulta"><?php echo($rs['id']);?></td>
								<td class="tabelaConsulta"><?php echo($rs['nome']);?></td>
								<td class="tabelaConsulta"><?php echo($rs['senha']);?></td>
								<td class="tabelaConsulta"><?php echo($rs['nivel']);?></td>
								
								<td class="tabelaConsulta">
									<a href="pg1.php?modo=editar&id=<?php echo($rs['id'])?>"><img class="img" src="imagem/e1.png"></a>
									<a href="pg1.php?modo=excluir&id=<?php echo($rs['id'])?>"><img class="img" src="imagem/d1.png"> </a>								
								</td>
								
							</tr>
							
							<?php
								}
							
							?>
						</table>
					</div>
				</div>
			</nav>
			
			<footer id="footer">
				<span id="">Desenvolvido por : Juan</span>
			</footer>
		
		</section>
	
	</body>
	
</html>