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

$lente = $res[0]['lente'];
$cotico = $res[0]['cotico'];
$altura = $res[0]['altura'];
$cor = $res[0]['cor'];
$retificacao = $res[0]['retificacao'];

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
	$titulo_rel = 'RECEITA Nº PEDIDO '. $pedido;
}else{
	$titulo_rel = 'ORDEM DE SERVIÇO NÚMERO '. $id;
}
$oculos = "img/logo.png";
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
					<td style="width:10%; border-right: 1px solid #000;border-bottom: : 1px solid #000;">NOME: </td>
					<td style="width:40%; border-right: : 1px solid #000; border-bottom: : 1px solid #000;">
						<?php echo mb_strtoupper($nome_cliente) ?>
					</td>
					
					<!-- <td style="width:10%; border-right: 1px solid #000;border-bottom: : 1px solid #000;">ENDEREÇO: </td>
					<td style="width:40%; border-bottom: : 1px solid #000;">
						<?php echo mb_strtoupper($endereco_cliente) ?>
					</td> -->
    			</tr>
    			<!-- <tr >
					<td style="width:10%; border-right: 1px solid #000;">TELEFONE: </td>
					<td style="width:40%; border-right: : 1px solid #000; ">
						<?php echo mb_strtoupper($tel_cliente) ?>
					</td>
					
					<td style="width:10%; border-right: 1px solid #000;">TELEFONE 2: </td>
					<td style="width:40%; ">
						<?php echo mb_strtoupper($tel_cliente2) ?>
					</td>
    			</tr> -->
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
					<td style="width:8%; border-right: 1px solid #000;border-bottom: : 1px solid #000;">PEDIDO: </td>
					<td style="width:10%; border-right: : 1px solid #000; border-bottom: : 1px solid #000;">
						<?php echo mb_strtoupper($pedido) ?>
					</td>
					
					<td style="width:12%; border-right: 1px solid #000;border-bottom: : 1px solid #000;">LABORATÓRIO: </td>
					<td style="width:35%; border-bottom: : 1px solid #000;">
						<?php echo mb_strtoupper($laboratorio) ?>
					</td>

					<td style="width:10%; border-right: 1px solid #000;border-bottom: : 1px solid #000;">DOUTOR: </td>
					<td style="width:25%; border-bottom: : 1px solid #000;">
						<?php echo mb_strtoupper($doutor) ?>
					</td>
    			</tr>
    			
			</thead>
		</table>

		<table id="cabecalhotabela" style=" font-size: 9px; margin-bottom:10px; width: 100%; table-layout: fixed; margin-top:10px;">
			<thead>
		<!--  -->

		<div class="oculos">
			<div class="quadrado" style="width: 60px; height: 30px; border: 1px solid black; margin-left: 23.5rem;" ></div>
			<div class="quadrado" style="width: 60px; height: 30px; border: 1px solid black; margin-left: 18rem; margin-top: -5rem; position:relative;" ></div>
			<div class="traco" style="width:17px;height: 15px; border-top: 1px solid black; border-left: 1px solid white; border-right: 1px solid white; border-bottom: 1px solid white;margin-left: 22.1rem;margin-top: -1rem;"></div>
	   </div>

<!--  -->
			
			
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
		</table>


		<table id="cabecalhotabela" style=" font-size: 9px; margin-bottom:10px; width: 100%; table-layout: fixed; margin-top:10px;">
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
		</table>
		</div>
	<?php } ?>
<!--  -->
<table id="cabecalhotabela" style="border-style: solid; font-size: 9px; margin-bottom:10px; width: 100%; table-layout: fixed; margin-top:10px;">
			<thead>
				
				
				<tr >
					<td style="width:10%; border-right: 1px solid #000;border-bottom: : 1px solid #000;">LENTE: </td>
					<td style="width:40%; border-right: : 1px solid #000; border-bottom: : 1px solid #000;">
						<?php echo mb_strtoupper($lente) ?>
					</td>
					
					<td style="width:10%; border-right: 1px solid #000;border-bottom: : 1px solid #000;">C. ÓTICO: </td>
					<td style="width:40%; border-bottom: : 1px solid #000;">
						<?php echo mb_strtoupper($cotico) ?>
					</td>
    			</tr>
    			<tr >
					<td style="width:10%; border-right: 1px solid #000;border-bottom: : 1px solid #000;">ALTURA: </td>
					<td style="width:40%; border-bottom: : 1px solid #000;">
						<?php echo mb_strtoupper($altura) ?>
					</td>
					
					<td style="width:10%; border-right: 1px solid #000;border-bottom: : 1px solid #000;">COR: </td>
					<td style="width:40%; border-bottom: : 1px solid #000;">
						<?php echo mb_strtoupper($cor) ?>
					</td>
					
    			</tr>
			
				<tr >			
					<td style="width:10%; border-right: 1px solid #000;">RETIFICAÇÃO: </td>
					<td style="width:40%; ">
						<?php echo mb_strtoupper($retificacao) ?>
					</td>
					
    			</tr>
			</thead>
		</table>

<!--  -->



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


