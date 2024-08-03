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
$saida = $_POST['saida'];
$vendedor = $_POST['vendedor'];
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
	$query = $pdo->prepare("INSERT INTO $tabela SET data = curDate(), valor_entrada = '$valor_entrada', saida = '$saida', vendedor = '$vendedor', cliente = '$cliente', data_entrega = '$data_entrega', valor = '$total_final', desconto = '$desconto', tipo_desconto = '$tipo_desconto', subtotal = '$total_com_desconto', funcionario = '$id_usuario', status = 'Aprovado', total_produtos = '$total_produtos', total_servicos = '$total_servicos', obs = :obs, frete = :frete");

}else{
	// $query = $pdo->prepare("UPDATE $tabela SET cliente = '$cliente', data_entrega = '$data_entrega', dias_validade = '$dias_validade', valor = '$total_final', desconto = '$desconto', tipo_desconto = '$tipo_desconto', subtotal = '$total_com_desconto', funcionario = '$id_usuario',  total_produtos = '$total_produtos', total_servicos = '$total_servicos', obs = :obs, frete = :frete where id = '$id'");
	$query = $pdo->prepare("UPDATE $tabela SET valor_entrada = '$valor_entrada', saida = '$saida', vendedor = '$vendedor',  cliente = '$cliente', data_entrega = '$data_entrega', valor = '$total_final', desconto = '$desconto', tipo_desconto = '$tipo_desconto', subtotal = '$total_com_desconto', funcionario = '$id_usuario',  total_produtos = '$total_produtos', total_servicos = '$total_servicos', obs = :obs, frete = :frete where id = '$id'");

	
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

//BAIXAR;
if ($valor_entrada != 0){
	$pdo->query("INSERT INTO receber SET descricao = 'Valor de entrada',valor_entrada = '$valor_entrada', valor = '$valor_entrada', data_venc = curDate(), data_lanc = curDate(), data_pgto = curDate(), usuario_lanc = '$id_usuario', usuario_pgto = '$id_usuario', saida = '$saida', vendedor = '$vendedor', arquivo = 'sem-foto.png', pago = 'Sim', cliente = '$cliente', referencia = 'Venda', hora = curTime(), desconto = '$desconto', id_ref = '$id'");
	$id_venda = $pdo->lastInsertId();	

	$pdo->query("INSERT INTO receber SET descricao = 'Nova Venda',valor_entrada = '$valor_entrada', valor = '$total_com_desconto', data_venc = curDate(), data_lanc = curDate(), data_pgto = curDate(), usuario_lanc = '$id_usuario', usuario_pgto = '$id_usuario', saida = '$saida', vendedor = '$vendedor', arquivo = 'sem-foto.png', pago = 'Não', cliente = '$cliente', referencia = 'Venda', hora = curTime(), desconto = '$desconto', id_ref = '$id'");
	$id_venda = $pdo->lastInsertId();	

	$query20 = $pdo->query("SELECT id from receber order by id desc limit 1");
	$res20 = $query20->fetchAll(PDO::FETCH_ASSOC);
	$id_conta = $res20[0]['id'];
    $pdo->query("INSERT INTO valor_parcial set id_conta = '$id_conta', tipo = 'Receber', valor = '$valor_entrada', data = curDate(), usuario = '$id_usuario'");
 


}else{  
	$pdo->query("INSERT INTO receber SET descricao = 'Nova Venda',valor_entrada = '$valor_entrada', valor = '$total_com_desconto', data_venc = curDate(), data_lanc = curDate(), data_pgto = curDate(), usuario_lanc = '$id_usuario', usuario_pgto = '$id_usuario', saida = '$saida', vendedor = '$vendedor', arquivo = 'sem-foto.png', pago = 'Sim', cliente = '$cliente', referencia = 'Venda', hora = curTime(), desconto = '$desconto', id_ref = '$id'");
	$id_venda = $pdo->lastInsertId();
	
	// $pdo->query("INSERT INTO receber SET descricao = 'Nova Venda',valor_entrada = '$valor_entrada', valor = '$total_com_desconto', data_venc = curDate(), data_lanc = curDate(), usuario_lanc = '$id_usuario', arquivo = 'sem-foto.png', pago = 'Não', cliente = '$cliente', referencia = 'Venda', hora = curTime(), desconto = '$desconto', id_ref = '$id'");
	// $id_venda = $pdo->lastInsertId();
}
		
		$query2 = $pdo->query("SELECT * from produtos_orc where orcamento = '$id_orcamento'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		$linhas2 = @count($res2);
		for($i=0; $i<$linhas2; $i++){
		$id_pro_orc = $res2[$i]['id'];
		$id_produto = $res2[$i]['produto'];
		$quantidade = $res2[$i]['quantidade'];
		$valor_prod = $res2[$i]['valor'];
		$total_prod = $res2[$i]['total'];

		$pdo->query("INSERT INTO itens_venda SET produto = '$id_produto', valor = '$valor_prod', quantidade = '$quantidade', total = '$total_prod', id_venda = '$id_venda', funcionario = '$id_usuario'");

		$query7 = $pdo->query("SELECT * from produtos where id = '$id_produto'");
		$res7 = $query7->fetchAll(PDO::FETCH_ASSOC);
		$estoque = $res7[0]['estoque'];

		$novo_estoque = $estoque - $quantidade;
		//remove o produto do estoque
		$pdo->query("UPDATE produtos SET estoque = '$novo_estoque' WHERE id = '$id_produto'"); 


	}


//BAIXAR

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