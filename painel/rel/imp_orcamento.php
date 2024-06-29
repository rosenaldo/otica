<?php 
include('../../conexao.php');

$id = $_POST['id'];

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


<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<?php if(@$impressao_automatica == 'Sim'){ ?>
<script type="text/javascript">
	$(document).ready(function() {    		
		window.print();
		window.close(); 
	} );
</script>
<?php } ?>


<style type="text/css">
	*{
	margin:0px;

	/*Espaçamento da margem da esquerda e da Direita*/
	padding:0px;
	background-color:#ffffff;
	
	font-color:#000;	
	font-family: TimesNewRoman, Geneva, sans-serif; 

}
.text {
	&-center { text-align: center; }
}
.ttu { text-transform: uppercase;
	font-weight: bold;
	font-size: 1.2em;
 }

.printer-ticket {
	display: table !important;
	width: 100%;

	/*largura do Campos que vai os textos*/
	max-width: 400px;
	font-weight: light;
	line-height: 1.3em;

	/*Espaçamento da margem da esquerda e da Direita*/
	padding: 0px;
	font-family: TimesNewRoman, Geneva, sans-serif; 

	/*tamanho da Fonte do Texto*/
	font-size: <?php echo $fonte_comprovante ?>; 
	font-color:#000;
	
	
	}
	
	th { 
		font-weight: inherit;

		/*Espaçamento entre as uma linha para outra*/
		padding:5px;
		text-align: center;

		/*largura dos tracinhos entre as linhas*/
		border-bottom: 1px dashed #000000;
	}


	

	
	
		
	.cor{
		color:#000000;
	}
	
	
	

	/*margem Superior entre as Linhas*/
	.margem-superior{
		padding-top:5px;
	}
	
	
}
</style>



<table class="printer-ticket">

	<tr>
		<th class="ttu" class="title" colspan="3"><?php echo $nome_sistema ?></th>

	</tr>
	<tr style="font-size: 10px">
		<th colspan="3">
			<?php echo $endereco_sistema ?> <br />
			Contato: <?php echo $telefone_sistema ?>  <?php if($cnpj_sistema != ""){ ?> / CNPJ <?php echo  $cnpj_sistema  ?><?php } ?>
		</th>
	</tr>

	<tr >
		<th colspan="3">Cliente <?php echo $nome_cliente ?> Tel: <?php echo $tel_cliente ?>			
					
			
		</th>
	</tr>
	
	<tr>
		<th class="ttu margem-superior" colspan="3">
			ORÇAMENTO Nº <?php echo $id ?> 
			
		</th>
	</tr>

	
	<tbody>

		<?php 
$total_servicos = 0;
$total_servicosF = 0;
$query = $pdo->query("SELECT * from servicos_orc where orcamento = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$linhas = @count($res);
if($linhas > 0){

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
				
					<td colspan="2" width="70%"> <?php echo $quantidade ?> - <?php echo $nome_servico ?>
					</td>				

				<td align="right">R$ <?php echo $totalF ;?></td>
			</tr>

		<?php } } ?>


<?php 
$total_produtos = 0;
$total_produtosF = 0;
$query = $pdo->query("SELECT * from produtos_orc where orcamento = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$linhas = @count($res);
if($linhas > 0){


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
				
					<td colspan="2" width="70%"> <?php echo $quantidade ?> - <?php echo $nome_produto ?>
					</td>				

				<td align="right">R$ <?php echo $totalF ;?></td>
			</tr>

		<?php } } ?>




				
	</tbody>
	<tfoot>

		<tfoot>

		<tr>
			<th class="ttu"  colspan="3" class="cor">
			<!-- _ _	_ _ _ _ _ _ _ _ _ _ _ _ _ _ _ -->
			</th>
		</tr>	
		
		<?php if($total_servicos > 0){ ?>
		<tr>
			<td colspan="2">Total Serviços</td>
			<td align="right">R$ <?php echo $total_servicosF ?></td>
		</tr>
		<?php } ?>

		<?php if($total_produtos > 0){ ?>
		<tr>
			<td colspan="2">Total Produtos</td>
			<td align="right">R$ <?php echo $total_produtosF ?></td>
		</tr>
		<?php } ?>


		<?php if($desconto > 0){ ?>
		<tr>
			<td colspan="2">Total Desconto</td>
			<td align="right"><?php echo $valor_reais ?> <?php echo $descontoF ?><?php echo $valor_porcent ?></td>
		</tr>
		<?php } ?>

		<?php if($frete > 0){ ?>
		<tr>
			<td colspan="2">Total Frete</td>
			<td align="right">R$ <?php echo $freteF ?></td>
		</tr>
		<?php } ?>

		
		</tr>

			<tr>
			<td colspan="2">SubTotal</td>
			<td align="right"><b>R$ <?php echo $subtotalF ?></b></td>
		</tr>

		


		<?php if($obs != ""){ ?>

			<tr >
		<th colspan="3">
		</th>
		</tr>

		<tr style="margin-top:2px; text-align:center">
			<td colspan="3"><small><b>OBS:</b> <?php echo $obs ?></small></td>
			
		</tr>
		<?php } ?>

		<tr >
		<th colspan="3">
		</th>
		</tr>
	
		<tr >
		<th colspan="3"><small>Data <?php echo $dataF ?>  /  Validade Proposta: <b><?php echo $dias_validade ?> Dias</b>  <br>  Previsão de Entrega <b><?php echo $data_entregaF ?></b></small>
		</th>
	</tr>



	</tfoot>
</table>




<br><br>
<div align="center">__________________________</div>
<div align="center"><small>Assinatura do Cliente</small></div>
