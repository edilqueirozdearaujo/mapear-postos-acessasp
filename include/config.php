<?
// Projeto RGM

	//--------------------------------------------------------
	//General
	define("cTituloSite","Projeto RGM");
	define("cDominio","projetorgm.com.br");
	define("cDominioFullURL","http://www.".cDominio);
	define("cDominioFullURLSSL","https://".cDominio);

	//--------------------------------------------------------
	//Database
	define("cDBHost","");
	define("cDBName","");
	define("cDBUser","");
	define("cDBPass","");

	$TbPrefix = "";

	define("cTbPostos",$TbPrefix."PostosAcessa");

	//Fields from Postos table	
	$cFdPtID           = "ID";
	$cFdPtNome         = "Nome";
	$cFdPtMun          = "Municipio";
	$cFdPtGeoc         = "Geocodigo";
	$cFdPtAddr         = "Endereco";
	$cFdPtPhon         = "Telefone";
	$cFdPtEmail        = "Email";
	$cFdPtLat          = "Latitude";
	$cFdPtLon          = "Longitude";
	$cFdPtRua          = "Rua";
	$cFdPtNum          = "Numero";
	$cFdPtSub          = "Bairro";
	$cFdPtCEP          = "CEP";
	$cFdPtOSM          = "NoOSM";



?>