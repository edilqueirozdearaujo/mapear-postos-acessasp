<?
	error_reporting(1);
	ini_set("display_errors", 1 );

include_once "funcoes.php";
include_once "leaflet.php";
include_once "db.php";

$IconDir = "imagens/pois/"; 
$IconSize = "37,44";
$IconShadowSize = "44,32";

	
function LinkOSMR($Lat,$Lon) {
	$Lat = ZeroDireita($Lat,10); //Contando com sinal negativo e ponto
	$Lon = ZeroDireita($Lon,10);
	
	$Link = "http://map.project-osrm.org/?hl=pt&loc=-24.015827,-48.348892&loc=".$Lat.",".$Lon."&z=17&center=".$Lat.",".$Lon."&alt=0&df=0&re=0&ly=-1171809665";
	$Link = ComporLinkHTML($Link,"Como Chegar","","<img src='imagens/pois/icon-poi-route.png' /> Como Chegar");
	return $Link;
}

//------------------------------------------------------------------------------------------
function LinkF4Map($Lat,$Lon) {
	$Lat = ZeroDireita($Lat,11); //Contando com sinal negativo e ponto
	$Lon = ZeroDireita($Lon,11);
	
	$Link = "http://demo.f4map.com/#lat=".$Lat."&lon=".$Lon."&zoom=19&camera.theta=58.465";
	$Link = ComporLinkHTML($Link,"Veja em um mapa 3D","","<img src='imagens/pois/icon-poi-3dmap.png' /> Veja em 3D");
	return $Link;
}

//------------------------------------------------------------------------------------------
function LinkMapillary($Lat,$Lon) {
	$Lat = ZeroDireita($Lat,19); //Contando com sinal negativo e ponto
	$Lon = ZeroDireita($Lon,19);
	
	$Link = "http://www.mapillary.com/map/im/18/".$Lat."/".$Lon;
	$Link = ComporLinkHTML($Link,"Veja no StreetView","","<img src='imagens/pois/icon-poi-streetview.png' /> StreetView deste local");
	return $Link;
}

//------------------------------------------------------------------------------------------
function LinkEditar($Lat,$Lon) {
	$Lat = ZeroDireita($Lat,9); //Contando com sinal negativo e ponto
	$Lon = ZeroDireita($Lon,9);
	
	$Link = "http://www.openstreetmap.org/edit#map=18/".$Lat."/".$Lon;
	$Link = ComporLinkHTML($Link,"Editar este mapa","","<img src='imagens/pois/icon-poi-edit.png' /> Editar mapa");
	return $Link;
}


function BotaoVerPOIem($Link) {
	Linha("			 <p class='caixas-arredondadas poi-veronde'>$Link</p>");
} 


function PrepararResultadosAcessa($ExeSQL,$TotalPOIs,$POISelecionado,&$POI, $MapaZoom, $MapaCenterLat, $MapaCenterLon, &$POISelecionadoDetalhes) { 		
	$ArrayPOIs = array();			//Varre todos POIs
	
//		$TotalPOIs = MySQLResults($ExeSQL);
	if( $TotalPOIs > 0 ) {													//Trouxe resultados?
			for($Cont=1;$Cont<=$TotalPOIs;$Cont++) {
				$ArrayPOIs = mysql_fetch_array($ExeSQL);
				
  					//================================================================================================
  					//Opção de Zoom						 
				$URLAproximar = "";
				if( $POISelecionado != $ArrayPOIs['ID'] ) {
					$URLAproximar = $MinhaURL . "?poi=" . $ArrayPOIs['ID'];
					$URLAproximar = "<br>" . ComporLinkHTML($URLAproximar,"Clique aqui para dar um zoom neste POI",
							      			    					 "","Revisar e submeter dados");
//								$URLAproximar = TrocarCaractere($URLAproximar,"'","\"");
				}							


				//================================================================================================
				//Conteúdo do balão para os POIs não selecionados (default)
				//se número vazio, mostra latitude
  					//Se complemento existe, mostra antes do número					 
				$LatLon = $ArrayPOIs['Latitude'] . "," . $ArrayPOIs['Longitude'];
				$PreEndereco = $ArrayPOIs['Endereco'] . "<br>Coordenadas: ". $LatLon;				
			
				$Conteudo = "<b>". $ArrayPOIs['Nome'] ."</b>"
							 . "<br>". $PreEndereco 
							 . "<br>". $URLAproximar;
							 													
				$POI[$Cont]['ID']				   = $ArrayPOIs['ID'];
				$POI[$Cont]['Lat']				= $ArrayPOIs['Latitude'];
				$POI[$Cont]['Lon']				= $ArrayPOIs['Longitude'];
				$POI[$Cont]['Descricao']		= $Conteudo;
				$POI[$Cont]['Popup']				= "none";
				$POI[$Cont]['Editado']    	   = (boolean)$ArrayPOIs['Editado'];
				$POI[$Cont]['NoOSM']    	   = (boolean)$ArrayPOIs['NoOSM'];
				
  					//================================================================================================
  					//POI foi selecionado (em foco)?
				if( $POISelecionado == $ArrayPOIs['ID']) {		
					$POI[$Cont]['Popup']			= "popup";
					
					//--------------------------------------------------------------------------------------
					//Montagem do endereço
					if( !Vazio($ArrayPOIs['Rua']) ) { 
						$Endereco = $ArrayPOIs['Rua'].", ".$ArrayPOIs['Numero'].", ".$ArrayPOIs['Bairro'].", CEP ".$ArrayPOIs['CEP'] . ", " . $ArrayPOIs['Municipio'] . ", SP";
					}else {
						$Endereco = "<small>AGUARDANDO CONFIRMAÇÃO DOS DADOS...</small>"; 
					}

					$POISelecionadoDetalhes['ID'] 			= $ArrayPOIs['ID'];
					$POISelecionadoDetalhes['Nome'] 			= $ArrayPOIs['Nome'];
					$POISelecionadoDetalhes['Conteudo'] 	= "<h4>MUNICÍPIO DE ".$ArrayPOIs['Municipio']." - <small>GEOCÓDIGO IBGE ".$ArrayPOIs['Geocodigo']."</small></h4><p><b>Endereço: </b>$Endereco</p>";
					$POISelecionadoDetalhes['Rua'] 			= $ArrayPOIs['Rua'];
					$POISelecionadoDetalhes['Numero'] 		= $ArrayPOIs['Numero'];
					$POISelecionadoDetalhes['Bairro'] 		= $ArrayPOIs['Bairro'];
					$POISelecionadoDetalhes['CEP'] 			= $ArrayPOIs['CEP'];
					$POISelecionadoDetalhes['Telefone'] 	= $ArrayPOIs['Telefone'];
					$POISelecionadoDetalhes['Email'] 		= $ArrayPOIs['Email'];
					$POISelecionadoDetalhes['Latitude'] 			= $ArrayPOIs['Latitude'];
					$POISelecionadoDetalhes['Longitude'] 			= $ArrayPOIs['Longitude'];
				   $POISelecionadoDetalhes['Editado']    	   = (boolean)$ArrayPOIs['Editado'];
				   $POISelecionadoDetalhes['NoOSM']    	= (boolean)$ArrayPOIs['NoOSM'];
					
					$POISelecionadoDetalhes['OSMR'] 			= LinkOSMR($ArrayPOIs['Latitude'],$ArrayPOIs['Longitude']);
					$POISelecionadoDetalhes['Mapilarry']	= LinkMapillary($ArrayPOIs['Latitude'],$ArrayPOIs['Longitude']);
					$POISelecionadoDetalhes['F4Map'] 		= LinkF4Map($ArrayPOIs['Latitude'],$ArrayPOIs['Longitude']);
					$POISelecionadoDetalhes['OSMEdit'] 		= LinkEditar($ArrayPOIs['Latitude'],$ArrayPOIs['Longitude']);
				}
				
				
//$Nome,$Rua,$Numero,$Bairro,$CEP,$Telefone,$Email,$ID,$Lat,$Lon,$NoOSM)				
				
			}
	}
}	

function MostrarPOIsAcessa($POI,$TotalPOIs,$Force,$Selecionado) {
	if( $TotalPOIs > 0 ) {
	  for($Cont=1;$Cont<=$TotalPOIs;$Cont++) {
	  	   $Icone = "normal";
	  	   if( $POI[$Cont]['NoOSM']  ) { $Icone = "noosm"; }
			elseif( $POI[$Cont]['Editado'] ) { $Icone = "editado"; } 
	  	   $Drag = FALSE;
         if( (int)$Selecionado == (int)$POI[$Cont]['ID'] ) {
           $Drag = TRUE; 
         }	 	  	
	  	
			if( $Force ) {											//Para finalizar com um ";"
					lfAddMarkerDrag("icon_" . $Icone,"layerG_$Icone",$POI[$Cont]['Lat'],$POI[$Cont]['Lon'],$POI[$Cont]['Descricao'],"none",$POI[$Cont]['Popup'],$Drag,"TextLat","TextLon");
			}else {	
			  	   if( $Cont < $TotalPOIs  ) {					
						lfAddMarkerDrag("icon_" . $Icone,"layerG_$Icone",$POI[$Cont]['Lat'],$POI[$Cont]['Lon'],$POI[$Cont]['Descricao'],"end",$POI[$Cont]['Popup'],$Drag,"TextLat","TextLon");
					}else {
						lfAddMarkerDrag("icon_" . $Icone,"layerG_$Icone",$POI[$Cont]['Lat'],$POI[$Cont]['Lon'],$POI[$Cont]['Descricao'],"end",$POI[$Cont]['Popup'],$Drag,"TextLat","TextLon");
					}								
			}		  	
	  }	
	}else {
		//echo "não há resultados....";		
	}
}	

?>