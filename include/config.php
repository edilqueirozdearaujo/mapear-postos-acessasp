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

	define("cMapboxAccessToken","your-Mapbox-Access-Token"); // -> Learn more: https://www.mapbox.com/mapbox.js/
   define("cSQL_AcessaPOIs","SELECT * FROM ".cTbPostos.";");
   define("cChaveDePermissaoDefault", "d4b560063b49a7d758250cc5580f42361a0eafb67f03d51772a1288a5d0edf658e36e187b5a127f01b442040e188748d5a6003cc7c7edb7c95167a807432c397");
   define("cChaveDePermissaoOSM",     "51e75204fc8734133ca65992530c33aff314c7ecd8481ce3b94349433ffe8bb3cdcd86b175f89630476557dd2ff6d6ed6e7a69db1bb7a48a69c2761515e14d13");
   define("cCaptchaDir","include/securimage/");
	

	//Fields from Postos table	
	define("cFdPtID","ID");
	define("cFdPtNome","Nome");
	define("cFdPtMun","Municipio");
	define("cFdPtGeoc","Geocodigo");
	define("cFdPtAddr","Endereco");
	define("cFdPtPhon","Telefone");
	define("cFdPtEmail","Email");
	define("cFdPtLat","Latitude");
	define("cFdPtLon","Longitude");
	define("cFdPtRua","Rua");
	define("cFdPtNum","Numero");
	define("cFdPtSub","Bairro");
	define("cFdPtCEP","CEP");
	define("cFdPtEdit","Editado");
	define("cFdPtOSM","NoOSM");



?>