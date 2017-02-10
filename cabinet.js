 document.getElementById('a').onclick = function (){               
 	var date = new Date(0);
 	document.cookie = "log=; path=/; expires=" + date.toUTCString();
 }   
 
 var workers = document.getElementById('formdiv');
 
 document.getElementById('rab').onclick = function(){     

 	workers.classList.remove('invisible');


 }
 
 document.getElementById('closewokers').onclick = function(){

 	workers.classList.add('invisible');   

 }
 
 
 function getXmlHttp(){
 	var xmlhttp;
 	try {
 		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
 	} catch (e) {
 		try {
 			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
 		} catch (E) {
 			xmlhttp = false;
 		}
 	}
 	if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
 		xmlhttp = new XMLHttpRequest();
 	}
 	return xmlhttp;
 }


 var httpreq = getXmlHttp();

 var currenttable;  	//Выбранная таблица из меню

 var bsubmit = document.getElementById('submit');

 bsubmit.onclick = click;


 function click(event){

 	if (currenttable!=="workers") return;

 	var res = document.getElementById('res'),
 	fam = document.getElementsByName('fam')[0].value,
 	nam = document.getElementsByName('name')[0].value,
 	nic = document.getElementsByName('nic')[0].value,
 	tel = document.getElementsByName('tel')[0].value,
 	mail = document.getElementsByName('mail')[0].value;

 	var body = "fam="+fam+"&name="+nam+"&nic="+nic+"&tel="+tel+"&mail="+mail+"&form=workers";

 	addData(body);

 }


 function addData(body){
 	httpreq.open('POST', "fhandler.php", true);
 	httpreq.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

 	httpreq.onreadystatechange = function() {
 		if (httpreq.readyState == 4) {
 			if(httpreq.status == 200) {
 				res.innerHTML = httpreq.responseText;        
 				getData("table=workers"); 			// =====   получение таблицы, для показа записей после удаления  
 			}

 		}
 	}
 	httpreq.send(body);
 }

 var table = document.getElementById('table');


 document.getElementById('workers').onclick = function (){

 	currenttable = "workers";

 	var body = "table="+currenttable;

 	getData(body);    

 }


 document.getElementById('objects').onclick = function (){

 	currenttable = "objects";

 	var body = "table="+currenttable;

 	getData(body);    

 }

 function getData(body){
 	httpreq.open('POST', "gettable.php", true);
 	httpreq.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

 	httpreq.onreadystatechange = function() {
 		if (httpreq.readyState == 4) {
 			if(httpreq.status == 200) {
 				table.innerHTML = httpreq.responseText;          
 				initializebbb();
 			}

 		}
 	}
 	httpreq.send(body);
 }

 function initializebbb(){

 	var bds = document.getElementsByClassName("bd");

 	for (var i=0;i<bds.length;i++){

 		bds[i].onclick = bdclick;

 	}

 }

 function bdclick()
 {

 	if (currenttable!=="workers") return;
 	
 	var id = this.value; 
 	var name = this.getAttribute('name');

 	if (name==='bbb'){
 		getidDate("id="+id+"&table=workers");
 		document.getElementsByName('id')[0].value = id;   
 	}

 	if (name === 'ddd') {
 		if (confirm("Вы уверены в этом?")) {
 			delDate("id="+id+"&del=del");
 		}
 	}
 }


 var bupdate = document.getElementById('update');

 bupdate.onclick=function(){   						//====== Изменение записи ====== 

 	if (currenttable!=="workers") return;

 	var res = document.getElementById('res'),
 	fam = document.getElementsByName('fam')[0].value,
 	nam = document.getElementsByName('name')[0].value,
 	nic = document.getElementsByName('nic')[0].value,
 	tel = document.getElementsByName('tel')[0].value,
 	mail = document.getElementsByName('mail')[0].value,
 	id = document.getElementsByName('id')[0].value;

 	var body = "fam="+fam+"&name="+nam+"&nic="+nic+"&tel="+tel+"&mail="+mail+"&form=workers&id="+id;

 	upDate(body);

 }

 function delDate(body){

 	httpreq.open('POST', "fhandler.php", true);
 	httpreq.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

 	httpreq.onreadystatechange = function() {
 		if (httpreq.readyState == 4) {
 			if(httpreq.status == 200) {

 				var result = httpreq.responseText;

 				alert(result);

 				getData("table="+currenttable); 			// =====   получение таблицы, для показа записей после удаления
 			}

 		}
 	}
 	httpreq.send(body);   

 }


 function getidDate(body){						// ========= получение записи по id и отображанение в форме ввода для изменения

 	httpreq.open('POST', "gettable.php", true);
 	httpreq.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

 	httpreq.onreadystatechange = function() {
 		if (httpreq.readyState == 4) {
 			if(httpreq.status == 200) {
 				document.getElementById('datadiv').innerHTML = httpreq.responseText; 
 				workers.classList.remove('invisible');
 				bupdate.classList.remove('invisible'); 
 				bsubmit.classList.add('invisible');
 			}

 		}
 	}
 	httpreq.send(body);   

 }

 function upDate(body){  						//====== обновление записи ========

 	httpreq.open('POST', "fhandler.php", true);
 	httpreq.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

 	httpreq.onreadystatechange = function() {
 		if (httpreq.readyState == 4) {
 			if(httpreq.status == 200) {
 				res.innerHTML = httpreq.responseText; 
 				getData("table="+currenttable);
 				bsubmit.classList.remove('invisible'); 
 				bupdate.classList.add('invisible');
 				document.getElementsByName('id')[0].value = null;
 				document.getElementsByName('fam')[0].value=null;
 				document.getElementsByName('name')[0].value=null;
 				document.getElementsByName('nic')[0].value=null;
 				document.getElementsByName('tel')[0].value=null;
 				document.getElementsByName('mail')[0].value=null;
 			}

 		}
 	}
 	httpreq.send(body);   

 }