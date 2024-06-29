<?php 
$tabela = 'receber';
require_once("../../../conexao.php");

@session_start();
$nivel = @$_SESSION['nivel'];
$id_usuario = @$_SESSION['id'];

$id = $_POST['id'];

if($nivel != 'Administrador'){
	$query = $pdo->query("SELECT * FROM $tabela where id = '$id' and pago = 'Sim'");
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	$total_reg = @count($res);
	if($total_reg > 0){
		echo 'Você não pode excluir uma conta já Paga!';
		exit();
	}
}

$query = $pdo->query("SELECT * FROM $tabela where id = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
$foto = $res[0]['arquivo'];
$pago = $res[0]['pago'];
$valor = $res[0]['valor'];
$cliente = $res[0]['cliente'];
$saida = $res[0]['saida'];

if($foto != "sem-foto.png"){
	@unlink('../../images/contas/'.$foto);
}

//devolver os produtos
$query = $pdo->query("SELECT * from itens_venda where id_venda = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$linhas = @count($res);
if($linhas > 0){
	for($i=0; $i<$linhas; $i++){
	$id_produto = $res[$i]['produto'];
	$quantidade = $res[$i]['quantidade'];	

$query2 = $pdo->query("SELECT * from produtos where id = '$id_produto'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
$estoque = $res2[0]['estoque'];

$novo_estoque = $estoque + $quantidade;
//adicionar os produtos na tabela produtos
$pdo->query("UPDATE produtos SET estoque = '$novo_estoque' WHERE id = '$id_produto'"); 

}
}

if($pago == 'Sim'){
	$pdo->query("UPDATE $tabela SET cancelada = 'Sim' where id = '$id'");
	$pdo->query("INSERT INTO pagar SET descricao = 'Devolução Venda', cliente = '$cliente', valor = '$valor', data_venc = curDate(), data_pgto = curDate(), frequencia = '0', saida = '$saida', data_lanc = curDate(), usuario_lanc = '$id_usuario', usuario_pgto = '$id_usuario', arquivo = 'sem-foto.png', pago = 'Sim', referencia = 'Cancelamento'");
}else{
	$pdo->query("DELETE FROM $tabela where id = '$id'");
}


//excluir a comissão
$pdo->query("DELETE FROM pagar where referencia = 'Comissão' and id_ref = '$id' and descricao = 'Comissão Venda'");


echo 'Excluído com Sucesso';



?>