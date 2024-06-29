<?php 
$pag = 'entradas';

//verificar se ele tem a permissão de estar nessa página
if(@$entradas == 'ocultar'){
    echo "<script>window.location='../index.php'</script>";
    exit();
}
 ?>

<div class="row margem_mobile">
	<form method="POST" action="rel/entradas_class.php" target="_blank">
	<span class="esc" style="font-size: 14px">Data Inicial</span>
	<input type="date" id="dataInicial" name="dataInicial" class="form-control" style="width:150px; display:inline-block; margin-right: 20px" onchange="mudarData()" required>

	<span class="esc" style="font-size: 14px">Data Final</span>
	<input type="date" id="dataFinal" name="dataFinal" class="form-control" style="width:150px; display:inline-block;" onchange="mudarData()" required>

	<button class="btn btn-success esc botao_rel" type="submit">Relatório</button>

	<button class="btn btn-success esc_web botao_rel" type="submit"><span class="fa fa-file-pdf-o"></span></button>

	</form>
</div>

<div class="bs-example widget-shadow" style="padding:15px" id="listar">

</div>


<script type="text/javascript">var pag = "<?=$pag?>"</script>
<script src="js/ajax.js"></script>


<script type="text/javascript">
	function mudarData(){
		var dataInicial = $("#dataInicial").val();
		var dataFinal = $("#dataFinal").val();

		if(dataInicial != "" && dataFinal != ""){			
			listar(dataInicial, dataFinal)
		}
	}
</script>