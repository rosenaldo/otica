<?php 
include('../../conexao.php');
include('data_formatada.php');

$id = $_GET['id'];

$query = $pdo->query("SELECT * from orcamentos where id = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$data = $res[0]['data'];
$cliente = $res[0]['cliente'];
$data_entrega = $res[0]['data_entrega'];
$dias_validade = $res[0]['dias_validade'];
$valor = $res[0]['valor'];
$desconto = $res[0]['desconto'];
$tipo_desconto = $res[0]['tipo_desconto'];
$subtotal = $res[0]['subtotal'];
$obs = $res[0]['obs'];
$status = $res[0]['status'];
$total_produtos = $res[0]['total_produtos'];
$total_servicos = $res[0]['total_servicos'];
$funcionario = $res[0]['funcionario'];
$frete = $res[0]['frete'];
$valor_entrada = $res[0]['valor_entrada'];


$dataF = implode('/', array_reverse(@explode('-', $data)));
$data_entregaF = implode('/', array_reverse(@explode('-', $data_entrega)));

$valorF = number_format($valor, 2, ',', '.');
$subtotalF = number_format($subtotal, 2, ',', '.');
$freteF = number_format($frete, 2, ',', '.');
$total_produtosF = number_format($total_produtos, 2, ',', '.');
$total_servicosF = number_format($total_servicos, 2, ',', '.');

$query2 = $pdo->query("SELECT * FROM usuarios where id = '$funcionario'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
if(@count($res2) > 0){
	$nome_usu_lanc = $res2[0]['nome'];
}else{
	$nome_usu_lanc = 'Sem Usuário';
}


$query2 = $pdo->query("SELECT * FROM clientes where id = '$cliente'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
if(@count($res2) > 0){
	$nome_cliente = $res2[0]['nome'];	
	$tel_cliente = $res2[0]['telefone'];
	$tel_cliente2 = $res2[0]['telefone2'];
	$endereco_cliente = $res2[0]['endereco'];
	$cpf = $res2[0]['cpf'];
}


if($tipo_desconto == "%"){
	$valor_porcent = '%';
	$valor_reais = '';
	$descontoF = $desconto;
}else{
	$valor_porcent = '';
	$valor_reais = 'R$';
	$descontoF = number_format($desconto, 2, ',', '.');
}

?>
<!DOCTYPE html>
<html>
<head>

<style>

@import url('https://fonts.cdnfonts.com/css/tw-cen-mt-condensed');
@page { margin: 145px 20px 25px 20px; }
#header { position: fixed; left: 0px; top: -110px; bottom: 100px; right: 0px; height: 35px; text-align: center; padding-bottom: 100px; }
#content {margin-top: 0px;}
#footer { position: fixed; left: 0px; bottom: -60px; right: 0px; height: 80px; }
#footer .page:after {content: counter(page, my-sec-counter);}
body {font-family: 'Tw Cen MT', sans-serif;}

.marca{
	position:fixed;
	left:50;
	top:100;
	width:80%;
	opacity:8%;
}

</style>

</head>
<body>
<?php 
if($marca_dagua == 'Sim'){ ?>
<img class="marca" src="<?php echo $url_sistema ?>img/logo.jpg">	
<?php } ?>



<div id="header" >

	<div style="border-style: solid; font-size: 10px; height: 50px;">
		<table style="width: 100%; border: 0px solid #ccc;">
			<tr>
				<td style="border: 1px; solid #000; width: 7%; text-align: left;">
					<img style="margin-top: 0px; margin-left: 7px;" id="imag" src="<?php echo $url_sistema ?>img/logo.jpg" width="120px">
				</td>
				<td style="width: 33%; text-align: left; font-size: 13px;">
				
				</td>
				<td style="width: 5%; text-align: center; font-size: 13px;">
				
				</td>
				<td style="width: 40%; text-align: right; font-size: 9px;padding-right: 10px;">
						<b><big>N° <?php echo $id ?></big></b><br>CONTATO: <?php echo $telefone_sistema ?><br> <?php echo mb_strtoupper($data_hoje) ?>
				</td>
			</tr>		
		</table>
	</div>

<br>


<table id="cabecalhotabela" style="border-bottom-style: solid; font-size: 10px; margin-bottom:10px; width: 100%; table-layout: fixed;">
			<thead>
				
				<tr id="cabeca" style="margin-left: 0px; background-color:#f2f0f0">
					<td style="width:33%"><b>DATA : <?php echo $dataF ?></b> </td>
					<!-- <td style="width:33%"><b>VALIDADE DA PROPOSTA : <?php echo $dias_validade ?> DIAS</b></td> -->					 
					<td style="width:34%"><b>PREVISÃO DE ENTREGA : <?php echo $data_entregaF ?></b></td>			
					
					
				</tr>
			</thead>
		</table>




		<table id="cabecalhotabela" style="border-style: solid; font-size: 9px; margin-bottom:10px; width: 100%; table-layout: fixed; margin-top:10px;">
			<thead>
				
				<tr id="cabeca" style="margin-left: 0px; background-color:#f2f0f0">
					<td colspan="4" style="width:100%; font-size: 10px"><b>DADOS DO CLIENTE</b> </td>					
				</tr>
				<tr >
					<td style="width:10%; border-right: 1px solid #000;border-bottom: : 1px solid #000;">NOME: </td>
					<td style="width:40%; border-right: : 1px solid #000; border-bottom: : 1px solid #000;">
						<?php echo mb_strtoupper($nome_cliente) ?>
					</td>
					
					<td style="width:10%; border-right: 1px solid #000;border-bottom: : 1px solid #000;">ENDEREÇO: </td>
					<td style="width:40%; border-bottom: : 1px solid #000;">
						<?php echo mb_strtoupper($endereco_cliente) ?>
					</td>
    			</tr>
    			<tr >
					<td style="width:10%; border-right: 1px solid #000;">TELEFONE: </td>
					<td style="width:40%; border-right: : 1px solid #000; ">
						<?php echo mb_strtoupper($tel_cliente) ?>
					</td>
					
					<td style="width:10%; border-right: 1px solid #000;">TELEFONE 2: </td>
					<td style="width:40%; ">
						<?php echo mb_strtoupper($tel_cliente2) ?>
					</td>
    			</tr>
				<td style="width:10%; border-right: 1px solid #000;">CPF: </td>
					<td style="width:40%; ">
						<?php echo mb_strtoupper($cpf) ?>
					</td>
				</tr>
			</thead>
		</table>


<?php 
$total_servicos = 0;
$total_servicosF = 0;
$query = $pdo->query("SELECT * from servicos_orc where orcamento = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$linhas = @count($res);
if($linhas > 0){
 ?>
		<table id="cabecalhotabela" style="border-bottom-style: solid; font-size: 10px; margin-bottom:10px; width: 100%; table-layout: fixed;">
			<thead>
				
				<tr id="cabeca" style="margin-left: 0px; background-color:#CCC">
					<td style="width:45%">SERVIÇO</td>
					<td style="width:15%">QUANTIDADE</td>
					<td style="width:20%">R$ VALOR</td>
					<td style="width:20%">TOTAL</td>
					
					
				</tr>
			</thead>
		</table>


		<table style="width: 100%; table-layout: fixed; font-size:10px; text-transform: uppercase; margin-top: -5px">
			<thead>
				<tbody>
					<?php 
for($i=0; $i<$linhas; $i++){
	
	$servico = $res[$i]['servico'];
	$quantidade = $res[$i]['quantidade'];
	$valor = $res[$i]['valor'];
	$total = $res[$i]['total'];
	
	$valorF = number_format($valor, 2, ',', '.');
	$totalF = number_format($total, 2, ',', '.');

	$total_servicos += $total;
	$total_servicosF = number_format($total_servicos, 2, ',', '.');

	$query2 = $pdo->query("SELECT * from servicos where id = '$servico'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
$nome_servico = $res2[0]['nome'];
	
  	 ?>

  	 
<tr>
<td style="width:45%"><?php echo $nome_servico ?></td>
<td style="width:15%"><?php echo $quantidade ?></td>
<td style="width:20%">R$ <?php echo $valorF ?></td>
<td style="width:20%">R$ <?php echo $totalF ?></td>


    </tr>

<?php } ?>
				</tbody>
	
			</thead>
		</table>

		<?php } ?>

<?php 
$total_produtos = 0;
$total_produtosF = 0;
$query = $pdo->query("SELECT * from produtos_orc where orcamento = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$linhas = @count($res);
if($linhas > 0){
 ?>
		<table id="cabecalhotabela" style="border-bottom-style: solid; font-size: 10px; margin-bottom:10px; width: 100%; table-layout: fixed; margin-top: 10px">
			<thead>
				
				<tr id="cabeca" style="margin-left: 0px; background-color:#CCC">
					<td style="width:45%">PRODUTO</td>
					<td style="width:15%">QUANTIDADE</td>
					<td style="width:20%">R$ VALOR</td>
					<td style="width:20%">TOTAL</td>
					
					
				</tr>
			</thead>
		</table>

		


		<table style="width: 100%; table-layout: fixed; font-size:10px; text-transform: uppercase; margin-top: -5px">
			<thead>
				<tbody>
					<?php 
for($i=0; $i<$linhas; $i++){
	
	$produto = $res[$i]['produto'];
	$quantidade = $res[$i]['quantidade'];
	$valor = $res[$i]['valor'];
	$total = $res[$i]['total'];
	
	$valorF = number_format($valor, 2, ',', '.');
	$totalF = number_format($total, 2, ',', '.');

	$total_produtos += $total;
	$total_produtosF = number_format($total_produtos, 2, ',', '.');

	$query2 = $pdo->query("SELECT * from produtos where id = '$produto'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
$nome_produto = $res2[0]['nome'];
	
  	 ?>

  	 
<tr>
<td style="width:45%"><?php echo $nome_produto ?></td>
<td style="width:15%"><?php echo $quantidade ?></td>
<td style="width:20%">R$ <?php echo $valorF ?></td>
<td style="width:20%">R$ <?php echo $totalF ?></td>


    </tr>

<?php } ?>
				</tbody>
	
			</thead>
		</table>

		<?php } ?>
<?php if($obs != ""){ ?>
<hr>
<div align="left" style="font-size:10px; margin-top: 15px"><b>OBS:</b> <?php echo $obs ?></div>
<?php } ?>
<hr>
		<div style="background:#f2f0f0; padding:5px; margin-top: 20px; ">
		<?php if($total_servicos > 0){ ?>
		<div align="right" style="font-size:10px;">
			<span><b>TOTAL SERVIÇOS:</b> R$ <?php echo $total_servicosF ?></span>
		</div>
		<?php } ?>

		<?php if($total_produtos > 0){ ?>
		<div align="right" style="margin-top: 4px; font-size:10px;">
			<span><b>TOTAL PRODUTOS:</b> R$ <?php echo $total_produtosF ?></span>
		</div>
		<?php } ?>

		<?php if($desconto > 0){ ?>
		<div align="right" style="margin-top: 4px; font-size:10px;">
			<span><b>DESCONTO:</b> <?php echo $valor_reais ?> <?php echo $descontoF ?><?php echo $valor_porcent ?></span>
		</div>
		<?php } ?>

		<?php if($valor_entrada > 0){ ?>
		<div align="right" style="margin-top: 4px; font-size:10px;">
			<span><b>VALOR DE ENTRADA:</b> <?php echo $valor_reais ?><?php echo $valor_entrada ?></span>
		</div>
		<?php } ?>

		<?php if($frete > 0){ ?>
		<div align="right" style="margin-top: 4px; font-size:10px;">
			<span><b>FRETE: </b>R$ <?php echo $freteF ?></span>
		</div>
		<?php } ?>

		</div>

		<hr>
		<div align="right" style="margin-top: 4px; font-size:11px; background:#d9dbdb; padding:5px">
			<span><b>TOTAL: R$ <?php echo $subtotalF ?></b></span>
		</div>

		<p style="font-size: 8px; text-align: left;">
			Autorizo a confecção dos óculos descriminados nesta nota, que sendo em bem específico e com medidas próprias não possui nenhuma utilidade para um terceiro.
			Estou ciente que não poderei desistir ou cancelar a compra após a assinatura deste documento, e reconheço como dívida a importância acima em favor da ÓTICA VENEZZA LTDA.
			Sendo inteiramente responsável por retirar a mercadoria no endereço acima e na data estabelecida.
			Estou ciente que se não o fizer, após 10 (dez) dias a duplicata correspondente será descontada em banco e tomada todas as medidas cabíveis. As armações de 1 ano de garantia a partir desta data, Lentes orgânicas ou CR39 não têm garantia de quebra ou risco.
			Lentes do material Trivex 2 anos e multifocais policarbonatos possuem garantia de um ano de quebra, mas não contra risco. Não nos responsabilizamos por armações não compradas na loja.
		</p>


		<div align="center" style="margin-top: 35px; font-size:10px; border:1px solid #000; padding-top:15px; padding-bottom:5px">
			<span>_________________________________________________________________<br>
			ASSINATURA DO CLIENTE</span>
		</div>


</div>



<div id="footer" class="row">
<hr style="margin-bottom: 0;">
	<table style="width:100%;">
		<tr style="width:100%;">
			<td style="width:60%; font-size: 10px; text-align: left;"><?php echo $nome_sistema ?> Telefone: <?php echo $telefone_sistema ?></td>
			<td style="width:40%; font-size: 10px; text-align: right;"><p class="page">Página  </p></td>
		</tr>
	</table>
</div>


	
</body>

</html>


