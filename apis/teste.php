<?php
  $url = "http://api.wordmensagens.com.br/send-text";

  $data = array('instance' => "S7QKEJ96",
                'to' => "5531975275084",
                'token' => "DBFY7-5NP-090U0",
                'message' => "Mensagem a ser Enviada Sistema");


  $options = array('http' => array(
                 'method' => 'POST',
                 'content' => http_build_query($data)
  ));

  $stream = stream_context_create($options);

  $result = @file_get_contents($url, false, $stream);

  echo $result;
?>
  