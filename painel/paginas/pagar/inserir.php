<?php 
$tabela = 'pagar';
require_once("../../../conexao.php");
@session_start();
$id_usuario = @$_SESSION['id'];

$data_atual = date('Y-m-d');

$descricao = $_POST['descricao'];
$cliente = @$_POST['cliente'];
$valor = $_POST['valor'];
$valor = str_replace(',', '.', $valor);
$data_venc = $_POST['data_venc'];
$data_pgto = $_POST['data_pgto'];
$frequencia = $_POST['frequencia'];
$saida = $_POST['saida'];
$funcionario = $_POST['funcionario'];
$fornecedor = $_POST['fornecedor'];
$obs = $_POST['obs'];
$id = $_POST['id'];


if($descricao == "" and $cliente == "" and $fornecedor == "" and $funcionario == ""){
	echo 'Escolha um Cliente / Fornecedor / Funcionário ou insira uma descrição!';
	exit();
}


if($descricao == "" and $cliente != ""){
	$query = $pdo->query("SELECT * FROM clientes where id = '$cliente'");
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	$nome_cliente = $res[0]['nome'];
	$descricao = $nome_cliente;
}

if($descricao == "" and $funcionario != ""){
	$query = $pdo->query("SELECT * FROM usuarios where id = '$funcionario'");
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	$nome_funcionario = $res[0]['nome'];
	$descricao = $nome_funcionario;
}

if($descricao == "" and $fornecedor != ""){
	$query = $pdo->query("SELECT * FROM fornecedores where id = '$fornecedor'");
	$res = $query->fetchAll(PDO::FETCH_ASSOC);
	$nome_fornecedor = $res[0]['nome'];
	$descricao = $nome_fornecedor;
}

$query = $pdo->query("SELECT * FROM $tabela where id = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
	$foto = $res[0]['arquivo'];
}else{
	$foto = 'sem-foto.png';
}

//SCRIPT PARA SUBIR FOTO NO SERVIDOR
$nome_img = date('d-m-Y H:i:s') .'-'.@$_FILES['arquivo']['name'];
$nome_img = preg_replace('/[ :]+/' , '-' , $nome_img);
$caminho = '../../images/contas/' .$nome_img;

$imagem_temp = @$_FILES['arquivo']['tmp_name']; 

if(@$_FILES['arquivo']['name'] != ""){
	$ext = pathinfo($nome_img, PATHINFO_EXTENSION);   
	if($ext == 'png' or $ext == 'jpg' or $ext == 'jpeg' or $ext == 'gif' or $ext == 'pdf' or $ext == 'rar' or $ext == 'zip' or $ext == 'doc' or $ext == 'docx' or $ext == 'webp'){ 

		if (@$_FILES['arquivo']['name'] != ""){

			//EXCLUO A FOTO ANTERIOR
			if($foto != "sem-foto.png"){
				@unlink('../../images/contas/'.$foto);
			}

			$foto = $nome_img;
		}

		move_uploaded_file($imagem_temp, $caminho);
	}else{
		echo 'Extensão de Imagem não permitida!';
		exit();
	}
}


if(strtotime($data_pgto) <= strtotime($data_atual) and $data_pgto != "" and $data_pgto != "0000-00-00"){
	$pago = 'Sim';
	$data_pag = $data_pgto;
	$usuario_pgto = $id_usuario;
}else{
	$pago = 'Não';
	$data_pag = '';
	$usuario_pgto = '';
}


$dataPgto = '';
if($data_pgto != ""){
    $dataPgto = "data_pgto = '$data_pag', ";
}


if($cliente == ""){
	$cliente = 0;
}

if($funcionario == ""){
	$funcionario = 0;
}

if($fornecedor == ""){
	$fornecedor = 0;
}

if($usuario_pgto == ""){
	$usuario_pgto = 0;
}


if($id == ""){
	$query = $pdo->prepare("INSERT INTO $tabela SET descricao = :descricao, cliente = '$cliente', valor = :valor, data_venc = '$data_venc', $dataPgto frequencia = '$frequencia', saida = '$saida', data_lanc = curDate(), usuario_lanc = '$id_usuario', usuario_pgto = '$usuario_pgto', arquivo = '$foto', pago = '$pago', fornecedor = '$fornecedor', obs = :obs, funcionario = '$funcionario', referencia = 'Conta'");
	$acao = 'inserção';

}else{
	$query = $pdo->prepare("UPDATE $tabela SET descricao = :descricao, cliente = '$cliente', valor = :valor, data_venc = '$data_venc', frequencia = '$frequencia', saida = '$saida', data_lanc = curDate(), usuario_lanc = '$id_usuario', arquivo = '$foto', fornecedor = '$fornecedor', obs = :obs, funcionario = '$funcionario' where id = '$id'");
	$acao = 'edição';
	
}

$query->bindValue(":descricao", "$descricao");
$query->bindValue(":valor", "$valor");
$query->bindValue(":obs", "$obs");
$query->execute();


echo 'Salvo com Sucesso'; 

?>