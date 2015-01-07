<?
// Projeto RGM
// 
//
//
//

//======= Includes
include_once "include/lang.php"; 	
include_once "include/config.php"; 	
include_once "include/funcoes.php"; 	
include_once "include/db.php"; 	
include_once "include/proc.php"; 	
include_once "include/leaflet.php"; 	


//======= Only for this page
	$MinhaURL 	   = $_SERVER['PHP_SELF'];
	$MinhaURL = NoIndexPHP($MinhaURL);	
	
	$ErrosNaPagina = "";
	function TryShowError($ErrorStr) {
		if( !Vazio($ErrorStr) ) {
			Linha ("<p class='showerror'><b>$ErrorStr</b></p>");		
		} 
	}
	

//======= Pre-process
	RedirectIfNotIsHTTPS(cDominioFullURLSSL . $MinhaURL); //Força HTTPS
	//session_start();
	$SemErro = FALSE;
	$SemErro = SecSessionStart("calendario",TRUE);
	if( !$SemErro ) {	$SemErro = SecSessionStart("calendario",FALSE);}	
	if( !$SemErro ) {	AddMsg("ErrSessStart",$ErrosNaPagina); session_start("calendario");}	

	$IsMobileBrowser = FALSE;	
	if( IsMobileBrowser() ) { $IsMobileBrowser = TRUE; }


	//Se não tiver configurado país, linguagem e tipo de calendário, configura e redireciona 
	// (geralmente, a primeira visita ao site)
	if( !isset($_SESSION['Lang']) || !isset($_SESSION['Country'])) {
	   $_SESSION['Lang']    = "pt";
	   $_SESSION['Country'] = "BR"; 
//	   $_SESSION['CalTipo'] = cTypeYear;
	}
	SetLanguage($_SESSION['Lang']);	
	//SetCalendarType($_SESSION['CalTipo']);					


//======= Pre-process
//	Pre-action

 //exit volta ao início da página
 if (filter_has_var(INPUT_POST,'exit')) { 	
	 ClearVars(); 	 
 	 RedirecionarPHP($MinhaURL);
 }
/* elseif (filter_has_var(INPUT_POST,'country')) {
		$Pais = filter_input(INPUT_POST,'country',FILTER_SANITIZE_STRING);
		$Country = CountryFilter($Pais);
		$Lang    = CountryToLanguage($Country);		
	   $_SESSION['Lang']    = $Lang;
	   $_SESSION['Country'] = $Country; 
		RedirecionarPHP($MinhaURL);
 }*/
 elseif (filter_has_var(INPUT_GET,'id')) {
 	   //Prevent first step
 	   ClearVars(); 
 	   
 }



?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
   <?
       Linha("	<title>".GetMsg('SiteTitle')." </title>");     
   ?>
	<link href="css/geral.css" rel="stylesheet" type="text/css"/>	
	<link href="css/map.css" rel="stylesheet" type="text/css"/>	
	<link rel="shortcut icon" href="imagens/favicon.png" type="image/png"/>
	<script src="include/funcoes.js"></script>
	<!-- Mapbox  -->
	<script src='https://api.tiles.mapbox.com/mapbox.js/v2.1.4/mapbox.js'></script>
	<link href='https://api.tiles.mapbox.com/mapbox.js/v2.1.4/mapbox.css' rel='stylesheet' />
	<script src='include/leafletrout.js'></script>
</head>
<body>
	<?	
//		Linha( "<div class='meio'" );
	   if( isset($NoneNoneNone)) {
	   }
		//Else, is the start
		else {
			DesenharMapa("mapdiv");
		}		

	    TryShowError($ErrosNaPagina);
//	 Linha( "</div>" );

   ?>
</body>
</html>