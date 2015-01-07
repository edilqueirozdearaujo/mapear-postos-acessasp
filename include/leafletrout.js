var attrOSM = '<a href="http://www.openstreetmap.org/copyright" title="Termos e condições" >contribuidores do OpenStreetMap</a>'; 
var attrThunder = '<a href="http://thunderforest.com/terms/" title="Termos e condições" >Thunderforest</a> | <a href="http://www.openstreetmap.org/copyright" title="Termos e condições" >contribuidores do OpenStreetMap</a>'; 
var attrESRI = '<a href="http://downloads2.esri.com/ArcGISOnline/docs/tou_summary.pdf" title="Termos e condições" >Esri World Imagery</a>'; 
var attrIBGE = '<a href="https://github.com/tmpsantos/IBGETools" title="IBGETools" >IBGETools</a> | <a href="ftp://geoftp.ibge.gov.br/mapas_estatisticos/censo_2010/mapas_de_setores_censitarios" title="Mapas de Setores Censitários" >Mapas de Setores Censitários (2010)</a> by <a href="http://www.ibge.gov.br/" title="IBGE" >IBGE</a> | hospedado por <a href="https://www.mapbox.com/" title="MapBox" >MapBox</a>'; 
var attrMapBox = '<a href="https://www.mapbox.com/" title="MapBox" >MapBox</a>'; 
var attrStamen = 'Map tiles by <a href="http://stamen.com">Stamen Design</a>, under <a href="http://creativecommons.org/licenses/by/3.0">CC BY 3.0</a>. Data by <a href="http://openstreetmap.org">OpenStreetMap</a>, under <a href="http://creativecommons.org/licenses/by-sa/3.0">CC BY SA</a>'; 


var layer_mapnik    = L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {attribution: attrOSM} ); 
var layer_OSMbw    = L.tileLayer('http://{s}.www.toolserver.org/tiles/bw-mapnik/{z}/{x}/{y}.png', {attribution: attrOSM} ); 
var layer_outdoors    = L.tileLayer('http://{s}.tile.thunderforest.com/outdoors/{z}/{x}/{y}.png', {attribution: attrThunder} ); 
var layer_cycle    = L.tileLayer('http://{s}.tile.thunderforest.com/cycle/{z}/{x}/{y}.png', {attribution: attrThunder} ); 
var layer_ESRI    = L.tileLayer('http://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {attribution: attrESRI} ); 
var layer_IBGEr    = L.tileLayer('https://{s}.tiles.mapbox.com/v3/tmpsantos.i00mo1kj/{z}/{x}/{y}.png', {attribution: attrIBGE} ); 
var layer_IBGEu    = L.tileLayer('https://{s}.tiles.mapbox.com/v3/tmpsantos.hgda0m6h/{z}/{x}/{y}.png', {attribution: attrIBGE} );
var layer_MapBox    = L.tileLayer('https://{s}.tiles.mapbox.com/v3/openstreetmap.map-inh7ifmo/{z}/{x}/{y}.png', {attribution: attrMapBox} );
var layer_StamenWater = L.tileLayer('http://{s}.tile.stamen.com/watercolor/{z}/{x}/{y}.jpg', {attribution: attrStamen} ); 


