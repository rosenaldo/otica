<?php 
$tabela = 'clientes';
require_once("../../../conexao.php");

$query = $pdo->query("SELECT * from $tabela order by id desc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$linhas = @count($res);
if($linhas > 0){
echo <<<HTML
<small>
	<table class="table table-hover" id="tabela">
	<thead> 
	<tr> 
	<th>Nome</th>	
	<th class="esc">Telefone</th>	
	<th class="esc">Telefone Sec</th>	
	<th class="esc">Pessoa</th>	
	<th class="esc">CPF / CNPJ</th>
	<th class="esc">Cadastrado Em</th>		
	<th>Ações</th>
	</tr> 
	</thead> 
	<tbody>	
HTML;

for($i=0; $i<$linhas; $i++){
	$id = $res[$i]['id'];
	$nome = $res[$i]['nome'];
	$telefone = $res[$i]['telefone'];
	$telefone2 = $res[$i]['telefone2'];	
	$endereco = $res[$i]['endereco'];
	$cpf = $res[$i]['cpf'];
	$pessoa = $res[$i]['pessoa'];
	$data = $res[$i]['data'];

	$dataF = implode('/', array_reverse(@explode('-', $data)));

	$tel_pessoaF = '55'.preg_replace('/[ ()-]+/' , '' , $telefone);

	//verificar débitos cliente
	$query2 = $pdo->query("SELECT * from receber where cliente = '$id' and data_venc < curDate() and pago != 'Sim'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
$linhas2 = @count($res2);
if($linhas2 > 0){
	$debito = 'text-danger';
}else{
	$debito = '';
}

echo <<<HTML
<tr>
<td class="{$debito}">
<input type="checkbox" id="seletor-{$id}" class="form-check-input" onchange="selecionar('{$id}')">
{$nome}
</td>
<td class="esc">{$telefone}</td>
<td class="esc">{$telefone2}</td>
<td class="esc">{$pessoa}</td>
<td class="esc">{$cpf}</td>
<td class="esc">{$dataF}</td>
<td>
	<big><a href="#" onclick="editar('{$id}','{$nome}','{$telefone}','{$telefone2}','{$pessoa}','{$cpf}','{$endereco}')" title="Editar Dados"><i class="fa fa-edit text-primary"></i></a></big>

	<li class="dropdown head-dpdn2" style="display: inline-block;">
		<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><big><i class="fa fa-trash-o text-danger"></i></big></a>

		<ul class="dropdown-menu" style="margin-left:-230px;">
		<li>
		<div class="notification_desc2">
		<p>Confirmar Exclusão? <a href="#" onclick="excluir('{$id}')"><span class="text-danger">Sim</span></a></p>
		</div>
		</li>										
		</ul>
</li>

<big><a href="#" onclick="mostrar('{$nome}','{$telefone}','{$telefone2}','{$endereco}','{$pessoa}','{$dataF}', '{$cpf}', '{$id}')" title="Mostrar Dados"><i class="fa fa-info-circle text-primary"></i></a></big>

<big><a href="#" onclick="mostrarContas('{$nome}','{$id}')" title="Mostrar Contas"><i class="fa fa-money text-verde"></i></a></big>

<big><a class="" href="http://api.whatsapp.com/send?1=pt_BR&phone={$tel_pessoaF}" title="Whatsapp" target="_blank"><i class="fa fa-whatsapp " style="color:green"></i></a></big>


<big><a href="#" onclick="arquivo('{$id}', '{$nome}')" title="Inserir / Ver Arquivos"><i class="fa fa-file-o " style="color:#22146e"></i></a></big>


</td>
</tr>
HTML;

}

}else{
	echo '<small>Não possui nenhum cadastro!</small>';
}


echo <<<HTML
</tbody>
<small><div align="center" id="mensagem-excluir"></div></small>
</table>
HTML;
?>



<script type="text/javascript">
	$(document).ready( function () {		
    $('#tabela').DataTable({
    	"language" : {
            //"url" : '//cdn.datatables.net/plug-ins/1.13.2/i18n/pt-BR.json'
        },
        "ordering": false,
		"stateSave": true
    });
} );
</script>

<script type="text/javascript">
	function editar(id, nome, telefone, telefone2, pessoa, cpf, endereco){
		$('#mensagem').text('');
    	$('#titulo_inserir').text('Editar Registro');

    	$('#id').val(id);
    	$('#nome').val(nome);
    	$('#telefone').val(telefone);
    	$('#telefone2').val(telefone2);
    	$('#endereco').val(endereco);
    	$('#pessoa').val(pessoa).change();
    	$('#cpf').val(cpf);

    	$('#modalForm').modal('show');
	}


	function mostrar(nome, telefone, telefone2, endereco, pessoa, data, cpf, id){
		    	
    	$('#titulo_dados').text(nome);
    	$('#telefone_dados').text(telefone);
    	$('#telefone2_dados').text(telefone2);
    	$('#endereco_dados').text(endereco);
    	$('#pessoa_dados').text(pessoa);
    	$('#data_dados').text(data);
    	$('#cpf_dados').text(cpf);
    	    	

    	$('#modalDados').modal('show');
    	//listarDebitos(id);
    	listarServicos(id);
	}

	function limparCampos(){
		$('#id').val('');
    	$('#nome').val('');
    	$('#cpf').val('');
    	$('#telefone').val('');
    	$('#telefone2').val('');
    	$('#endereco').val('');

    	$('#ids').val('');
    	$('#btn-deletar').hide();	
	}

	function selecionar(id){

		var ids = $('#ids').val();

		if($('#seletor-'+id).is(":checked") == true){
			var novo_id = ids + id + '-';
			$('#ids').val(novo_id);
		}else{
			var retirar = ids.replace(id + '-', '');
			$('#ids').val(retirar);
		}

		var ids_final = $('#ids').val();
		if(ids_final == ""){
			$('#btn-deletar').hide();
		}else{
			$('#btn-deletar').show();
		}
	}

	function deletarSel(){
		var ids = $('#ids').val();
		var id = ids.split("-");
		
		for(i=0; i<id.length-1; i++){
			excluir(id[i]);			
		}

		limparCampos();
	}


	function listarDebitos(id){


		 $.ajax({
        url: 'paginas/' + pag + "/listar_debitos.php",
        method: 'POST',
        data: {id},
        dataType: "html",

        success:function(result){
            $("#listar_debitos").html(result);           
        }
    });
	}


	function mostrarContas(nome, id){
		    	
    	$('#titulo_contas').text(nome); 
    	$('#id_contas').val(id); 	
    	    	
    	$('#modalContas').modal('show');
    	listarDebitos(id);
    	
	}


		function listarServicos(id){
		 $.ajax({
        url: 'paginas/' + pag + "/listar_servicos.php",
        method: 'POST',
        data: {id},
        dataType: "html",

        success:function(result){
            $("#listar_servicos").html(result);           
        }
    });
	}



	function arquivo(id, nome){
    $('#id-arquivo').val(id);    
    $('#nome-arquivo').text(nome);
    $('#modalArquivos').modal('show');
    $('#mensagem-arquivo').text(''); 
    listarArquivos();   
}



</script>