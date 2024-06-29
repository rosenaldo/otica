<?php
require_once("../../conexao.php");
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
    <title>Capa do Carnê</title>
     <link rel="icon" href="../imagens/favicon.ico" type="image/x-icon">
    <link href="css/style.css" rel="stylesheet" type="text/css">
  </head>
  <body>
  <div class="bto">
    Ao Imprimir o carnê certifique-se se a impressão está ajustada à página
    <br>
    <br>
    <button class="btn-impress" onclick="window.print()">Imprimir</button>
  </div>

  <div class="capa">
    <div class="grid">
      <div class="col5 text-center">
        <img class="logocapa" src="img/logo.svg">
      </div>
      <div class="col5">
        <h1>Carnê de Pagamento</h1>
        <p><b><?php echo mb_strtoupper($nome_sistema) ?></b></p>
        <p><small><?php echo $endereco_sistema ?></small> 
        <br><small> Telefone: <strong> <?php echo $telefone_sistema ?> </strong></small> </p>
      </div>
      <div class="col2">
      <img class='pix' src='../../img/qr.jpg'>
      </div>
    </div>
  </div>

  </body>
</html>