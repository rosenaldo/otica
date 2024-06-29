<?php 
$tabela = 'produtos';
require_once("../../../conexao.php");

$id = @$_POST['p1'];
$busca = @$_POST['p2'];

$id_cat = @$_POST['p1'];

if($id == ""){
	$query = $pdo->query("SELECT * from categorias where ativo = 'Sim' order by id asc limit 1");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$id = $res[0]['id'];
$nome_cat = $res[0]['nome'];
}else{
	$query = $pdo->query("SELECT * from categorias where id = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$nome_cat = $res[0]['nome'];
}

if($busca == ""){
	$query = $pdo->query("SELECT * from $tabela where categoria = '$id' and ativo = 'Sim' order by id asc");
}else{
	$query = $pdo->query("SELECT * from $tabela where nome LIKE '%$busca%' and ativo = 'Sim' order by id asc");
}

$res = $query->fetchAll(PDO::FETCH_ASSOC);
$linhas = @count($res);
if($linhas > 0){
	for($i=0; $i<$linhas; $i++){
	$id = $res[$i]['id'];
	$nome = $res[$i]['nome'];	
	$valor_venda = $res[$i]['valor_venda'];	
	$estoque = $res[$i]['estoque'];			
	$foto = $res[$i]['foto'];
	$categoria = $res[$i]['categoria'];	
		
	$valor_vendaF = number_format($valor_venda, 2, ',', '.'); 
	$nomeF = mb_strimwidth($nome, 0, 20, "..."); 

	if($estoque <= 0){
		$ocultar_card = 'ocultar';
	}else{
		$ocultar_card = '';
	}

	$query2 = $pdo->query("SELECT * from categorias where id = '$categoria'");
	$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
	$cat_ativo = $res2[0]['ativo'];	

	if($cat_ativo == 'Sim'){
	
echo <<<HTML
<a href="#" onclick="produto('{$id}', '{$nome}', '$valor_venda')">
<div class="col-md-3 widget {$ocultar_card}" style="margin-right: 5px; margin-bottom: 5px; ">			<div class="r3_counter_box" style="min-height: 60px; padding:10px">
				<i class="pull-left fa " style="background-image:url('images/produtos/{$foto}'); background-size: cover;"></i>
				<div class="stats">
					<h5 style="font-size:12px"><strong>{$nomeF}	</strong></h5>
					<span><span style="color:red; font-size:12px">R$ {$valor_vendaF}</span> <span class="" style="color:#000; font-size:11px">({$estoque}) Itens</span></span>
					</div>	
			</div>
</div>
 </a>
HTML;
}
}
}else{
	echo '<small>Nenhum Produto Encontrado!</small>';
}
?>


<script type="text/javascript">
	$(document).ready( function () {	

	$('#nome_categoria').text('<?=$nome_cat?>')

	var busca = $('#txt_buscar').val();
	var id_cat = '<?=$id_cat?>';

	if(id_cat != ""){
		$('#txt_buscar').val('');
	}

	if(busca != ""){
		$('#area_cat').hide();
	}else{
		$('#area_cat').show();
	}

	});

	function produto(id, nome, valor){

		$('#mensagem').text('');
    	$('#titulo_inserir').text('Venda: '+nome);
    	
    	$('#id').val(id);     	
    	$('#quantidade').val('1');
    	
    	$('#modalForm').modal('show');
    	listarVendas();
	}
</script>