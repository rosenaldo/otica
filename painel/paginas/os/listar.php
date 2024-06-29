<?php 
require_once("../../../conexao.php");
$pagina = 'os';
$data_atual = date('Y-m-d');

$total_valor = 0;
$total_valorF = 0;

$dataInicial = @$_POST['p1'];
$dataFinal = @$_POST['p2'];
$status = '%'.@$_POST['p3'].'%';
$filtro = @$_POST['p4'];

if($dataFinal == ""){
	$dataFinal = $data_atual;
}

if($dataInicial == ""){
	$dataInicial = $data_atual;
}

if($filtro == 'filtro'){
	if($status == ""){
		$query = $pdo->query("SELECT * from $pagina WHERE data = curDate() order by id desc ");
	}else{
		$query = $pdo->query("SELECT * from $pagina WHERE status LIKE '$status' order by id desc ");
	}
	
}else{
	$query = $pdo->query("SELECT * from $pagina WHERE data >= '$dataInicial' and data <= '$dataFinal' and status LIKE '$status' order by id desc ");
}



echo <<<HTML
<small>
HTML;
$total_abertas = 0;
$total_iniciadas = 0;
$total_aguardando = 0;
$total_finalizadas = 0;
$total_entregues = 0;

$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
echo <<<HTML
	<table class="table table-hover" id="tabela">
		<thead> 
			<tr> 				
				<th>Cliente</th>
				<th>Receita / OS</th>				
				<th class="esc">Entrega</th> 				
				<th class="esc">Subtotal</th>
				<th class="esc">Vendedor</th>
				<th class="esc">Status</th>					
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
$tecnico = $res[$i]['tecnico'];
$condicoes = $res[$i]['condicoes'];
$acessorios = $res[$i]['acessorios'];
$situacao = $res[$i]['situacao'];
$equipamento = $res[$i]['equipamento'];
$orcamento = $res[$i]['orcamento'];
$mao_obra = $res[$i]['mao_obra'];
$laudo = $res[$i]['laudo'];

$longe1 = $res[$i]['longe1'];
$longe2 = $res[$i]['longe2'];
$longe3 = $res[$i]['longe3'];
$longe4 = $res[$i]['longe4'];
$longe5 = $res[$i]['longe5'];
$longe6 = $res[$i]['longe6'];
$longe7 = $res[$i]['longe7'];
$longe8 = $res[$i]['longe8'];
$longe9 = $res[$i]['longe9'];
$longe10 = $res[$i]['longe10'];
$longe11 = $res[$i]['longe11'];
$longe12 = $res[$i]['longe12'];

$perto1 = $res[$i]['perto1'];
$perto2 = $res[$i]['perto2'];
$perto3 = $res[$i]['perto3'];
$perto4 = $res[$i]['perto4'];
$perto5 = $res[$i]['perto5'];
$perto6 = $res[$i]['perto6'];
$perto7 = $res[$i]['perto7'];
$perto8 = $res[$i]['perto8'];

$pedido = $res[$i]['pedido'];
$laboratorio = $res[$i]['laboratorio'];
$doutor = $res[$i]['doutor'];

$lente = $res[$i]['lente'];
$cotico = $res[$i]['cotico'];
$altura = $res[$i]['altura'];
$cor = $res[$i]['cor'];
$retificacao = $res[$i]['retificacao'];

if($longe1 != "" || $longe2 != "" || $perto1 != "" || $perto2 != "" || $pedido != "" || $laboratorio != ""){
	$receita = 'Receita';
	$titulo_link = 'PDF da Receita';
	$ref_link = 'rel/receita_class.php';
}else{
	$receita = 'OS';
	$titulo_link = 'Impressão da OS 80mm';
	$ref_link = 'rel/imp_os.php';
}

$dataF = implode('/', array_reverse(@explode('-', $data)));
$data_entregaF = implode('/', array_reverse(@explode('-', $data_entrega)));

$valorF = @number_format($valor, 2, ',', '.');
$subtotalF = @number_format($subtotal, 2, ',', '.');
$freteF = @number_format($frete, 2, ',', '.');
$total_produtosF = @number_format($total_produtos, 2, ',', '.');
$total_servicosF = @number_format($total_servicos, 2, ',', '.');
$mao_obraF = @number_format($mao_obra, 2, ',', '.');

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
	$nome_tecnico = 'Não Lançando';
}


$query2 = $pdo->query("SELECT * FROM clientes where id = '$cliente'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
if(@count($res2) > 0){
	$nome_cliente = $res2[0]['nome'];	
	$tel_cliente = $res2[0]['telefone'];
	$tel_cliente2 = $res2[0]['telefone2'];
	$endereco_cliente = $res2[0]['endereco'];
}


if($status == 'Aberta'){
	$classe_pago = 'red';	
	$total_abertas += 1;
}else if($status == 'Iniciada'){
	$classe_pago = 'blue';	
	$total_iniciadas += 1;
}else if($status == 'Aguardando'){
	$classe_pago = '#a34807';	
	$total_aguardando += 1;
}else if($status == 'Finalizada'){
	$classe_pago = 'green';	
	$total_finalizadas += 1;
}else{
	$classe_pago = '#06858a';	
	$total_entregues += 1;
}


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


$ocultar_status = '';
if($status == "Entregue"){
	$ocultar_status = 'ocultar';	
}

echo <<<HTML
			<tr> 
				<td><i class="fa fa-square mr-1" style="color:{$classe_pago}"></i> {$nome_cliente} 


				<li class="dropdown head-dpdn2 " style="display: inline-block; margin-left: 5px">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><big><i class="fa fa-info-circle {$classe_obs} "></i></big></a>

		<ul class="dropdown-menu" style="margin-left:-50px;">
		<li>
		<div class="notification_desc2">
		<p>	
			<span><b>OS:</b> {$status} </span><br>
			<span><b>Cliente:</b> {$nome_cliente} </span><br>
			<span><b>Telefone:</b> {$tel_cliente} </span><br>
			<span><b>Telefone Secundário:</b> {$tel_cliente2} </span><br>
			<span><b>Endereço:</b> {$endereco_cliente} </span>

			<span class="{$ocultar_obs}"><br><br><b>Equipamento:</b><br>
			 {$equipamento} 
			 </span>

			<span class="{$ocultar_obs}"><br><b>Observações do Orçamento:</b><br>
			 {$obs} 
			 </span>
		</p>
		</div>
		</li>										
		</ul>
		</li>


				</td> 
					<td class="esc">{$receita}</td>
					<td class="esc">{$data_entregaF}</td>
				
				<td class="esc text-danger">R$ {$subtotalF}</td>
				<td class="esc">{$nome_tecnico}</td>
				<td class="esc"><div style="color:#FFF; background:{$classe_pago}; padding:0px; width:75px; text-align: center; font-size: 12px; ">{$status}</div></td>
				<td>
					<big><a class="{$ocultar_status}" href="#" onclick="editar('{$id}', '{$cliente}', '{$data_entrega}','{$dias_validade}','{$valor}','{$desconto}','{$tipo_desconto}','{$subtotal}', '{$obs}','{$frete}','{$tecnico}','{$laudo}','{$condicoes}','{$acessorios}','{$situacao}','{$equipamento}','{$orcamento}','{$mao_obra}','{$laboratorio}','{$pedido}','{$doutor}','{$longe1}','{$longe2}','{$longe3}','{$longe4}','{$longe5}','{$longe6}','{$longe7}','{$longe8}','{$longe9}','{$longe10}','{$longe11}','{$longe12}','{$perto1}','{$perto2}','{$perto3}','{$perto4}','{$perto5}','{$perto6}','{$perto7}','{$perto8}','{$lente}','{$cotico}','{$altura}','{$cor}','{$retificacao}')" title="Editar Dados"><i class="fa fa-edit text-primary "></i></a></big>

				
				
		<li class="dropdown head-dpdn2 " style="display: inline-block;">
		<a class="{$ocultar_status}" href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><big><i class="fa fa-trash-o text-danger "></i></big></a>

		<ul class="dropdown-menu" style="margin-left:-230px;">
		<li>
		<div class="notification_desc2">
		<p>Confirmar Exclusão? <a href="#" onclick="excluir('{$id}', '{$nome_cliente}')"><span class="text-danger">Sim</span></a></p>
		</div>
		</li>										
		</ul>
		</li>
					

						<big><a class="{$ocultar_status}" href="#" onclick="status('{$id}', '{$status}')" title="Mudar Status"><i class="fa fa-pencil " style="color:blue"></i></a></big>



					<big><a href="#" onclick="arquivo('{$id}', '{$nome_cliente}')" title="Inserir / Ver Arquivos"><i class="fa fa-file-o " style="color:#22146e"></i></a></big>


						<form method="POST" action="rel/os_class.php" target="_blank" style="display:inline-block">
					<input type="hidden" name="id" value="{$id}">
					<big><button title="PDF da OS" style="background:transparent; border:none; margin:0; padding:0"><i class="fa fa-file-pdf-o " style="color:blue"></i></button></big>
					</form>


							<form method="POST" action="{$ref_link}" target="_blank" style="display:inline-block" >
					<input type="hidden" name="id" value="{$id}">
					<big><button title="{$titulo_link}" style="background:transparent; border:none; margin:0; padding:0"><i class="fa fa-print " style="color:#545352"></i></button></big>
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
	<div align="right">

	<span>Abertas: <span style="color:red">{$total_abertas}</span></span> 
	<span style="margin-left: 25px">Iniciadas: <span style="color:blue">{$total_iniciadas}</span></span>
	<span style="margin-left: 25px">Aguardando: <span style="color:#a34807">{$total_aguardando}</span></span>
	<span style="margin-left: 25px">Finalizadas: <span style="color:green">{$total_finalizadas}</span></span>
	<span style="margin-left: 25px">Entregues: <span style="color:#06858a">{$total_entregues}</span></span>

	</div>

	
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
	    
	} );



	function editar(id, cliente, data_entrega, dias_validade, valor, desconto, tipo_desconto, subtotal, obs, frete, tecnico, laudo, condicoes, acessorios, situacao, equipamento, orcamento, mao_obra, laboratorio, pedido, doutor, longe1, longe2, longe3, longe4, longe5, longe6, longe7, longe8, longe9, longe10, longe11, longe12, perto1, perto2, perto3, perto4, perto5, perto6, perto7, perto8,lente,cotico,altura,cor,retificacao){	
	    
		
		if(tecnico > 0){
			orcamento = "";
		}

		if(cliente == 0){
			cliente = "";
		}		

		
		$('#id').val(id);
		$('#data_entrega').val(data_entrega);
		$('#cliente').val(cliente).change();
		//$('#dias_validade').val(dias_validade);
		$('#valor').val(valor);
		$('#desconto').val(desconto);
		$('#tipo_desconto').val(tipo_desconto).change();
		$('#subtotal').val(subtotal);
		$('#frete').val(frete);
		$('#obs').val(obs);	

		$('#tecnico').val(tecnico).change();	
		$('#equipamento').val(equipamento);
		$('#situacao').val(situacao);
		$('#mao_obra').val(mao_obra);
		$('#acessorios').val(acessorios);
		$('#condicoes').val(condicoes);
		$('#laudo').val(laudo);	


		$('#laboratorio').val(laboratorio);	
		$('#pedido').val(pedido);	
		$('#doutor').val(doutor);	

		$('#longe1').val(longe1);
		$('#longe2').val(longe2);
		$('#longe3').val(longe3);
		$('#longe4').val(longe4);
		$('#longe5').val(longe5);
		$('#longe6').val(longe6);
		$('#longe7').val(longe7);
		$('#longe8').val(longe8);
		$('#longe9').val(longe9);
		$('#longe10').val(longe10);
		$('#longe11').val(longe11);
		$('#longe12').val(longe12);

		$('#perto1').val(perto1);
		$('#perto2').val(perto2);
		$('#perto3').val(perto3);
		$('#perto4').val(perto4);
		$('#perto5').val(perto5);
		$('#perto6').val(perto6);
		$('#perto7').val(perto7);
		$('#perto8').val(perto8);

		$('#lente').val(lente);
		$('#cotico').val(cotico);
		$('#altura').val(altura);
		$('#cor').val(cor);
		$('#retificacao').val(retificacao);
		


		listarProdutos(orcamento);
		listarServicos(orcamento);
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
		$('#obs').val('');
		$('#dias_validade').val('');
		$('#tecnico').val('').change();	
		$('#equipamento').val('');
		$('#situacao').val('');
		$('#mao_obra').val('');
		$('#acessorios').val('');
		$('#condicoes').val('');
		$('#laudo').val('');
		listarServicos()
		listarProdutos()
		totalizar()


		$('#laboratorio').val('');	
		$('#pedido').val('');	
		$('#doutor').val('');


		$('#longe1').val('');
		$('#longe2').val('');
		$('#longe3').val('');
		$('#longe4').val('');
		$('#longe5').val('');
		$('#longe6').val('');
		$('#longe7').val('');
		$('#longe8').val('');
		$('#longe9').val('');
		$('#longe10').val('');
		$('#longe11').val('');
		$('#longe12').val('');

		$('#perto1').val('');
		$('#perto2').val('');
		$('#perto3').val('');
		$('#perto4').val('');
		$('#perto5').val('');
		$('#perto6').val('');
		$('#perto7').val('');
		$('#perto8').val('');

		$('#lente').val('');
		$('#cotico').val('');
		$('#altura').val('');
		$('#cor').val('');
		$('#retificacao').val('');
	

	}


	


	function arquivo(id, nome){
    $('#id-arquivo').val(id);    
    $('#nome-arquivo').text(nome);
    $('#modalArquivos').modal('show');
    $('#mensagem-arquivo').text(''); 
    listarArquivos();   
}


	function status(id, status){

    $('#id_da_os').val(id);   
    $('#id_status').val(status);   
    $('#modalStatus').modal('show');
    $('#mensagem-status').text(''); 
     
}


</script>



