<?php 
require_once("conexao.php");
$query = $pdo->query("SELECT * from usuarios where nivel = 'Administrador'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$linhas = @count($res);
$senha = '123';
$senha_crip = password_hash($senha, PASSWORD_DEFAULT);
if($linhas == 0){
	$pdo->query("INSERT INTO usuarios SET nome = '$nome_sistema', email = '$email_sistema', senha = '', senha_crip = '$senha_crip', nivel = 'Administrador', ativo = 'Sim', foto = 'sem-foto.jpg', telefone = '$telefone_sistema', data = curDate() ");
}

$data_atual = date('Y-m-d');
//percorrer as contas para gerar as cobranças
if($cobranca_auto == 'Sim' and strtotime($data_cobranca) != strtotime($data_atual) and $api_whatsapp == 'Sim'){

	$query = $pdo->query("SELECT * from receber where data_venc <= curDate() and pago = 'Não' and cliente > 0 order by id asc ");
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	$total_reg = @count($res);
	if($total_reg > 0){
		for($i=0; $i < $total_reg; $i++){
			$descricao = $res[$i]['descricao'];
			$cliente = $res[$i]['cliente'];
			$valor = $res[$i]['valor'];			
			$data_venc = $res[$i]['data_venc'];

			$data_vencF = implode('/', array_reverse(explode('-', $data_venc)));
			$valorF = number_format($valor, 2, ',', '.');

			$query2 = $pdo->query("SELECT * FROM clientes where id = '$cliente'");
			$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
			if(@count($res2) > 0){
				$nome_cliente = $res2[0]['nome'];				
				$tel_cliente = $res2[0]['telefone'];
			}

			if(strtotime($data_venc) == strtotime($data_atual)){
				$mensagem = '_Você tem uma conta à Pagar Hoje '.$nome_sistema.'_ %0A';
			}else{
				$mensagem = '_Você tem uma conta Vencida '.$nome_sistema.'_ %0A';
			}


			//api whats			
				$telefone_envio = '55'.preg_replace('/[ ()-]+/' , '' , $tel_cliente);			
				
					$mensagem .= 'Nome: *'.$nome_cliente.'* %0A';
					$mensagem .= 'Valor: *R$ '.$valorF.'* %0A';
					$mensagem .= 'Data de Vencimento: *'.$data_vencF.'* %0A%0A';
					$mensagem .= '_Entre em contato conosco para acertar o pagamento!_ %0A';

				require('apis/api_texto.php');
		}	
	}

	$pdo->query("UPDATE config SET data_cobranca = curDate()");
}

 ?>
 <!DOCTYPE html>
<html>
<head>
	<title><?php echo $nome_sistema ?></title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" type="image/x-icon" href="img/icone.png">

</head>
<body>
	<div class="login">		
		<div class="form">
			<img src="img/logo.png" class="imagem">
			<form method="post" action="autenticar.php">
				<input type="text" name="usuario" id="usuario" placeholder="Seu Email ou Telefone" required>
				<input type="password" name="senha" placeholder="Senha" required>
				<button>Login</button>
				<p><small><a href="#" onclick="recuperar()" title="Preencha o seu email para receber a recuperação">Recuperar Senha?</a></small></p>
			</form>	
		</div>
	</div>
</body>
</html>


<script src="painel/js/jquery-1.11.1.min.js"></script>
	<!-- Mascaras JS -->
<script type="text/javascript" src="painel/js/mascaras.js"></script>

<!-- Ajax para funcionar Mascaras JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script> 



<script type="text/javascript">
	function recuperar(){
		var email = $('#usuario').val();
		if(email == ""){
			alert("Digite um Email!");
			return;
		}

		$.ajax({
	        url: 'recuperar.php',
	        method: 'POST',
	        data: {email},
	        dataType: "html",

	        success:function(result){
	            if(result == 'Recuperado'){
	            	alert('Confira sua senha no email!')
	            }else{
	            	alert(result)
	            }
	            
	        }
    	});
	}
</script>