<?php 
$tabela = 'orcamentos';
require_once("../../../conexao.php");

@session_start();
$nivel = @$_SESSION['nivel'];

$id = $_POST['id'];

if($nivel != 'Administrador'){
	$query = $pdo->query("SELECT * FROM $tabela where id = '$id' and status = 'Aprovado'");
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	$total_reg = @count($res);
	if($total_reg > 0){
		echo 'Você não pode excluir uma orçamento Aprovado!';
		exit();
	}
}


$pdo->query("DELETE FROM $tabela where id = '$id'");

echo 'Excluído com Sucesso';


?>