 
 document.getElementById('a').onclick = function (){         // ===== функция для удаления куки ========//
 	var date = new Date(0);
 	document.cookie = "log=; path=/; expires=" + date.toUTCString();
 }   


 

 var workers = document.getElementById('form_workers'); 


 var obgects = document.getElementById('form_obgects');

 var httpreq = getXmlHttp();

 var currenttable;  	//Выбранная таблица из меню

 var submit_obg = document.getElementById('submit_obg');

 var update_obg = document.getElementById('update_obg');

 var bsubmit = document.getElementById('submit');

 var bupdate = document.getElementById('update');

 var table = document.getElementById('table');
 
 document.getElementById('close_wokers').onclick = function(){workers.classList.add('invisible'); }

 document.getElementById('close_obgeсts').onclick = function(){obgects.classList.add('invisible'); }
 
 
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


 document.getElementById('workers').onclick = function (){   // =====  Выбор пункта меню Рабочие


 	currenttable = "workers";


 	var body = "table="+currenttable;


 	getData(body);    

 function click(event){

 	if (currenttable!=="workers") return;

 	var res = document.getElementById('res'),
 	fam = document.getElementsByName('fam')[0].value,
 	nam = document.getElementsByName('name')[0].value,
 	nic = document.getElementsByName('nic')[0].value,
 	tel = document.getElementsByName('tel')[0].value,
 	mail = document.getElementsByName('mail')[0].value;


 }


 document.getElementById('objects').onclick = function (){   // =====  Выбор пункта меню Объекты

 	currenttable = "objects";

 	var body = "table="+currenttable;

 	getData(body);    

 }



 document.getElementById('jobs').onclick = function(){    

 	currenttable = "jobs" ;

 document.getElementById('workers').onclick = function (){

 	currenttable = "workers";

 	var body = "table="+currenttable;

 	getData(body);    

 }


 document.getElementById('objects').onclick = function (){

 	currenttable = "objects";

 	var body = "table="+currenttable;


 	var body = "table="+currenttable;

 	getData(body);
 	
 }



 function initializebbb(){

 	var bds = document.getElementsByClassName("bd");

 	for (var i=0;i<bds.length;i++){

 		bds[i].onclick = bdclick;

 	}

 }

 function bdclick() 		//============ Обработчик кнопок; Добавить,Изменить,Удалить ================
 {





 	
 	var id = this.value; 
 	var name = this.getAttribute('name');

 	document.getElementsByName('id')[0].value = id;
 	document.getElementsByName('id_obg')[0].value = id; 


 	switch (name) {   

 		case 'bbb':   // изменить 						
 			getidDate("id="+id+"&table="+currenttable);
 		break;

 		case 'ddd':    // удалить
 		if (confirm("Вы уверены в этом?")) {
 			delDate("id="+id+"&del=del&table="+currenttable);
 		}

 		break;
 		case 'add':  // добавить  ,  показывает соответсвующую форму редактирования 

 			switch (currenttable) {
 				case 'workers':workers.classList.remove('invisible');break;
 				case 'objects':obgects.classList.remove('invisible');break;
 				case 'jobs':;break;
 			} 			

 		break;
 	}
 	
 }

 bsubmit.onclick = function (){					// ====== Добавление записи =========

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


 submit_obg.onclick = function (){					// ====== Добавление записи =========

 	var res = document.getElementById('res_obg'),
 	nameobg = document.getElementsByName('nameobg')[0].value,
 	adress = document.getElementsByName('adress')[0].value,
 	start = document.getElementsByName('start')[0].value,
 	finish = document.getElementsByName('finish')[0].value;

 	var body = "nameobg="+nameobg+"&adress="+adress+"&start="+start+"&finish="+finish+"&form=objects";

 	addData(body);
 }




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
 

 update_obg.onclick = function (){

 	var res = document.getElementById('res_obg'),
 	nameobg = document.getElementsByName('nameobg')[0].value,
 	adress = document.getElementsByName('adress')[0].value,
 	start = document.getElementsByName('start')[0].value,
 	finish = document.getElementsByName('finish')[0].value,
 	id = document.getElementsByName('id_obg')[0].value;

 	var body = "nameobg="+nameobg+"&adress="+adress+"&start="+start+"&finish="+finish+"&form=objects&id="+id;

 	upDate(body);
 }


 function addData(body){
 	httpreq.open('POST', "fhandler.php", true);
 	httpreq.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

 	httpreq.onreadystatechange = function() {
 		if (httpreq.readyState == 4) {
 			if(httpreq.status == 200) {
 				res.innerHTML = httpreq.responseText;        
 				getData("table="+currenttable); 			
 			}

 		}
 	}
 	httpreq.send(body);
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

 function delDate(body){

 	httpreq.open('POST', "fhandler.php", true);
 	httpreq.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

 	httpreq.onreadystatechange = function() {
 		if (httpreq.readyState == 4) {
 			if(httpreq.status == 200) {

 				var result = httpreq.responseText; 				

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
 				if (currenttable=="workers"){
	 				document.getElementById('datadiv').innerHTML = httpreq.responseText; 
	 				workers.classList.remove('invisible');
	 				bupdate.classList.remove('invisible'); 
	 				bsubmit.classList.add('invisible');
 				}
 				if (currenttable=="objects"){
 					document.getElementById('datadiv_obgects').innerHTML = httpreq.responseText; 
	 				obgects.classList.remove('invisible');
	 				update_obg.classList.remove('invisible'); 
	 				submit_obg.classList.add('invisible');
 				}
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