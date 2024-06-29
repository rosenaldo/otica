<?php 
$pag = 'os_tecnico';

//verificar se ele tem a permissão de estar nessa página
if(@$os_tecnico == 'ocultar'){
    echo "<script>window.location='../index.php'</script>";
    exit();
}
?>


<div class="row margem_mobile">
		<form method="POST" action="rel/lista_os_class.php" target="_blank">
	<div class="col-md-12" align="center">		
		
				
				<a style="width: 120px" href="#" class="btn btn-primary" onclick="buscar_status('Iniciada')">Iniciadas</a>
				<a style="width: 120px" href="#" class="btn btn-warning" onclick="buscar_status('Aguardando')">Aguardando</a>
				<a style="width: 120px" href="#" class="btn btn-success" onclick="buscar_status('Finalizada')">Finalizadas</a>
				<a style="width: 120px" href="#" class="btn btn-info" onclick="buscar_status('Entregue')">Entregues</a>		
			
				<input type="hidden" id="status_busca" name="status">
		
		
	</div>

	

	</form>

	

	
</div>


<div class="bs-example widget-shadow" style="padding:15px" id="listar">
	
</div>




<!-- Modal -->
<div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
	<div class="modal-dialog modal-lg" role="document" style="">
		<div class="modal-content">
			
			<form method="post" id="form_orcamento">
				<div class="modal-body">

						<button id="btn-fechar" type="button" class="close" data-dismiss="modal" aria-label="Close" style="position:absolute; top: 5px; right:5px">
					<span aria-hidden="true">&times;</span>
				</button>

							

					
					<div id="div_listar" class="row" style="margin-top: 0px; margin-bottom: 10px; ">
						<div class="col-md-12" id="listar_produtos">	
						</div>

						<div class="col-md-12" id="listar_servicos">	
						</div>
					</div>


							
					</div>


					<div class="row" style="margin-top: 0px">
						<div class="col-md-5">		
							<div class="form-group"> 
								<label>Laboratório</label> 
								<input maxlength="255" class="form-control" type="text" name="laboratorio" id="laboratorio"  placeholder="Laboratório" >
							</div>	
						</div>

						<div class="col-md-2">		
							<div class="form-group"> 
								<label>Nº Pedido</label> 
								<input maxlength="1000" class="form-control" type="text" name="pedido" id="pedido"  placeholder="Número do Pedido">
							</div>	
						</div>


						<div class="col-md-5">		
							<div class="form-group"> 
								<label>Doutor</label> 
								<input class="form-control" type="text" name="doutor" id="doutor"  placeholder="Nome do Doutor">
							</div>	
						</div>
					</div>




					<hr style="margin:5px">
					<div class="row" style="margin-top: 0px; margin-bottom: 8px">
						<div class="col-md-12" style="color:blue; border-bottom: 1px solid #757474"><b><small>GRAU DE LONGE</small></b></div>
					</div>
					

					<div class="row" style="margin-top: 0px">	
						<div class="col-md-2">						
							<div class="form-group"> 
								<label>OD-ESF</label> 
								<input class="form-control" type="text" name="longe1" id="longe1" placeholder="">
							</div>						
						</div>	

						<div class="col-md-2">						
							<div class="form-group"> 
								<label>OD-CIL</label> 
								<input class="form-control" type="text" name="longe2" id="longe2" placeholder="">
							</div>						
						</div>	

						<div class="col-md-2">						
							<div class="form-group"> 
								<label>OD-EIXO</label> 
								<input class="form-control" type="text" name="longe3" id="longe3" placeholder="">
							</div>						
						</div>	

						<div class="col-md-2">						
							<div class="form-group"> 
								<label>OD-DNP</label> 
								<input class="form-control" type="text" name="longe4" id="longe4" placeholder="">
							</div>						
						</div>	

						<div class="col-md-2">						
							<div class="form-group"> 
								<label>OD-ADIÇÃO</label> 
								<input class="form-control" type="text" name="longe5" id="longe5" placeholder="">
							</div>						
						</div>	

						<div class="col-md-2">						
							<div class="form-group"> 
								<label>OD-ALTURA</label> 
								<input class="form-control" type="text" name="longe6" id="longe6" placeholder="">
							</div>						
						</div>	

						<div class="col-md-2">						
							<div class="form-group"> 
								<label>OE-ESF</label> 
								<input class="form-control" type="text" name="longe7" id="longe7" placeholder="">
							</div>						
						</div>	

						<div class="col-md-2">						
							<div class="form-group"> 
								<label>OE-CIL</label> 
								<input class="form-control" type="text" name="longe8" id="longe8" placeholder="">
							</div>						
						</div>	

						<div class="col-md-2">						
							<div class="form-group"> 
								<label>OE-EIXO</label> 
								<input class="form-control" type="text" name="longe9" id="longe9" placeholder="">
							</div>						
						</div>	

						<div class="col-md-2">						
							<div class="form-group"> 
								<label>OE-DNP</label> 
								<input class="form-control" type="text" name="longe10" id="longe10" placeholder="">
							</div>						
						</div>	

						<div class="col-md-2">						
							<div class="form-group"> 
								<label>OE-ADIÇÃO</label> 
								<input class="form-control" type="text" name="longe11" id="longe11" placeholder="">
							</div>						
						</div>	

						<div class="col-md-2">						
							<div class="form-group"> 
								<label>OE-ALTURA</label> 
								<input class="form-control" type="text" name="longe12" id="longe12" placeholder="">
							</div>						
						</div>	

					</div>
					



					<hr style="margin:5px">
					<div class="row" style="margin-top: 0px; margin-bottom: 8px">
						<div class="col-md-12" style="color:blue; border-bottom: 1px solid #757474"><b><small>GRAU DE PERTO</small></b></div>
					</div>
					

					<div class="row" style="margin-top: 0px">	
						<div class="col-md-2">						
							<div class="form-group"> 
								<label>OD-ESF</label> 
								<input class="form-control" type="text" name="perto1" id="perto1" placeholder="">
							</div>						
						</div>	

						<div class="col-md-2">						
							<div class="form-group"> 
								<label>OD-CIL</label> 
								<input class="form-control" type="text" name="perto2" id="perto2" placeholder="">
							</div>						
						</div>	

						<div class="col-md-2">						
							<div class="form-group"> 
								<label>OD-EIXO</label> 
								<input class="form-control" type="text" name="perto3" id="perto3" placeholder="">
							</div>						
						</div>	

						<div class="col-md-2">						
							<div class="form-group"> 
								<label>OD-DNP</label> 
								<input class="form-control" type="text" name="perto4" id="perto4" placeholder="">
							</div>						
						</div>	

					</div>

					<div class="row">

						<div class="col-md-2">						
							<div class="form-group"> 
								<label>OE-ESF</label> 
								<input class="form-control" type="text" name="perto5" id="perto5" placeholder="">
							</div>						
						</div>	

						<div class="col-md-2">						
							<div class="form-group"> 
								<label>OE-CIL</label> 
								<input class="form-control" type="text" name="perto6" id="perto6" placeholder="">
							</div>						
						</div>	

						<div class="col-md-2">						
							<div class="form-group"> 
								<label>OE-EIXO</label> 
								<input class="form-control" type="text" name="perto7" id="perto7" placeholder="">
							</div>						
						</div>	

						<div class="col-md-2">						
							<div class="form-group"> 
								<label>OE-DNP</label> 
								<input class="form-control" type="text" name="perto8" id="perto8" placeholder="">
							</div>						
						</div>	

						

					</div>
					
					<hr>


					<div class="row" style="margin-top: 0px">
					

						<div class="col-md-6">		
							<div class="form-group"> 
								<label>Equipamento</label> 
								<input maxlength="255" class="form-control" type="text" name="equipamento" id="equipamento"  placeholder="Celular Sansung J3 marca XX" readonly>
							</div>	
						</div>

						<div class="col-md-6">		
							<div class="form-group"> 
								<label>Situação (Serviços)</label> 
								<input maxlength="1000" class="form-control" type="text" name="situacao" id="situacao"  placeholder="Troca de Tela, Bateria, etc" required="">
							</div>	
						</div>


					

					<div class="row" style="margin-top: 0px">
					<div class="col-md-12">						
							<div class="form-group"> 
								<label>Acessórios</label> 
								<input maxlength="1000" class="form-control" type="text" name="acessorios" id="acessorios" placeholder="Capa, pelicula, chip, etc">
							</div>						
						</div>								
					</div>	


					<div class="row" style="margin-top: 0px">
					<div class="col-md-12">						
							<div class="form-group"> 
								<label>Condições ou Avarias</label> 
								<input maxlength="2000" class="form-control" type="text" name="condicoes" id="condicoes" placeholder="Tela Quebrada, arranhado, etc">
							</div>						
						</div>								
					</div>	



					<div class="row" style="margin-top: 0px">
					<div class="col-md-12">						
							<div class="form-group"> 
								<label>Laudo Técnico</label> 
								<textarea maxlength="2000" class="form-control"  name="laudo" id="laudo" placeholder="Laudo Técnico Caso Exista"></textarea>
							</div>						
						</div>								
					</div>	
					

					



					<div class="row" style="margin-top: 0px">					

					<div class="col-md-10">						
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
	</div>






	<!-- Modal Status -->
	<div class="modal fade" id="modalStatus" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" style="width:400px">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="tituloModal">Mudar Status da OS</h4>
					<button id="btn-fechar-status" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -20px">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form id="form-status" method="post">
					<div class="modal-body">					
						

						<div class="row" style="">
							<div class="col-md-8">
								<select class="form-control" aria-label="Default select example" name="status" id="id_status" onchange="buscar()">									
								<option value="Aguardando">Aguardando Peça</option>
								<option value="Finalizada">Finalizada</option>
								<option value="Entregue">Entregue</option>
			</select>
							</div>

							<div class="col-md-4">										 
								<button type="submit" class="btn btn-primary">Editar</button>
							</div>
						</div>

						
						
						<br>
						<small><div align="center" id="mensagem-status"></div></small>

						<input type="hidden" class="form-control" name="id_da_os"  id="id_da_os">


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
				
				listarProdutos();
				listarServicos();

				buscar();

			});
		</script>


				
		
		


		<script type="text/javascript">

			function listarBusca(dataInicial, dataFinal, status, alterou_data){
				$.ajax({
					url: 'paginas/' + pag + "/listar.php",
					method: 'POST',
					data: {dataInicial, dataFinal, status, alterou_data},
					dataType: "html",

					success:function(result){
						$("#listar").html(result);
					}
				});
			}
		

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




function listarProdutos(orc){

	
	var id = $("#id").val();
	$.ajax({
        url: 'paginas/' + pag + "/listar_produtos.php",
        method: 'POST',
        data: {id, orc},
        dataType: "html",

        success:function(result){        	
           $("#listar_produtos").html(result);      
        }
    });
}



function listarServicos(orc){
	
	var id = $("#id").val();
	$.ajax({
        url: 'paginas/' + pag + "/listar_servicos.php",
        method: 'POST',
        data: {id, orc},
        dataType: "html",

        success:function(result){        	
           $("#listar_servicos").html(result);      
        }
    });
}




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
            $('#mensagem').text('');
            $('#mensagem').removeClass()
            if (mensagem.trim() == "Salvo com Sucesso") {

                $('#btn-fechar').click();
                listar();
                listarServicos();
                listarProdutos();

            } else {
               alert(mensagem)
            }

             $('#btn_salvar').show();

        },

        cache: false,
        contentType: false,
        processData: false,

    });

});



function buscar(){
	var dataInicial = "";
	var dataFinal = "";
	var status = $('#status_busca').val();
	var filtro = 'filtro';

	listar(dataInicial, dataFinal, status, filtro);

}


</script>



		<script type="text/javascript">
			$("#form-status").submit(function () {
				event.preventDefault();
				var formData = new FormData(this);

				$.ajax({
					url: 'paginas/' + pag + "/status.php",
					type: 'POST',
					data: formData,

					success: function (mensagem) {

						$('#mensagem-status').text('');
						$('#mensagem-status').removeClass()
						if (mensagem.trim() == "Alterado com Sucesso") {                    
						$('#btn-fechar-status').click();
						listar();
					} else {
						$('#mensagem-status').addClass('text-danger')
						$('#mensagem-status').text(mensagem)
					}

				},

				cache: false,
				contentType: false,
				processData: false,

			});

			});
		</script>

		<script type="text/javascript">
			function buscar_status(status){
				$('#status_busca').val(status);
				buscar();
			}
		</script>


		<script type="text/javascript">
			$('#modalCliente').on('hidden.bs.modal', function (e) {
		      $('body').addClass('modal-open');
			});
		</script>