<?php
header("access-control-allow-origin: https://pagseguro.uol.com.br");
header("Content-Type: text/html; charset=UTF-8",true);
date_default_timezone_set('America/Sao_Paulo');

require_once("PagSeguro.class.php");
$PagSeguro = new PagSeguro();
	

$_GET['codigo'] = "teste";

//EFETUAR PAGAMENTO	 =
$venda = array("codigo"=>"1",
			   "valor"=>100.00,
			   "descricao"=>"VENDA DE NONONONONONO",
			   "nome"=>"Cliente",
			   "email"=>"cliente@cliente.com",
			   "telefone"=>"(21) 1234-1234",
			   "rua"=>"ba",
			   "numero"=>"ba",
			   "bairro"=>"ba",
			   "cidade"=>"ba",
			   "estado"=>"BA", //2 LETRAS MAIÚSCULAS
			   "cep"=>"78.456-123",
			   "codigo_pagseguro"=>"x45u");
			   
$PagSeguro->executeCheckout($venda,"localhost:8080/pagseguro/".$_GET['codigo']);

//----------------------------------------------------------------------------


//RECEBER RETORNO
if( isset($_GET['transaction_id']) ){
	$pagamento = $PagSeguro->getStatusByReference($_GET['codigo']);
	
	$pagamento->codigo_pagseguro = $_GET['transaction_id'];
	if($pagamento->status==3 || $pagamento->status==4){
		//ATUALIZAR DADOS DA VENDA, COMO DATA DO PAGAMENTO E STATUS DO PAGAMENTO
		
	}else{
		//ATUALIZAR NA BASE DE DADOS
	}
}

?>