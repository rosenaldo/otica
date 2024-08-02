<?php 
require_once("../../../conexao.php");
$pagina = 'orcamentos';
$data_atual = date('Y-m-d');

$total_valor = 0;
$total_valorF = 0;

$dataInicial = @$_POST['p1'];
$dataFinal = @$_POST['p2'];
$status = '%'.@$_POST['p3'].'%';

if($dataFinal == ""){
	$dataFinal = $data_atual;
}

if($dataInicial == ""){
	$dataInicial = $data_atual;
}


//PEGAR O TOTAL ORÇAMENTOS PENDENTES
$query = $pdo->query("SELECT * from $pagina where status = 'Pendente'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_orcamentos = @count($res);


$query = $pdo->query("SELECT * from $pagina WHERE data >= '$dataInicial' and data <= '$dataFinal' and status LIKE '$status' order by id desc ");

echo <<<HTML
<small>
HTML;
$total_pago = 0;
$total_pendentes = 0;
$total_pagoF = 0;
$total_pendentesF = 0;
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
echo <<<HTML
	<table class="table table-hover" id="tabela">
		<thead> 
			<tr> 				
				<th>Cliente</th>
				<th class="esc">Data</th> 
				<th class="esc">Entrega</th> 
				<th class="esc">Valor</th> 
				<th class="esc">Desconto</th>
				<th class="esc">Frete</th>
				<th class="esc">Valor entrada</th>
				<th class="esc">Subtotal</th>
				<th class="esc">Efetuado Por</th>					
				<th>Ações</th>
			</tr> 
		</thead> 
		<tbody> 
HTML;
for($i=0; $i < $total_reg; $i++){
	foreach ($res[$i] as $key => $value){}
$id = $res[$i]['id'];
$data = $res[$i]['data'];
$cliente = $res[$i]['cliente'];
$data_entrega = $res[$i]['data_entrega'];
$dias_validade = $res[$i]['dias_validade'];
$valor = $res[$i]['valor'];
$desconto = $res[$i]['desconto'];
$tipo_desconto = $res[$i]['tipo_desconto'];
$subtotal = $res[$i]['subtotal'];
$obs = $res[$i]['obs'];
$status = $res[$i]['status'];
$total_produtos = $res[$i]['total_produtos'];
$total_servicos = $res[$i]['total_servicos'];
$funcionario = $res[$i]['funcionario'];
$frete = $res[$i]['frete'];
$valor_entrada = $res[$i]['valor_entrada'];


$dataF = implode('/', array_reverse(@explode('-', $data)));
$data_entregaF = implode('/', array_reverse(@explode('-', $data_entrega)));

$valorF = number_format($valor, 2, ',', '.');
$subtotalF = number_format($subtotal, 2, ',', '.');
$freteF = number_format($frete, 2, ',', '.');
$valor_entradaF = number_format($valor_entrada, 2, ',', '.');
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


if($status == 'Aprovado'){
	$classe_pago = 'verde';
	$ocultar = 'ocultar';
	$total_pago += $subtotal;
}else{
	$classe_pago = 'text-danger';
	$ocultar = '';
	$total_pendentes += $subtotal;
}


$total_pagoF = number_format($total_pago, 2, ',', '.');
$total_pendentesF = number_format($total_pendentes, 2, ',', '.');

if($tel_cliente == "Sem Registro"){
	$ocultar_whats = 'ocultar';
}else{
	$ocultar_whats = '';
}

$tel_pessoaF = '55'.preg_replace('/[ ()-]+/' , '' , $tel_cliente);

if($tipo_desconto == "%"){
	$valor_porcent = '%';
	$valor_reais = '';
	$descontoF = $desconto;
}else{
	$valor_porcent = '';
	$valor_reais = 'R$';
	$descontoF = number_format($desconto, 2, ',', '.');
}

$ocultar_obs = '';
$classe_obs = 'text-warning';
if($obs == ""){
	$ocultar_obs = 'ocultar';
	$classe_obs = 'text-primary';
}
echo <<<HTML
			<tr> 
				<td><i class="fa fa-square {$classe_pago} mr-1"></i> {$nome_cliente} 


				<li class="dropdown head-dpdn2 " style="display: inline-block; margin-left: 5px">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><big><i class="fa fa-info-circle {$classe_obs} "></i></big></a>

		<ul class="dropdown-menu" style="margin-left:-50px;">
		<li>
		<div class="notification_desc2">
		<p>	
			<span><b>Orçamento:</b> {$status} </span><br>
			<span><b>Cliente:</b> {$nome_cliente} </span><br>
			<span><b>Telefone:</b> {$tel_cliente} </span><br>
			<span><b>Telefone Secundário:</b> {$tel_cliente2} </span><br>
			<span><b>Endereço:</b> {$endereco_cliente} </span>

			<span class="{$ocultar_obs}"><br><br><b>Observações do Orçamento:</b><br>
			 {$obs} 
			 </span>
		</p>
		</div>
		</li>										
		</ul>
		</li>


				</td> 
					<td class="esc">{$dataF}</td>	
					<td class="esc">{$data_entregaF}</td>
				<td class="esc">R$ {$valorF}</td>
				<td class="esc">{$valor_reais} {$descontoF}{$valor_porcent}</td>
				<td class="esc">R$ {$freteF}</td>
				<td class="esc">R$ {$valor_entradaF}</td>
				<td class="esc text-danger">R$ {$subtotalF}</td>
				<td class="esc">{$nome_usu_lanc}</td>
				
				<td>
					<big><a class="{$ocultar}" href="#" onclick="editar('{$id}', '{$cliente}', '{$data_entrega}','{$dias_validade}','{$valor}','{$desconto}','{$tipo_desconto}','{$subtotal}', '{$obs}','{$frete}','{$valor_entrada}')" title="Editar Dados"><i class="fa fa-edit text-primary "></i></a></big>

				
				
		<li class="dropdown head-dpdn2 " style="display: inline-block;">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><big><i class="fa fa-trash-o text-danger "></i></big></a>

		<ul class="dropdown-menu" style="margin-left:-230px;">
		<li>
		<div class="notification_desc2">
		<p>Confirmar Exclusão? <a href="#" onclick="excluir('{$id}', '{$nome_cliente}')"><span class="text-danger">Sim</span></a></p>
		</div>
		</li>										
		</ul>
		</li>
					

					<li class="dropdown head-dpdn2 " style="display: inline-block;">
		<a class='{$ocultar}' title="Aprovar Orçamento" href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><big><i class="fa fa-check-square text-verde "></i></big></a>

		<ul class="dropdown-menu" style="margin-left:-230px;">
		<li>
		<div class="notification_desc2">
		<p>Confirmar Aprovação? <a href="#" onclick="baixar('{$id}', '{$nome_cliente}')"><span class="text-verde">Sim</span></a></p>
		</div>
		</li>										
		</ul>
		</li>


					<big><a href="#" onclick="arquivo('{$id}', '{$nome_cliente}')" title="Inserir / Ver Arquivos"><i class="fa fa-file-o " style="color:#22146e"></i></a></big>

					<form method="POST" action="rel/orcamento_class.php" target="_blank" style="display:inline-block">
					<input type="hidden" name="id" value="{$id}">
					<big><button title="PDF do Orçamento" style="background:transparent; border:none; margin:0; padding:0"><i class="fa fa-file-pdf-o " style="color:blue"></i></button></big>
					</form>


					<form method="POST" action="rel/imp_orcamento.php" target="_blank" style="display:inline-block">
					<input type="hidden" name="id" value="{$id}">
					<big><button title="Impressão do Orçamento 80mm" style="background:transparent; border:none; margin:0; padding:0"><i class="fa fa-print " style="color:#545352"></i></button></big>
					</form>


					<big><a class="{$ocultar_whats}" href="http://api.whatsapp.com/send?1=pt_BR&phone={$tel_pessoaF}" title="Whatsapp" target="_blank"><i class="fa fa-whatsapp " style="color:green"></i></a></big>
				</td>  
			</tr> 
HTML;
}
echo <<<HTML
		</tbody> 
		<small><div align="center" id="mensagem-excluir"></div></small>
	</table>
	<br>
	<div align="right"><span>Total Pendentes: <span class="text-danger">{$total_pendentesF}</span></span> <span style="margin-left: 25px">Total Aprovados: <span class="verde">{$total_pagoF}</span></span></div>
</small>
HTML;
}else{
	echo 'Não possui nenhuma conta para esta data!';
}

?>


<script type="text/javascript">


	$(document).ready( function () {
	    $('#tabela').DataTable({
	    	"ordering": false,
	    	"stateSave": true,
	    });
	    $('#tabela_filter label input').focus();
	    $('#total_itens').text('<?=$total_orcamentos?>');
	} );



	function editar(id, cliente, data_entrega, dias_validade, valor, desconto, tipo_desconto, subtotal, obs, frete, valor_entrada){

		if(cliente == 0){
			cliente = "";
		}

		
		$('#id').val(id);
		$('#data_entrega').val(data_entrega);
		$('#cliente').val(cliente).change();
		$('#dias_validade').val(dias_validade);
		$('#valor').val(valor);
		$('#desconto').val(desconto);
		$('#tipo_desconto').val(tipo_desconto).change();
		$('#subtotal').val(subtotal);
		$('#frete').val(frete);
		$('#valor_entrada').val(valor_entrada);
		$('#obs').val(obs);		

		//$('#btn_cliente').hide();					

		listarProdutos();
		listarServicos();
		totalizar();
		
		$('#modalForm').modal('show');
		$('#mensagem').text('');
		
	}


	
	function limparCampos(){
		$('#id').val('');
		$('#cliente').val('').change();	
		$('#produto').val('').change();	
		$('#servico').val('').change();		
		$('#valor').val('');
		$('#subtotal').val('');		
		$('#data_entrega').val('<?=$data_atual?>');			
		$('#desconto').val('');
		$('#frete').val('');
		$('#valor_entrada').val('');
		$('#obs').val('');
		$('#dias_validade').val('');
		listarServicos()
		listarProdutos()
		totalizar()

		//$('#btn_cliente').show();	
		
	}


	


	function arquivo(id, nome){
    $('#id-arquivo').val(id);    
    $('#nome-arquivo').text(nome);
    $('#modalArquivos').modal('show');
    $('#mensagem-arquivo').text(''); 
    listarArquivos();   
}


	function baixar(id, nome){
    $.ajax({
					url: 'paginas/' + pag + "/baixar.php",
					method: 'POST',
					data: {id},
					dataType: "html",
					success:function(result){
						listar();
						//alert(result)
					}
				});
}


</script>



