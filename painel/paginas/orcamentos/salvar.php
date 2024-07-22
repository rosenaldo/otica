<?php 
$tabela = 'orcamentos';
require_once("../../../conexao.php");
@session_start();
$id_usuario = @$_SESSION['id'];

$data_atual = date('Y-m-d');

$data_entrega = $_POST['data_entrega'];
$cliente = @$_POST['cliente'];
// $dias_validade = $_POST['dias_validade'];
 $valor_entrada = $_POST['valor_entrada'];
$desconto = $_POST['desconto'];
$tipo_desconto = $_POST['tipo_desconto'];
$obs = $_POST['obs'];
$frete = $_POST['frete'];
$frete = str_replace(',', '.', $frete);
$id = $_POST['id'];

$data_entregaF = implode('/', array_reverse(explode('-', $data_entrega)));

if($cliente == ""){
	echo 'Escolha um Cliente';
	exit();
}

if($id == ""){
	$id_orc = 0;
}else{
	$id_orc = $id;
}


$total_produtos = 0;
if($id == ""){
	$query = $pdo->query("SELECT * from produtos_orc where funcionario = '$id_usuario' and orcamento = '$id_orc'");
}else{
	$query = $pdo->query("SELECT * from produtos_orc where  orcamento = '$id_orc'");
}


$res = $query->fetchAll(PDO::FETCH_ASSOC);
$produtos = @count($res);
	if($produtos > 0){
		for($i=0; $i<$produtos; $i++){
		$total = $res[$i]['total'];
		$total_produtos += $total;
	}
}


$total_servicos = 0;
if($id == ""){
	$query = $pdo->query("SELECT * from servicos_orc where funcionario = '$id_usuario' and orcamento = '$id_orc'");
}else{
	$query = $pdo->query("SELECT * from servicos_orc where  orcamento = '$id_orc'");
}

$res = $query->fetchAll(PDO::FETCH_ASSOC);
$servicos = @count($res);
	if($servicos > 0){
		for($i=0; $i<$servicos; $i++){
		$total = $res[$i]['total'];
		$total_servicos += $total;
	}
}

$total_final = $total_produtos + $total_servicos;
if($total_final <= 0){
	echo 'Você precisa adicionar itens ao orçamento!';
	exit();
}

if($desconto == ""){
	$desconto = 0;
}

if($frete == ""){
	$frete = 0;
}

if ($valor_entrada == ""){
     $valor_entrada = 0;
}

if($tipo_desconto == "%"){
	$total_com_desconto = $total_final - $valor_entrada - ($total_final * $desconto / 100) + $frete;
}else{
	$total_com_desconto = $total_final - $desconto - $valor_entrada + $frete;
}



if($id == ""){
	// $query = $pdo->prepare("INSERT INTO $tabela SET data = curDate(), cliente = '$cliente', data_entrega = '$data_entrega', dias_validade = '$dias_validade', valor = '$total_final', desconto = '$desconto', tipo_desconto = '$tipo_desconto', subtotal = '$total_com_desconto', funcionario = '$id_usuario', status = 'Pendente', total_produtos = '$total_produtos', total_servicos = '$total_servicos', obs = :obs, frete = :frete");
	$query = $pdo->prepare("INSERT INTO $tabela SET data = curDate(), valor_entrada = '$valor_entrada', cliente = '$cliente', data_entrega = '$data_entrega', valor = '$total_final', desconto = '$desconto', tipo_desconto = '$tipo_desconto', subtotal = '$total_com_desconto', funcionario = '$id_usuario', status = 'Pendente', total_produtos = '$total_produtos', total_servicos = '$total_servicos', obs = :obs, frete = :frete");

}else{
	// $query = $pdo->prepare("UPDATE $tabela SET cliente = '$cliente', data_entrega = '$data_entrega', dias_validade = '$dias_validade', valor = '$total_final', desconto = '$desconto', tipo_desconto = '$tipo_desconto', subtotal = '$total_com_desconto', funcionario = '$id_usuario',  total_produtos = '$total_produtos', total_servicos = '$total_servicos', obs = :obs, frete = :frete where id = '$id'");
	$query = $pdo->prepare("UPDATE $tabela SET valor_entrada = '$valor_entrada', cliente = '$cliente', data_entrega = '$data_entrega', valor = '$total_final', desconto = '$desconto', tipo_desconto = '$tipo_desconto', subtotal = '$total_com_desconto', funcionario = '$id_usuario',  total_produtos = '$total_produtos', total_servicos = '$total_servicos', obs = :obs, frete = :frete where id = '$id'");

	
}

$query->bindValue(":obs", "$obs");
$query->bindValue(":frete", "$frete");
$query->execute();

if($id == ""){
$id_orcamento = $pdo->lastInsertId();
	$pdo->query("UPDATE produtos_orc SET orcamento = '$id_orcamento' WHERE orcamento = 0 and funcionario = '$id_usuario'");
	$pdo->query("UPDATE servicos_orc SET orcamento = '$id_orcamento' WHERE orcamento = 0 and funcionario = '$id_usuario'");
}else{
	$id_orcamento = $id;
}

echo 'Salvo com Sucesso-'.$id_orcamento; 



//api whats
if($api_whatsapp == 'Sim'){
	$query = $pdo->query("SELECT * from clientes where id = '$cliente' ");
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	$telefone = $res[0]['telefone'];
	$nome_cliente = $res[0]['nome'];

	$telefone_envio = '55'.preg_replace('/[ ()-]+/' , '' , $telefone);
	if($id == ""){
		$mensagem = '_Novo Orçamento '.$nome_sistema.'_ %0A';
	}else{
		$mensagem = '_Orçamento Editado '.$nome_sistema.'_ %0A';
	}
	
		$mensagem .= 'Nome: *'.$nome_cliente.'* %0A';
		$mensagem .= 'Previsão de Entrega: *'.$data_entregaF.'* %0A';
		// $mensagem .= 'Validade do Orçamento: *'.$dias_validade.' Dias* %0A%0A';

		$mensagem .= '_Segue abaixo o PDF com o Detalhamento_ %0A';

	require('../../../apis/api_texto.php');
}	

?>