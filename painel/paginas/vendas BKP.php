<?php 
$pag = 'vendas';

//verificar se ele tem a permissão de estar nessa página
if(@$vendas == 'ocultar'){
    echo "<script>window.location='../index.php'</script>";
    exit();
}
 ?>
<div class="margin_mobile">
	<div class="row">
		<?php 
		$query = $pdo->query("SELECT * from categorias where ativo = 'Sim' order by id asc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$linhas = @count($res);
if($linhas > 0){
	for($i=0; $i<$linhas; $i++){
	$id = $res[$i]['id'];
	$nome = $res[$i]['nome'];	
	$foto = $res[$i]['foto'];	
	$ativo = $res[$i]['ativo'];

	$nomeF = mb_strimwidth($nome, 0, 16, "..."); 
	
	//totalizar produtos
	$query2 = $pdo->query("SELECT * from produtos where categoria = '$id' and estoque > 0 and ativo = 'Sim'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
$produtos = @count($res2);
if($produtos > 0){
?>

<a href="#" onclick="listar('<?php echo $id ?>')">
<div class="col-md-3 widget" style="margin-right: 5px; margin-bottom: 5px; ">			<div class="r3_counter_box" style="min-height: 60px; padding:10px">
				<i class="pull-left fa " style="background-image:url('images/categorias/<?php echo $foto ?>'); background-size: cover;"></i>
				<div class="stats">
					<h5 style="font-size:14px"><strong><?php echo $nomeF ?>	</strong></h5>
					<span style="font-size:13px"><?php echo $produtos ?> Produtos</span>
					</div>	
			</div>
</div>
 </a>
<?php } } } else{ echo 'Cadastre uma Categoria!'; } ?>

	</div>
</div>


<br>
<span id="area_cat" style="margin-right: 25px">
<small><b>Produtos Categoria:</b> <span id="nome_categoria"></span></small> 
</span>
<span>
<i class="fa fa-search"></i>	
<input style="width:170px; background: none; border:none; border-bottom: 1px solid #000; font-size:14px" type="text" name="txt_buscar" id="txt_buscar" placeholder="Buscar Qualquer Produto" onkeyup="buscar()" >
</span>

<div style="margin-top: 5px" id="listar">

</div>




<div class="modal fade" id="modalForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="exampleModalLabel"><span id="titulo_inserir"></span></h4>
				<button id="btn-fechar" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -25px">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="form_venda">
			<div class="modal-body">
				

					<div class="row">
						<div class="col-md-6" style="font-size: 14px">
							<div class="col-md-6">							
								<label>Quantidade</label>
								<input type="number" class="form-control" id="quantidade" name="quantidade" value="1" style="height:32px">							
							</div>
							<div class="col-md-6">	
								<a title="ADD a Venda" href="#" onclick="addVenda()" class="btn btn-primary" style="margin-top:22px; height:32px"><i class="fa fa-plus"></i></a>
							</div>

							<div class="col-md-12" style="margin-top: 8px">
								
								<label>Cliente</label> 
								<select class="form-control sel2" name="cliente" id="cliente" style="width:100%; height:32px"> 

									<option value="">Selecionar Cliente</option>

									<?php 
									$query = $pdo->query("SELECT * FROM clientes order by nome asc");
									$res = $query->fetchAll(PDO::FETCH_ASSOC);
									for($i=0; $i < @count($res); $i++){
										foreach ($res[$i] as $key => $value){}

											?>	
										<option value="<?php echo $res[$i]['id'] ?>"><?php echo $res[$i]['nome'] ?></option>

									<?php } ?>

								</select>
										
							</div>


							<div class="col-md-12" style="margin-top: 8px">						
							
								<label>Forma de Pagamento</label> 
								<select class="form-control" name="saida" id="saida" style="width:100%; height:32px"> 
									<?php 
									$query = $pdo->query("SELECT * FROM formas_pgto order by id asc");
									$res = $query->fetchAll(PDO::FETCH_ASSOC);
									for($i=0; $i < @count($res); $i++){
										foreach ($res[$i] as $key => $value){}

											?>	
										<option value="<?php echo $res[$i]['nome'] ?>"><?php echo $res[$i]['nome'] ?></option>

									<?php } ?>

								</select>
											
						</div>

						<div class="col-md-6" style="margin-top: 8px">						
								<label>Desconto R$</label>
								<input type="number" class="form-control" id="desconto" name="desconto" onkeyup="listarVendas()" style="height:32px">						
							</div>

							<div class="col-md-6" style="margin-top: 8px">					
								<label>Troco Para</label>
								<input type="number" class="form-control" id="troco" name="troco" onkeyup="listarVendas()" style="height:32px">						
							</div>

							<div class="col-md-12" style="margin-top: 8px">
							<label>Data Pagamento</label>
								<input type="date" class="form-control" id="data" name="data" value="<?php echo $data_atual ?>" style="height:32px">
						</div>



							<div class="col-md-12" style="margin-top: 8px">
								
									<label>Vendedor</label> 
									<select class="form-control sel3" name="vendedor" id="vendedor" required style="width:100%; height:32px" required>
									<option value="">Selecionar Vendedor</option>
									<option value="0">Nenhum</option>		
									<?php 
									$query = $pdo->query("SELECT * FROM usuarios where nivel != 'Cliente' and nivel != 'Administrador' order by id asc");
									$res = $query->fetchAll(PDO::FETCH_ASSOC);
									for($i=0; $i < @count($res); $i++){
										foreach ($res[$i] as $key => $value){}

											?>	
										<option value="<?php echo $res[$i]['id'] ?>"><?php echo $res[$i]['nome'] ?></option>

									<?php } ?>

								</select>
							
							</div>



							

						</div>



						<div class="col-md-6" id="listar_vendas">
							
						</div>							
						
						
					</div>

					<div class="row">						

						<div class="col-md-12" style="margin-top: -10px" align="right">
							<button id="btn_limpar" onclick="limparVenda()" type="button" class="btn btn-danger">Limpar Venda</button>							

								<button id="btn_venda" type="submit" class="btn btn-success">Fechar Venda</button>
					<img id="img_loading" src="../img/loading.gif" width="40px" style="display:none">
							</div>
					</div>

					
					<input type="hidden" class="form-control" id="id" name="id">	
								

				<br>
				<small><div id="mensagem" align="center"></div></small>
			</div>		    
					
				
			
			</form>
		</div>
	</div>
</div>




<script type="text/javascript">var pag = "<?=$pag?>"</script>
<script src="js/ajax.js"></script>

<script type="text/javascript">
	$(document).ready(function() {		

				$('.sel2').select2({
					dropdownParent: $('#modalForm')
				});

				$('.sel3').select2({
					dropdownParent: $('#modalForm')
				});
			});
</script>

<script type="text/javascript">	

$("#form_venda").submit(function () {

	$("#btn_venda").hide();
	$("#btn_limpar").hide();
		$("#img_loading").show();


    event.preventDefault();

    var data = $("#data").val();
    var cliente = $("#cliente").val();
    var data_atual = "<?=$data_atual?>";

    if(data > data_atual && cliente == ""){
    	alert('Você precisa selecionar um cliente para essa venda!');
    	$("#img_loading").hide();
    	$("#btn_venda").show();
    	return;
    }

    
    var formData = new FormData(this);

    $.ajax({
        url: 'paginas/' + pag + "/salvar.php",
        type: 'POST',
        data: formData,

        success: function (mensagem) {        	
        	var msg = mensagem.split("-");        	
        	
            $('#mensagem').text('');
            $('#mensagem').removeClass()
            if (msg[0].trim() == "Salvo com Sucesso") {
            	$("#img_loading").hide();
                $('#btn-fechar').click();
                $('#desconto').val('');
                $('#troco').val('');
                $('#cliente').val('').change();
                $('#data').val('<?=$data_atual?>');
                listar(); 
                //verificar abertura comprovante
            	var imp_auto = "<?=$impressao_automatica?>";
            	if(imp_auto == 'Sim'){
            		window.open('rel/comprovante.php?id='+msg[1])
            	}else{
            		alert('Venda Efetuada!');
            	}
            } else {
            	alert(msg[0]);               
                $("#btn_venda").show();
					$("#img_loading").hide();
					$("#btn_limpar").show();
            }

            $("#btn_venda").show();
            $("#btn_limpar").show();

        },

        cache: false,
        contentType: false,
        processData: false,

    });

});

function buscar(){
	var busca = $('#txt_buscar').val();
	listar('', busca)
}

function addVenda(){
	var quantidade = $('#quantidade').val();
	var id_produto = $('#id').val();	

	if(quantidade <= 0){
		alert('A quantidade deve ser maior que zero')
		return;
	}
	
    $.ajax({
        url: 'paginas/' + pag + "/inserir_item.php",
        method: 'POST',
        data: {quantidade, id_produto},
        dataType: "html",

        success:function(mensagem){
            if (mensagem.trim() == "Inserido com Sucesso") {  
            	listarVendas();

            }else{
            	alert(mensagem)
            }
        }
    });


	
}

function listarVendas(){
	var desconto = $("#desconto").val();	
	var troco = $("#troco").val();	
	$.ajax({
        url: 'paginas/' + pag + "/listar_vendas.php",
        method: 'POST',
        data: {desconto, troco},
        dataType: "html",

        success:function(result){
            $("#listar_vendas").html(result);            
        }
    });
}

function limparVenda(){
	$("#cliente").val('').change();
	$("#quantidade").val('1');
	$("#desconto").val('');
	$("#troco").val('');
	$("#data").val('<?=$data_atual?>');

	$("#btn_limpar").hide();		
	$.ajax({
        url: 'paginas/' + pag + "/limpar_venda.php",
        method: 'POST',
        data: {},
        dataType: "html",

        success:function(result){        	
            listarVendas();      
        }
    });
    
}
</script>