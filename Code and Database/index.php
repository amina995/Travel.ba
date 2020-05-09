<!DOCTYPE html>
<html>
   <head>
      <?php include "biblioteke.php" ?>
      <link rel="stylesheet" type="text/css" href="css/index.css">
      </script>
   </head>
   <body>
      <?php include "dbconn.php" ?>
      <?php include "relacije.php" ?>
      <div style="display: none">
         <?php include "stanice.php" ?>
      </div>
      <div class="col-xs-2" id="menu">
         <div class="col-lg-12 col-xs-12" id="logo">
            <img id="logo" src="images/logo2.png">
         </div>
         <div id="upit" class="col-lg-12 col-xs-12">
            <div id="opis">
               Travel.ba je aplikacija koja korisniku pruža mogućnost informisanja o međunarodnim autobuskim linijama na relaciji Bosna-Europa.<br>
               <hr>
               <input type="button"  id="vise" value="Saznaj više" onClick="vise()"></input>
               <div style="display: none" id="viseinfo">
                  Klikom na 'Unesi upit' korisnik može izabrati relaciju i dobiti spisak agencija koje voze na toj relaciji i informacije o njima (naziv, telefon, web stranica sa dodatnim informacijama) kako bi mogao saznati tačne datume i cijene za željenu relaciju. Pored toga klikom na 'Pokaži na mapi' pokazat će se ruta te relacije sa prosječnim trajanjem puta i udaljenošću u kilometrima.<br>
                  <hr>
                  Na mapi su trenutno prikazani markeri koji označavaju autobuske stanice i stajališta u BiH, a klikom na njih možete pogledati detaljne informacije.<br>Pretragom mjesta u gornjem desnom uglu ćete dobiti njegov prikaz sa označenim područjem 7 km oko centra kako bi mogli vidjeti koje su stanice u tom području.
               </div>
            </div>
            <div id="u" style="display: none" class="whitebasic">Upit</div>
            <hr>
            <br>
            <div id="one">
               <?php include "upit.php" ?>
               <form method="post" action="">
                  <input type="text" name="name" id="name" style="display: none" />
                  <input type="text" name="name11" id="name" style="display: none" />
                  <div id="hiddencontainer" style="display:none;">
                     Relacija
                     <div  id="listaRelacija">
                        <select  id="relacijaOd" name="rOd" onchange="getvalOd(this);">
                           <option selected="selected" disabled>Od</option>
                           <?php include "od.php" ?>
                        </select>
                        <select id="relacijaDo" name="rDo" onchange="getvalDo(this);">
                           <option selected="selected" disabled>Do</option>
                           <?php include "do.php" ?>
                        </select>
                     </div>
                     Max. cijena:
                     <input class="range1" type="range" min="10" max="350" step="1" name="rating" value="1" onmousemove="showrangevalue()"/>
                  </div>
                  <div id="container">
                  </div>
                  <div id="value" name="value">
                  </div>
                  <input type="button" id="upitButton" value="Unesi upit" onClick="showhiddencontainer()"></input>
                  <input type="submit" name="gotovo" id="upitButton1" value="Gotovo" onClick="gotovo()"></input>
               </form>
            </div>
         </div>
         <!--menu-->
      </div>
      <div class="col-xs-10" id="map"></div>
      <script src="https://unpkg.com/leaflet@1.0.0-rc.3/dist/leaflet.js"></script>
      <script src="leaflet-routing-machine.js"></script>
      <script type="text/javascript"></script>
      <script type="text/javascript">
         var map = L.map('map').setView([43.85, 18.25], 9);
         L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
         attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
         }).addTo(map);
         
         
         var ma1 = [];
         var ma2 = [];
         var ma3;
         // var ma2 = [];
         map.on('zoomend', function() {
         
            var size=map.getZoom();
            if(size<=5)
            size=size*2;
            else
            size=size*3;
         
         
            for(var i=0; i<ma1.length;i++){
            sIcon=createIcons('images/markerbus.png', size, size);
            // s=createIcons('images/odrediste.png', size, size);
            ma1[i].setIcon(sIcon);
            ma3.setIcon(sIcon);
            
            }
            
            for(var i=0; i<ma2.length;i++){
            s=createIcons('images/odrediste.png', size, size);
            // s=createIcons('images/odrediste.png', size, size);
             ma2[i].setIcon(s);
         }
         
         });
         
         var nn;
         var nn1;  
         var nn2;
         function showrangevalue(){
         document.getElementById("value").innerText=document.querySelectorAll(".range1")[1].value+"KM";
         document.getElementById("name").value =document.querySelectorAll(".range1")[1].value+":"+nn1+' - '+nn2;
         document.getElementById("name").innerText =document.querySelectorAll(".range1")[1].value+document.getElementById("relacija").value;
         
         
         }
         function showhiddencontainer(){
         
         document.getElementById("container").innerHTML=document.getElementById("hiddencontainer").innerHTML;
         document.getElementById("upitButton").style.display="none";
         document.getElementById("upitButton1").style.display="block";
         document.getElementById("u").style.display="block";
         document.getElementById("opis").style.display="none";
         }
         
         function getval(sel)
         {
         nn=sel.value;
         
         }
         
         function getvalOd(sel)
         {
         nn1=sel.value;
         
         
         }
         function getvalDo(sel)
         {
         nn2=sel.value;
         
         
         
         }
         var usedNames = {};
         $("select[name='r'] > option").each(function () {
         if(usedNames[this.text]) {
         $(this).remove();
         } else {
         usedNames[this.text] = this.value;
         }
         });
         var usedNames = {};
         $("select[name='rOd'] > option").each(function () {
         if(usedNames[this.text]) {
         $(this).remove();
         } else {
         usedNames[this.text] = this.value;
         }
         });
         var usedNames = {};
         $("select[name='rDo'] > option").each(function () {
         if(usedNames[this.text]) {
         $(this).remove();
         } else {
         usedNames[this.text] = this.value;
         }
         });
           
         var GooglePlacesSearchBox = L.Control.extend({
         onAdd: function() {
         var element = document.createElement("input");
         element.id = "searchBox";
         return element;
         }
         });
         (new GooglePlacesSearchBox).addTo(map);
         
         var input = document.getElementById("searchBox");
         var searchBox = new google.maps.places.SearchBox(input);
         searchBox.addListener('places_changed', function() {
         var places = searchBox.getPlaces();
         if (places.length == 0) {
         return;
         }
         var group = L.featureGroup();
         places.forEach(function(place) {
         // Create a marker for each place.
         if(typeof(marker)==='undefined'){
         marker = new L.marker([
           place.geometry.location.lat(),
           place.geometry.location.lng()
         ], {draggable:'true', icon: secondIcon});
         $('#markerLatLng').val(marker.getLatLng());
         marker.on('dragend', function(event) {
         var marker = event.target; 
         var result = marker.getLatLng(); 
         $('#markerLatLng').val(marker.getLatLng());
         });
         map.panTo(marker.getLatLng());
         }
         else {
         marker.setLatLng([place.geometry.location.lat(),
           place.geometry.location.lng()]); 
           $('#markerLatLng').val(marker.getLatLng());
         marker.on('dragend', function(event) {
         var marker = event.target; 
         var result = marker.getLatLng(); 
         $('#markerLatLng').val(marker.getLatLng());
         });        
         }
         group.addLayer(marker);
         alert('Prikazuje se područje 7km od centra. ');
         cc = L.circle(marker.getLatLng(), 7000).addTo(map);
         });
         group.addTo(map);
         map.fitBounds(group.getBounds());
         map.setZoom(12);
         });
         
         
         function createIcons(iconUrl, w, h){
         var iconName = L.icon({
         iconUrl: iconUrl,
         iconSize: [w,h]
         });
         return iconName;
         }
         
         var markerGroup1 = L.layerGroup().addTo(map);
         
         var brojs=document.getElementById("bb").innerText;
         brojs=Number(brojs);
         for(var i=0; i<113; i++)
         {
          ll=[];
         var idpopup="popup"+i;
         
         var idp="p"+i;
         ll=document.getElementById(idp).innerText;
         
         ll =ll.split(',');
         //alert(document.getElementById(idpopup).innerText);
         //alert(ll[0]);
         //alert(ll[0]);
         var firstIcon=createIcons('images/markerbus.png', 40, 40);
         
         //ma2[i]= new L.marker([Number(ll[0]), Number(ll[1])], {draggable:false, icon: firstIcon}).addTo(map);
         var fIcon=createIcons('images/odrediste.png', 40, 40);
         ma2[i] = L.marker([Number(ll[0]), Number(ll[1])], {draggable:false, icon: fIcon}).bindPopup(document.getElementById(idpopup).innerHTML).addTo(map);
         
         ma2[i].addTo(markerGroup1);
         
         }
         
         
         
         
         
         var brojstanica=document.getElementById("brojs").innerText;
         brojstanica=Number(brojstanica);
         var mystr="";
         for(var i=0; i<=brojstanica; i++)
         {
           var t="tacke"+i;
          var p = document.getElementsByClassName(t);
         
         
         for (var j = 0; j < p.length; j++) {
         mystr =mystr+", "+ p[j].innerText;
         
         }
         //alert(mystr);
         // var m=document.getElementsByClassName(t).innerText;
         //alert(m);
         var idnew="s"+i;
         var islika="slika"+i;
         var imjesto="mjesto"+i;
         i=i+1;
         var inatkriveno="natkriveno"+i;
         var iadresa="adresa"+i;
         var itelefon="telefon"+i;
         i=i-1;
         var stanica= document.getElementById(idnew).innerText;
         var slika=document.getElementById(islika).innerText;
         var mjesto=document.getElementById(imjesto).innerText;
         var natkriveno=document.getElementById(inatkriveno).innerText;
         var adresa=document.getElementById(iadresa).innerText;
         var telefon=document.getElementById(itelefon).innerText;
         
         stanica =stanica.split(',');
         var markerGroup = L.layerGroup().addTo(map);
         var firstIcon=createIcons('images/markerbus.png', 40, 40);
         var secondIcon=createIcons('images/yellow.png', 40, 40);
         var saIcon=createIcons('images/samarker.png', 30, 30);
         if(slika.length>0)
         slika='<img id="slikastanice" src="' +slika+'">'
         if(natkriveno==1)
         {
         var natkriveno = "Stanica je natkrivena."
         }
         if (natkriveno===0)
          var natkriveno="Stanica nije natkrivena."
         
         if(adresa.length>0)
          adresa= 'Adresa: '+adresa;
         else
          adresa="";
         if(telefon.length>0)
          telefon= 'Telefon: '+telefon;
         else
          telefon="";
         
         
          mystr = Array.from(new Set(mystr.split(','))).toString();
          
         
         
         ma1[i]= new L.marker([Number(stanica[0]), Number(stanica[1])], {draggable:false, icon: firstIcon}).addTo(map).
         bindPopup('<span id="popup"><div>Mjesto: '+mjesto+'</div><div>'+adresa+'</div>'+'</div><div>'+telefon+'</div>'+'</div>'+natkriveno+'</span>'+'<div id="slikaS">'+slika+'<br>'+'<i class="fa fa-plus" aria-hidden="true"></i><input id="odredista" type="button" value="Moguća odredišta" onClick="pokazi(\'' + mystr + '\')" />'+'</div>'
         );
         ma1[i].addTo(markerGroup);
         
         mjesto="SARAJEVO";
         adresa="Put života 8, Sarajevo 71000";
         telefon="033 213-100";
         natkriveno="Stanica je natkrivena.";
         tip="gradsko";
         slika="<img id=slikastanice src='images/stanice/SARAJEVO.jpg' />"
         mystr1="YVERDON,VINKOVCI,PIACENZA,GUSINJE,ULCINJ,NOVA GRADIsKA,DURRES,PRAG,BARCELONA,CLERMONT FERRAND,MILANO,PODGORICA,BRATISLAVA,BREGENZ,WIEN,ST GALLEN,ANTWERPEN,BASEL";
         
         ma3=new L.marker([43.858945, 18.396727], {draggable:false, icon: saIcon}).addTo(map).
         bindPopup('<span id="popup"><div>Mjesto: '+mjesto+'</div><div>'+adresa+'</div>'+'</div><div>'+telefon+'</div>'+'</div>'+natkriveno+'</span>'+'<div id="slikaS">'+slika+'<br>'+'<i class="fa fa-plus" aria-hidden="true"></i><input id="odredista" type="button" value="Moguća odredišta" onClick="pokazi(\'' + mystr1 + '\')" />'+'</div>'
         );
         ma3.addTo(markerGroup);
         }
         
         
         
         
         $('#upitButton').click(function(){
         
         
         });
         
         function mapa(){
         
         lat1=document.getElementById('prvaLat').innerText;
         lng1=document.getElementById('prvaLng').innerText;
         lat2=document.getElementById('drugaLat').innerText;
         lng2=document.getElementById('drugaLng').innerText;
         mIcon=createIcons('images/marker1.png', 40, 40);
         mIcon1=createIcons('images/marker1.png', 2, 2);
         lat1=Number(lat1);
         lng1=Number(lng1);
         lat2=Number(lat2);
         lng2=Number(lng2);
         prvaTacka= new L.marker([lat1, lng1], {draggable:false, icon: mIcon1}).addTo(map);
         drugaTacka= new L.marker([lat2, lng2], {draggable:false, icon: mIcon1}).addTo(map);
         var group = new L.featureGroup([prvaTacka, drugaTacka]);
         
         
             map.fitBounds(group.getBounds());
             var route = L.Routing.control({
              waypoints: [
                L.latLng(lat1, lng1),
                L.latLng(lat2, lng2)
                ],
              lineOptions: {
            styles: [{color: '#696868', opacity: 1, weight: 3}]
                            }
                     }).addTo(map);
         var d=map.distance(L.latLng(lat1,lng1), L.latLng(lat2, lng2));
         var v=(Math.round((d/1000)*100)/100)/60;
         v=Math.round(v*100)/100;
         
         
         
         prvaTacka.bindPopup('Najkraća udaljenost do odredišta je '+ Math.round((d/1000)*100)/100 + ' km<br>'+'Trajanje puta iznosi oko '+v+' h').openPopup();
         
         
         }
         
         
         /*map.on('zoomend', function() {
         alert('hi');
         });*/
         
         function vise(){
         document.getElementById("viseinfo").style.display="block";
         document.getElementById("vise").style.display="none";
         
         }
         
         
         function pokazi(mystr) {
         mystr =mystr.split(',');
         
         newWindow = window.open("", null, "height=400,width=250,status=yes,toolbar=no,menubar=no,location=no");  
         
         var myTable;
         // var myTable="<table><th style='width: 100px; color: red;'>Naziv mjesta</th>";
         
         mystr.sort();
         for(var i=0; i<mystr.length;i++){
         if(i%2==0)
         myTable+= "<div style='background-color:#ffffff ;color: #866b6b;text-align: center;'>"+mystr[i]+"</div>";
         else
         myTable+= "<div style=' text-align: center;background-color: #e7e7e7;color: #866b6b; '>"+mystr[i]+"</div>";
         
         }
         myTable = myTable.replace('undefined', '');
         //myTable+="</table>";
         newWindow.document.write( myTable);
         
         
         }
         
         
      </script>
   </body>
</html>