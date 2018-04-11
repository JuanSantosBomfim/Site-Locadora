<?php 

function cms(){
	
	$conexao = mysql_connect('localhost','root','bcd127');
	
	mysql_select_db('dblocadora');
	
	session_start();
	
	// Verifica se não há a variável da sessão que identifica o usuário
    if (!isset($_SESSION['UsuarioID'])) {
        //Destrói a sessão por segurança
		session_destroy();
        //Redireciona o visitante de volta pro login
		header('location: ..\index.php');
		exit;	
	
   }
   
   if(isset($_GET['modo'])){
		
		$modo = $_GET['modo'];
		
		if($modo == 'sair'){
			
			//Destrói a sessão por segurança
			session_destroy();
			//Redireciona o visitante de volta pro login
			header('location: ..\index.php');
			exit;
			
		}
		
	}
	
}

function usuarioB(){
	
	$conexao = mysql_connect('localhost','root','bcd127');
	
	mysql_select_db('dblocadora');
	
	session_start();
	
	
	if(isset($_GET['btnlogin'])){
		
		$nome = $_GET['txtnome'];
		$senha = $_GET['txtsenha'];
		
		//Verifica se os campos estão vazios
		if(empty($nome) or empty($senha)){?>

			<script>
			
				alert("Preencha Todos os campos!");
				
			</script>
			
			<?php
		}else{	
			// Validação do usuário/senha digitados
			$sql = "SELECT * FROM tblusuario where (nome = '".$nome."') and (senha = '".$senha."') ";
			
			//executa o comando mysql
			$query = mysql_query($sql);
			
			if(mysql_num_rows($query) != 1){
			// Mensagem de erro quando os dados são inválidos e/ou o usuário não foi encontrado?>
				
				<script>
				
					alert("Usuario ou Senha Invalido!");
				
				</script>
				<?php
				
			}else{
				// Salva os dados encontados na variável $resultado
				$resultado = mysql_fetch_assoc($query);
				
				// Se a sessão não existir, inicia uma
				if(!isset($_SESSION))session_start();
				
				// Salva os dados encontrados na sessão
				$_SESSION['UsuarioID'] = $resultado['id'];
				$_SESSION['UsuarioNome'] = $resultado['nome'];
				$_SESSION['UsuarioNivel'] = $resultado['nivel'];
				
				// Redireciona o visitante
				header('location:cms/admconteudo.php');
				exit;
				
			}
		}
		
	}
	
}

function itens(){
	
	?>
	<div id="caixaFlutuanteP">
		<div id="caixaFlutuante1">
			
		</div>
		<div id="caixaFlutuante2">
			
		</div>
		<div id="caixaFlutuante3">
			
		</div>
	</div>
	<div id="itens">
		<?php
		
			$sql0="select * from tblcategoria";
			
			$select0 = mysql_query($sql0);
			
			while($linha = mysql_fetch_array($select0)){
		
		?>
			<div class="itensConteudo">
				<ul class="menu">
					<li><a href="index.php?modo=pesquisaCat&id=<?php echo($linha['id'])?>"><?php echo($linha['nome']);?></a>
						<ul class="subMenu">
							<?php
								$sql="select * from tblsubcategoria where categoria=".$linha['id'];
			
								$select = mysql_query($sql);
								
								while($rs = mysql_fetch_array($select)){
							?>

									<li><a href="index.php?modo=pesquisaSub&id=<?php echo($rs['id'])?>"><?php echo($rs['nome']);?></a></li>
							
							<?php
								}
							?>
						</ul>
					</li>									
				</ul>
			</div>
			
		<?php
		
			}
		
		?>
		</div>
	
	<?php
	
}

function mostrarFilmes(){
	
	?>
	
	<?php
	
		if(isset($_GET['modo'])){
			
			$modo = $_GET['modo'];
			$id = $_GET['id'];
			
			if($modo == "pesquisaCat"){
				
				$sql = "SELECT f.*, c.nome as Cat, s.nome as Sub FROM tblfilme AS f
				INNER JOIN tblcategoria AS c 
				ON f.categoria = c.id 
				INNER JOIN tblsubcategoria AS s
				ON f.subcategoria = s.id 
				WHERE f.categoria =".$id;
				
				$select = mysql_query($sql);
		
				while($rs = mysql_fetch_array($select)){
					
					?>
						<div class="caixasProdutos">
							<div class="conteudoProdutos">
								<img class="conteudoProdutos" src="<?php echo("cms/".$rs['foto']); ?>" alt="foto1" >
							</div>					
							<div class="detalhesProdutos">						
								<p><?php echo("Filme: ".$rs['nome']); ?></p>											
								<p><?php echo("Categoria: ".$rs['Cat']); ?></p>
								<p><?php echo("Sub Categoria: ".$rs['Sub']); ?></p>
								<p><?php echo("Preco: ".$rs['preco']." R$"); ?></p>
								<p class="detalhes">Detalhes</p>
							</div>
						</div>
					<?php
				}
				
			}elseif($modo == "pesquisaSub"){
				
				$sql = "SELECT f.*, c.nome as Cat, s.nome as Sub FROM tblfilme AS f
				INNER JOIN tblcategoria AS c 
				ON f.categoria = c.id 
				INNER JOIN tblsubcategoria AS s
				ON f.subcategoria = s.id 
				WHERE f.subcategoria =".$id;
				
				$select = mysql_query($sql);
		
				while($rs = mysql_fetch_array($select)){
					
					?>
						<div class="caixasProdutos">
							<div class="conteudoProdutos">
								<img class="conteudoProdutos" src="<?php echo("cms/".$rs['foto']); ?>" alt="foto1" >
							</div>					
							<div class="detalhesProdutos">						
								<p><?php echo("Filme: ".$rs['nome']); ?></p>
								<p><?php echo("Categoria: ".$rs['Cat']); ?></p>
								<p><?php echo("Sub Categoria: ".$rs['Sub']); ?></p>
								<p><?php echo("Preco: ".$rs['preco']." R$"); ?></p>
								<p class="detalhes">Detalhes</p>
							</div>
						</div>
					<?php
				}
			}
			
		}else{
			
			$sql = "SELECT f.*, c.nome as Cat, s.nome as Sub FROM tblfilme AS f
				INNER JOIN tblcategoria AS c 
				ON f.categoria = c.id 
				INNER JOIN tblsubcategoria AS s
				ON f.subcategoria = s.id";
				
				$select = mysql_query($sql);
		
				while($rs = mysql_fetch_array($select)){
					
					?>
						<div class="caixasProdutos">
							<div class="conteudoProdutos">
								<img class="conteudoProdutos" src="<?php echo("cms/".$rs['foto']); ?>" alt="foto1" >
							</div>					
							<div class="detalhesProdutos">						
								<p><?php echo("Filme: ".$rs['nome']); ?></p>
								<p><?php echo("Categoria: ".$rs['Cat']); ?></p>
								<p><?php echo("Sub Categoria: ".$rs['Sub']); ?></p>
								<p><?php echo("Preco: ".$rs['preco']." R$"); ?></p>
								<p class="detalhes">Detalhes</p>
							</div>
						</div>
					<?php
				}
			
		}
		
	
	?>
	
	<?php
	
}

function menuResponsivo(){
	?>
	<ul>
		<li>
			<img src="imagem/menu_mobile.jpg"> 
			<ul class="lstmenu">
				<li><A href="index.php">Home</A></li>
				<li><A href="pg3.php">Promoções</A></li>					
				<li>Destaque
					<ul class="lstsubmenu">
						<li><A href="pg2.php">Filmes em Destaque</A></li>
						<li><A href="pg4.php">Atores em Destaque</A></li>
					</ul>
				</li>					
				<li><A href="pg5.php">Nossas Lojas</A></li>					
			</ul>
		</li>
	</ul>
	<?php
}

function mobileFlutuante(){
	
	?>
	<div id="caixaFlutuante">
		<div id="caixaFlutuante01">
			
		</div>
		<div id="caixaFlutuante02">
			
		</div>
		<div id="caixaFlutuante03">
			
		</div>
	</div>
	<?php
}

?>