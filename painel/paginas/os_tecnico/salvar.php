<?php 
$tabela = 'os';
require_once("../../../conexao.php");
@session_start();
$id_usuario = @$_SESSION['id'];

$data_atual = date('Y-m-d');


$obs = $_POST['obs'];
$id = $_POST['id'];

$equipamento = $_POST['equipamento'];
$situacao = $_POST['situacao'];
$acessorios = $_POST['acessorios'];
$condicoes = $_POST['condicoes'];
$laudo = $_POST['laudo'];



$laboratorio = @$_POST['laboratorio'];
$pedido = @$_POST['pedido'];
$doutor = @$_POST['doutor'];

$longe1 = @$_POST['longe1'];
$longe2 = @$_POST['longe2'];
$longe3 = @$_POST['longe3'];
$longe4 = @$_POST['longe4'];
$longe5 = @$_POST['longe5'];
$longe6 = @$_POST['longe6'];
$longe7 = @$_POST['longe7'];
$longe8 = @$_POST['longe8'];
$longe9 = @$_POST['longe9'];
$longe10 = @$_POST['longe10'];
$longe11 = @$_POST['longe11'];
$longe12 = @$_POST['longe12'];

$perto1 = @$_POST['perto1'];
$perto2 = @$_POST['perto2'];
$perto3 = @$_POST['perto3'];
$perto4 = @$_POST['perto4'];
$perto5 = @$_POST['perto5'];
$perto6 = @$_POST['perto6'];
$perto7 = @$_POST['perto7'];
$perto8 = @$_POST['perto8'];
$lente = @$_POST[0]['lente'];
$cotico = @$_POST[0]['cotico'];
$altura = @$_POST[0]['altura'];
$cor = @$_POST[0]['cor'];
$retificacao = @$_POST[0]['retificacao'];


$query = $pdo->prepare("UPDATE $tabela SET equipamento = :equipamento, situacao = :situacao, acessorios = :acessorios, condicoes = :condicoes, laudo = :laudo, obs = :obs, laboratorio = :laboratorio, pedido = :pedido, doutor = :doutor, longe1 = :longe1, longe2 = :longe2, longe3 = :longe3, longe4 = :longe4, longe5 = :longe5, longe6 = :longe6, longe7 = :longe7, longe8 = :longe8, longe9 = :longe9, longe10 = :longe10, longe11 = :longe11, longe12 = :longe12, perto1 = :perto1, perto2 = :perto2, perto3 = :perto3, perto4 = :perto4, perto5 = :perto5, perto6 = :perto6, perto7 = :perto7, perto8 = :perto8 where id = '$id'");


$query->bindValue(":obs", "$obs");
$query->bindValue(":equipamento", "$equipamento");
$query->bindValue(":situacao", "$situacao");
$query->bindValue(":acessorios", "$acessorios");
$query->bindValue(":condicoes", "$condicoes");
$query->bindValue(":laudo", "$laudo");
$query->bindValue(":laboratorio", "$laboratorio");
$query->bindValue(":pedido", "$pedido");
$query->bindValue(":doutor", "$doutor");

$query->bindValue(":longe1", "$longe1");
$query->bindValue(":longe2", "$longe2");
$query->bindValue(":longe3", "$longe3");
$query->bindValue(":longe4", "$longe4");
$query->bindValue(":longe5", "$longe5");
$query->bindValue(":longe6", "$longe6");
$query->bindValue(":longe7", "$longe7");
$query->bindValue(":longe8", "$longe8");
$query->bindValue(":longe9", "$longe9");
$query->bindValue(":longe10", "$longe10");
$query->bindValue(":longe11", "$longe11");
$query->bindValue(":longe12", "$longe12");

$query->bindValue(":perto1", "$perto1");
$query->bindValue(":perto2", "$perto2");
$query->bindValue(":perto3", "$perto3");
$query->bindValue(":perto4", "$perto4");
$query->bindValue(":perto5", "$perto5");
$query->bindValue(":perto6", "$perto6");
$query->bindValue(":perto7", "$perto7");
$query->bindValue(":perto8", "$perto8");
$query->execute();


echo 'Salvo com Sucesso'; 


?>