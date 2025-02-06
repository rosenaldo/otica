<?php 
@session_start();
require_once("../conexao.php");
require_once("verificar.php");

$data_atual = date('Y-m-d');
$mes_atual = Date('m');
$ano_atual = Date('Y');
$data_mes = $ano_atual."-".$mes_atual."-01";
$data_ano = $ano_atual."-01-01";

if($mes_atual == '04' || $mes_atual == '06' || $mes_atual == '09' || $mes_atual == '11'){
	$data_final_mes = $ano_atual.'-'.$mes_atual.'-30';
}else if($mes_atual == '02'){
	$bissexto = date('L', @mktime(0, 0, 0, 1, 1, $ano_atual));
	if($bissexto == 1){
		$data_final_mes = $ano_atual.'-'.$mes_atual.'-29';
	}else{
		$data_final_mes = $ano_atual.'-'.$mes_atual.'-28';
	}
	
}else{
	$data_final_mes = $ano_atual.'-'.$mes_atual.'-31';
}

$pag_inicial = 'home';
if(@$_SESSION['nivel'] != 'Administrador'){
	require_once("verificar_permissoes.php");
}
if(@$_GET['pagina'] != ""){
	$pagina = @$_GET['pagina'];
}else{
	$pagina = $pag_inicial;
}

$id_usuario = @$_SESSION['id'];
$query = $pdo->query("SELECT * from usuarios where id = '$id_usuario'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$linhas = @count($res);
if($linhas > 0){
	$nome_usuario = $res[0]['nome'];
	$email_usuario = $res[0]['email'];
	$telefone_usuario = $res[0]['telefone'];
	$senha_usuario = $res[0]['senha'];
	$nivel_usuario = $res[0]['nivel'];
	$foto_usuario = $res[0]['foto'];
	$endereco_usuario = $res[0]['endereco'];
}

?>
<!DOCTYPE HTML>
<html>
<head>
	<title><?php echo $nome_sistema ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="shortcut icon" href="../img/icone.png" type="image/x-icon">

	<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>

	<!-- Bootstrap Core CSS -->
	<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />

	<!-- Custom CSS -->
	<link href="css/style.css" rel='stylesheet' type='text/css' />

	<!-- font-awesome icons CSS -->
	<link href="css/font-awesome.css" rel="stylesheet"> 
	<!-- //font-awesome icons CSS-->

	<!-- side nav css file -->
	<link href='css/SidebarNav.min.css' media='all' rel='stylesheet' type='text/css'/>
	<!-- //side nav css file -->

	<!-- js-->
	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/modernizr.custom.js"></script>

	<!--webfonts-->
	<link href="//fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i&amp;subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
	<!--//webfonts--> 

	<!-- chart -->
	<script src="js/Chart.js"></script>
	<!-- //chart -->

	<!-- Metis Menu -->
	<script src="js/metisMenu.min.js"></script>
	<script src="js/custom.js"></script>
	<link href="css/custom.css" rel="stylesheet">
	<!--//Metis Menu -->
	<style>
		#chartdiv {
			width: 100%;
			height: 295px;
		}
	</style>
	<!--pie-chart --><!-- index page sales reviews visitors pie chart -->
	<script src="js/pie-chart.js" type="text/javascript"></script>
	<script type="text/javascript">

		$(document).ready(function () {
			$('#demo-pie-1').pieChart({
				barColor: '#2dde98',
				trackColor: '#eee',
				lineCap: 'round',
				lineWidth: 8,
				onStep: function (from, to, percent) {
					$(this.element).find('.pie-value').text(Math.round(percent) + '%');
				}
			});

			$('#demo-pie-2').pieChart({
				barColor: '#8e43e7',
				trackColor: '#eee',
				lineCap: 'butt',
				lineWidth: 8,
				onStep: function (from, to, percent) {
					$(this.element).find('.pie-value').text(Math.round(percent) + '%');
				}
			});

			$('#demo-pie-3').pieChart({
				barColor: '#ffc168',
				trackColor: '#eee',
				lineCap: 'square',
				lineWidth: 8,
				onStep: function (from, to, percent) {
					$(this.element).find('.pie-value').text(Math.round(percent) + '%');
				}
			});


		});

	</script>
	<!-- //pie-chart --><!-- index page sales reviews visitors pie chart -->


<link rel="stylesheet" type="text/css" href="DataTables/datatables.min.css"/> <script src="DataTables/datatables.min.js"></script>


<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<style type="text/css">
		.select2-selection__rendered {
			line-height: 36px !important;
			font-size:16px !important;
			color:#666666 !important;

		}

		.select2-selection {
			height: 36px !important;
			font-size:16px !important;
			color:#666666 !important;

		}
</style>  
	
</head> 
<body class="cbp-spmenu-push">
	<div class="main-content">
		<div class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
			<!--left-fixed -navigation-->
			<aside class="sidebar-left" style="overflow: scroll; height:100%; scrollbar-width: thin;">
				<nav class="navbar navbar-inverse">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".collapse" aria-expanded="false">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<h1><a class="navbar-brand" href="index.php"><span class="fa fa-eye"></span> OptiGo<span class="dashboard_text"><?php echo $nome_sistema ?></span></a></h1>
					</div>
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<ul class="sidebar-menu">
							<li class="header">MENU NAVEGAÇÃO</li>
							<li class="treeview <?php echo $home ?>">
								<a href="index.php">
									<i class="fa fa-dashboard"></i> <span>Home</span>
								</a>
							</li>
							<li class="treeview <?php echo $menu_pessoas ?>">
								<a href="#">
									<i class="fa fa-users"></i>
									<span>Pessoas</span>
									<i class="fa fa-angle-left pull-right"></i>
								</a>
								<ul class="treeview-menu">

									<li class="<?php echo $clientes ?>"><a href="clientes"><i class="fa fa-angle-right"></i> Clientes</a></li>

									<li class="<?php echo $funcionarios ?>"><a href="funcionarios"><i class="fa fa-angle-right"></i> Funcionários</a></li>

									<li class="<?php echo $usuarios ?>"><a href="usuarios"><i class="fa fa-angle-right"></i> Usuários</a></li>

									<li class="<?php echo $fornecedores ?>"><a href="fornecedores"><i class="fa fa-angle-right"></i> Fornecedores</a></li>
									
								</ul>
							</li>

							<li class="treeview <?php echo $menu_cadastros ?>">
								<a href="#">
									<i class="fa fa-plus"></i>
									<span>Cadastros</span>
									<i class="fa fa-angle-left pull-right"></i>
								</a>
								<ul class="treeview-menu">
								
									<li class="<?php echo $cargos ?>"><a href="cargos"><i class="fa fa-angle-right"></i> Cargos</a></li>

									<li class="<?php echo $servicos ?>"><a href="servicos"><i class="fa fa-angle-right"></i> Serviços</a></li>

									<li class="<?php echo $frequencias ?>"><a href="frequencias"><i class="fa fa-angle-right"></i> Frequências</a></li>

									<li class="<?php echo $formas_pgto ?>"><a href="formas_pgto"><i class="fa fa-angle-right"></i> Formas de Pagamento</a></li>

									<?php if($alterar_acessos == 'Sim'){ ?>
									<li class="<?php echo $grupos ?>"><a href="grupos"><i class="fa fa-angle-right"></i> Grupos de Acessos</a></li>

									<li class="<?php echo $acessos ?>"><a href="acessos"><i class="fa fa-angle-right"></i> Acessos</a></li>
									<?php } ?>
									
								</ul>
							</li>


							<li class="treeview <?php echo $menu_produtos ?>">
								<a href="#">
									<i class="fa fa-product-hunt"></i>
									<span>Produtos</span>
									<i class="fa fa-angle-left pull-right"></i>
								</a>
								<ul class="treeview-menu">
								
									<li class="<?php echo $categorias ?>"><a href="categorias"><i class="fa fa-angle-right"></i> Categorias</a></li>

									<li class="<?php echo $produtos ?>"><a href="produtos"><i class="fa fa-angle-right"></i> Produtos</a></li>

									<li class="<?php echo $entradas ?>"><a href="entradas"><i class="fa fa-angle-right"></i> Entradas</a></li>


									<li class="<?php echo $saidas ?>"><a href="saidas"><i class="fa fa-angle-right"></i> Saídas</a></li>

									<li class="<?php echo $estoque ?>"><a href="estoque"><i class="fa fa-angle-right"></i> Estoque Baixo</a></li>
									
								</ul>
							</li>


							<li class="treeview <?php echo $menu_financeiro ?>">
								<a href="#">
									<i class="fa fa-usd"></i>
									<span>Financeiro</span>
									<i class="fa fa-angle-left pull-right"></i>
								</a>
								<ul class="treeview-menu">
								
									<li class="<?php echo $pagar ?>"><a href="pagar"><i class="fa fa-angle-right"></i> Contas à Pagar</a></li>

									<li class="<?php echo $receber ?>"><a href="receber"><i class="fa fa-angle-right"></i> Contas à Receber</a></li>

									<li class="<?php echo $compras ?>"><a href="compras"><i class="fa fa-angle-right"></i> Compras</a></li>
<!-- junior -->
									<!-- <li class="<?php echo $vendas ?>"><a href="vendas"><i class="fa fa-angle-right"></i> Vendas</a></li> -->

									<li class="<?php echo $lista_vendas ?>"><a href="lista_vendas"><i class="fa fa-angle-right"></i> Lista de Vendas</a></li>


									<li class="<?php echo $comissoes ?>"><a href="comissoes"><i class="fa fa-angle-right"></i> Comissoes</a></li>

									<li class="<?php echo $rel_financeiro ?>"><a href="" data-toggle="modal" data-target="#modalRelFin"><i class="fa fa-angle-right"></i> Relatório Financeiro</a></li>

									<li class="<?php echo $rel_lucro ?>"><a href="" data-toggle="modal" data-target="#modalRelLucro"><i class="fa fa-angle-right"></i> Detalhamento de Lucro</a></li>
									
								</ul>
							</li>



							

							<li class="treeview <?php echo $orcamentos ?>">
								<a href="orcamentos">
									<i class="fa fa-pencil"></i> <span>Cadastro de vendas</span>
								</a>
							</li>



							<li class="treeview <?php echo $menu_os ?>">
								<a href="#">
									<i class="fa fa-sun-o"></i>
									<span>Ordem de serviço</span>
									<i class="fa fa-angle-left pull-right"></i>
								</a>
								<ul class="treeview-menu">
								
									<li class="<?php echo $os ?>"><a href="os"><i class="fa fa-angle-right"></i> OS/Entrada</a></li>

									<li class="<?php echo $os_status ?>"><a href="os_status"><i class="fa fa-angle-right"></i> OS Por Status</a></li>

									<li class="<?php echo $os_tecnico ?>"><a href="os_tecnico"><i class="fa fa-angle-right"></i> Minhas OS</a></li>
									
								</ul>
							</li>

							<?php if($nivel_usuario == 'Técnico' || $nivel_usuario == 'Administrador'){ ?>
							<li class="treeview">
								<a href="minhas_comissoes">
									<i class="fa fa-money"></i> <span>Minhas Comissões</span>
								</a>
							</li>
						<?php } ?>

						</ul>
					</div>
					<!-- /.navbar-collapse -->
				</nav>
			</aside>
		</div>
		<!--left-fixed -navigation-->
		
		<!-- header-starts -->
		<div class="sticky-header header-section ">
			<div class="header-left">
				<!--toggle button start-->
				<button id="showLeftPush" data-toggle="collapse" data-target=".collapse"><i class="fa fa-bars"></i></button>
				<!--toggle button end-->
				<div class="profile_details_left"><!--notifications of menu start -->
					<ul class="nofitications-dropdown">

						<?php 
							//contas a pagar vencidas							
							$query = $pdo->query("SELECT * from pagar where data_venc < curDate() and pago = 'Não' ");
							$res = $query->fetchAll(PDO::FETCH_ASSOC);
							$pagar_vencidas = @count($res);
						 ?>
						<li class="dropdown head-dpdn">
							<a href="#" class="dropdown-toggle <?php echo $pagar ?>" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-money" style="color:#FFF"></i><span class="badge"><?php echo $pagar_vencidas ?></span></a>
							<ul class="dropdown-menu">
								<li>
									<div class="notification_header">
										<h3>Possui <?php echo $pagar_vencidas ?> contas à pagar vencidas</h3>
									</div>
								</li>

								<?php 
								$query = $pdo->query("SELECT * from pagar where data_venc < curDate() and pago = 'Não' order by data_venc asc limit 10");
							$res = $query->fetchAll(PDO::FETCH_ASSOC);
							$pagar_vencidas = @count($res);
								if($pagar_vencidas > 0){
								for($i=0; $i < $pagar_vencidas; $i++){			
									$valor_conta = $res[$i]['valor'];
									$descricao_conta = $res[$i]['descricao'];
									$valor_contaF = number_format($valor_conta, 2, ',', '.');
								 ?>
								<li><a href="#">
									<div class="user_img"><img src="images/1.jpg" alt=""></div>
									<div class="notification_desc">										<p><?php echo $descricao_conta ?> <span style="color:#73020c !important">R$ <?php echo $valor_conta ?></span></p>
										
									</div>
									<div class="clearfix"></div>	
								</a></li>
								
								<?php } } ?>
								
								<li>
									<div class="notification_bottom">
										<a href="index.php?pagina=pagar">Ver Todas</a>
									</div> 
								</li>
							</ul>
						</li>




						<?php 
							//contas a receber vencidas	
							$query = $pdo->query("SELECT * from receber where data_venc < curDate() and pago = 'Não' ");
							$res = $query->fetchAll(PDO::FETCH_ASSOC);
							$receber_vencidas = @count($res);
						 ?>
						<li class="dropdown head-dpdn">
							<a href="#" class="dropdown-toggle <?php echo $receber ?>" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-money" style="color:#FFF"></i><span class="badge" style="background:green"><?php echo $receber_vencidas ?></span></a>
							<ul class="dropdown-menu">
								<li>
									<div class="notification_header">
										<h3>Possui <?php echo $receber_vencidas ?> contas à receber vencidas</h3>
									</div>
								</li>

								<?php 
								$query = $pdo->query("SELECT * from receber where data_venc < curDate() and pago = 'Não' order by data_venc asc limit 10");
							$res = $query->fetchAll(PDO::FETCH_ASSOC);
							$receber_vencidas = @count($res);
								if($receber_vencidas > 0){
								for($i=0; $i < $receber_vencidas; $i++){			
									$valor_conta = $res[$i]['valor'];
									$descricao_conta = $res[$i]['descricao'];
									$valor_contaF = number_format($valor_conta, 2, ',', '.');
								 ?>
								<li><a href="#">
									<div class="user_img"><img src="images/1.jpg" alt=""></div>
									<div class="notification_desc">										<p><?php echo $descricao_conta ?> <span style="color:green !important">R$ <?php echo $valor_conta ?></span></p>
										
									</div>
									<div class="clearfix"></div>	
								</a></li>
								
								<?php } } ?>
								
								<li>
									<div class="notification_bottom">
										<a href="index.php?pagina=receber">Ver Todas</a>
									</div> 
								</li>
							</ul>





						</li>
						


					</ul>
					<div class="clearfix"> </div>
				</div>
				
			</div>
			<div class="header-right">

				<div class="profile_details">		
					<ul>
						<li class="dropdown profile_details_drop">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
								<div class="profile_img">	
									<span class="prfil-img"><img src="images/perfil/<?php echo $foto_usuario ?>" alt="" width="50px" height="50px"> </span> 
									<div class="user-name esc">
										<p><?php echo $nome_usuario ?></p>
										<span><?php echo $nivel_usuario ?></span>
									</div>
									<i class="fa fa-angle-down lnr"></i>
									<i class="fa fa-angle-up lnr"></i>
									<div class="clearfix"></div>	
								</div>	
							</a>
							<ul class="dropdown-menu drp-mnu">
								<li class="<?php echo $configuracoes ?>"> <a class="" href="" data-toggle="modal" data-target="#modalConfig"><i class="fa fa-cog"></i> Configurações</a> </li> 
								<li> <a href="" data-toggle="modal" data-target="#modalPerfil"><i class="fa fa-user"></i> Perfil</a> </li> 								
								<li> <a href="logout.php"><i class="fa fa-sign-out"></i> Sair</a> </li>
							</ul>
						</li>
					</ul>
				</div>
				<div class="clearfix"> </div>				
			</div>
			<div class="clearfix"> </div>	
		</div>
		<!-- //header-ends -->




		<!-- main content start-->
		<div id="page-wrapper">
			<?php 
			require_once('paginas/'.$pagina.'.php');
			?>
		</div>





	</div>

	<!-- new added graphs chart js-->
	
	<script src="js/Chart.bundle.js"></script>
	<script src="js/utils.js"></script>
	
	
	
	<!-- Classie --><!-- for toggle left push menu script -->
	<script src="js/classie.js"></script>
	<script>
		var menuLeft = document.getElementById( 'cbp-spmenu-s1' ),
		showLeftPush = document.getElementById( 'showLeftPush' ),
		body = document.body;

		showLeftPush.onclick = function() {
			classie.toggle( this, 'active' );
			classie.toggle( body, 'cbp-spmenu-push-toright' );
			classie.toggle( menuLeft, 'cbp-spmenu-open' );
			disableOther( 'showLeftPush' );
		};


		function disableOther( button ) {
			if( button !== 'showLeftPush' ) {
				classie.toggle( showLeftPush, 'disabled' );
			}
		}
	</script>
	<!-- //Classie --><!-- //for toggle left push menu script -->

	<!--scrolling js-->
	<script src="js/jquery.nicescroll.js"></script>
	<script src="js/scripts.js"></script>
	<!--//scrolling js-->
	
	<!-- side nav js -->
	<script src='js/SidebarNav.min.js' type='text/javascript'></script>
	<script>
		$('.sidebar-menu').SidebarNav()
	</script>
	<!-- //side nav js -->
	
	
	
	<!-- Bootstrap Core JavaScript -->
	<script src="js/bootstrap.js"> </script>
	<!-- //Bootstrap Core JavaScript -->



	<!-- Mascaras JS -->
<script type="text/javascript" src="js/mascaras.js"></script>

<!-- Ajax para funcionar Mascaras JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script> 

	
</body>
</html>






<!-- Modal Perfil -->
<div class="modal fade" id="modalPerfil" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="exampleModalLabel">Alterar Dados</h4>
				<button id="btn-fechar-perfil" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -25px">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="form-perfil">
			<div class="modal-body">
				

					<div class="row">
						<div class="col-md-6">							
								<label>Nome</label>
								<input type="text" class="form-control" id="nome_perfil" name="nome" placeholder="Seu Nome" value="<?php echo $nome_usuario ?>" required>							
						</div>

						<div class="col-md-6">							
								<label>Email</label>
								<input type="email" class="form-control" id="email_perfil" name="email" placeholder="Seu Nome" value="<?php echo $email_usuario ?>" required>							
						</div>
					</div>


					<div class="row">
						<div class="col-md-4">							
								<label>Telefone</label>
								<input type="text" class="form-control" id="telefone_perfil" name="telefone" placeholder="Seu Telefone" value="<?php echo $telefone_usuario ?>" required>							
						</div>

						<div class="col-md-4">							
								<label>Senha</label>
								<input type="password" class="form-control" id="senha_perfil" name="senha" placeholder="Senha" value="<?php echo $senha_usuario ?>" required>							
						</div>

						<div class="col-md-4">							
								<label>Confirmar Senha</label>
								<input type="password" class="form-control" id="conf_senha_perfil" name="conf_senha" placeholder="Confirmar Senha" value="" required>							
						</div>

						
					</div>


					<div class="row">
						<div class="col-md-12">	
							<label>Endereço</label>
							<input type="text" class="form-control" id="endereco_perfil" name="endereco" placeholder="Seu Endereço" value="<?php echo $endereco_usuario ?>" >	
						</div>
					</div>
					


					<div class="row">
						<div class="col-md-8">							
								<label>Foto</label>
								<input type="file" class="form-control" id="foto_perfil" name="foto" value="<?php echo $foto_usuario ?>" onchange="carregarImgPerfil()">							
						</div>

						<div class="col-md-4">								
							<img src="images/perfil/<?php echo $foto_usuario ?>"  width="80px" id="target-usu">								
							
						</div>

						
					</div>


					<input type="hidden" name="id_usuario" value="<?php echo $id_usuario ?>">
				

				<br>
				<small><div id="msg-perfil" align="center"></div></small>
			</div>
			<div class="modal-footer">       
				<button type="submit" class="btn btn-primary">Salvar</button>
			</div>
			</form>
		</div>
	</div>
</div>








<!-- Modal Config -->
<div class="modal fade" id="modalConfig" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="exampleModalLabel">Editar Configurações</h4>
				<button id="btn-fechar-config" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -25px">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form id="form-config">
			<div class="modal-body">
				

					<div class="row">
						<div class="col-md-3">							
								<label>Nome do Projeto</label>
								<input type="text" class="form-control" id="nome_sistema" name="nome_sistema" placeholder="" value="<?php echo @$nome_sistema ?>" required>							
						</div>

						<div class="col-md-3">							
								<label>Email Sistema</label>
								<input type="email" class="form-control" id="email_sistema" name="email_sistema" placeholder="Email do Sistema" value="<?php echo @$email_sistema ?>" >							
						</div>


						<div class="col-md-3">							
								<label>Telefone Sistema</label>
								<input type="text" class="form-control" id="telefone_sistema" name="telefone_sistema" placeholder="" value="<?php echo @$telefone_sistema ?>" required>							
						</div>


						<div class="col-md-3">							
								<label>CNPJ</label>
								<input type="text" class="form-control" id="cnpj_sistema"  name="cnpj_sistema" placeholder="Telefone do Sistema" value="<?php echo @$cnpj_sistema ?>" >							
						</div>

					</div>


					<div class="row">
						<div class="col-md-6">							
								<label>Endereço <small>(Rua Número Bairro e Cidade)</small></label>
								<input type="text" class="form-control" id="endereco_sistema" name="endereco_sistema" placeholder="Rua X..." value="<?php echo @$endereco_sistema ?>" >							
						</div>

						<div class="col-md-6">							
								<label>Instagram</label>
								<input type="text" class="form-control" id="instagram_sistema" name="instagram_sistema" placeholder="Link do Instagram" value="<?php echo @$instagram_sistema ?>">							
						</div>
					</div>



					<div class="row">
						<div class="col-md-3">	
							<label>Validade Orçamento</label>
								<input type="number" class="form-control" id="validade_orcamento" name="validade_orcamento" placeholder="Dias de Validade" value="<?php echo @$validade_orcamento ?>">		
						</div>

						<div class="col-md-3">	
							<label>Excluir Orçamentos</label>
								<input type="number" class="form-control" id="excluir_orcamentos" name="excluir_orcamentos" placeholder="Dias Excluir Pendentes" value="<?php echo @$excluir_orcamentos ?>">		
						</div>

						<div class="col-md-3">	
							<label>Comissão Serviços %</label>
								<input type="number" class="form-control" id="comissao_geral" name="comissao_geral" placeholder="Comissão Geral %" value="<?php echo @$comissao_geral ?>">		
						</div>


						<div class="col-md-3">	
							<label>Chave Pix</label>
								<input type="text" class="form-control" name="chave_pix" placeholder="CNPJ xxxxxxxxxxxx" value="<?php echo @$chave_pix ?>">		
						</div>
					</div>




					<div class="row">
						<div class="col-md-2">	
							<label>Api Whatsapp</label>
								<select class="form-control" name="api_whatsapp">
									<option <?php if(@$api_whatsapp == 'Não'){ ?> selected <?php } ?> value="Não">Não</option>
									<option <?php if(@$api_whatsapp == 'Sim'){ ?> selected <?php } ?> value="Sim">Sim</option>
								</select>	
						</div>

							<div class="col-md-2">	
							<label>Seletor Api</label>
								<select class="form-control" name="seletor_api">
									<option <?php if(@$seletor_api == 'menuia'){ ?> selected <?php } ?> value="menuia">Menuia</option>
									<option <?php if(@$seletor_api == 'wm'){ ?> selected <?php } ?> value="wm">Word Mensagens</option>
								</select>	
						</div>

						<div class="col-md-4">	
							<label>Token Whatsapp (AppKey)</label>
								<input type="text" class="form-control" name="token" placeholder="Token da API" value="<?php echo @$token ?>">		
						</div>

						<div class="col-md-4">	
							<label>Instância Whats (AuthKey)</label>
								<input type="text" class="form-control" name="instancia" placeholder="Instância Whatsapp" value="<?php echo @$instancia ?>">		
						</div>

					
					</div>


					<div class="row">

							<div class="col-md-3">	
							<label>Marca D'agua Relatório</label>
								<select class="form-control" name="marca_dagua">
									<option <?php if(@$marca_dagua == 'Sim'){ ?> selected <?php } ?> value="Sim">Sim</option>
									<option <?php if(@$marca_dagua == 'Não'){ ?> selected <?php } ?> value="Não">Não</option>
								</select>	
						</div>


						<div class="col-md-3">	
							<label>Impressão Automática</label>
								<select class="form-control" name="impressao_automatica">
									<option <?php if(@$impressao_automatica == 'Sim'){ ?> selected <?php } ?> value="Sim">Sim</option>
									<option <?php if(@$impressao_automatica == 'Não'){ ?> selected <?php } ?> value="Não">Não</option>
								</select>	
						</div>

						<div class="col-md-3">
							<label>Fonte Comprovante</label>
								<input type="number" class="form-control" name="fonte_comprovante" placeholder="Tamanho da Fonte" value="<?php echo @$fonte_comprovante ?>">		
						</div>

						<div class="col-md-2">
							<label>Dias Comissão</label>
								<input type="number" class="form-control" name="dias_comissao" placeholder="Pagamento Comissão" value="<?php echo @$dias_comissao ?>">		
						</div>	

						

						

					</div>


					<div class="row">

						<div class="col-md-3">
							<label>Cobrança Automática</label>
								<select class="form-control" name="cobranca_auto">
									<option <?php if(@$cobranca_auto == 'Sim'){ ?> selected <?php } ?> value="Sim">Sim</option>
									<option <?php if(@$cobranca_auto == 'Não'){ ?> selected <?php } ?> value="Não">Não</option>
								</select>	
						</div>	

						<div class="col-md-3">	
							<label>Impressão Duas Vias OS</label>
								<select class="form-control" name="duas_vias_os">
									<option <?php if(@$duas_vias_os == 'Sim'){ ?> selected <?php } ?> value="Sim">Sim</option>
									<option <?php if(@$duas_vias_os == 'Não'){ ?> selected <?php } ?> value="Não">Não</option>
								</select>	
						</div>

						<div class="col-md-3">	
							<label>Comissão Venda %</label>
								<input type="number" class="form-control" id="comissao_venda" name="comissao_venda" placeholder="Comissão Venda %" value="<?php echo @$comissao_venda ?>">		
						</div>


						<div class="col-md-3">	
							<label>Alterar Acessos</label>
								<select class="form-control" name="alterar_acessos">
									<option <?php if(@$alterar_acessos == 'Sim'){ ?> selected <?php } ?> value="Sim">Sim</option>
									<option <?php if(@$alterar_acessos == 'Não'){ ?> selected <?php } ?> value="Não">Não</option>
								</select>	
						</div>

					</div>



					<div class="row">
						<div class="col-md-3">	
							<label>Banco Sistema</label>
								<input type="text" class="form-control" id="banco_sistema" name="banco_sistema" placeholder="Bradesco, Itaú, etc" value="<?php echo @$banco_sistema ?>">		
						</div>

						<div class="col-md-3">	
							<label>Agência</label>
								<input type="text" class="form-control" id="agencia_sistema" name="agencia_sistema" placeholder="" value="<?php echo @$agencia_sistema ?>">		
						</div>

						<div class="col-md-3">	
							<label>Conta</label>
								<input type="text" class="form-control" id="conta_sistema" name="conta_sistema" placeholder="" value="<?php echo @$conta_sistema ?>">		
						</div>


						<div class="col-md-3">	
							<label>Beneficiário</label>
								<input type="text" class="form-control" name="beneficiario_sistema" placeholder="Nome do Beneficiário" value="<?php echo @$beneficiario_sistema ?>">		
						</div>
					</div>

					

					<div class="row">
						<div class="col-md-4">						
								<div class="form-group"> 
									<label>Logo (*PNG)</label> 
									<input class="form-control" type="file" name="foto-logo" onChange="carregarImgLogo();" id="foto-logo">
								</div>						
							</div>
							<div class="col-md-2">
								<div id="divImg">
									<img src="../img/<?php echo $logo_sistema ?>"  width="80px" id="target-logo">									
								</div>
							</div>


							<div class="col-md-4">						
								<div class="form-group"> 
									<label>Ícone (*Png)</label> 
									<input class="form-control" type="file" name="foto-icone" onChange="carregarImgIcone();" id="foto-icone">
								</div>						
							</div>
							<div class="col-md-2">
								<div id="divImg">
									<img src="../img/<?php echo $icone_sistema ?>"  width="50px" id="target-icone">									
								</div>
							</div>

						
					</div>




					<div class="row">
							<div class="col-md-4">						
								<div class="form-group"> 
									<label>Logo Relatório (*Jpg)</label> 
									<input class="form-control" type="file" name="foto-logo-rel" onChange="carregarImgLogoRel();" id="foto-logo-rel">
								</div>						
							</div>
							<div class="col-md-2">
								<div id="divImg">
									<img src="../img/<?php echo @$logo_rel ?>"  width="80px" id="target-logo-rel">									
								</div>
							</div>



							<div class="col-md-4">						
								<div class="form-group"> 
									<label>QRCode Carnê (*Jpg) Min 200x200</label> 
									<input class="form-control" type="file" name="foto-qr" onChange="carregarImgQr();" id="foto-qr">
								</div>						
							</div>
							<div class="col-md-2">
								<div id="divImg">
									<img src="../img/qr.jpg"  width="80px" id="target-qr">									
								</div>
							</div>


						
					</div>					
				

				<br>
				<small><div id="msg-config" align="center"></div></small>
			</div>
			<div class="modal-footer">       
				<button type="submit" class="btn btn-primary">Salvar</button>
			</div>
			</form>
		</div>
	</div>
</div>








<!-- Modal Rel Financeiro -->
<div class="modal fade" id="modalRelFin" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="exampleModalLabel">Relatório Financeiro</h4>
				<button id="btn-fechar-rel" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -25px">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="POST" action="rel/financeiro_class.php" target="_blank">
			<div class="modal-body">	
			<div class="row">
				<div class="col-md-4">
					<label>Data Inicial</label>
					<input type="date" name="dataInicial" class="form-control" value="<?php echo $data_atual ?>">
				</div>

				<div class="col-md-4">
					<label>Data Final</label>
					<input type="date" name="dataFinal" class="form-control" value="<?php echo $data_atual ?>">
				</div>

				<div class="col-md-4">
					<label>Filtro Data</label>
					<select name="filtro_data" class="form-control">
						<option value="data_lanc">Data de Lançamento</option>
						<option value="data_venc">Data de Vencimento</option>
						<option value="data_pgto">Data de Pagamento</option>
					</select>
				</div>
			</div>		


			<div class="row">				
				<div class="col-md-4">
					<label>Entradas / Saídas</label>
					<select name="filtro_tipo" class="form-control">
						<option value="receber">Entradas / Ganhos</option>
						<option value="pagar">Saídas / Despesas</option>
					</select>
				</div>

				<div class="col-md-4">
					<label>Tipo Lançamento</label>
					<select name="filtro_lancamento" class="form-control">
						<option value="">Tudo</option>
						<option value="Conta">Ganhos / Despesas</option>
						<option value="Venda">Vendas</option>
						<option value="Serviço">Serviços</option>
						<option value="Cancelamento">Devoluções</option>
						<option value="Compra">Compras</option>
						<option value="Comissão">Comissões</option>
					</select>
				</div>
				<div class="col-md-4">
					<label>Pendentes / Pago</label>
					<select name="filtro_pendentes" class="form-control">
						<option value="">Tudo</option>
						<option value="Não">Pendentes</option>
						<option value="Sim">Pago</option>
					</select>
				</div>			
			</div>		
				
						

			</div>
			<div class="modal-footer">       
				<button type="submit" class="btn btn-primary">Gerar</button>
			</div>
			</form>
		</div>
	</div>
</div>




<!-- Modal Rel Lucro -->
<div class="modal fade" id="modalRelLucro" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="exampleModalLabel">Relatório de Lucro</h4>
				<button id="btn-fechar-rel" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top: -25px">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form method="POST" action="rel/lucro_class.php" target="_blank">
			<div class="modal-body">	
			<div class="row">
				<div class="col-md-4">
					<label>Data Inicial</label>
					<input type="date" name="dataInicial" class="form-control" value="<?php echo $data_atual ?>">
				</div>

				<div class="col-md-4">
					<label>Data Final</label>
					<input type="date" name="dataFinal" class="form-control" value="<?php echo $data_atual ?>">
				</div>

				
			</div>		


								

			</div>
			<div class="modal-footer">       
				<button type="submit" class="btn btn-primary">Gerar</button>
			</div>
			</form>
		</div>
	</div>
</div>






<script type="text/javascript">
	function carregarImgPerfil() {
    var target = document.getElementById('target-usu');
    var file = document.querySelector("#foto_perfil").files[0];
    
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
	$("#form-perfil").submit(function () {

		event.preventDefault();
		var formData = new FormData(this);

		$.ajax({
			url: "editar-perfil.php",
			type: 'POST',
			data: formData,

			success: function (mensagem) {
				$('#msg-perfil').text('');
				$('#msg-perfil').removeClass()
				if (mensagem.trim() == "Editado com Sucesso") {

					$('#btn-fechar-perfil').click();
					location.reload();				
						

				} else {

					$('#msg-perfil').addClass('text-danger')
					$('#msg-perfil').text(mensagem)
				}


			},

			cache: false,
			contentType: false,
			processData: false,

		});

	});
</script>






 <script type="text/javascript">
	$("#form-config").submit(function () {

		event.preventDefault();
		var formData = new FormData(this);

		$.ajax({
			url: "editar-config.php",
			type: 'POST',
			data: formData,

			success: function (mensagem) {
				$('#msg-config').text('');
				$('#msg-config').removeClass()
				if (mensagem.trim() == "Editado com Sucesso") {

					$('#btn-fechar-config').click();
					location.reload();				
						

				} else {

					$('#msg-config').addClass('text-danger')
					$('#msg-config').text(mensagem)
				}


			},

			cache: false,
			contentType: false,
			processData: false,

		});

	});
</script>




<script type="text/javascript">
	function carregarImgLogo() {
    var target = document.getElementById('target-logo');
    var file = document.querySelector("#foto-logo").files[0];
    
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
	function carregarImgLogoRel() {
    var target = document.getElementById('target-logo-rel');
    var file = document.querySelector("#foto-logo-rel").files[0];
    
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
	function carregarImgIcone() {
    var target = document.getElementById('target-icone');
    var file = document.querySelector("#foto-icone").files[0];
    
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
	function carregarImgQr() {
    var target = document.getElementById('target-qr');
    var file = document.querySelector("#foto-qr").files[0];
    
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