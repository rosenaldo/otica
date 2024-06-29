<?php 
require_once("../../conexao.php");

$id = @$_POST['id'];
$enviar = @$_POST['enviar'];

$html = file_get_contents($url_sistema."painel/rel/os.php?id=$id");

//CARREGAR DOMPDF
require_once '../../dompdf/autoload.inc.php';
use Dompdf\Dompdf;
use Dompdf\Options;

header("Content-Transfer-Encoding: binary");
header("Content-Type: image/png");

//INICIALIZAR A CLASSE DO DOMPDF
$options = new Options();
$options->set('isRemoteEnabled', TRUE);
$pdf = new DOMPDF($options);


//Definir o tamanho do papel e orientação da página
$pdf->set_paper('A4', 'portrait');

//CARREGAR O CONTEÚDO HTML
$pdf->load_html($html);

//RENDERIZAR O PDF
$pdf->render();
//NOMEAR O PDF GERADO


$output = $pdf->output();
$arquivo = "../pdf/os/os_".$id.".pdf";
	
if(file_put_contents($arquivo,$output) <> false) {
	$pdf->stream(
	'os.pdf',
	array("Attachment" => false)
);

}


$query = $pdo->query("SELECT * from os where id = '$id' ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$cliente = $res[0]['cliente'];

$query = $pdo->query("SELECT * from clientes where id = '$cliente' ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$telefone = $res[0]['telefone'];

//enviar relatório para o whatsapp
if($enviar == 'Sim' and $api_whatsapp == 'Sim'){
$telefone_envio = '55'.preg_replace('/[ ()-]+/' , '' , $telefone);
$mensagem = 'receita';
$url_envio = $url_sistema."painel/pdf/os/os_".$id.".pdf";
require("../../apis/doc.php");
}



 ?>