<?php 
$tabela = 'config';
require_once("../conexao.php");

$nome = $_POST['nome_sistema'];
$email = $_POST['email_sistema'];
$telefone = $_POST['telefone_sistema'];
$endereco = $_POST['endereco_sistema'];
$instagram = $_POST['instagram_sistema'];
$validade_orcamento = $_POST['validade_orcamento'];
$excluir_orcamentos = $_POST['excluir_orcamentos'];
$comissao_geral = $_POST['comissao_geral'];
$api_whatsapp = $_POST['api_whatsapp'];
$token = $_POST['token'];
$instancia = $_POST['instancia'];
$chave_pix = $_POST['chave_pix'];
$marca_dagua = $_POST['marca_dagua'];
$impressao_automatica = $_POST['impressao_automatica'];
$fonte_comprovante = $_POST['fonte_comprovante'];
$cnpj = $_POST['cnpj_sistema'];
$dias_comissao = $_POST['dias_comissao'];
$cobranca_auto = $_POST['cobranca_auto'];
$duas_vias_os = $_POST['duas_vias_os'];
$comissao_venda = $_POST['comissao_venda'];
$seletor_api = $_POST['seletor_api'];
$alterar_acessos = $_POST['alterar_acessos'];
$banco_sistema = $_POST['banco_sistema'];
$agencia_sistema = $_POST['agencia_sistema'];
$conta_sistema = $_POST['conta_sistema'];
$beneficiario_sistema = $_POST['beneficiario_sistema'];

//foto logo
$caminho = '../img/logo.png';
$imagem_temp = @$_FILES['foto-logo']['tmp_name']; 

if(@$_FILES['foto-logo']['name'] != ""){
	$ext = pathinfo($_FILES['foto-logo']['name'], PATHINFO_EXTENSION);   
	if($ext == 'png' || $ext == 'PNG'){ 	
				
		move_uploaded_file($imagem_temp, $caminho);
	}else{
		echo 'Extensão de Imagem não permitida!';
		exit();
	}
}


//foto logo rel
$caminho = '../img/logo.jpg';
$imagem_temp = @$_FILES['foto-logo-rel']['tmp_name']; 

if(@$_FILES['foto-logo-rel']['name'] != ""){
	$ext = pathinfo(@$_FILES['foto-logo-rel']['name'], PATHINFO_EXTENSION);   
	if($ext == 'jpg' || $ext == 'JPG'){ 	
			
		move_uploaded_file($imagem_temp, $caminho);
	}else{
		echo 'Extensão de Imagem não permitida!';
		exit();
	}
}


//foto icone
$caminho = '../img/icone.png';
$imagem_temp = @$_FILES['foto-icone']['tmp_name']; 

if(@$_FILES['foto-icone']['name'] != ""){
	$ext = pathinfo(@$_FILES['foto-icone']['name'], PATHINFO_EXTENSION);   
	if($ext == 'png' || $ext == 'PNG'){ 	
			
		move_uploaded_file($imagem_temp, $caminho);
	}else{
		echo 'Extensão de Imagem não permitida!';
		exit();
	}
}


//foto qr
$caminho = '../img/qr.jpg';
$imagem_temp = @$_FILES['foto-qr']['tmp_name']; 

if(@$_FILES['foto-qr']['name'] != ""){
	$ext = pathinfo(@$_FILES['foto-qr']['name'], PATHINFO_EXTENSION);   
	if($ext == 'jpg' || $ext == 'JPG'){ 	
			
		move_uploaded_file($imagem_temp, $caminho);
	}else{
		echo 'Extensão de Imagem não permitida!';
		exit();
	}
}


$query = $pdo->prepare("UPDATE $tabela SET nome = :nome, email = :email, telefone = :telefone, endereco = :endereco, instagram = :instagram, validade_orcamento = :validade_orcamento, excluir_orcamentos = :excluir_orcamentos, comissao_geral = :comissao_geral, api_whatsapp = :api_whatsapp, token = :token, instancia = :instancia, chave_pix = :chave_pix, marca_dagua = :marca_dagua, impressao_automatica = :impressao_automatica, fonte_comprovante = :fonte_comprovante, cnpj = :cnpj, dias_comissao = '$dias_comissao', cobranca_auto = '$cobranca_auto', duas_vias_os = '$duas_vias_os', comissao_venda = '$comissao_venda', seletor_api = '$seletor_api', alterar_acessos = '$alterar_acessos', banco_sistema = '$banco_sistema', agencia_sistema = '$agencia_sistema', conta_sistema = '$conta_sistema', beneficiario_sistema = '$beneficiario_sistema' where id = 1");

$query->bindValue(":nome", "$nome");
$query->bindValue(":email", "$email");
$query->bindValue(":telefone", "$telefone");
$query->bindValue(":endereco", "$endereco");
$query->bindValue(":instagram", "$instagram");
$query->bindValue(":validade_orcamento", "$validade_orcamento");
$query->bindValue(":excluir_orcamentos", "$excluir_orcamentos");
$query->bindValue(":comissao_geral", "$comissao_geral");
$query->bindValue(":api_whatsapp", "$api_whatsapp");
$query->bindValue(":token", "$token");
$query->bindValue(":instancia", "$instancia");
$query->bindValue(":chave_pix", "$chave_pix");
$query->bindValue(":marca_dagua", "$marca_dagua");
$query->bindValue(":impressao_automatica", "$impressao_automatica");
$query->bindValue(":fonte_comprovante", "$fonte_comprovante");
$query->bindValue(":cnpj", "$cnpj");
$query->execute();

echo 'Editado com Sucesso';
 ?>