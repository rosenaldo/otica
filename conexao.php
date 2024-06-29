<?php 

//definir fuso horário
date_default_timezone_set('America/Sao_Paulo');


//dados conexão bd local
$servidor = 'localhost';
$banco = 'omnidb';
$usuario = 'root';
$senha = '';

/*
$servidor = 'localhost';
$banco = 'hugocu75_assistec';
$usuario = 'hugocu75_assistec';
$senha = 'senhaprojeto';
*/
try {
	$pdo = new PDO("mysql:dbname=$banco;host=$servidor;charset=utf8", "$usuario", "$senha");
} catch (Exception $e) {
	echo 'Erro ao conectar ao banco de dados!<br>';
	echo $e;
}

$url_sistema = "https://$_SERVER[HTTP_HOST]/";
$url = explode("//", $url_sistema);
if($url[1] == 'localhost/'){
	$url_sistema = "http://$_SERVER[HTTP_HOST]/otica/";
}

// TODO: variaveis globais
$nome_sistema = 'OticaVenezza';
$email_sistema = 'omni@omnisolucoes.com.br';
$telefone_sistema = '(84)99439-0605';

$query = $pdo->query("SELECT * from config");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$linhas = @count($res);
if($linhas == 0){
	$pdo->query("INSERT INTO config SET nome = '$nome_sistema', email = '$email_sistema', telefone = '$telefone_sistema', logo = 'logo.png', logo_rel = 'logo.jpg', icone = 'icone.png', validade_orcamento = '7', excluir_orcamentos = '60', comissao_geral = 50, api_whatsapp = 'Não', marca_dagua = 'Sim', impressao_automatica = 'Não', fonte_comprovante = '12', dias_comissao = '7', cobranca_auto = 'Sim', duas_vias_os = 'Sim', ativo = 'Sim', comissao_venda = 5, seletor_api = 'menuia', alterar_acessos = 'Não'");
}else{
$nome_sistema = $res[0]['nome'];
$email_sistema = $res[0]['email'];
$telefone_sistema = $res[0]['telefone'];
$endereco_sistema = $res[0]['endereco'];
$instagram_sistema = $res[0]['instagram'];
$logo_sistema = $res[0]['logo'];
$logo_rel = $res[0]['logo_rel'];
$icone_sistema = $res[0]['icone'];
$validade_orcamento = $res[0]['validade_orcamento'];
$excluir_orcamentos = $res[0]['excluir_orcamentos'];
$comissao_geral = $res[0]['comissao_geral'];
$api_whatsapp = $res[0]['api_whatsapp'];
$token = $res[0]['token'];
$instancia = $res[0]['instancia'];
$chave_pix = $res[0]['chave_pix'];
$marca_dagua = $res[0]['marca_dagua'];
$impressao_automatica = $res[0]['impressao_automatica'];
$fonte_comprovante = $res[0]['fonte_comprovante'];
$cnpj_sistema = $res[0]['cnpj'];
$dias_comissao = $res[0]['dias_comissao'];
$cobranca_auto = $res[0]['cobranca_auto'];
$data_cobranca = $res[0]['data_cobranca'];
$duas_vias_os = $res[0]['duas_vias_os'];
$ativo_sistema = $res[0]['ativo'];
$comissao_venda = $res[0]['comissao_venda'];
$seletor_api = $res[0]['seletor_api'];
$alterar_acessos = $res[0]['alterar_acessos'];
$banco_sistema = $res[0]['banco_sistema'];
$agencia_sistema = $res[0]['agencia_sistema'];
$conta_sistema = $res[0]['conta_sistema'];
$beneficiario_sistema = $res[0]['beneficiario_sistema'];

$whatsapp_sistema = '55'.preg_replace('/[ ()-]+/' , '' , $telefone_sistema);


if($ativo_sistema != 'Sim' and $ativo_sistema != ''){ ?>
	<style type="text/css">
		@media only screen and (max-width: 700px) {
		  .imgsistema_mobile{
		    width:300px;
		  }    
		}
	</style>
	<div style="text-align: center; margin-top: 100px">
	<img src="<?php echo $url_sistema ?>img/bloqueio.png" class="imgsistema_mobile">	
	</div>
<?php 
exit();
} 


}	
 ?>
