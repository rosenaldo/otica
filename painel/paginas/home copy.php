<?php 

//verificar se ele tem a permissão de estar nessa página
if(@$home == 'ocultar'){
    echo "<script>window.location='../index.php'</script>";
    exit();
}

//total de clientes
$query = $pdo->query("SELECT * from clientes ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_clientes = @count($res);

//total de os
$query = $pdo->query("SELECT * from os where status = 'Aberta' ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$os_abertas = @count($res);

//total de orcamentos
$query = $pdo->query("SELECT * from orcamentos where status = 'Pendente' ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$orc_pendentes = @count($res);


//total receber hoje
$receber_hoje_rs = 0;
$query = $pdo->query("SELECT * from receber where data_venc = curDate() and pago = 'Não' ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$receber_hoje = @count($res);
	if($receber_hoje > 0){
		for($i=0; $i < $receber_hoje; $i++){			
			$valor = $res[$i]['valor'];
			$receber_hoje_rs +=	$valor;

			}
		}	
$receber_hoje_rsF = number_format($receber_hoje_rs, 2, ',', '.');


//total pagar hoje
$pagar_hoje_rs = 0;
$query = $pdo->query("SELECT * from pagar where data_venc = curDate() and pago = 'Não' ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$pagar_hoje = @count($res);
	if($pagar_hoje > 0){
		for($i=0; $i < $pagar_hoje; $i++){			
			$valor = $res[$i]['valor'];
			$pagar_hoje_rs +=	$valor;

			}
		}	
$pagar_hoje_rsF = number_format($pagar_hoje_rs, 2, ',', '.');






//total vendas hoje
$vendas_hoje_rs = 0;
$query = $pdo->query("SELECT * from receber where data_pgto = curDate() and pago = 'Sim' and referencia = 'Venda' ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$vendas_hoje = @count($res);
	if($vendas_hoje > 0){
		for($i=0; $i < $vendas_hoje; $i++){			
			$valor = $res[$i]['valor'];
			$vendas_hoje_rs +=	$valor;

			}
		}	
$vendas_hoje_rsF = number_format($vendas_hoje_rs, 2, ',', '.');





//total receber pendentes
$receber_pendentes = 0;
$query = $pdo->query("SELECT * from receber where data_venc < curDate() and pago = 'Não' ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$receber_pendente = @count($res);
	if($receber_pendente > 0){
		for($i=0; $i < $receber_pendente; $i++){			
			$valor = $res[$i]['valor'];
			$receber_pendentes +=	$valor;

			}
		}	
$receber_pendentesF = number_format($receber_pendentes, 2, ',', '.');


//total pagar pendentes
$pagar_pendentes = 0;
$query = $pdo->query("SELECT * from pagar where data_venc < curDate() and pago = 'Não' ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$pagar_pendente = @count($res);
	if($pagar_pendente > 0){
		for($i=0; $i < $pagar_pendente; $i++){			
			$valor = $res[$i]['valor'];
			$pagar_pendentes +=	$valor;

			}
		}	
$pagar_pendentesF = number_format($pagar_pendentes, 2, ',', '.');




//total de os atrasadas
$query = $pdo->query("SELECT * from os where data_entrega < curDate() and status != 'Entregue' and status != 'Finalizada'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$os_atrasadas = @count($res);


//total de os atrasadas
$query = $pdo->query("SELECT * from os where data_entrega = curDate()");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$os_entregas_hoje = @count($res);



//total de produtos estoque baixo
$query = $pdo->query("SELECT * from produtos where estoque <= nivel_estoque");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_estoque = @count($res);


//total de orçamentos no mês
$query = $pdo->query("SELECT * from orcamentos where data >= '$data_mes' and data <= curDate()");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_orc_mes = @count($res);

//total de orçamentos no mês aprovados
$query = $pdo->query("SELECT * from orcamentos where data >= '$data_mes' and data <= curDate() and status = 'Aprovado'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_orc_mes_aprovados = @count($res);

if($total_orc_mes > 0 and $total_orc_mes_aprovados > 0){
    $porcentagem_orc = ($total_orc_mes_aprovados / $total_orc_mes) * 100;
}else{
    $porcentagem_orc = 0;
}




//total de os no mês
$query = $pdo->query("SELECT * from os where data >= '$data_mes' and data <= curDate()");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_os_mes = @count($res);

//total de os no mês aprovados
$query = $pdo->query("SELECT * from os where data >= '$data_mes' and data <= curDate() and status = 'Entregue'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_os_mes_aprovados = @count($res);

if($total_os_mes > 0 and $total_os_mes_aprovados > 0){
    $porcentagem_os = ($total_os_mes_aprovados / $total_os_mes) * 100;
}else{
    $porcentagem_os = 0;
}




//total de contas receber no mês
$query = $pdo->query("SELECT * from receber where data_venc >= '$data_mes' and data_venc <= '$data_final_mes'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_receber_mes = @count($res);

//total de os no mês aprovados
$query = $pdo->query("SELECT * from receber where data_venc >= '$data_mes' and data_venc <= '$data_final_mes' and pago = 'Sim'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_receber_mes_pagas = @count($res);

if($total_receber_mes > 0 and $total_receber_mes_pagas > 0){
    $porcentagem_receber = ($total_receber_mes_pagas / $total_receber_mes) * 100;
}else{
    $porcentagem_receber = 0;
}





//grafico de linhas
$meses = 6;
$data_inicio_mes_atual = $ano_atual.'-'.$mes_atual.'-01';
$data_inicio_apuracao = date('Y-m-d', strtotime("-$meses months",strtotime($data_inicio_mes_atual)));
$datas_apuracao = '';
$nome_mes = '';
$datas_apuracao_final = '';

$total_receber_final = '';
$total_pagar_final = '';
for($cont=0; $cont<$meses; $cont++){

	$datas_apuracao = date('Y-m-d', strtotime("+$cont months",strtotime($data_inicio_apuracao)));

	$mes = date('m', strtotime($datas_apuracao));
	$ano = date('Y', strtotime($datas_apuracao));

	if($mes == '01'){
		$nome_mes = 'Janeiro';
	}

	if($mes == '02'){
		$nome_mes = 'Fevereiro';
	}

	if($mes == '03'){
		$nome_mes = 'Março';
	}

	if($mes == '04'){
		$nome_mes = 'Abril';
	}

	if($mes == '05'){
		$nome_mes = 'Maio';
	}

	if($mes == '06'){
		$nome_mes = 'Junho';
	}

	if($mes == '07'){
		$nome_mes = 'Julho';
	}

	if($mes == '08'){
		$nome_mes = 'Agosto';
	}

	if($mes == '09'){
		$nome_mes = 'Setembro';
	}

	if($mes == '10'){
		$nome_mes = 'Outubro';
	}

	if($mes == '11'){
		$nome_mes = 'Novembro';
	}

	if($mes == '12'){
		$nome_mes = 'Dezembro';
	}

	if($mes == '04' || $mes == '06' || $mes == '09' || $mes == '11'){
		$data_final_mes = '30';
	}else if($mes == '2'){
		$data_final_mes = '28';
	}else{
		$data_final_mes = '31';
	}
	
	$data_final_mes_completa = $ano.'-'.$mes.'-'.$data_final_mes;	
	//percorrer os meses totalizando os valores

$query = $pdo->query("SELECT * from receber where data_pgto >= '$datas_apuracao' and data_pgto<= '$data_final_mes_completa' and pago = 'Sim'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total = @count($res);
$total_receber = 0;
$total_receberF = 0;
if($total > 0){
	for($i=0; $i<$total; $i++){		
		$valor = $res[$i]['valor'];
		$total_receber += $valor;		
	}
}


$query = $pdo->query("SELECT * from pagar where data_pgto >= '$datas_apuracao' and data_pgto<= '$data_final_mes_completa' and pago = 'Sim'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total = @count($res);
$total_pagar = 0;
$total_pagarF = 0;
if($total > 0){
	for($i=0; $i<$total; $i++){		
		$valor = $res[$i]['valor'];
		$total_pagar += $valor;		
	}
}

	
		$total_receber_final .= $total_receber.'*';		
		$total_pagar_final .= $total_pagar.'*';
		

	$datas_apuracaoF = implode('/', array_reverse(explode('-', $datas_apuracao)));

	$datas_apuracao_final .= $nome_mes.'*';
}	

 ?>
<div class="main-page margem_mobile">

	<?php if($ativo_sistema == ''){ ?>
<div style="background: #ffc341; color:#3e3e3e; padding:10px; font-size:14px; margin-bottom:10px">
<div><i class="fa fa-info-circle"></i> <b>Aviso: </b> Prezado Cliente, não identificamos o pagamento de sua última mensalidade, entre em contato conosco o mais rápido possivel para regularizar o pagamento, caso contário seu acesso ao sistema será desativado.</div>
</div>
<?php } ?>

	<div class="col_3">

		<a href="pagar">
		<div class="col-md-3 widget widget1">
			<div class="r3_counter_box">
				<i class="pull-left fa fa-dollar icon-rounded" style="background:#c20c24"></i>
				<div class="stats">
					<h5><strong>R$ <?php echo $pagar_hoje_rsF ?></strong></h5>
					<span><span style="font-size: 13px; color:#424242">(<?php echo $pagar_hoje ?>) Pagar Hoje</span></span>
				</div>
			</div>
		</div>
		</a>
		<a href="receber">
		<div class="col-md-3 widget widget1">
			<div class="r3_counter_box">
				<i class="pull-left fa fa-money dollar2 icon-rounded"></i>
				<div class="stats">
					<h5><strong>R$ <?php echo $receber_hoje_rsF ?></strong></h5>
					<span><span style="font-size: 13px; color:#424242">(<?php echo $receber_hoje ?>) Receb Hoje</span></span>
				</div>
			</div>
		</div>
		</a>
		<a href="orcamentos">
		<div class="col-md-3 widget widget1">
			<div class="r3_counter_box">				
				<i class="pull-left fa fa-laptop user1 icon-rounded"></i>
				<div class="stats">
					<h5><strong><?php echo $orc_pendentes ?></strong></h5>
					<span><span style="font-size: 13px; color:#424242">Orç Pendentes</span></span>
				</div>
			</div>
		</div>
		</a>
		<a href="estoque">
		<div class="col-md-3 widget widget1">
			<div class="r3_counter_box">
				<i class="pull-left fa fa-pie-chart dollar1 icon-rounded"></i>
				<div class="stats">
					<h5><strong><?php echo $total_estoque ?></strong></h5>
					<span><span style="font-size: 13px; color:#424242">Estoque Baixo</span></span>
				</div>
			</div>
		</div>
		</a>
		<a href="clientes">
		<div class="col-md-3 widget">
			<div class="r3_counter_box">
				<i class="pull-left fa fa-users dollar2 icon-rounded"></i>
				<div class="stats">
					<h5><strong><?php echo $total_clientes ?></strong></h5>
					<span><span style="font-size: 13px; color:#424242">Clientes</span></span>
				</div>
			</div>
		</div>
		</a>
		
	</div>



	<div class="col_3" style="margin-top: 15px">

		<a href="pagar">
		<div class="col-md-3 widget widget1 margem_10_web">
			<div class="r3_counter_box">
				<i class="pull-left fa fa-dollar icon-rounded" style="background:#c20c24"></i>
				<div class="stats">
					<h5><strong><span style="font-size: 19px; color:#000"><?php echo $pagar_pendentesF ?></span></strong></h5>
					<span><span style="font-size: 13px; color:#424242">(<?php echo $pagar_pendente ?>) Pgto Venc</span></span>
				</div>
			</div>
		</div>
		</a>
		<a href="receber">
		<div class="col-md-3 widget widget1 margem_10_web">
			<div class="r3_counter_box">
				<i class="pull-left fa fa-money dollar2 icon-rounded"></i>
				<div class="stats">
					<h5><strong><span style="font-size: 19px; color:#000"><?php echo $receber_pendentesF ?></span></strong></h5>
					<span><span style="font-size: 13px; color:#424242">(<?php echo $receber_pendente ?>) Receb Venc</span></span>
				</div>
			</div>
		</div>
		</a>
		<a href="os">
		<div class="col-md-3 widget widget1 margem_10_web">
			<div class="r3_counter_box">				
				<i class="pull-left fa fa-info user1 icon-rounded"></i>
				<div class="stats">
					<h5><strong><?php echo $os_atrasadas ?></strong></h5>
					<span><span style="font-size: 13px; color:#424242">OS Atrasadas</span></span>
				</div>
			</div>
		</div>
		</a>
		<a href="estoque">
		<div class="col-md-3 widget widget1 margem_10_web">
			<div class="r3_counter_box">
				<i class="pull-left fa fa-info-circle dollar1 icon-rounded"></i>
				<div class="stats">
					<h5><strong><?php echo $os_entregas_hoje ?></strong></h5>
					<span><span style="font-size: 13px; color:#424242">Entregas Hoje</span></span>
				</div>
			</div>
		</div>
		</a>
		<a href="lista_vendas">
		<div class="col-md-3 widget margem_10_web">
			<div class="r3_counter_box">
				<i class="pull-left fa fa-dollar dollar2 icon-rounded"></i>
				<div class="stats">
					<h5><strong><span style="font-size: 19px; color:#000">R$ <?php echo $vendas_hoje_rsF ?></span></strong></h5>
					<!-- <span><span style="font-size: 13px; color:#424242">(<?php echo $vendas_hoje ?>) Warning: Undefined variable $res2 in C:\xampp\htdocs\otica\painel\paginas\os\listar.php on line 114</span></span> -->
					<span><span style="font-size: 13px; color:#424242">(<?php echo $vendas_hoje ?>) Vendas de hoje</span></span>
				</div>
			</div>
		</div>
		</a>
		<div class="clearfix"> </div>
	</div>

	
	<div class="row-one widgettable">
		<div class="col-md-8 content-top-2 card">
			<div class="agileinfo-cdr altura_grafico">
				<div class="card-header">
					<h3>Recebimentos / Despesas</h3>
				</div>
				
				<div id="Linegraph" style="width: 98%; height: 350px">
				</div>
				
			</div>
		</div>
		<div class="col-md-4 stat">
			<div class="content-top-1">
				<div class="col-md-6 top-content">
					<h5>Orçamentos do Mês</h5>
					<label><?php echo $total_orc_mes ?> / <?php echo $total_orc_mes_aprovados ?></label>
				</div>
				<div class="col-md-6 top-content1">	   
					<div id="demo-pie-1" class="pie-title-center" data-percent="<?php echo $porcentagem_orc ?>"> <span class="pie-value"></span> </div>
				</div>
				<div class="clearfix"> </div>
			</div>
			<div class="content-top-1">
				<div class="col-md-6 top-content">
					<h5>OS Concluídas Mês</h5>
					<label><?php echo $total_os_mes ?> / <?php echo $total_os_mes_aprovados ?></label>
				</div>
				<div class="col-md-6 top-content1">	   
					<div id="demo-pie-2" class="pie-title-center" data-percent="<?php echo $porcentagem_os ?>"> <span class="pie-value"></span> </div>
				</div>
				<div class="clearfix"> </div>
			</div>
			<div class="content-top-1">
				<div class="col-md-6 top-content">
					<h5>Recebimentos do Mês</h5>
					<label><?php echo $total_receber_mes ?> / <?php echo $total_receber_mes_pagas ?></label>
				</div>
				<div class="col-md-6 top-content1">	   
					<div id="demo-pie-3" class="pie-title-center" data-percent="<?php echo $porcentagem_receber ?>"> <span class="pie-value"></span> </div>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
		


		<div class="clearfix"> </div>
	</div>
	
	
	

	
</div>




<!-- for index page weekly sales java script -->
<script src="js/SimpleChart.js"></script>
<script>

	var meses = "<?=$datas_apuracao_final?>";
	var dados = meses.split("*"); 

	var receber = "<?=$total_receber_final?>";
	var dados_receber = receber.split("*"); 

	var pagar = "<?=$total_pagar_final?>";
	var dados_pagar = pagar.split("*"); 

		var maior_valor_linha_pagar = Math.max(...dados_pagar);
    	var maior_valor_linha_receber = Math.max(...dados_receber);
    	var maior_valor = Math.max(maior_valor_linha_pagar, maior_valor_linha_receber);
    	maior_valor = parseFloat(maior_valor) + 100;
    	
    	var menor_valor_linha_pagar = Math.min(...dados_pagar);
    	var menor_valor_linha_receber = Math.min(...dados_receber);
    	var menor_valor = Math.min(menor_valor_linha_pagar, menor_valor_linha_receber);

	var graphdata1 = {
		linecolor: "#c91508",
		title: "Despesas",
		values: [
		{ X: dados[0], Y: dados_pagar[0] },
		{ X: dados[1], Y: dados_pagar[1] },
		{ X: dados[2], Y: dados_pagar[2] },
		{ X: dados[3], Y: dados_pagar[3] },
		{ X: dados[4], Y: dados_pagar[4] },
		{ X: dados[5], Y: dados_pagar[5] },
		
		]
	};
	var graphdata2 = {
		linecolor: "#00CC66",
		title: "Recebimentos",
		values: [
		{ X: dados[0], Y: dados_receber[0] },
		{ X: dados[1], Y: dados_receber[1] },
		{ X: dados[2], Y: dados_receber[2] },
		{ X: dados[3], Y: dados_receber[3] },
		{ X: dados[4], Y: dados_receber[4] },
		{ X: dados[5], Y: dados_receber[5] },
		]
	};

	var dataRangeLinha = {
    		linecolor: "transparent",
    		title: "",
    		values: [
    		{ X: dados[0], Y: menor_valor },
    		{ X: dados[1], Y: menor_valor },
    		{ X: dados[2], Y: menor_valor },
    		{ X: dados[3], Y: menor_valor },
    		{ X: dados[4], Y: menor_valor },
    		{ X: dados[5], Y: maior_valor },
    		
    		]
    	};
	
		
		$("#Linegraph").SimpleChart({
			ChartType: "Line",
			toolwidth: "50",
			toolheight: "25",
			axiscolor: "#E6E6E6",
			textcolor: "#6E6E6E",
			showlegends: true,
			data: [graphdata2, graphdata1, dataRangeLinha],
			legendsize: "30",
			legendposition: 'bottom',
			xaxislabel: 'Meses',
    		title: 'Últimos 6 Meses',
    		yaxislabel: 'Total de Contas R$',
    		responsive: true,
		});



</script>
<!-- //for index page weekly sales java script -->
