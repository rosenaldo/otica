<?php 
require_once("conexao.php");

$telefone = filter_var(@$_POST['email'], @FILTER_SANITIZE_STRING);

$query = $pdo->prepare("SELECT * from usuarios where telefone = :telefone and nivel != 'Administrador'");
$query->bindValue(":telefone", "$telefone");

$query->execute();
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$linhas = @count($res);
if($linhas > 0){
	$senha = $res[0]['senha'];
	$telefone = $res[0]['telefone'];	

	$nova_senha = rand(100000, 100000000);
	$senha_crip = password_hash($nova_senha, PASSWORD_DEFAULT);
	$query = $pdo->prepare("UPDATE usuarios SET senha_crip = '$senha_crip' where telefone = :telefone");
	$query->bindValue(":telefone", "$telefone");
	$query->execute();
	
	
	echo 'Nova senha Enviada para seu Telefone';



	if($api_whatsapp == 'Sim'){
		$telefone_envio = '55'.preg_replace('/[ ()-]+/' , '' , @$telefone);
		$mensagem = '*'.$nome_sistema.'* %0A';
		$mensagem .= '_Recuperação de Senha_ %0A';		
		$mensagem .= 'Sua Senha é: *'.$nova_senha.'*';
		
		require("apis/api_texto.php");
}

}else{
echo 'Telefone não Cadastrado!';
}	




 ?>
