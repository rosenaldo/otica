<?php 
$tabela = 'produtos_orc';
require_once("../../../conexao.php");

$data_atual = date('Y-m-d');

@session_start();
$id_usuario = @$_SESSION['id'];

$desconto = @$_POST['desconto'];
$tipo_desconto = @$_POST['tipo_desconto'];
$frete = @$_POST['frete'];
$id = @$_POST['id'];
$mao_obra = @$_POST['mao_obra'];

$total_produtos = 0;
if($id == ""){
	$query = $pdo->query("SELECT * from produtos_orc where funcionario = '$id_usuario' and os = '0'");
}else{
	$query = $pdo->query("SELECT * from produtos_orc where os = '$id'");
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
$query = $pdo->query("SELECT * from servicos_orc where funcionario = '$id_usuario' and os = '0'");
}else{
	$query = $pdo->query("SELECT * from servicos_orc where os = '$id'");
}
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$servicos = @count($res);
	if($servicos > 0){
		for($i=0; $i<$servicos; $i++){
		$total = $res[$i]['total'];
		$total_servicos += $total;
	}
}

if($mao_obra == ""){
	$mao_obra = 0;
}


$total_final = $total_produtos + $total_servicos + $mao_obra;

if($desconto == ""){
	$desconto = 0;
}

if($frete == ""){
	$frete = 0;
}


if($tipo_desconto == "%"){
	$total_com_desconto = $total_final - ($total_final * $desconto / 100) + $frete;
}else{
	$total_com_desconto = $total_final - $desconto + $frete;
}

$total_finalF = number_format($total_final, 2, ',', '.');
$total_com_descontoF = number_format($total_com_desconto, 2, ',', '.');

echo $total_finalF.'-'.$total_com_descontoF;

if($id != ""){
	$pdo->query("UPDATE os SET valor = '$total_final', subtotal = '$total_com_desconto', total_produtos = '$total_produtos', total_servicos = '$total_servicos' where id = '$id'");
}

?>


