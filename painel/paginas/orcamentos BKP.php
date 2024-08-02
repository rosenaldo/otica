<?php 
$pag = 'orcamentos';

//verificar se ele tem a permissão de estar nessa página
if(@$orcamentos == 'ocultar'){
    echo "<script>window.location='../index.php'</script>";
    exit();
}
?>


<div class="row margem_mobile">
	<div class="col-md-10">
		
		<div style="float:left; margin-right:35px">
			<button onclick="inserir()" type="button" class="btn btn-primary btn-flat btn-pri"><i class="fa fa-plus" aria-hidden="true"></i>Vendas</button>
		</div>
		<div style="float:left; margin-right:35px">
		    <a href="vendas" class="btn btn-primary btn-flat btn-pri" role="button"> <i class="fa fa-plus" aria-hidden="true"></i> Testando Vendas</a>
		</div>

		<form method="POST" action="rel/lista_orcamentos_class.php" target="_blank">
		<div class="esc" style="float:left; margin-right:10px"><span><small><i title="Data de Vencimento Inicial" class="fa fa-calendar-o"></i></small></span>
		</div>
		<div class="esc" style="float:left; margin-right:20px">
			<input type="date" class="form-control " name="dataInicial" id="dataInicial" value="<?php echo date('Y-m-d') ?>" required onchange="buscar()">
		</div>

		<div class="esc" style="float:left; margin-right:10px"><span><small><i title="Data de Vencimento Final" class="fa fa-calendar-o"></i></small></span></div>
		<div class="esc" style="float:left; margin-right:30px">
			<input type="date" class="form-control " name="dataFinal"  id="dataFinal" value="<?php echo date('Y-m-d') ?>" required onchange="buscar()">
		</div>


		<div class="esc" style="float:left; margin-right:10px"><span><small><i title="Filtrar por Status" class="bi bi-search"></i></small></span></div>
		<div class="esc" style="float:left; margin-right:20px">
			<select class="form-control" aria-label="Default select example" name="status" id="status" onchange="buscar()">
				<option value="">Todos</option>
				 <option value="Pendente">Pendentes</option> -->
				<option value="Aprovado">Aprovados</option>
				
			</select>
		</div>

		<button class="btn btn-success esc botao_rel" type="submit">Relatório</button>

	</form>




		

		
	</div>

	<div align="right" class="col-md-2">
		<small><i class="fa fa-check text-danger"></i> <span class="text-dark">Pendentes: <span class="text-danger" id="total_itens"></span></span></small>
	</div>

	
</div>


<div class="bs-example widget-shadow" style="padding:15px" id="listar">
	
</div>




<!-- Modal -->
<div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static">
	<div class="modal-dialog modal-lg" role="document" style="width:85%">
		<div class="modal-content">
			
			<form method="post" id="form_orcamento">
				<div class="modal-body">

						<button id="btn-fechar" type="button" class="close" data-dismiss="modal" aria-label="Close" style="position:absolute; top: 5px; right:5px">
					<span aria-hidden="true">&times;</span>
				</button>

					<div class="row" style="margin-top: 5px">					
						<div class="col-md-5">						
							<div class="form-group"> 
								<label>Cliente</label> 
									<div id="listar_clientes">
									
									</div>
							</div>		
						</div>

						<div class="col-md-1" style="margin-top: 22px; margin-left: -10px">
							<button id="btn_cliente" type="button" data-toggle="modal" data-target="#modalCliente" class="btn btn-primary"> <i class="fa fa-plus"></i> </button>	
						</div>


						<div class="col-md-3">						
							<div class=""> 
								<label>Produtos / <small>R$ <span id="tot_produtos"></span></small></label> 
								<select class="sel2" name="produto" id="produto"  style="width:80%;"> 
									<option value="">Adicionar Produto</option>
									<?php 
									$query = $pdo->query("SELECT * FROM produtos where ativo = 'Sim' order by id asc");
									$res = $query->fetchAll(PDO::FETCH_ASSOC);
									for($i=0; $i < @count($res); $i++){
										foreach ($res[$i] as $key => $value){}

											?>	
										<option value="<?php echo $res[$i]['id'] ?>"><?php echo $res[$i]['nome'] ?></option>

									<?php } ?>

								</select>

								<a class="btn btn-success" href="#" onclick="addProduto()" class="btn btn-primary"> <i class="fa fa-check"></i> </a>
							</div>						
						</div>

						


						<div class="col-md-3">						
							<div class=""> 
								<label>Serviços / <small>R$ <span id="tot_servicos"></span></small></label> 
								
								<select class="sel2" name="servico" id="servico"  style="width:80%;"> 
									<option value="">Adicionar Serviço</option>
									<?php 
									$query = $pdo->query("SELECT * FROM servicos where ativo = 'Sim' order by id asc");
									$res = $query->fetchAll(PDO::FETCH_ASSOC);
									for($i=0; $i < @count($res); $i++){
										foreach ($res[$i] as $key => $value){}

											?>	
										<option value="<?php echo $res[$i]['id'] ?>"><?php echo $res[$i]['nome'] ?></option>

									<?php } ?>

								</select>

								<a class="btn btn-success" href="#" onclick="addServico()" class="btn btn-primary"> <i class="fa fa-check"></i> </a>
							</div>						
						</div>

					
					</div>

				

					
					<div id="div_listar" class="row" style="margin-top: 0px; margin-bottom: 10px; overflow: scroll; height:auto; max-height: 250px; scrollbar-width: thin;">
						<div class="col-md-12" id="listar_produtos">	
						</div>

						<div class="col-md-12" id="listar_servicos">	
						</div>
					</div>

					

					<div class="row" style="margin-top: 0px">	

						<div class="col-md-2">						
							<div class="form-group"> 
								<label>Data Entrega</label> 
								<input class="form-control" type="date" name="data_entrega" id="data_entrega" required>
							</div>						
						</div>

						<!-- <div class="col-md-2">						
							<div class="form-group"> 
								<label>Validade</label> 
								<input class="form-control" type="number" name="dias_validade" id="dias_validade" placeholder="5 Dias" required>
							</div>						
						</div> -->

						<div class="col-md-2">						
							<div class="form-group"> 
								<label>Valor</label> 
								<input class="form-control" type="text" name="valor" id="valor" readonly>
							</div>						
						</div>

						<div class="col-md-2">						
							<div class="form-group"> 
								<label>Tipo Desconto</label> 
								<select class="form-control"  name="tipo_desconto" id="tipo_desconto" onchange="totalizar()">
									<option value="%">% Porcentagem</option>
									<option value="Valor">R$ Valor</option>
								</select>
							</div>						
						</div>					

						<div class="col-md-2">						
							<div class="form-group"> 
								<label>Desconto</label> 
								<input class="form-control" type="number" name="desconto" id="desconto"  onkeyup="totalizar()">
							</div>						
						</div>

						<div class="col-md-2">						
							<div class="form-group"> 
								<label>Valor de entrada</label> 
								<input class="form-control" type="number" name="valor_entrada" id="valor_entrada"  onkeyup="totalizar()">
							</div>						
						</div>

						
						<div class="col-md-2">						
							<div class="form-group"> 
								<label>SubTotal</label> 
								<input class="form-control" type="text" name="subtotal" id="subtotal" readonly >
							</div>						
						</div>

						<div class="col-md-2">					
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


					</div>	

					<div class="row" style="margin-top: 0px">

						<div class="col-md-2">						
							<div class="form-group"> 
								<label>Frete</label> 
								<input class="form-control" type="text" name="frete" id="frete" placeholder="Se Houver" onkeyup="totalizar()">
							</div>						
						</div>	

					<div class="col-md-8">						
							<div class="form-group"> 
								<label>OBS</label> 
								<input class="form-control" type="text" name="obs" id="obs">
							</div>						
						</div>	

						<div class="col-md-2" style="margin-top: 22px">						
							<button id="btn_salvar" type="submit" class="btn btn-primary">Salvar</button>					
						</div>		
					</div>	
					

					<br>
					<input type="hidden" name="id" id="id"> 
					<small><div id="mensagem" align="center" class="mt-3"></div></small>					

				</div>


			</form>

		</div>
	</div>
</div>




<!-- Modal Cliente -->
<div class="modal fade" id="modalCliente" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="exampleModalLabel">Novo Cliente</h4>
				<button id="btn-fechar-cliente" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -25px">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="form-cliente">
			<div class="modal-body">
				

					<div class="row">
						<div class="col-md-8">							
								<label>Nome</label>
								<input type="text" class="form-control" id="nome" name="nome" placeholder="Seu Nome" required>							
						</div>
						
						<div class="col-md-4">						
								<label>Pessoa</label>
								<select class="form-control" name="pessoa" id="pessoa" onchange="mudarPessoa()">
									<option value="Física">Física</option>
									<option value="Jurídica">Jurídica</option>
								</select>						
						</div>
						
					</div>


					<div class="row">

						<div class="col-md-4">							
								<label id="label_pessoa">CPF</label>
								<input type="text" class="form-control" id="cpf" name="cpf" placeholder="CPF" >							
						</div>

						<div class="col-md-4">							
								<label>Telefone</label>
								<input type="text" class="form-control" id="telefone" name="telefone" placeholder="Telefone" required>							
						</div>
						

						<div class="col-md-4">							
								<label>Telefone Secundário</label>
								<input type="text" class="form-control" id="telefone2" name="telefone2" placeholder="Outro Telefone para Contato">							
						</div>


						
					</div>

					<div class="row">

						<div class="col-md-12">							
								<label>Endereço</label>
								<input type="text" class="form-control" id="endereco" name="endereco" placeholder="Seu Endereço" >							
						</div>
					</div>
				<input type="hidden" class="form-control" name="id">
					
				<br>
				<small><div id="mensagem_cliente" align="center"></div></small>
			</div>
			<div class="modal-footer">       
				<button type="submit" id="btn_salvar_cliente" class="btn btn-primary">Salvar</button>
			</div>
			</form>
		</div>
	</div>
</div>


	<!-- Modal Arquivos -->
	<div class="modal fade" id="modalArquivos" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="tituloModal">Gestão de Arquivos - <span id="nome-arquivo"> </span></h4>
					<button id="btn-fechar-arquivos" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form id="form-arquivos" method="post">
					<div class="modal-body">

						<div class="row">
							<div class="col-md-8">						
								<div class="form-group"> 
									<label>Arquivo</label> 
									<input class="form-control" type="file" name="arquivo_conta" onChange="carregarImgArquivos();" id="arquivo_conta">
								</div>	
							</div>
							<div class="col-md-4" style="margin-top:-10px">	
								<div id="divImgArquivos">
									<img src="images/arquivos/sem-foto.png"  width="60px" id="target-arquivos">									
								</div>					
							</div>




						</div>

						<div class="row" style="margin-top:-40px">
							<div class="col-md-8">
								<input type="text" class="form-control" name="nome-arq"  id="nome-arq" placeholder="Nome do Arquivo * " required>
							</div>

							<div class="col-md-4">										 
								<button type="submit" class="btn btn-primary">Inserir</button>
							</div>
						</div>

						<hr>

						<small><div id="listar-arquivos"></div></small>

						<br>
						<small><div align="center" id="mensagem-arquivo"></div></small>

						<input type="hidden" class="form-control" name="id-arquivo"  id="id-arquivo">


					</div>
				</form>
			</div>
		</div>


		<form id="form_rel" method="POST" action="rel/orcamento_class.php" target="_blank" style="display:none">
			<input type="text" name="id" id="id_orca">
			<input type="text" name="enviar" id="enviar_rel">
			<button type="submit" id="botao_disparar_rel">Enviar</button>
		</form>


		<script type="text/javascript">var pag = "<?=$pag?>"</script>
		<script src="js/ajax.js"></script>

		<script type="text/javascript">
			$(document).ready(function() {

				$('.sel2').select2({
					dropdownParent: $('#modalForm')
				});
				listarClientes();
				listarProdutos();
				listarServicos();

				buscar();

			});
		</script>

		<script type="text/javascript">
			function carregarImgArquivos() {
				var target = document.getElementById('target-arquivos');
				var file = document.querySelector("#arquivo_conta").files[0];

				var arquivo = file['name'];
				resultado = arquivo.split(".", 2);

				if(resultado[1] === 'pdf'){
					$('#target-arquivos').attr('src', "images/pdf.png");
					return;
				}

				if(resultado[1] === 'rar' || resultado[1] === 'zip'){
					$('#target-arquivos').attr('src', "images/rar.png");
					return;
				}

				if(resultado[1] === 'doc' || resultado[1] === 'docx' || resultado[1] === 'txt'){
					$('#target-arquivos').attr('src', "images/word.png");
					return;
				}


				if(resultado[1] === 'xlsx' || resultado[1] === 'xlsm' || resultado[1] === 'xls'){
					$('#target-arquivos').attr('src', "images/excel.png");
					return;
				}


				if(resultado[1] === 'xml'){
					$('#target-arquivos').attr('src', "images/xml.png");
					return;
				}



				var reader = new FileReader();

				reader.onloadend = function () {
					target.src = reader.result;
				};

				if (file) {
					reader.readAsDataURL(file);

				} else {
					target.src = "";
				}
			}
		</script>




		<script type="text/javascript">
			$("#form-arquivos").submit(function () {
				event.preventDefault();
				var formData = new FormData(this);

				$.ajax({
					url: 'paginas/' + pag + "/arquivos.php",
					type: 'POST',
					data: formData,

					success: function (mensagem) {
						$('#mensagem-arquivo').text('');
						$('#mensagem-arquivo').removeClass()
						if (mensagem.trim() == "Inserido com Sucesso") {                    
						//$('#btn-fechar-arquivos').click();
						$('#nome-arq').val('');
						$('#arquivo_conta').val('');
						$('#target-arquivos').attr('src','images/arquivos/sem-foto.png');
						listarArquivos();
					} else {
						$('#mensagem-arquivo').addClass('text-danger')
						$('#mensagem-arquivo').text(mensagem)
					}

				},

				cache: false,
				contentType: false,
				processData: false,

			});

			});
		</script>

		<script type="text/javascript">
			function listarArquivos(){
				var id = $('#id-arquivo').val();	
				$.ajax({
					url: 'paginas/' + pag + "/listar-arquivos.php",
					method: 'POST',
					data: {id},
					dataType: "text",

					success:function(result){
						$("#listar-arquivos").html(result);
					}
				});
			}

		</script>




<script type="text/javascript">
	

$("#form-cliente").submit(function () {

    $('#mensagem_cliente').text('Carregando!!');
    $('#btn_salvar_cliente').hide();

    event.preventDefault();
    var formData = new FormData(this);
    var nova_pag = 'clientes';

    $.ajax({
        url: 'paginas/' + nova_pag + "/salvar.php",
        type: 'POST',
        data: formData,

        success: function (mensagem) {
            $('#mensagem_cliente').text('');
            $('#mensagem_cliente').removeClass()
            if (mensagem.trim() == "Salvo com Sucesso") {

                $('#btn-fechar-cliente').click();
                listar();
                listarClientes('1');          

            } else {

                $('#mensagem_cliente').addClass('text-danger')
                $('#mensagem_cliente').text(mensagem)
            }

             $('#btn_salvar_cliente').show();

        },

        cache: false,
        contentType: false,
        processData: false,

    });

});


function listarClientes(valor){
	$.ajax({
        url: 'paginas/' + pag + "/listar_clientes.php",
        method: 'POST',
        data: {valor},
        dataType: "html",

        success:function(result){
            $("#listar_clientes").html(result);           
        }
    });
}

function addProduto(){
	var id = $("#id").val();
	var produto = $("#produto").val();
	if(produto == ""){
		alert('Selecione um produto');
		return;
	}
	$.ajax({
        url: 'paginas/' + pag + "/addProduto.php",
        method: 'POST',
        data: {produto, id},
        dataType: "html",

        success:function(result){
           listarProdutos();        
        }
    });
}

function listarProdutos(){	
	totalizar();
	var id = $("#id").val();
	$.ajax({
        url: 'paginas/' + pag + "/listar_produtos.php",
        method: 'POST',
        data: {id},
        dataType: "html",

        success:function(result){        	
           $("#listar_produtos").html(result);      
        }
    });
}


function quantidadeProdutos(id){		
	var quant = $("#quant_produtos_"+id).val();	
	$.ajax({
        url: 'paginas/' + pag + "/quantidade_produtos.php",
        method: 'POST',
        data: {id, quant},
        dataType: "html",

        success:function(result){             	
           listarProdutos();    
        }
    });
}


function excluirProduto(id){
	$.ajax({
        url: 'paginas/' + pag + "/excluir_produto.php",
        method: 'POST',
        data: {id},
        dataType: "html",

        success:function(result){             	
           listarProdutos();    
        }
    });
}








function addServico(){
	var id = $("#id").val();
	var servico = $("#servico").val();
	if(servico == ""){
		alert('Selecione um Serviço');
		return;
	}
	$.ajax({
        url: 'paginas/' + pag + "/addServico.php",
        method: 'POST',
        data: {servico, id},
        dataType: "html",

        success:function(result){
           listarServicos();        
        }
    });
}

function listarServicos(){
	totalizar();
	var id = $("#id").val();
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


function quantidadeServicos(id){		
	var quant = $("#quant_servicos_"+id).val();	
	$.ajax({
        url: 'paginas/' + pag + "/quantidade_servicos.php",
        method: 'POST',
        data: {id, quant},
        dataType: "html",

        success:function(result){             	
           listarServicos();    
        }
    });
}


function excluirServico(id){
	$.ajax({
        url: 'paginas/' + pag + "/excluir_servico.php",
        method: 'POST',
        data: {id},
        dataType: "html",

        success:function(result){             	
           listarServicos();    
        }
    });
}


// salvar vendas

$("#form_orcamento").submit(function () {

    $('#mensagem').text('Carregando!!');
    $('#btn_salvar').hide();

    event.preventDefault();
    var formData = new FormData(this);

    $.ajax({
        url: 'paginas/' + pag + "/salvar.php",
        type: 'POST',
        data: formData,

        success: function (mensagem) {  
        	var msg = mensagem.split('-');      	 
            $('#mensagem').text('');
            $('#mensagem').removeClass()
            if (msg[0].trim() == "Salvo com Sucesso") {

                $('#btn-fechar').click();
                listar();
                listarServicos();
                listarProdutos();

                
                var id_orc = msg[1].trim();

                //abrir o relatório pdf
                //window.open("rel/orcamento_class.php?id="+id_orc+"&enviar=Sim"); 

                 $('#id_orca').val(id_orc);
                 $('#enviar_rel').val('Sim'); 
                 $('#botao_disparar_rel').click();

            } else {
               alert(msg[0])
            }

             $('#btn_salvar').show();

        },

        cache: false,
        contentType: false,
        processData: false,

    });

});

function buscar(){
	var dataInicial = $('#dataInicial').val();
	var dataFinal = $('#dataFinal').val();
	var status = $('#status').val();

	listar(dataInicial, dataFinal, status);

}

function totalizar(){
	
	var desconto = $('#desconto').val();
	var tipo_desconto = $('#tipo_desconto').val();
	var frete = $('#frete').val();
	var valor_entrada = $('#valor_entrada').val();
	var id = $("#id").val();

	$.ajax({
        url: 'paginas/' + pag + "/totalizar.php",
        method: 'POST',
        data: {desconto, tipo_desconto, frete,valor_entrada, id},
        dataType: "html",

        success:function(result){   
        var vlr = result.split('-');          	
           $('#subtotal').val(vlr[1]);
           $('#valor').val(vlr[0]);
        }
    });
}

</script>


