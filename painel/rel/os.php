<?php 
include('../../conexao.php');
include('data_formatada.php');

$id = $_GET['id'];

$query = $pdo->query("SELECT * from os where id = '$id'");
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
$tecnico = $res[0]['tecnico'];
$condicoes = $res[0]['condicoes'];
$acessorios = $res[0]['acessorios'];
$situacao = $res[0]['situacao'];
$equipamento = $res[0]['equipamento'];
$orcamento = $res[0]['orcamento'];
$mao_obra = $res[0]['mao_obra'];
$laudo = $res[0]['laudo'];

$longe1 = $res[0]['longe1'];
$longe2 = $res[0]['longe2'];
$longe3 = $res[0]['longe3'];
$longe4 = $res[0]['longe4'];
$longe5 = $res[0]['longe5'];
$longe6 = $res[0]['longe6'];
$longe7 = $res[0]['longe7'];
$longe8 = $res[0]['longe8'];
$longe9 = $res[0]['longe9'];
$longe10 = $res[0]['longe10'];
$longe11 = $res[0]['longe11'];
$longe12 = $res[0]['longe12'];

$perto1 = $res[0]['perto1'];
$perto2 = $res[0]['perto2'];
$perto3 = $res[0]['perto3'];
$perto4 = $res[0]['perto4'];
$perto5 = $res[0]['perto5'];
$perto6 = $res[0]['perto6'];
$perto7 = $res[0]['perto7'];
$perto8 = $res[0]['perto8'];


$pedido = $res[0]['pedido'];
$laboratorio = $res[0]['laboratorio'];
$doutor = $res[0]['doutor'];

if($longe1 != "" || $longe2 != "" || $perto1 != "" || $perto2 != "" || $pedido != "" || $laboratorio != ""){
	$receita = 'Receita';
}else{
	$receita = 'OS';
}

$dataF = implode('/', array_reverse(@explode('-', $data)));
$data_entregaF = implode('/', array_reverse(@explode('-', $data_entrega)));

$valorF = number_format($valor, 2, ',', '.');
$subtotalF = number_format($subtotal, 2, ',', '.');
$freteF = number_format($frete, 2, ',', '.');
$total_produtosF = number_format($total_produtos, 2, ',', '.');
$total_servicosF = number_format($total_servicos, 2, ',', '.');
$mao_obraF = number_format($mao_obra, 2, ',', '.');

$query2 = $pdo->query("SELECT * FROM usuarios where id = '$funcionario'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
if(@count($res2) > 0){
	$nome_usu_lanc = $res2[0]['nome'];
}else{
	$nome_usu_lanc = 'Sem Usuário';
}

$query2 = $pdo->query("SELECT * FROM usuarios where id = '$tecnico'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
if(@count($res2) > 0){
	$nome_tecnico = $res2[0]['nome'];
}else{
	$nome_tecnico = 'Sem Usuário';
}


$query2 = $pdo->query("SELECT * FROM clientes where id = '$cliente'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
if(@count($res2) > 0){
	$nome_cliente = $res2[0]['nome'];	
	$tel_cliente = $res2[0]['telefone'];
	$tel_cliente2 = $res2[0]['telefone2'];
	$cpf = $res2[0]['cpf'];
	$endereco_cliente = $res2[0]['endereco'];
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

if($pedido == ""){
	$pedido = $id;
}

if($receita == 'Receita'){
	$titulo_rel = 'Nº '. $pedido;   //RECEITA Nº PEDIDO
}else{
	$titulo_rel = 'ORDEM DE SERVIÇO NÚMERO '. $id;
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
						<b><big><?php echo $titulo_rel ?></big></b><br>CONTATO: <?php echo $telefone_sistema ?><br> <?php echo mb_strtoupper($data_hoje) ?>
				</td>
			</tr>		
		</table>
	</div>

<br>


<table id="cabecalhotabela" style="border-bottom-style: solid; font-size: 10px; margin-bottom:10px; width: 100%; table-layout: fixed;">
			<thead>
				
				<tr id="cabeca" style="margin-left: 0px; background-color:#f2f0f0">
					<td style="width:33%"><b>DATA : <?php echo $dataF ?></b> </td>
					<td style="width:33%"><b>VENDEDOR : <?php echo mb_strtoupper($nome_tecnico) ?></b></td>
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
					<td style="width:10%; border-right: 1px solid #000;border-bottom: 1px solid #000;">NOME: </td>
					<td style="width:40%; border-right: 1px solid #000; border-bottom: 1px solid #000;">
						<?php echo mb_strtoupper($nome_cliente) ?>
					</td>
					
					<td style="width:10%; border-right: 1px solid #000;border-bottom: 1px solid #000;">ENDEREÇO: </td>
					<td style="width:40%; border-bottom: 1px solid #000;">
						<?php echo mb_strtoupper($endereco_cliente) ?>
					</td>
    			</tr>
    			<tr >
					<td style="width:10%; border-right: 1px solid #000;">TELEFONE: </td>
					<td style="width:40%; border-right: 1px solid #000; ">
						<?php echo mb_strtoupper($tel_cliente) ?>
					</td>
					
					<td style="width:10%; border-right: 1px solid #000;">TELEFONE 2: </td>
					<td style="width:40%; ">
						<?php echo mb_strtoupper($tel_cliente2) ?>
					</td>			
					
    			</tr>
				<tr>
				<td style="width:10%; border-right: 1px solid #000;">CPF: </td>
					<td style="width:40%; ">
						<?php echo mb_strtoupper($cpf) ?>
					</td>
				</tr>

			</thead>
		</table>

		<?php if($receita == 'Receita'){ ?>
		<div style="border-style: solid; margin-bottom: 15px">
		<table id="cabecalhotabela" style=" font-size: 9px; margin-bottom:10px; width: 100%; table-layout: fixed; margin-top:10px;">
			<thead>
				
				<tr id="cabeca" style="margin-left: 0px; background-color:#f2f0f0">
					<td colspan="6" style="width:100%; font-size: 10px"><b>DADOS DA RECEITA</b> </td>					
				</tr>
				<tr >
					<td style="width:8%; border-right: 1px solid #000;border-bottom: 1px solid #000;">PEDIDO: </td>
					<td style="width:10%; border-right: 1px solid #000; border-bottom: 1px solid #000;">
						<?php echo mb_strtoupper($pedido) ?>
					</td>
					
					<td style="width:12%; border-right: 1px solid #000;border-bottom: 1px solid #000;">LABORATÓRIO: </td>
					<td style="width:35%; border-bottom: 1px solid #000;">
						<?php echo mb_strtoupper($laboratorio) ?>
					</td>

					<td style="width:10%; border-right: 1px solid #000;border-bottom: 1px solid #000;">DOUTOR: </td>
					<td style="width:25%; border-bottom: 1px solid #000;">
						<?php echo mb_strtoupper($doutor) ?>
					</td>
    			</tr>
    			
			</thead>
		</table>
		<!-- <table id="cabecalhotabela" style=" font-size: 9px; margin-bottom:10px; width: 100%; table-layout: fixed; margin-top:10px;">
			<thead>
				
				<tr id="cabeca" style="margin-left: 0px; background-color:#f2f0f0">
					<td colspan="6" style="width:100%; font-size: 9px"><b>GRAU DE LONGE</b> </td>					
				</tr>
				<tr style="text-align: center">
					<td style="width:16%; border-right: 1px solid #000;border-bottom: 1px solid #000;"><b>OD-ESF</b></td>

					<td style="width:16%; border-right: 1px solid #000;border-bottom: 1px solid #000;"><b>OD-CIL</b></td>

					<td style="width:16%; border-right: 1px solid #000;border-bottom: 1px solid #000;"><b>OD-EIXO</b></td>

					<td style="width:16%; border-right: 1px solid #000;border-bottom: 1px solid #000;"><b>OD-DNP</b></td>

					<td style="width:16%; border-right: 1px solid #000;border-bottom: 1px solid #000;"><b>OD-ADIÇÃO</b></td>

					<td style="width:16%; border-bottom: 1px solid #000;"><b>OD-ALTURA</b></td>
					
    			</tr>
    			<tr style="font-size: 10px; text-align: center">
					<td style="width:16%; border-right: 1px solid #000;border-bottom: 1px solid #000;"><b><?php echo $longe1 ?></b></td>

					<td style="width:16%; border-right: 1px solid #000;border-bottom: 1px solid #000;"><b><?php echo $longe2 ?></b></td>

					<td style="width:16%; border-right: 1px solid #000;border-bottom: 1px solid #000;"><b><?php echo $longe3 ?></b></td>

					<td style="width:16%; border-right: 1px solid #000;border-bottom: 1px solid #000;"><b><?php echo $longe4 ?></b></td>

					<td style="width:16%; border-right: 1px solid #000;border-bottom: 1px solid #000;"><b><?php echo $longe5 ?></b></td>

					<td style="width:16%; border-bottom: 1px solid #000;"><b><?php echo $longe6 ?></b></td>
					
    			</tr>


    			<tr style="text-align: center">
					<td style="width:16%; border-right: 1px solid #000;border-bottom: 1px solid #000;"><b>OE-ESF</b></td>

					<td style="width:16%; border-right: 1px solid #000;border-bottom: 1px solid #000;"><b>OE-CIL</b></td>

					<td style="width:16%; border-right: 1px solid #000;border-bottom: 1px solid #000;"><b>OE-EIXO</b></td>

					<td style="width:16%; border-right: 1px solid #000;border-bottom: 1px solid #000;"><b>OE-DNP</b></td>

					<td style="width:16%; border-right: 1px solid #000;border-bottom: 1px solid #000;"><b>OE-ADIÇÃO</b></td>

					<td style="width:16%; border-bottom: 1px solid #000;"><b>OE-ALTURA</b></td>
					
    			</tr>
    			<tr style="font-size: 10px; text-align: center">
					<td style="width:16%; border-right: 1px solid #000;border-bottom: 1px solid #000;"><b><?php echo $longe7 ?></b></td>

					<td style="width:16%; border-right: 1px solid #000;border-bottom: 1px solid #000;"><b><?php echo $longe8 ?></b></td>

					<td style="width:16%; border-right: 1px solid #000;border-bottom: 1px solid #000;"><b><?php echo $longe9 ?></b></td>

					<td style="width:16%; border-right: 1px solid #000;border-bottom: 1px solid #000;"><b><?php echo $longe10 ?></b></td>

					<td style="width:16%; border-right: 1px solid #000;border-bottom: 1px solid #000;"><b><?php echo $longe11 ?></b></td>

					<td style="width:16%; border-bottom: 1px solid #000;"><b><?php echo $longe12 ?></b></td>
					
    			</tr>
    			
			</thead>
		</table> -->


		<!-- <table id="cabecalhotabela" style=" font-size: 9px; margin-bottom:10px; width: 100%; table-layout: fixed; margin-top:10px;">
			<thead>
				
				<tr id="cabeca" style="margin-left: 0px; background-color:#f2f0f0">
					<td colspan="4" style="width:100%; font-size: 9px"><b>GRAU DE PERTO</b> </td>					
				</tr>
				<tr style="text-align: center">
					<td style="width:16%; border-right: 1px solid #000;border-bottom: 1px solid #000;"><b>OD-ESF</b></td>

					<td style="width:16%; border-right: 1px solid #000;border-bottom: 1px solid #000;"><b>OD-CIL</b></td>

					<td style="width:16%; border-right: 1px solid #000;border-bottom: 1px solid #000;"><b>OD-EIXO</b></td>

					<td style="width:16%; border-bottom: 1px solid #000;"><b>OD-DNP</b></td>

				
    			</tr>
    			<tr style="font-size: 10px; text-align: center">
					<td style="width:16%; border-right: 1px solid #000;border-bottom: 1px solid #000;"><b><?php echo $perto1 ?></b></td>

					<td style="width:16%; border-right: 1px solid #000;border-bottom: 1px solid #000;"><b><?php echo $perto2 ?></b></td>

					<td style="width:16%; border-right: 1px solid #000;border-bottom: 1px solid #000;"><b><?php echo $perto3 ?></b></td>

					<td style="width:16%; border-bottom: 1px solid #000;"><b><?php echo $perto4 ?></b></td>

				
					
    			</tr>


    			<tr style="text-align: center">
					<td style="width:16%; border-right: 1px solid #000;border-bottom: 1px solid #000;"><b>OE-ESF</b></td>

					<td style="width:16%; border-right: 1px solid #000;border-bottom: 1px solid #000;"><b>OE-CIL</b></td>

					<td style="width:16%; border-right: 1px solid #000;border-bottom: 1px solid #000;"><b>OE-EIXO</b></td>

					<td style="width:16%; border-bottom: 1px solid #000;"><b>OE-DNP</b></td>

				
					
    			</tr>
    			<tr style="font-size: 10px; text-align: center">
					<td style="width:16%; border-right: 1px solid #000;border-bottom: 1px solid #000;"><b><?php echo $perto5 ?></b></td>

					<td style="width:16%; border-right: 1px solid #000;border-bottom: 1px solid #000;"><b><?php echo $perto6 ?></b></td>

					<td style="width:16%; border-right: 1px solid #000;border-bottom: 1px solid #000;"><b><?php echo $perto7 ?></b></td>

					<td style="width:16%; border-bottom: 1px solid #000;"><b><?php echo $perto8 ?></b></td>

					
    			</tr>
    			
			</thead>
		</table> -->
		</div>
	<?php } ?>


<?php 
$total_servicos = 0;
$total_servicosF = 0;
$query = $pdo->query("SELECT * from servicos_orc where os = '$id'");
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
$query = $pdo->query("SELECT * from produtos_orc where os = '$id'");
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



<?php if($equipamento != ""){ ?>
<hr>
<div align="left" style="font-size:9px; margin-top: 10px"><b>Equipamento:</b> <?php echo $equipamento ?></div>
<?php } ?>


<?php if($situacao != ""){ ?>
<hr>
<div align="left" style="font-size:9px; margin-top: 10px"><b>Situação:</b> <?php echo $situacao ?></div>
<?php } ?>


<?php if($laudo != ""){ ?>
<hr>
<div align="left" style="font-size:9px; margin-top: 10px"><b>Laudo Técnico:</b> <?php echo $laudo ?></div>
<?php } ?>

<?php if($acessorios != ""){ ?>
<hr>
<div align="left" style="font-size:9px; margin-top: 10px"><b>Acessórios:</b> <?php echo $acessorios ?></div>
<?php } ?>

<?php if($condicoes != ""){ ?>
<hr>
<div align="left" style="font-size:9px; margin-top: 10px"><b>Condições:</b> <?php echo $condicoes ?></div>
<?php } ?>

<?php if($obs != ""){ ?>
<hr>
<div align="left" style="font-size:9px; margin-top: 10px"><b>OBS:</b> <?php echo $obs ?></div>
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

		<?php if($mao_obra > 0){ ?>
		<div align="right" style="margin-top: 4px; font-size:10px;">
			<span><b>MÃO DE OBRA:</b> R$ <?php echo $mao_obraF ?></span>
		</div>
		<?php } ?>

		<?php if($desconto > 0){ ?>
		<div align="right" style="margin-top: 4px; font-size:10px;">
			<span><b>DESCONTO:</b> <?php echo $valor_reais ?> <?php echo $descontoF ?><?php echo $valor_porcent ?></span>
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


