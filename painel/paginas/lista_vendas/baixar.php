<?php 
$tabela = 'receber';
require_once("../../../conexao.php");
@session_start();
$id_usuario = $_SESSION['id'];

$data_hoje = date('Y-m-d');

$id = $_POST['id-baixar'];
$data_atual = date('Y-m-d');
	$dia = date('d');
	$mes = date('m');
	$ano = date('Y');

$valor = $_POST['valor-baixar'];
$valor = str_replace(',', '.', $valor);

$subtotal = $_POST['subtotal'];
$subtotal = str_replace(',', '.', $subtotal);

$saida = $_POST['saida-baixar'];
$data_baixar = $_POST['data-baixar'];
$vendedor = $_POST['vendedor'];

$query = $pdo->query("SELECT * FROM $tabela where id = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);

$descricao = $res[0]['descricao'];
$cliente = $res[0]['cliente'];
$valor_antigo = $res[0]['valor'];
$data_lanc = $res[0]['data_lanc'];
$data_venc = $res[0]['data_venc'];
$data_pgto = $res[0]['data_pgto'];
$usuario_lanc = $res[0]['usuario_lanc'];
$usuario_pgto = $res[0]['usuario_pgto'];
$frequencia = $res[0]['frequencia'];
$saida_antiga = $res[0]['saida'];
$arquivo = $res[0]['arquivo'];
$pago = $res[0]['pago'];


$query = $pdo->query("SELECT * FROM pagar where referencia = 'Comissão' and id_ref='$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) == 0){
//lançar a comissão do vendedor
	if($vendedor > 0 and $comissao_venda > 0){
		$query = $pdo->query("SELECT * from usuarios where id = '$vendedor' ");
			$res = $query->fetchAll(PDO::FETCH_ASSOC);
			$comissao_tec = $res[0]['comissao'];
			
			if($comissao_tec > 0){
				$comissao = $comissao_tec;
			}else{
				$comissao = $comissao_venda;
			}

			$total_comissao = ($valor_antigo * $comissao) / 100;
			$data_venc = date('Y/m/d', strtotime("+$dias_comissao days",strtotime($data_hoje)));

			$pdo->query("INSERT INTO pagar SET descricao = 'Comissão Venda', funcionario = '$vendedor', valor = '$total_comissao', data_venc = '$data_venc', frequencia = '0', data_lanc = curDate(), usuario_lanc = '$id_usuario', arquivo = 'sem-foto.png', pago = 'Não', referencia = 'Comissão', id_ref='$id'");


	}
	$pdo->query("UPDATE $tabela set vendedor = '$vendedor' where id = '$id'");
}


if($valor > $valor_antigo){
	echo 'O valor a ser pago não pode ser superior ao valor da conta! O valor da conta é de R$ '.$valor_antigo;
	exit();
}

if($valor <= 0){
	echo 'O precisa ser maior que 0 ';
	exit();
}



if($valor == $valor_antigo){

	$pdo->query("UPDATE $tabela set saida = '$saida', usuario_pgto = '$id_usuario', pago = 'Sim', valor = '$subtotal', data_pgto = '$data_baixar' where id = '$id'");

	//CRIAR A PRÓXIMA CONTA A PAGAR
	$dias_frequencia = $frequencia;

	if($dias_frequencia == 30 || $dias_frequencia == 31){		
		$nova_data_vencimento = date('Y/m/d', strtotime("+1 month",strtotime($data_venc)));

	}else if($dias_frequencia == 90){
		$nova_data_vencimento = date('Y/m/d', strtotime("+3 month",strtotime($data_venc)));

	}else if($dias_frequencia == 180){ 
		$nova_data_vencimento = date('Y/m/d', strtotime("+6 month",strtotime($data_venc)));

	}else if($dias_frequencia == 360 || $dias_frequencia == 365){
		$nova_data_vencimento = date('Y/m/d', strtotime("+1 year",strtotime($data_venc)));

	}else{		
		$nova_data_vencimento = date('Y/m/d', strtotime("+$dias_frequencia days",strtotime($data_venc))); 
	}


	if(@$dias_frequencia > 0){
		$pdo->query("INSERT INTO $tabela set descricao = '$descricao', cliente = '$cliente', valor = '$valor_antigo', data_lanc = curDate(), data_venc = '$nova_data_vencimento', frequencia = '$frequencia', saida = '$saida_antiga', arquivo = '$arquivo', pago = 'Não'");
				$id_ult_registro = $pdo->lastInsertId();				
	}

	

}else{

	$descricao = '(Resíduo) ' .$descricao;
	//PEGAR RESIDUOS DA CONTA
	$total_resid = 0;
	$query = $pdo->query("SELECT * FROM valor_parcial WHERE id_conta = '$id' and tipo = 'Receber'");
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	if(@count($res) > 0){
	
		for($i=0; $i < @count($res); $i++){
		foreach ($res[$i] as $key => $value){} 
			$valor_resid = $res[$i]['valor'];
			$total_resid += $valor_resid;
		}
	}

	 $valor_antigo = $valor_antigo - $subtotal;

	$pdo->query("INSERT INTO valor_parcial set id_conta = '$id', tipo = 'Receber', valor = '$subtotal', data = curDate(), usuario = '$id_usuario'");

	$pdo->query("UPDATE $tabela set saida = '$saida', usuario_pgto = '$id_usuario', valor = '$valor_antigo', data_pgto = curDate() where id = '$id'");

	$pdo->query("INSERT INTO $tabela SET descricao = 'Valor baixado',valor_entrada = '0', valor = '$subtotal', data_venc = curDate(), data_lanc = curDate(), data_pgto = curDate(), usuario_lanc = '$id_usuario', usuario_pgto = '$id_usuario', saida = '$saida', vendedor = '$vendedor', arquivo = 'sem-foto.png', pago = 'Sim', cliente = '$cliente', referencia = 'Venda', hora = curTime(), desconto = '0', id_ref = '$id'");

}

echo 'Baixado com Sucesso';

?>

