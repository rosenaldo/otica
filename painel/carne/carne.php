<?php
require_once("../../conexao.php");
$id = $_GET['id'];
$ref = $_GET['ref'];
if($id == ""){
  echo 'Você não selecionou uma conta valida!';
  exit();
}

$hoje = date("d/m/Y");

?>
<!DOCTYPE HTML>
<!-- SPACES 2 -->
<html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <meta name="Resource-type" content="document">
    <meta name="Robots" content="all">
    <meta name="Rating" content="general">
    <meta name="author" content="Gabriel Masson">
    <title>Carnê</title>
   <link rel="icon" href="../imagens/favicon.ico" type="image/x-icon">
    <link href="css/style.css" rel="stylesheet" type="text/css">
  </head>
  <body>
  <div class="bto">
    Ao Imprimir o carnê certifique-se se a impressão está ajustada à página
    <br>
    <br>
    <button class="btn-impress" onclick="window.print()">Imprimir</button>
    &nbsp;
    <?php echo "<a href=\"capa.php\" class=\"btn\" target=\"_blank\">
      Capa do carnê
    </a>"; ?>
    &nbsp;
   
  </div>

<?php
$query = $pdo->query("SELECT * FROM receber where id_ref = '$id' and referencia = '$ref' order by parcela asc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
  for($i=0; $i<$total_reg; $i++){
    $valor = $res[$i]['valor']; 
    $data_pgto = $res[$i]['data_pgto'];
    $obs = $res[$i]['obs'];   
    $cliente = $res[$i]['cliente']; 
    $data_venc = $res[$i]['data_venc'];
     $descricao = $res[$i]['descricao'];
      $pago = $res[$i]['pago'];

    $data_vencF = implode('/', array_reverse(@explode('-', $data_venc)));
    $data_pgtoF = implode('/', array_reverse(@explode('-', $data_pgto)));

    $valorF = number_format($valor, 2, ',', '.');  
    


  //dados do cliente
  $query2 = $pdo->query("SELECT * FROM clientes where id = '$cliente'");
  $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
  $total_reg2 = @count($res2);
  if($total_reg2 > 0){
    $nome = $res2[0]['nome'];   
    $cpf = $res2[0]['cpf'];   
    $endereco = $res2[0]['endereco'];   
    $pessoa = $res2[0]['pessoa'];
    if($pessoa == 'Física'){
      $tipo_pessoa = 'CPF';
    }else{
      $tipo_pessoa = 'CNPJ';
    }
  }else{
    $nome = '';
    $cpf = '';
    $endereco = '';
    $tipo_pessoa = '';
  }

  $img = '';
  $data_pg = '';
  $data_pg2 = '';
  if($pago == 'Sim'){
    $img = '<div align="center"><img src="../../img/pago.png" style="position:absolute; left:350px;  width:50%; opacity:8%;"></div>';

    $data_pg = $data_pgtoF;
    $data_pg2 = 'Paga Em: ';
  }

  echo $img;

$parcela_numero = $i+1;

  echo "<!-- PARCELA -->
  <div class=\"parcela\">
    <div class=\"grid\">
      <div class=\"col3\">
        <div class=\"destaca\">
          <table width=\"100%\">
            <tr>
              <td>
                <small>Parcela</small>
                <br>{$parcela_numero} / {$total_reg}
              </td>
            <td>
              <small>Valor</small>
              <br>R$ {$valorF}
            </td>
            </tr>
            <tr>
              <td>
                <small>Vencimento</small>
                <br>{$data_vencF}
              </td>
              <td>
              <small>{$data_pg2}</small>
              <br>{$data_pg}
            </td>
            </tr>
            <tr>
              <td colspan=\"2\">
              <small><b>Descrição:</b> {$descricao}</small><br>
                
                <small>Observações</small><br>
                <small>{$obs}</small>
                <br><br><br>
              </td>
            </tr>
          </table>
        </div>
      </div>
      <div class=\"col9\">
        <table width=\"100%\">
          <tr>
            <td colspan=\"2\">
              <small>Nome do cedente</small>
              <br>{$nome_sistema}
            </td>
            <td>
              <small>Parcela</small>
              <br>{$parcela_numero} / {$total_reg}
            </td>
            <td>
              <small>Valor</small>
              <br>R$ {$valorF}
            </td>
          </tr>
          <tr>
            <td>
              <small>Data do Documento</small>
              <br>{$hoje}
            </td>
            <td>
              <small>Tipo de Documento</small>
              <br>Carnê
            </td>
            <td colspan=\"2\">
              <small>Vencimento</small>
              <br>{$data_vencF}
            </td>
          </tr>
          <tr>
            <td colspan=\"1\">
            <small>
              <b>Dados do Cliente</b><br>  
              <small>Nome: {$nome}</small> <br>
              <small>{$tipo_pessoa}: {$cpf}</small><br>
            </small>  
             
            </td>
            
            <td colspan=\"2\">
            <small>
              <b>Dados para Pagamento</b><br>  
              <small>Banco: {$banco_sistema}</small> <br>
              <small>Conta: {$conta_sistema} Agência: {$agencia_sistema}</small><br>
             
              <small>{$beneficiario_sistema}</small>
              </small>
            </td>
            <td colspan=\"1\">
            <small>
             <b>Pix</b> 
              <small>Chave Pix<br> {$chave_pix}</small> <br><br>
            <img src='../../img/qr.jpg' width='65px' height='65px'>
            </small>
            </td>
          </tr>
        </table>
       
      </div>
    </div>
  </div>";

  if (!@$count_quebra_pg) { @$count_quebra_pg = 0; } // Preenche Variavel
  @$count_quebra_pg++; // contagem de loop
  if (@$count_quebra_pg == 4) { // Adiciona quebra a cada 4 loops e zera a variavel
    echo "<div class=\"quebra-pagina\"></div>";
    @$count_quebra_pg = 0;
  }

  

}

  }else{
  echo 'Você não selecionou uma conta valida!';
  exit();
}


  


?>

  </body>
</html>