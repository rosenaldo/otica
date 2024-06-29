<?php 
@session_set_cookie_params(['httponly' => true]);
@session_start();
@session_regenerate_id(true);
require_once("conexao.php");
$usuario = filter_var(@$_POST['usuario'], @FILTER_SANITIZE_STRING);
$senha = filter_var(@$_POST['senha'], @FILTER_SANITIZE_STRING);

function Mask($mask,$str){

    $str = str_replace(" ","",$str);

    for($i=0;$i<strlen($str);$i++){
        @$mask[strpos(@$mask,"#")] = @$str[$i];
    }

    return $mask;

}

$usuario2 = Mask("(##) #####-####",$usuario);


$query = $pdo->prepare("SELECT * from usuarios where (telefone = :usuario2 or telefone = :email) and nivel = 'Cliente'");
$query->bindValue(":email", "$usuario");
$query->bindValue(":usuario2", "$usuario2");
$query->execute();
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$linhas = @count($res);

if($linhas > 0){


if(!password_verify($senha, $res[0]['senha_crip'])){
		echo '<script>window.alert("Dados Incorretos!!")</script>'; 
		echo '<script>window.location="acesso"</script>';  
		exit();
	}

	if($res[0]['ativo'] != 'Sim'){
		echo '<script>window.alert("Seu acesso foi desativado!!")</script>'; 
		echo '<script>window.location="acesso"</script>';  
	}

	$_SESSION['nome'] = $res[0]['nome'];
	$_SESSION['id'] = $res[0]['id'];
	$_SESSION['nivel'] = $res[0]['nivel'];
	$_SESSION['id_ref'] = $res[0]['id_ref'];
	
	if($_SESSION['nivel'] == 'Cliente'){
		$_SESSION['4841544fd5sf4ds'] = '8454fds5f4ds5f';
		echo '<script>window.location="painel_cliente"</script>';
	}

	
}else{
	echo '<script>window.alert("Dados Incorretos!!")</script>'; 
	echo '<script>window.location="acesso"</script>';  
}


 ?>
