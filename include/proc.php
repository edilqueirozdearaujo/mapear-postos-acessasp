<?

 define("cSiteRGM","<a href='https://projetorgm.com.br/'><img class='alinhar-vertical' src='imagens/RGM-logo.png' width='32px' /> projetorgm.com.br</a>");
 $MensagemBoasVindas = "<p>Vamos colocar os postos do Acessa SP no mapa do OpenStreetMap? Esta ferramenta te ajudará a mapear e acompanhar o andamento, "
           . " principalmente se você não tem intimidade com mapas ou quer começar agora."
           ." <b>Saiba que <b>você mesmo pode</b> e tem a liberdade de  realizar edições no mapa do OSM!!</b></p>"
           ." <h4>➯ Quer começar no mundo do OpenStreetMap? ". ComporLinkHTML("http://projetorgm.com.br/blog/guia-de-openstreetmap/' class='active","","","Clique aqui e saiba mais - seja bem-vindo!!") .""
           ." <br>➯ ". ComporLinkHTML("aplicativos.php' class='active","","","Clique aqui e conheça aplicativos relacionados a mapas recomendados pelo projeto") ."</h4>"			           
           ."<h4>Como funciona esta ferramenta:</h4>"
           ."<ul>"
	           ."<li> Pesquise por um posto ou localize dentro do mapa e clique no marcador.</li>"
	           ."<li> Verifique e revise os dados e mova o marcador para o local correto.</li>"
	           ."<li> Não consegue mover o marcador? Provavelmente seu município tem mais de um posto e por padrão, ambos terão as mesmas coordenadas e o outro está por cima. Nesse caso, apenas edite o que estiver em cima primeiro.</li>"
	           ."<li> Clique em <b>Salvar dados!</b></li>"
	           ."<li> Se o posto <b>já estiver</b> no mapa do OpenStreetMap, marque <b>SIM</b> para <b>Está no mapa</b>.</li>"
	           ."<li> Se onde seu posto está não há imagem de satélite mas você tem um aparelho com GPS, você pode usar o botão localizar <img src='mapear-postos/locate.png' > para identificar sua localização</li>"
	           ."<li> O formulário para relatar problemas com cobertura de imagem serve para sabermos onde há \"falhas\" na cobertura.</li>"
           ."</ul>";


/*	Linha("			L.marker([-21.4829998016357,-51.5331993103027], {");
	Linha("				title :'teste de marcador'");
	Linha("			}).bindPopup('b>TESTE</b><br>teste de marcador').addTo(layer_editado);");
	Linha("						 ");
*/

function Legenda($PcMapear,$PcEdit,$PcNoosm,$Total) {
	Linha("	<!-- A legenda é dinâmica, então o estilo também... por isso está aqui 	-->");
	Linha("	<style>");
	Linha("			#lgdmapear{");
	Linha("			  width: ".$PcMapear."%;			");
	Linha("			  background:#74A9CF;");
	Linha("			}");
	Linha("			#lgdeditados{");
	Linha("			  width: ".$PcEdit."%;");
	Linha("			  background:#FE492D;");
	Linha("			}");
	Linha("			#lgdnoosm{");
	Linha("			  width: ".$PcNoosm."%;");
	Linha("			  background:#75E775;");
	Linha("			}");
	Linha("	</style>");
	Linha("	<!-- Set the display of this container to none so we can add it programmatically to `legendControl`");
	Linha("	source: https://www.mapbox.com/mapbox.js/example/v1.0.0/custom-legend/ -->");
	Linha("	<div id='legend' style='display:none;'>");
	Linha("	  <strong>Mapeamento dos Postos do Acessa SP</strong>");
	Linha("	  <nav class='legend clearfix'>");
	Linha("	    <span id='lgdmapear'></span>");
	Linha("	    <span id='lgdeditados'></span>");
	Linha("	    <span id='lgdnoosm'></span>");
	Linha("	    <label>A mapear: ".$PcMapear."%</label>");
	Linha("	    <label>Editados: ".$PcEdit  ."%</label>");
	Linha("	    <label>No mapa:  ".$PcNoosm ."%</label>");
	Linha("	    <strong>Total: $Total | <b>Pesquisar um posto</b></strong>");
	Linha("	  </nav>	    ");
	Linha("	</div>");
}

function DesenharMapa($MapDiv) {
	Legenda(90,2,8,988);
	
	
	Linha("");
	Linha("	<div id='$MapDiv'></div>");
	Linha("	<script>");
	Linha("			//Ajusta altura do mapa de acordo com a tela - não se esqueça da unidade de medida");
	Linha("			var ScreenH = (GetScreenHeight() -20);");
	Linha("			var ScreenH = ScreenH + 'px';");
	Linha("			document.getElementById('$MapDiv').style.height = ScreenH;");
	Linha("");
	Linha("			L.mapbox.accessToken = '" . cMapboxAccessToken ."';");
	Linha("			var map = L.mapbox.map('$MapDiv');");
	Linha("");
	Linha("			//Default layer to show");
	Linha("			layer_mapnik.addTo(map);  ");
	Linha("			layer_editado.addTo(map); ");
	Linha("			layer_noosm.addTo(map);");
	Linha("");
	Linha("			L.control.layers({");
	Linha("			    'OpenStreetMap': layer_mapnik,");
	Linha("			    'Ciclistas'    : layer_cycle");
	Linha("			},{");
	Linha("             'A mapear'      : layer_mapear,");
	Linha("             'Editados'      : layer_editado,");
	Linha("             'No Mapa'       : layer_noosm			");
	Linha("			}");
	Linha("			).addTo(map);");
	Linha("	");
	Linha("	");
	
	//Marcadores são adicionados aqui 


	Linha("");
	Linha("			map.setView([-22.53514,-48.36743], 7);");
	Linha("			map.legendControl.addLegend(document.getElementById('legend').innerHTML);");
	Linha("	</script>");


}



function DesenharForm($Nome,$Rua,$Numero,$Bairro,$CEP,$Telefone,$Email,$ID,$Lat,$Lon,$NoOSM){ 
   global $MinhaURL;      
   $NoOSM0 = " checked='true' "; 
   $NoOSM1 = ""; 
   if( $NoOSM ) {
      $NoOSM0 = ""; 
      $NoOSM1 = " checked='true' "; 
   }

   if( Vazio($Rua) ) { $Rua = "RUA"; }
   if( Vazio($Numero) ) { $Numero = "NÚMERO"; }
   if( Vazio($Bairro) ) { $Bairro = "BAIRRO"; }
   if( Vazio($CEP) || $CEP == 0 ) { $CEP = "CEP"; }
   if( Vazio($Email) ) { $Email = "EMAIL"; }


  $Telefone1DDD = "DDD";
  $Telefone1    = "TELEFONE";
  $Telefone2DDD = "DDD";
  $Telefone2    = "TELEFONE";
  $Telefone3DDD = "DDD";
  $Telefone3    = "TELEFONE";

  if( !Vazio($Telefone) ) {
	  $Telefones = explode(";",$Telefone);
	  $Tamanho = count($Telefones);
	  for( $Cont=0; $Cont<$Tamanho; $Cont++ ) {
	     $DadosTemp = explode(",",$Telefones[$Cont]);
	     
	     //BR,DDD,Numero
	     switch( $Cont ) {
				case 0:
				   $Telefone1DDD = $DadosTemp[1]; 
				   $Telefone1    = $DadosTemp[2]; 
				break;        
				case 1:
				   $Telefone2DDD = $DadosTemp[1]; 
				   $Telefone2    = $DadosTemp[2]; 
				break;        
				case 2:
				   $Telefone3DDD = $DadosTemp[1]; 
				   $Telefone3    = $DadosTemp[2]; 
				break;        
	     }
	  }
  }	


	Linha("<form id='formdados'  method='post' action='$MinhaURL'>");
   Linha("	<fieldset>");
   Linha("	<legend>Dados do posto</legend>");
	Linha("		<p><b>Nome</b> <input id='TextNome' name='TextNome' type='text' onblur='EmUpperCase(this);' value='$Nome' size='60' />");
   Linha("		   <br><small>Apenas o nome do posto. O prefixo \"posto\" é adicionado automaticamente</small></p>");

	Linha("		<p>");
	Linha("			<b>Endereço</b> <input id='TextRua' name='TextRua' type='text' value='$Rua' size='60' onblur='EmUpperCase(this);' onclick='this.focus();this.select()' />");
	Linha("							 <input id='TextNumero' name='TextNumero' type='text' value='$Numero' size='5' onclick='this.focus();this.select()' />");
	Linha("							 <input id='TextBairro' name='TextBairro' type='text' value='$Bairro'  onblur='EmUpperCase(this);' onclick='this.focus();this.select()' />");
	Linha("							 <input id='TextCEP' name='TextCEP' type='text' value='$CEP'  onclick='this.focus();this.select()' />");
	Linha("		   <br><small>Se o endereço não tiver número, coloque <b>0</b> (*zero)<br>O CEP é somente números, e sem traço. Ex: 18315000</small>");
	Linha("		</p>");

	Linha("		<p><b>Coordenadas</b> <input id='TextLat' name='TextLat' type='text' readonly='true' value='$Lat' />, <input id='TextLon' name='TextLon' type='text' readonly='true' value='$Lon' />");
   Linha("		   <br><small>O marcador está no lugar errado? Arraste o ele em cima de onde fica seu posto no mapa</small></p>");


	Linha("		<p>");
	Linha("			<b>Telefone 1</b> <input id='TextTelefone1DDD' name='TextTelefone1DDD' type='text' value='$Telefone1DDD' size='3' onblur='EmUpperCase(this);' onclick='this.focus();this.select()' />");
	Linha("							 <input id='TextTelefone1' name='TextTelefone1' type='text' value='$Telefone1' onblur='EmUpperCase(this);' onclick='this.focus();this.select()' />");
	Linha("	  <br><b>Telefone 2</b> <input id='TextTelefone2DDD' name='TextTelefone2DDD' type='text' value='$Telefone2DDD' size='3' onblur='EmUpperCase(this);' onclick='this.focus();this.select()' />");
	Linha("							 <input id='TextTelefone2' name='TextTelefone2' type='text' value='$Telefone2' onblur='EmUpperCase(this);' onclick='this.focus();this.select()' />");
	Linha("	  <br><b>Telefone 3</b> <input id='TextTelefone3DDD' name='TextTelefone3DDD' type='text' value='$Telefone3DDD' size='3' onblur='EmUpperCase(this);' onclick='this.focus();this.select()' />");
	Linha("							 <input id='TextTelefone3' name='TextTelefone3' type='text' value='$Telefone3' onblur='EmUpperCase(this);' onclick='this.focus();this.select()' />");
	Linha("		<br><small>Deixe em branco se não houver dados</small>");
	Linha("		</p>");

	Linha("		<p>");
	Linha("			<b>Email</b> <input id='TextEmail' name='TextEmail' type='text' value='$Email' size='40' onblur='EmLowerCase(this);' onclick='this.focus();this.select()' />");
	Linha("		   <br><small>Email de contato do posto</small>");
	Linha("		</p>");


	Linha("<hr>");
	Linha("		<input id='RadioOSM' name='RadioOSM' type='hidden' value='0' />");

	Linha("<hr>");
	Linha("		<p>");
	Linha("		<img id='siimage' style='border: 1px solid #000; vertical-align: middle;' src='".cCaptchaDir."securimage_show.php?sid=". md5(uniqid()) ."' alt='desafio CAPTCHA' >");
//	Linha("	<object type='application/x-shockwave-flash' data='".cCaptchaDir."securimage_play.swf?bgcol=#ffffff&amp;icon_file=".cCaptchaDir."images/audio_icon.png&amp;audio_file=".cCaptchaDir."securimage_play.php' height='32' width='32'>");
//	Linha("	<param name='movie' value='".cCaptchaDir."securimage_play.swf?bgcol=#ffffff&amp;icon_file=".cCaptchaDir."images/audio_icon.png&amp;audio_file=".cCaptchaDir."securimage_play.php' />");
//	Linha("	</object>");
   Linha("		<a href='#' title='Trocar Imagem' onclick='document.getElementById(\"siimage\").src = \"".cCaptchaDir."securimage_show.php?sid=\" + Math.random(); this.blur(); return false'><img src='".cCaptchaDir."images/refresh.png' onclick='this.blur()' style='vertical-align: middle;' ><strong> Trocar Imagem</strong></a><br />");
	Linha("		</p>");
	Linha("		<p>");
   Linha("			<strong>Repita o CAPTCHA:</strong><br />");
   Linha(" 			<input type='text' name='captcha_code' size='16' maxlength='16' />");
	Linha("		 	<input  type='submit' value='Salvar dados!' />");
	Linha("		 	<input  type='hidden' name='EnviarDados' value='". $ID ."'  />");
	Linha("		</p>");

   Linha("	</fieldset>");
	Linha("</form>");
}


function ValidarVazio($Campo,$ErrorDetalhe,$MinhaURL) {
	$Resultado = TRUE;
	$TemErro =  Vazio($Campo);  
	if( $TemErro ) { 
	    MostrarErroVolta("Dados inválidos para este campo: <b>$ErrorDetalhe</b>",$MinhaURL);
	    $Resultado = FALSE;
	}
	return $Resultado;
}



function ProcessarForm($ID,$Nome,$Rua,$Numero,$Bairro,$CEP,$Telefone,$Email,$Latitude,$Longitude,$NoOSM) {
	global  $MinhaURL;
   //==========================================================================
	//CAPTCHA
	$securimage = new Securimage();


     $MsgEstaNoMapa = "em breve estará";	
     $MsgNoOSM = "";	//Mensagem a exibir em caso de erro para não mapeadores
     $SQLNoOSM = ""; //trecho SQL adicional em caso de mapeador OSM
 
 	  $SQLNoOSM = ", NoOSM = 0 ";
     if( $NoOSM ){
        	$SQLNoOSM = ", NoOSM = 1 ";
        	$MsgEstaNoMapa = "<b>está</b>";
     }

 	  //----------------------------------------------------------------------------------

	  //----------------------------------------------------------------------------------
	  $SemErro = ValidarVazio($Nome,"Campo Nome do posto",$MinhaURL);
     if( $SemErro ) { $SemErro = ValidarVazio($Rua,"Campo Rua vazio",$MinhaURL); } 
     if( $SemErro ) { $SemErro = ValidarVazio($Numero,"Campo Número do prédio vazio",$MinhaURL); }
     if( $SemErro ) { $SemErro = ValidarVazio($Bairro,"Campo Bairro vazio",$MinhaURL); } 

     if( $SemErro ) { $SemErro =  ValidarVazio($Latitude,"Latitude e Longitude - Faltou mover o marcador do posto para o lugar certo"); } 
     if( $SemErro ) { $SemErro =  ValidarVazio($Longitude,"Latitude e Longitude - Faltou mover o marcador do posto para o lugar certo"); } 

     if( $SemErro ) { $SemErro = ValidarVazio($CEP,"Campo CEP vazio",$MinhaURL); } 
     if( $SemErro ) { $SemErro = ValidarVazio($Email,"Campo Email inválido",$MinhaURL); } 
     if( $SemErro ) {
     	  $Dominio = "acessa.sp.gov.br";
     	  if( GetDomainFromEmail($Email) != $Dominio ) {
     	  	  $Email = "";
     	     $SemErro = ValidarVazio($Email,"Campo Email não é um email do acessa, pois não termina com \"$Dominio\"",$MinhaURL);
     	  } 
     } 
           
     if( $SemErro && $securimage->check($_POST['captcha_code']) == false) {
     	 $SemErro = FALSE;
       MostrarErroVolta("Código CAPTCHA incorreto!! Tente novamente.",$MinhaURL);
     }     
     
     
     if( $SemErro){
	  	   $SQL = "SELECT * FROM PostosAcessa WHERE ID = $ID;";
		   $ExeSQL = mysql_query($SQL);// or die (mysql_error());
			$Resultados = MySQLResults($ExeSQL);
			if( $Resultados > 0) {  
				$Dados = mysql_fetch_array($ExeSQL);
            $NomeOri     = $Dados['Nome'];				
            $RuaOri      = $Dados['Rua'];				
            $NumeroOri   = $Dados['Numero'];				
            $BairroOri   = $Dados['Bairro'];				
            $CEPOri      = $Dados['CEP'];				
				$TelefoneOri = $Dados['Telefone']; 
            $EmailOri    = $Dados['Email'];				
				$LatOri      = $Dados['Latitude']; 
				$LonOri      = $Dados['Longitude']; 
				
				
				$Endereco = "$Rua, $Numero, $Bairro, CEP $CEP, " . $Dados['Municipio'] . ", SP";				

            //Houve modificações?			   
			   if( $NomeOri != $Nome || $RuaOri != $Rua || $NumeroOri != $Numero || $BairroOri != $Bairro || $CEPOri != $CEP || $TelefoneOri != $Telefone || $EmailOri != $Email || $LatitudeOri != $Latitude || $LongitudeOri != $Longitude ) {
				  	   $SQL = "UPDATE PostosAcessa SET Endereco = '$Endereco', Nome = '$Nome', Rua = '$Rua', Numero = $Numero, Bairro = '$Bairro', CEP = $CEP, Telefone = '$Telefone', Email = '$Email', Latitude = $Latitude, Longitude = $Longitude, Editado = 1".$SQLNoOSM." WHERE ID = $ID;";
					   $ExeSQL = mysql_query($SQL)  or die (mysql_error());
					   if( $ExeSQL ) {
					      MostrarInfo("Obrigado por sua contribuição! Seu posto $MsgEstaNoMapa no mapa!! $MsgNoOSM <br>". ComporLinkHTML($MinhaURL,"","","Voltar")  );
					   }
			   }else {
					Redirecionar($MinhaURL);
			   }
			   
			}     
     }//Tem erro??     
}


function DesenharFormPesquisa(){ 
	Linha("<div id='navegacao_horizontal' class='caixas-arredondadas'>");	
	Linha("  <form id='formpesquisa'  method='post' action='$MinhaURL'>");
	Linha("  <p><input id='TextPesquisa' name='TextPesquisa' type='text'  value='pesquisar <ENTER>' onclick='this.focus();this.select()' /></p>");
	Linha("  </form>");
	Linha("</div>");
}



function MostrarStatusPostos($Selecionado, $PostosTotal,$PostosEditados,$PostosNoOSM) {
	if( $Selecionado < 0  ) {
		$EditadosP = floor(RegraD3Percent($PostosTotal,$PostosEditados)) . "%";
		$NoOSMP = floor(RegraD3Percent($PostosTotal,$PostosNoOSM)) . "%";
	
		Linha("<div id='navegacao_horizontal' class='caixas-arredondadas'>");	
		Linha("<p>Total de postos a mapear: <b>$PostosTotal</b> | Postos editados: <b>$PostosEditados</b> ($EditadosP) | Postos no mapa: <b>$PostosNoOSM</b> ($NoOSMP)</p>");
		Linha("</div>");
	}	
}

function ItemDivNav($Texto) {
		Linha("<div id='navegacao_horizontal' class='caixas-arredondadas'>");	
		Linha($Texto);
		Linha("</div>");
}


function InitOSMFile() {
   $SQL = "SELECT * FROM PostosAcessa WHERE Editado = 1 AND NoOSM = 0;";
   $ExeSQL = mysql_query($SQL);// or die (mysql_error());
	$Resultados = MySQLResults($ExeSQL);

	$OK = FALSE;
	if( $Resultados > 0) {
	  $OK = TRUE;	
	}	
	
	if($OK) {
		Linha("<p>Copiar em um editor de texto puro (notepad, edit, gedit, pluma) e salvar como .osm<br>");
	   $Dados = "<?xml version='1.0' encoding='UTF-8'?>";
		$Dados = $Dados ."\n". "<osm version='0.6' upload='true' generator='Projeto RGM'>";
		Linha("<textarea cols='120' rows='20' onclick='this.focus();this.select();'>$Dados");
		for( $Cont=0;$Cont<$Resultados;$Cont++ ) {  
			$Dados = mysql_fetch_array($ExeSQL);
	      $ID       = $Dados['ID'];				
	      $Nome     = $Dados['Nome'];				
	      $Rua      = $Dados['Rua'];				
	      $Numero   = $Dados['Numero'];				
	      $Bairro   = $Dados['Bairro'];				
	      $CEP      = $Dados['CEP'];				
			$Telefone = $Dados['Telefone']; 
	      $Email    = $Dados['Email'];				
			$Lat      = $Dados['Latitude']; 
			$Lon      = $Dados['Longitude'];
			ListOSMFile($ID,$Nome,$Rua,$Numero,$Bairro,$CEP,$Telefone,$Email,$Lat,$Lon);
		} 
	}else {
		Linha("<h2>Legal! Todos postos editados já estão no OpenStreetMap!!</h2>");
		Linha("<p>Nehhum dado para mostrar por aqui...</p>");
	}
	
	return $OK;
}

function EndOSMFile() {
	$Dados = "";
	$Dados = $Dados . "</osm>";
   Linha($Dados);
	Linha("</textarea>");	
	Linha("</p>");
}


function ListOSMFile($ID,$Nome,$Rua,$Numero,$Bairro,$CEP,$Telefone,$Email,$Latitude,$Longitude) {
	$Dados = "";
	
	$Nome = ucwords(mb_strtolower($Nome,'UTF-8'));
	$Rua  = ucwords(mb_strtolower($Rua,'UTF-8'));
	$Bairro  = ucwords(mb_strtolower($Bairro,'UTF-8'));

	$Dados = $Dados ."\n". "  <node id='-$ID' action='modify' visible='true' lat='$Latitude' lon='$Longitude'>";
	$Dados = $Dados ."\n". "    <tag k='name' v='Ponto Acessa SP $Nome' />";
	$Dados = $Dados ."\n". "    <tag k='internet_access' v='yes' />";
	$Dados = $Dados ."\n". "    <tag k='internet_access:fee' v='no' />";
	$Dados = $Dados ."\n". "    <tag k='addr:street' v='$Rua' />";
	$Dados = $Dados ."\n". "    <tag k='addr:housenumber' v='$Numero' />";
	$Dados = $Dados ."\n". "    <tag k='addr:suburb' v='$Bairro' />";
	$Dados = $Dados ."\n". "    <tag k='addr:postcode' v='$CEP' />";
	$Dados = $Dados ."\n". "    <tag k='contact:email' v='$Email' />";
	$Dados = $Dados ."\n". "    <tag k='wheelchair' v='yes' />";
	
	
	if( $Telefone != '' ) {
		$Telefone = TrocarCaractere($Telefone,";","x"); //Para preservar separador
		$Telefone = TirarAcentoSimblos($Telefone);
		$Telefone = TrocarCaractere($Telefone,"x",";");
      $Dados = $Dados ."\n". "    <tag k='contact:phone' v='+$Telefone' />"; 
	}
	$Dados = $Dados ."\n". "    <tag k='website' v='http://acessasp.sp.gov.br/' />";
	$Dados = $Dados ."\n". "  </node>";
   Linha($Dados);

}


function DrawHeader($MinhaURL) {
	Linha("<div class='header alinhar-direita'>");
	Linha( "		<h1 class='item-alinhado alinhar-centro' >".GetMsg('IntroTitle')."</h1>" );
   Linha("		<p class='item-alinhado itempadl' >".cSiteRGM."</p>");
   Linha("		<form id='formlang' class='item-alinhado itempadl' action='$MinhaURL' method='post'>");
   Linha("					<p class='item-alinhado'><img src='imagens/country-translate.png' alt='country...'/></p>");
   Linha("					<div class='item-alinhado langescolha' onclick=\"CheckElement('country-br',true);document.getElementById('formlang').submit();\" ><img src='imagens/country-br.png' title='Brasil, Português' ><br><input hidden='true' id='country-br' type='radio' name='country' value='BR'></div>");									
   Linha("     			<div class='item-alinhado langescolha' onclick=\"CheckElement('country-wd', true);document.getElementById('formlang').submit();\" ><img src='imagens/country-wd.png'   title='World, English'><br>   <input hidden='true' id='country-wd' type='radio' name='country' value='WD'></div>");
   Linha("     			<div class='item-alinhado langescolha' onclick=\"CheckElement('country-es', true);document.getElementById('formlang').submit();\" ><img src='imagens/country-es.png'   title='España, Español'><br>   <input hidden='true' id='country-es' type='radio' name='country' value='ES'></div>");
   Linha("		</form>");									
   Linha(" ");									

	Linha("</div>");
   Linha(" ");									
}


function Footer() {
   Linha("	<div class='footer'>");
   Linha("		<p class='alinhar-centro'> " . cSiteRGM . " | <img class='alinhar-vertical' src='imagens/git.png' /> " . GetMsg('GetSource')."</p>");
   Linha("		<p class='alinhar-centro'> <img class='alinhar-vertical' src='imagens/cc.png' /> ".GetMsg('CreditosMapillary')."</p>");
   Linha("	</div>");
   Linha(" ");									
}


function GetPostoURL($MinhaURL,$ID) {
	return cDominioFullURLSSL . $MinhaURL."?id=".$ID;	
}

function ClearVars() {
// 	 if( isset($_SESSION['CalendarioTipoEscolhido']) ) { unset($_SESSION['CalendarioTipoEscolhido']); }
}


function TwitterShare($URL) {
	Linha("		");
	Linha("		<a class='twitter-share-button' href='$URL'");
	Linha("		  	data-related='twitterdev'");
//	Linha("		  	data-size='large'");
	Linha("		  	data-count='horizontal'>");
	Linha("		Share");
	Linha("		</a>");
	Linha("		<script type='text/javascript'>");
	Linha("		window.twttr=(function(d,s,id){var t,js,fjs=d.getElementsByTagName(s)[0];if(d.getElementById(id)){return}js=d.createElement(s);js.id=id;js.src='https://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);return window.twttr||(t={_e:[],ready:function(f){t._e.push(f)}})}(document,'script','twitter-wjs'));");
	Linha("		</script>");
}


function FBShare($URL) {
	Linha("		<div id='fb-root'></div>");
	Linha("		<script>(function(d, s, id) {");
	Linha("		  var js, fjs = d.getElementsByTagName(s)[0];");
	Linha("		  if (d.getElementById(id)) return;");
	Linha("		  js = d.createElement(s); js.id = id;");
	Linha("		  js.src = '//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.0';");
	Linha("		  fjs.parentNode.insertBefore(js, fjs);");
	Linha("		}(document, 'script', 'facebook-jssdk'));</script>");
	Linha("<div class='fb-share-button' data-href='$URL' data-layout='button_count'></div>");
}


?>