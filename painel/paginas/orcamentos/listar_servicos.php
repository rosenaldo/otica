<?php 
$tabela = 'servicos_orc';
require_once("../../../conexao.php");

$data_atual = date('Y-m-d');

@session_start();
$id_usuario = @$_SESSION['id'];

$id = @$_POST['id'];

$total_produtos = 0;
$total_produtosF = 0;

if($id == ""){
	$query = $pdo->query("SELECT * from $tabela where funcionario = '$id_usuario' and orcamento = '0'");
}else{
	$query = $pdo->query("SELECT * from $tabela where orcamento = '$id'");
}
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$linhas = @count($res);
if($linhas > 0){
echo <<<HTML
<small>
	<table class="table table-bordered" id="tabela2">
	<thead> 
	<tr style="background: #e0e0e0"> 
	<th width="40%">Serviço</th>
	<th width="15%">Quantidade</th>	
	<th width="15%">Valor</th>
	<th width="15%">Total</th>
	<th width="15%">Remover</th>					
	</tr> 
	</thead> 
	<tbody>	
HTML;

for($i=0; $i<$linhas; $i++){
	$id = $res[$i]['id'];
	$servico = $res[$i]['servico'];
	$quantidade = $res[$i]['quantidade'];
	$valor = $res[$i]['valor'];
	$total = $res[$i]['total'];
	
	$valorF = number_format($valor, 2, ',', '.');
	$totalF = number_format($total, 2, ',', '.');

	$total_produtos += $total;
	$total_produtosF = number_format($total_produtos, 2, ',', '.');

	$query2 = $pdo->query("SELECT * from servicos where id = '$servico'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
$nome_servico = $res2[0]['nome'];

echo <<<HTML
<tr>
<td >{$nome_servico}</td>
<td ><input type="number" id="quant_servicos_{$id}" value="{$quantidade}" style="border:none; width:45px" onchange="quantidadeServicos({$id})"></td>
<td >R$ {$valorF}</td>
<td >R$ {$totalF}</td>
<td><a href="#" onclick="excluirServico({$id})" title="Excluir Item"><i class="fa fa-trash-o text-danger"></i></a></td>
</tr>
HTML;

}



echo <<<HTML
</tbody>
</table>
</small>
HTML;

}
?>

<script type="text/javascript">
	$("#tot_servicos").text("<?=$total_produtosF?>");
</script>