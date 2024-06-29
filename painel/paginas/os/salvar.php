<?php 
$tabela = 'os';
require_once("../../../conexao.php");
@session_start();
$id_usuario = @$_SESSION['id'];

$data_atual = date('Y-m-d');

$data_entrega = $_POST['data_entrega'];
$cliente = @$_POST['cliente'];
//$dias_validade = $_POST['dias_validade'];
$desconto = $_POST['desconto'];
$tipo_desconto = $_POST['tipo_desconto'];
$obs = $_POST['obs'];
$frete = $_POST['frete'];
$frete = str_replace(',', '.', $frete);
$id = $_POST['id'];

$tecnico = $_POST['tecnico'];
$equipamento = @$_POST['equipamento'];
$situacao = @$_POST['situacao'];
$acessorios = @$_POST['acessorios'];
$condicoes = @$_POST['condicoes'];
$laudo = @$_POST['laudo'];

$mao_obra = @$_POST['mao_obra'];
$mao_obra = str_replace(',', '.', $mao_obra);


$laboratorio = @$_POST['laboratorio'];
$pedido = @$_POST['pedido'];
$doutor = @$_POST['doutor'];

$longe1 = @$_POST['longe1'];
$longe2 = @$_POST['longe2'];
$longe3 = @$_POST['longe3'];
$longe4 = @$_POST['longe4'];
$longe5 = @$_POST['longe5'];
$longe6 = @$_POST['longe6'];
$longe7 = @$_POST['longe7'];
$longe8 = @$_POST['longe8'];
$longe9 = @$_POST['longe9'];
$longe10 = @$_POST['longe10'];
$longe11 = @$_POST['longe11'];
$longe12 = @$_POST['longe12'];

$perto1 = @$_POST['perto1'];
$perto2 = @$_POST['perto2'];
$perto3 = @$_POST['perto3'];
$perto4 = @$_POST['perto4'];
$perto5 = @$_POST['perto5'];
$perto6 = @$_POST['perto6'];
$perto7 = @$_POST['perto7'];
$perto8 = @$_POST['perto8'];

$lente = @$_POST['lente'];
$cotico = @$_POST['cotico'];
$altura = @$_POST['altura'];
$cor = @$_POST['cor'];
$retificacao = @$_POST['retificacao'];

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


$query = $pdo->query("SELECT * from os where id = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$status = @$res[0]['status'];

if($status == 'Aberta' and $tecnico > 0){
	$status = 'Iniciada';
}

$total_produtos = 0;
$query = $pdo->query("SELECT * from produtos_orc where funcionario = '$id_usuario' and os = '$id_orc'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$produtos = @count($res);
	if($produtos > 0){
		for($i=0; $i<$produtos; $i++){
		$total = $res[$i]['total'];
		$total_produtos += $total;
	}
}


$total_servicos = 0;
$query = $pdo->query("SELECT * from servicos_orc where funcionario = '$id_usuario' and os = '$id_orc'");
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
if($total_final <= 0){
	echo 'Você precisa adicionar itens a OS!';
	exit();
}

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



if($id == ""){
	$query = $pdo->prepare("INSERT INTO $tabela SET data = curDate(), cliente = '$cliente', data_entrega = '$data_entrega', valor = '$total_final', desconto = '$desconto', tipo_desconto = '$tipo_desconto', subtotal = '$total_com_desconto', funcionario = '$id_usuario', status = 'Iniciada', total_produtos = '$total_produtos', total_servicos = '$total_servicos', obs = :obs, frete = :frete, mao_obra = '$mao_obra', tecnico = '$tecnico', equipamento = :equipamento, situacao = :situacao, acessorios = :acessorios, condicoes = :condicoes, laudo = :laudo, laboratorio = :laboratorio, pedido = :pedido, doutor = :doutor, longe1 = :longe1, longe2 = :longe2, longe3 = :longe3, longe4 = :longe4, longe5 = :longe5, longe6 = :longe6, longe7 = :longe7, longe8 = :longe8, longe9 = :longe9, longe10 = :longe10, longe11 = :longe11, longe12 = :longe12, perto1 = :perto1, perto2 = :perto2, perto3 = :perto3, perto4 = :perto4, perto5 = :perto5, perto6 = :perto6, perto7 = :perto7, perto8 = :perto8,lente = :lente,cotico = :cotico,altura = :altura,cor = :cor = :cor,retificacao = :retificacao");

}else{
	$query = $pdo->prepare("UPDATE $tabela SET cliente = '$cliente', data_entrega = '$data_entrega', valor = '$total_final', desconto = '$desconto', tipo_desconto = '$tipo_desconto', subtotal = '$total_com_desconto', funcionario = '$id_usuario',  total_produtos = '$total_produtos', total_servicos = '$total_servicos', obs = :obs, frete = :frete, mao_obra = '$mao_obra', tecnico = '$tecnico', equipamento = :equipamento, situacao = :situacao, acessorios = :acessorios, condicoes = :condicoes, laudo = :laudo, status = '$status', laboratorio = :laboratorio, pedido = :pedido, doutor = :doutor, longe1 = :longe1, longe2 = :longe2, longe3 = :longe3, longe4 = :longe4, longe5 = :longe5, longe6 = :longe6, longe7 = :longe7, longe8 = :longe8, longe9 = :longe9, longe10 = :longe10, longe11 = :longe11, longe12 = :longe12, perto1 = :perto1, perto2 = :perto2, perto3 = :perto3, perto4 = :perto4, perto5 = :perto5, perto6 = :perto6, perto7 = :perto7, perto8 = :perto8,lente = :lente,cotico = :cotico,altura = :altura,cor = :cor,retificacao = :retificacao where id = '$id'");
	
}

$query->bindValue(":obs", "$obs");
$query->bindValue(":frete", "$frete");
$query->bindValue(":equipamento", "$equipamento");
$query->bindValue(":situacao", "$situacao");
$query->bindValue(":acessorios", "$acessorios");
$query->bindValue(":condicoes", "$condicoes");
$query->bindValue(":laudo", "$laudo");
$query->bindValue(":laboratorio", "$laboratorio");
$query->bindValue(":pedido", "$pedido");
$query->bindValue(":doutor", "$doutor");

$query->bindValue(":longe1", "$longe1");
$query->bindValue(":longe2", "$longe2");
$query->bindValue(":longe3", "$longe3");
$query->bindValue(":longe4", "$longe4");
$query->bindValue(":longe5", "$longe5");
$query->bindValue(":longe6", "$longe6");
$query->bindValue(":longe7", "$longe7");
$query->bindValue(":longe8", "$longe8");
$query->bindValue(":longe9", "$longe9");
$query->bindValue(":longe10", "$longe10");
$query->bindValue(":longe11", "$longe11");
$query->bindValue(":longe12", "$longe12");

$query->bindValue(":perto1", "$perto1");
$query->bindValue(":perto2", "$perto2");
$query->bindValue(":perto3", "$perto3");
$query->bindValue(":perto4", "$perto4");
$query->bindValue(":perto5", "$perto5");
$query->bindValue(":perto6", "$perto6");
$query->bindValue(":perto7", "$perto7");
$query->bindValue(":perto8", "$perto8");

$query->bindValue("lente","$lente");
$query->bindValue("cotico","$cotico");
$query->bindValue("altura","$altura");
$query->bindValue("cor","$cor");
$query->bindValue("retificacao","$retificacao");

$query->execute();

if($id == ""){
$id_orcamento = $pdo->lastInsertId();
	$pdo->query("UPDATE produtos_orc SET os = '$id_orcamento' WHERE os = 0 and funcionario = '$id_usuario'");
	$pdo->query("UPDATE servicos_orc SET os = '$id_orcamento', cliente = '$cliente', data = curDate() WHERE os = 0 and funcionario = '$id_usuario'");
}else{
	$id_orcamento = $id;
	$pdo->query("UPDATE servicos_orc SET cliente = '$cliente' WHERE os = '$id'");
}

echo 'Salvo com Sucesso-'.$id_orcamento; 



//api whats
if($api_whatsapp == 'Sim'){
	$query = $pdo->query("SELECT * from clientes where id = '$cliente' ");
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	$telefone = $res[0]['telefone'];
	$nome_cliente = $res[0]['nome'];

	$telefone_envio = '55'.preg_replace('/[ ()-]+/' , '' , $telefone);

	$mensagem = '*'.mb_strtoupper($nome_sistema).'* %0A';

	if($id == ""){
		$mensagem .= '_Nova OS / Receita_ %0A';
	}else{
		$mensagem .= '_OS / Receita Editada_ %0A';
	}
	
		$mensagem .= 'Nome: *'.$nome_cliente.'* %0A';
		$mensagem .= 'Previsão de Entrega: *'.$data_entregaF.'* %0A';
		
		$mensagem .= '_Segue abaixo o PDF com o Detalhamento_ %0A';

	require('../../../apis/api_texto.php');
}	


//enviar ao técnico a notificação de nova OS
if($api_whatsapp == 'Sim' and $tecnico > 0){

		$query = $pdo->query("SELECT * from usuarios where id = '$tecnico' ");
		$res = $query->fetchAll(PDO::FETCH_ASSOC);
		$telefone_tec = $res[0]['telefone'];
		$nome_tecnico = $res[0]['nome'];

		$telefone_envio = '55'.preg_replace('/[ ()-]+/' , '' , $telefone_tec);

		$mensagem = '*'.mb_strtoupper($nome_sistema).'* %0A';
		$mensagem .= '_Nova Ordem de Serviço Nº '.$id_orcamento.'_ %0A%0A';
		$mensagem .= 'Vendedor: *'.$nome_tecnico.'* %0A';
		$mensagem .= 'Nome: *'.$nome_cliente.'* %0A';
		$mensagem .= 'Previsão de Entrega: *'.$data_entregaF.'* %0A';
		$mensagem .= 'Equipamento: *'.$equipamento.'* %0A';
		$mensagem .= 'Serviço: *'.$situacao.'* %0A';

		require('../../../apis/api_texto.php');
}

if($id == ""){
//inserir nova conta
$pdo->query("INSERT INTO receber SET descricao = 'Novo Serviço', valor = '$total_final', data_venc = '$data_entrega', data_lanc = curDate(), usuario_lanc = '$id_usuario', arquivo = 'sem-foto.png', pago = 'Não', cliente = '$cliente', referencia = 'Serviço', hora = curTime(),  id_ref = '$id_orcamento'");
}

?>