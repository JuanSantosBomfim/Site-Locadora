<?php
	
	mysql_connect('localhost','root','bcd127');
	
	mysql_select_db('dblocadora');
	
	$listaFilmes = array();
	
	$select = mysql_query("SELECT * FROM tblfilme;");
	
	while($rs = mysql_fetch_array($select)){
	
		$listaFilmes [] = array(
			'id'=>$rs["id"],
			'imagem'=>$rs["foto"],
			'nome'=>$rs["nome"],
			'detalhe'=>$rs["detalhe"],
			'preco'=>$rs["preco"]
		);
		
	}
	
	echo json_encode($listaFilmes);

?>