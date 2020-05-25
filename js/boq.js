$(document).ready(function() {

ID=0;
//fillSections();
//getUsers();
 


///

$("#pcemitters").change(function(){

	 pcemitters=$('#pcemitters').val();



if(pcemitters=="02")
totalflow=Math.ceil(emitters*0.033333);
else if(pcemitters=="05")
totalflow=	Math.ceil(emitters*0.083333);
else if(pcemitters=="07")
totalflow=	Math.ceil(emitters*0.116666);
else if(pcemitters=="10")
totalflow=	Math.ceil(emitters*0.166666);
else if(pcemitters=="12")
totalflow=	Math.ceil(emitters*0.2);
else if(pcemitters=="18")
totalflow=	Math.ceil(emitters*0.3);
else if(pcemitters=="24")
totalflow=	Math.ceil(emitters*0.4);
else totalflow=	0;


if(totalflow<=4)
pipesize=20;
else if(totalflow<=9)
pipesize=25;
else if(totalflow<=14)
pipesize=32;
else if(totalflow<=26)
pipesize=40;
else if(totalflow<=40)
pipesize=50;
else pipesize=63;

 
 $("#pipesize").val(pipesize);
 $("#adapter").val(pipesize);
   $("#ball").val(pipesize);
    $("#elbow").val(pipesize);

})









$("#pipesize").change(function(){

pipesize=$("#pipesize").val();

$("#adapter").val(pipesize);
   $("#ball").val(pipesize);
    $("#elbow").val(pipesize);


})






$("#skinqty").keyup(function(){


skinqty=$("#skinqty").val();
skintype1= $("#skintype1").val();
staplespersqm= $("#staplespersqm").val();

gwwidth= $("#gwwidth").val();
gwheight= $("#gwheight").val();
modulus= $("#modulus").val();
skinadd= $("#skinadd").val();

 
 



 
if(skintype1==2){
staplesqty= Math.ceil((skinqty*staplespersqm/2+(20*(Number(gwwidth)+Number(gwheight))))/100)*100;//Math.ceil((skinqty*staplespersqm/2+(20*(Number(gwwidth)+Number(gwheight) )))/100)*100;//-2
//

}
else if(skintype1==1){

	if(modulus<50){
staplesqty=Math.ceil(((skinadd*staplespersqm/2)+(skinqty*staplespersqm)+(20*(Number(gwwidth)+Number(gwheight))))/100)*100;//-2


	}
	else{
		staplesqty=Math.ceil(((Number(skinqty)+Number(skinadd))*staplespersqm)+(20*(Number(gwwidth)+Number(gwheight))));
	}

}


$("#staplesqty").val(staplesqty);









 
  
});





$("#gs").keyup(function(){


	gs= $("#gs").val();
 
$("#staples").val((Math.ceil(gs*1.77/100))*100);
 
  
});





$("#pvcqty").keyup(function(){

	pvcqty= $("#pvcqty").val();

pvcclose=pvcqty*25;
 $("#pvcclose").val(pvcclose);


jambsqty=$("#jambsqty").val();

 pvcwater= Math.ceil(((pvcqty*3.66)+(jambsqty*2))/10);
$("#pvcwater").val(pvcwater);
  
});



$("#omegaqty").keyup(function(){

	 omegaqty= $("#omegaqty").val();

	 omegascrews=omegaqty*14;
$("#omegascrews").val(omegascrews);
$("#omegaanchors").val(omegascrews);
$("#omegawater").val(Math.ceil(omegascrews/800));
  
});




$("#jambsqty").keyup(function(){

	 jambsqty= $("#jambsqty").val();
$("#jambsscrews").val(jambsqty*8);
$("#jambsanchors").val(jambsqty*8);
if(jambsqty<5){
jambswater=	1;
}
else{
	jambswater= Math.ceil(jambsqty*2/10);

}
$("#jambswater").val(jambswater);
	 
  
});
  



 $("#show_windows").click(function(){
    $("#legend_windows").show();
    $("#div_windows").show();

     $(this).hide(1000);

  });


  $("#show_doors").click(function(){
    
    $("#legend_doors").show();
    $("#div_doors").show();
    $(this).hide(1000);
  });







function findGetParameter(parameterName) {
    var result = null,
        tmp = [];
    var items = location.search.substr(1).split("&");
    for (var index = 0; index < items.length; index++) {
        tmp = items[index].split("=");
        if (tmp[0] === parameterName) result = decodeURIComponent(tmp[1]);
    }
    return result;
}	

$("#myModal").on('shown.bs.modal', function () {
document.getElementById("lblalert").style.visibility='hidden';
 if(ID > 0)
	 
	{
		$("#title").html("Edit BOQ");

		bringData(ID);
		}
	else
	$("#title").html("Add BOQ");
		
});


$("#myModal").on('hidden.bs.modal', function (e) {
document.getElementById("lblalert").style.visibility='hidden';
  $(this)
    .find("input,textarea,select")
       .val('')
       .end()
    .find("input[type=checkbox], input[type=radio]")
       .prop("checked", "")
       .end();
       location.reload();
       
});
function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;

    return [year, month, day].join('-');
}

// ADD User
$(document).on('click',"[id^='Add']",function(){

			ID=0;
		$('#dat').val(formatDate(Date.now()));

	});

	$(document).on('click',"[id^='del_']",function(){	
			//$(this).parent().parent().remove();
	  		strID=$(this).attr('id');			
			ID = strID.substring(4);
			var answer = confirm("Are You Sure You Want To Delete This Company Information");
    if (answer)
			deleteAttachment(ID);
		
			
	});
	
	//Update users
	$(document).on('click',"[id^='Edit_']",function(){
	  		strID=$(this).attr('id');			
			ID = strID.substring(5);
	});
	//-----------------------------------------------------------------------------
	


$("#calc").click(function(){
	
 gwwidth= $("#gwwidth").val();
gwheight= $("#gwheight").val();




windowsqty= $("#windowsqty").val();
windowswidth= $("#windowswidth").val();
windowsheight= $("#windowsheight").val();
windowsarea=windowsqty*windowswidth*windowsheight;

 $("#windowsarea").val(windowsarea);




doorsqty= $("#doorsqty").val();
doorswidth= $("#doorswidth").val();
doorsheight= $("#doorsheight").val();
doorsarea=doorsheight*doorswidth*doorsqty;
 $("#doorsarea").val(doorsarea);

gwarea=(gwwidth*gwheight)-windowsarea-doorsarea;
$("#gwarea").val(Math.ceil(gwarea));

pvcqty= Math.ceil(((gwarea/2.97)*1.05));
$("#pvcqty").val(pvcqty);



pvcclose=pvcqty*25;
 $("#pvcclose").val(pvcclose);



 




if(gwheight<=25){

omegaqty=(Math.ceil(gwwidth/0.61)+2)*((gwheight)/2)-((((windowsheight*windowswidth)-(doorswidth*doorsheight))/0.61)*(((windowsheight*windowsqty)-(doorsheight*doorsqty))/2));
}
else{
	omegaqty=((gwwidth/0.61)+2)*12.5 +(gwwidth/0.3 + 2)*((gwheight-25)/2)*1.03;
}

omegaqty=Math.ceil(omegaqty);
$("#omegaqty").val(omegaqty);

omegascrews=omegaqty*14;
$("#omegascrews").val(omegascrews);
$("#omegaanchors").val(omegascrews);
$("#omegawater").val(Math.ceil(omegascrews/800));


 
jambsqty=Math.ceil(((2*gwheight)+Number(gwwidth))/2 +((2*windowsqty*windowsheight) +(2*doorsqty*doorsheight))/2);
$("#jambsqty").val(jambsqty);

$("#jambsscrews").val(jambsqty*8);
$("#jambsanchors").val(jambsqty*8);



pvcwater= Math.ceil(((pvcqty*3.66)+(jambsqty*2))/10);
$("#pvcwater").val(pvcwater);



if(jambsqty<5){
jambswater=	1;
}
else{
	jambswater= Math.ceil(jambsqty*2/10);

}
$("#jambswater").val(jambswater);

 
if(gwheight<=6){
pipe=Math.ceil((Number(gwheight)+Number(gwwidth))*1.1);
}
else if(gwheight>6){
	 
pipe=Math.ceil(((2*Number(gwwidth))+Number(gwheight))*1.1);
}
else if(gwheight>13){
pipe=Math.ceil(((3*Number(gwwidth))+Number(gwheight))*1.1);
}
else if(gwheight>19){
pipe=Math.ceil(((4*Number(gwwidth))+Number(gwheight))*1.1);
}
else if(gwheight>25){
pipe=Math.ceil(((5*Number(gwwidth))+Number(gwheight))*1.1);
}
$("#pipe").val(pipe);


$("#gs").val(Math.round(gwarea*1.05));

$("#staples").val((Math.ceil((gwarea*1.05)*1.77/100))*100);


$("#skin").val(Math.ceil((gwheight/2)));

 
if(gwheight<=8){
emitters=gwwidth*5;

}
else if(gwheight<12){emitters= 2*gwwidth*5;}
else if(gwheight<18){emitters=3*gwwidth*5;}
else if(gwheight<24){emitters=4*gwwidth*5;}
else if(gwheight<30){emitters=5*gwwidth*5;}
else if(gwheight<36){emitters=6*gwwidth*5;}
else if(gwheight<42){emitters=7*gwwidth*5;}
else if(gwheight>=42){emitters=0;}

$("#emitters").val(Math.ceil(emitters));


$("#lock").val(Math.ceil((emitters/5)/10));
 
if(doorsqty==0){
gutterwalls=gwwidth;
}
else{
gutterwalls=gwwidth- doorswidth*doorsheight;
}

 $("#gutterwalls").val(gutterwalls);


 $("#gutterwindows").val(windowsqty*windowswidth);
 $("#gutterdoors").val(doorswidth*doorsqty);

 $("#sensorsflow").val($("#zonesqty").val());
 

 skintype=$("#skintype").val();

 if(skintype=='0'||skintype=='1'||skintype=='2'){
$("#staplespersqm").val(87);
 }
 else{

$("#staplespersqm").val(87);
 }
modulus=(gwwidth*100)%60;
$("#modulus").val(Math.round(modulus));



 
if(modulus ==0){
	skinadd=0;

}
else if(modulus <= 30){
	skinadd= Math.ceil(gwheight/1.55);

}

else if(modulus < 50){
	skinadd=  Math.ceil(2*gwheight/1.55);

}

else if(modulus>=50){
	skinadd=  Math.ceil(gwheight/1.55);

}



$("#skinadd").val(skinadd);


 
 

// =IF(E34=TRUE,
//  ROUNDUP((F35*B40/2+(20*(B4+B5))),-2),
//  IF(E34=FALSE,
//  	IF(A34=TRUE,
//  		IF(C37="30 cm skin",
//  			ROUNDUP(((B37*B40/2)+(B36*B40)+(20*(B4+B5))),-2),
//  				IF(C37="60 cm skin",
//  					ROUNDUP((((B36+B37)*B40)+(20*(B4+B5))),-2),0)),
//  							IF(A34=TRUE,
//  								IF(C37="30 cm skin",
//  									ROUNDUP((((B37+F35)*B40/2)+(B36*B40)+(20*(B4+B5))),-2),
//  											IF(C37="60 cm skin",
//  														ROUNDUP((((B36+B37)*B40)+(F35*B40/2)+(20*(B4+B5))),-3),0)),0))))



skintype1= $("#skintype1").val();
staplespersqm= $("#staplespersqm").val();

if(skintype1==1){

skinqty=Math.ceil(parseInt(gwwidth*gwheight*1.1));
}
else skinqty=Math.ceil(gwwidth*gwheight*2.2*1.05);
$("#skinqty").val(skinqty);



 
if(skintype1==2){
staplesqty= Math.ceil((skinqty*staplespersqm/2+(20*(Number(gwwidth)+Number(gwheight))))/100)*100;//Math.ceil((skinqty*staplespersqm/2+(20*(Number(gwwidth)+Number(gwheight) )))/100)*100;//-2
//

}
else if(skintype1==1){

	if(modulus<50){
staplesqty=Math.ceil(((skinadd*staplespersqm/2)+(skinqty*staplespersqm)+(20*(Number(gwwidth)+Number(gwheight))))/100)*100;//-2


	}
	else{
		staplesqty=Math.ceil(((Number(skinqty)+Number(skinadd))*staplespersqm)+(20*(Number(gwwidth)+Number(gwheight))));
	}

}


$("#staplesqty").val(staplesqty);



if(gwheight<=1)
pcemitters="02";
else if(gwheight<=2)
pcemitters="05";
else if(gwheight<=3)
pcemitters="07";
else if(gwheight<=7)
pcemitters="10";
 else 
 pcemitters="12";
 
$("#pcemitters").val(pcemitters);


 


if(pcemitters=="02")
totalflow=Math.ceil(emitters*0.033333);
else if(pcemitters=="05")
totalflow=	Math.ceil(emitters*0.083333);
else if(pcemitters=="07")
totalflow=	Math.ceil(emitters*0.116666);
else if(pcemitters=="10")
totalflow=	Math.ceil(emitters*0.166666);
else if(pcemitters=="12")
totalflow=	Math.ceil(emitters*0.2);
else if(pcemitters=="18")
totalflow=	Math.ceil(emitters*0.3);
else if(pcemitters=="24")
totalflow=	Math.ceil(emitters*0.4);
else totalflow=	0;

 

 

if(totalflow<=4)
pipesize=20;
else if(totalflow<=9)
pipesize=25;
else if(totalflow<=14)
pipesize=32;
else if(totalflow<=26)
pipesize=40;
else if(totalflow<=40)
pipesize=50;
else pipesize=63;

 
 $("#pipesize").val(pipesize);

  $("#adapter").val(pipesize);
   $("#ball").val(pipesize);
    $("#elbow").val(pipesize);

     $("#adapterqty").val(1);
   $("#ballqty").val(1);
    $("#elbowqty").val(1);

});






$("#add1").click(function(){


gwwidth= $("#gwwidth").val();
gwheight= $("#gwheight").val();
gwarea= $("#gwarea").val();



windowsqty= $("#windowsqty").val();
windowswidth= $("#windowswidth").val();
windowsheight= $("#windowsheight").val();
windowsarea= $("#windowsarea").val();




doorsqty= $("#doorsqty").val();
doorswidth= $("#doorswidth").val();
doorsheight= $("#doorsheight").val();
doorsarea= $("#doorsarea").val();

zonesqty= $("#zonesqty").val();


pvcqty= $("#pvcqty").val();
pvcclose= $("#pvcclose").val();
pvcwater= $("#pvcwater").val();


omegaqty= $("#omegaqty").val();
omegascrews= $("#omegascrews").val();
omegaanchors= $("#omegaanchors").val();
omegawater= $("#omegawater").val();


jambsqty= $("#jambsqty").val();
jambsscrews= $("#jambsscrews").val();
jambsanchors= $("#jambsanchors").val();
jambswater= $("#jambswater").val();




pipe= $("#pipe").val();
gs= $("#gs").val();
staples= $("#staples").val();
lock= $("#lock").val();
skin= $("#skin").val();
emitters= $("#emitters").val();


staplesqty= $("#staplesqty").val();
gutterwalls= $("#gutterwalls").val();
gutterwindows= $("#gutterwindows").val();
gutterdoors= $("#gutterdoors").val();


sensorssm150t= $("#sensorssm150t").val();
sensorsflow= $("#sensorsflow").val();


microtype= $("#microtype").val();
microqty= $("#microqty").val();



modulus= $("#modulus").val();
skinqty= $("#skinqty").val();
skinadd= $("#skinadd").val();
skintype= $("#skintype").val();
skintype1= $("#skintype1").val();
staplespersqm= $("#staplespersqm").val();


offer_ID=findGetParameter('offerid');

corners= $("#corners").val();

pipesize= $("#pipesize").val();
pcemitters= $("#pcemitters").val();

elbow= $("#elbow").val();
ball= $("#ball").val();
adapter= $("#adapter").val();


elbowqty= $("#elbowqty").val();
ballqty= $("#ballqty").val();
adapterqty= $("#adapterqty").val();


plumbsys= $("#plumbsys").val();

plumbsysqty= $("#plumbsysqty").val();


closetype= $("#closetype").val();
watertype= $("#watertype").val();
omegatype= $("#omegatype").val();
screwstype= $("#screwstype").val();
anchorstype= $("#anchorstype").val();
watersealanttype= $("#watersealanttype").val();
watersealant2type= $("#watersealant2type").val();
jambstype= $("#jambstype").val();
staplestype= $("#staplestype").val();



 
if(false)
document.getElementById("lblalert").style.visibility='visible';
else{
if(ID==0)	
				{
						
					//window.open("../pages/upload.php?x="+ document.getElementById("attachment").value,"_blank","width=0,height=0");
					addAttachment(closetype,watertype,omegatype,screwstype,anchorstype,watersealanttype,watersealant2type,jambstype,staplestype,plumbsysqty,plumbsys,elbowqty,ballqty,adapterqty,elbow,ball,adapter,pcemitters,pipesize,corners,modulus,skinqty,skinadd,skintype,skintype1,staplespersqm,offer_ID,gwwidth,gwheight,gwarea,windowsqty,windowswidth,windowsheight,windowsarea,doorsqty,doorswidth,doorsheight,doorsarea,zonesqty,pvcqty,pvcclose,pvcwater,omegaqty,omegascrews,omegaanchors,omegawater,jambsqty,jambsscrews,jambsanchors,jambswater,pipe,gs,staples,lock,skin,emitters,staplesqty,gutterwalls,gutterwindows,gutterdoors,sensorssm150t,sensorsflow,microtype,microqty);
					
					
				}
		else{ 
		//	window.open("../pages/upload.php?x="+ attachment,"_blank","width=0,height=0");
		UpdateAttachment(closetype,watertype,omegatype,screwstype,anchorstype,watersealanttype,watersealant2type,jambstype,staplestype,plumbsysqty,plumbsys,elbowqty,ballqty,adapterqty,elbow,ball,adapter,pcemitters,pipesize,corners,modulus,skinqty,skinadd,skintype,skintype1,staplespersqm,offer_ID,ID,gwwidth,gwheight,gwarea,windowsqty,windowswidth,windowsheight,windowsarea,doorsqty,doorswidth,doorsheight,doorsarea,zonesqty,pvcqty,pvcclose,pvcwater,omegaqty,omegascrews,omegaanchors,omegawater,jambsqty,jambsscrews,jambsanchors,jambswater,pipe,gs,staples,lock,skin,emitters,staplesqty,gutterwalls,gutterwindows,gutterdoors,sensorssm150t,sensorsflow,microtype,microqty);
			
			}	
	//	}
	
}

});
//=========================================================================
$("#add2").click(function(){


company= $("#company").val();
specialty= $("#specialty").val();
website= $("#website").val();
country= $("#country").val();
city= $("#city").val();
tel= $("#tel").val();
fax= $("#fax").val();
fname= $("#fname").val();
lname= $("#lname").val();
title= $("#titlee").val();
email= $("#email").val();
mobile= $("#mobile").val();
notes= $("#notes").val();
referred= $("#referral").val();
phours= $("#phours").val();
category= 0;
var today = new Date();
var dd = today.getDate();
var mm = today.getMonth()+1; //January is 0!

var yyyy = today.getFullYear();
if(dd<10){
    dd='0'+dd;
} 
if(mm<10){
    mm='0'+mm;
} 
var today = yyyy+ "-" + mm+'-'+dd;
today=today.replace(/(\d\d)\/(\d\d)\/(\d{4})/, "$3-$1-$2");
dat=$('#dat').val();
if( company=='' || specialty=='')
document.getElementById("lblalert").style.visibility='visible';
else{
if(ID==0)	
				{
						
					//window.open("../pages/upload.php?x="+ document.getElementById("attachment").value,"_blank","width=0,height=0");
					addAttachment1(phours,dat,referred,category,company,specialty,website,country,city,tel,fax,fname,lname,title,email,mobile,notes,today);
					 
					
				}
		else{ 
			
		//	window.open("../pages/upload.php?x="+ attachment,"_blank","width=0,height=0");
		UpdateAttachment1(ID,phours,dat,referred,category,company,specialty,website,country,city,tel,fax,fname,lname,title,email,mobile,notes,today);
		
			}	
	//	}
	
}

});
//===================================================================================
function addAttachment1(phours,dat,referred,category,company,specialty,website,country,city,tel,fax,fname,lname,title,email,mobile,notes,today)
	{		
	
//	alert(attachment+" "+paperid+" "+notes);
		  $.ajax({
			
			  type: 'GET',
			  url: "../../ws/ws_tclients.php",
			  data: ({action:1,phours:phours,dat:dat,referred:referred,category:category,company:company,specialty:specialty,website:website,country:country,city:city,tel:tel,fax:fax,fname:fname,lname:lname,title:title,email:email,mobile:mobile,notes:notes,today:today}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
	//	alert("1");
				  if(data==0)
					  alert("Data is not inserted");  
				 	  else	  {
  				  	data = JSON.parse(xhr.responseText);	
				document.getElementById("fname").value="";
		document.getElementById("lname").value="";}		  
				
			  },
			  error: function(xhr, status, errorThrown) 
			  {
			//	alert("2");
				//  alert(status + errorThrown);
			  }
		  });  //	

	}
//====================================================================================
function UpdateAttachment(closetype,watertype,omegatype,screwstype,anchorstype,watersealanttype,watersealant2type,jambstype,staplestype,plumbsysqty,plumbsys,elbowqty,ballqty,adapterqty,elbow,ball,adapter,pcemitters,pipesize,corners,modulus,skinqty,skinadd,skintype,skintype1,staplespersqm,offer_ID,serial,gwwidth,gwheight,gwarea,windowsqty,windowswidth,windowsheight,windowsarea,doorsqty,doorswidth,doorsheight,doorsarea,zonesqty,pvcqty,pvcclose,pvcwater,omegaqty,omegascrews,omegaanchors,omegawater,jambsqty,jambsscrews,jambsanchors,jambswater,pipe,gs,staples,lock,skin,emitters,staplesqty,gutterwalls,gutterwindows,gutterdoors,sensorssm150t,sensorsflow,microtype,microqty)
	{
		
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_tboq.php",
			  data: ({action:3,closetype:closetype,watertype:watertype,omegatype:omegatype,screwstype:screwstype,anchorstype:anchorstype,watersealanttype:watersealanttype,watersealant2type:watersealant2type,jambstype:jambstype,staplestype:staplestype,plumbsys:plumbsys,plumbsysqty:plumbsysqty,elbowqty:elbowqty,ballqty:ballqty,adapterqty:adapterqty,modulus:modulus,elbow:elbow,ball:ball,adapter:adapter,pipesize:pipesize,pcemitters:pcemitters,corners:corners,skinqty:skinqty,skinadd:skinadd,skintype:skintype,skintype1:skintype1,staplespersqm:staplespersqm,offer_ID:offer_ID,serial:serial,gwwidth:gwwidth,gwheight:gwheight,gwarea:gwarea,windowsqty:windowsqty,windowswidth:windowswidth,windowsheight:windowsheight,windowsarea:windowsarea,doorsqty:doorsqty,doorswidth:doorswidth,doorsheight:doorsheight,doorsarea:doorsarea,zonesqty:zonesqty,pvcqty:pvcqty,pvcclose:pvcclose,pvcwater:pvcwater,omegaqty:omegaqty,omegascrews:omegascrews,omegaanchors:omegaanchors,omegawater:omegawater,jambsqty:jambsqty,jambsscrews:jambsscrews,jambsanchors:jambsanchors,jambswater:jambswater,pipe:pipe,gs:gs,staples:staples,lock:lock,skin:skin,emitters:emitters,staplesqty:staplesqty,gutterwalls:gutterwalls,gutterwindows:gutterwindows,gutterdoors:gutterdoors,sensorssm150t:sensorssm150t,sensorsflow:sensorsflow,microtype:microtype,microqty:microqty}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
			
				
				  if(data==0)
				  	alert("No Update!");
				 	  else	  {
  				  	data = JSON.parse(xhr.responseText);	
					location.reload();}			  				 			  

			  },
			  error: function(xhr, status, errorThrown) 
			  {
			  //	alert("2");
				 // $("#LoadingImage").hide();
				//  alert(status + errorThrown);
			  }
			  
		  }); 
		  
		  } //	
//=======================================================================================
function UpdateAttachment1(serial,phours,dat,referred,category,company,specialty,website,country,city,tel,fax,fname,lname,title,email,mobile,notes,today)
	{
		
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_tclients.php",
			  data: ({action:3,serial :serial,phours:phours,dat:dat,referred:referred,category:category,company:company,specialty:specialty,website:website,country:country,city:city,tel:tel,fax:fax,fname:fname,lname:lname,title:title,email:email,mobile:mobile,notes:notes,today:today}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
			
				
				  if(data==0)
				  	alert("No Update!");
				 	  else	  {
  				  	data = JSON.parse(xhr.responseText);	
								   document.getElementById("fname").value="";
		document.getElementById("lname").value="";
		$('#dat').val(formatDate(Date.now()));
		ID=0;}			  				 			  

			  },
			  error: function(xhr, status, errorThrown) 
			  {
			  //	alert("2");
				 // $("#LoadingImage").hide();
				// alert(status + errorThrown);
			  }
			  
		  }); 
		  
		  } //	
//=====================================================================================
function addAttachment(closetype,watertype,omegatype,screwstype,anchorstype,watersealanttype,watersealant2type,jambstype,staplestype,plumbsysqty,plumbsys,elbowqty,ballqty,adapterqty,elbow,ball,adapter,pcemitters,pipesize,corners,modulus,skinqty,skinadd,skintype,skintype1,staplespersqm,offer_ID,gwwidth,gwheight,gwarea,windowsqty,windowswidth,windowsheight,windowsarea,doorsqty,doorswidth,doorsheight,doorsarea,zonesqty,pvcqty,pvcclose,pvcwater,omegaqty,omegascrews,omegaanchors,omegawater,jambsqty,jambsscrews,jambsanchors,jambswater,pipe,gs,staples,lock,skin,emitters,staplesqty,gutterwalls,gutterwindows,gutterdoors,sensorssm150t,sensorsflow,microtype,microqty)
	{		
	
//	alert(attachment+" "+paperid+" "+notes);
		  $.ajax({
			
			  type: 'GET',
			  url: "../../ws/ws_tboq.php",
			  data: ({action:1,closetype:closetype,watertype:watertype,omegatype:omegatype,screwstype:screwstype,anchorstype:anchorstype,watersealanttype:watersealanttype,watersealant2type:watersealant2type,jambstype:jambstype,staplestype:staplestype,plumbsys:plumbsys,plumbsysqty:plumbsysqty,elbowqty:elbowqty,ballqty:ballqty,adapterqty:adapterqty,corners:corners,elbow:elbow,ball:ball,adapter:adapter,pcemitters:pcemitters,pipesize:pipesize,modulus:modulus,skinqty:skinqty,skinadd:skinadd,skintype:skintype,skintype1:skintype1,staplespersqm:staplespersqm,offer_ID:offer_ID,gwwidth:gwwidth,gwheight:gwheight,gwarea:gwarea,windowsqty:windowsqty,windowswidth:windowswidth,windowsheight:windowsheight,windowsarea:windowsarea,doorsqty:doorsqty,doorswidth:doorswidth,doorsheight:doorsheight,doorsarea:doorsarea,zonesqty:zonesqty,pvcqty:pvcqty,pvcclose:pvcclose,pvcwater:pvcwater,omegaqty:omegaqty,omegascrews:omegascrews,omegaanchors:omegaanchors,omegawater:omegawater,jambsqty:jambsqty,jambsscrews:jambsscrews,jambsanchors:jambsanchors,jambswater:jambswater,pipe:pipe,gs:gs,staples:staples,lock:lock,skin:skin,emitters:emitters,staplesqty:staplesqty,gutterwalls:gutterwalls,gutterwindows:gutterwindows,gutterdoors:gutterdoors,sensorssm150t:sensorssm150t,sensorsflow:sensorsflow,microtype:microtype,microqty:microqty}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
	//	alert("1");
				  if(data==0)
					  alert("Data is not inserted");  
				 	  else	  {
  				  	data = JSON.parse(xhr.responseText);	
				 location.reload();}		  
				
			  },
			  error: function(xhr, status, errorThrown) 
			  {
			//	alert("2");
				//  alert(status + errorThrown);
			  }
		  });  //	

	}
	
	function bringData(serial)
	{
	
	//$("#LoadingImage").show();
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_boq.php",
			  data: ({id:serial}),			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			 
			  {
			  
				// $("#LoadingImage").hide();
				  data = JSON.parse(xhr.responseText);	
				  decide(data,serial);				  
			  },
			  
			  error: function(xhr, status, errorThrown) 
			  {
			  
  				//  $("#LoadingImage").hide();
				 alert(status + errorThrown);
				  
			  }
		  });  	
	}
	
	//delete person from server
	function deleteAttachment(idval)
	{
		
		//$("#LoadingImage").show();
		 
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_tboq.php",
			  data: ({action:2,id :idval}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
				 // $("#LoadingImage").hide();
				
				  if(data==0)
				  	alert("Row not deleted!");
			
			  },
			  error: function(xhr, status, errorThrown) 
			  {
				 
			
				//  alert(status + errorThrown);
			  }
		  });  //	

	}
////////////////////////////////////////////////////////////////////////////////////

////////////////////////////////////////////////////////////////////////////////////////	

		function decide(data,serial)
	{		

		count=data.length;
	if(count>0)
	{
		if( serial==0)
			alert("user exist");	
		else 
			{		
		document.getElementById("gwwidth").value=data[0]["gw_width"];
		document.getElementById("gwheight").value=data[0]["gw_height"];
		document.getElementById("gwarea").value=data[0]["gw_area"];
		document.getElementById("windowswidth").value=data[0]["windows_width"];
		document.getElementById("windowsheight").value=data[0]["windows_height"];


		document.getElementById("windowsarea").value=data[0]["windows_area"];
		document.getElementById("windowsqty").value=data[0]["windows_qty"];
		document.getElementById("doorsqty").value=data[0]["doors_qty"];
		document.getElementById("doorswidth").value=data[0]["doors_width"];
		document.getElementById("doorsheight").value=data[0]["doors_height"];
		document.getElementById("doorsarea").value=data[0]["doors_area"];


		document.getElementById("zonesqty").value=data[0]["zonesqty"];
		document.getElementById("pvcqty").value=data[0]["pvcqty"];
		document.getElementById("pvcclose").value=data[0]["pvcclose"];
		document.getElementById("pvcwater").value=data[0]["pvcwater"];
		document.getElementById("omegaqty").value=data[0]["omegaqty"];
		document.getElementById("omegascrews").value=data[0]["omegascrews"];


		document.getElementById("omegaanchors").value=data[0]["omegaanchors"];
		document.getElementById("omegawater").value=data[0]["omegawater"];
		document.getElementById("jambsqty").value=data[0]["jambsqty"];
		document.getElementById("jambsscrews").value=data[0]["jambsscrews"];
		document.getElementById("jambsanchors").value=data[0]["jambsanchors"];
		document.getElementById("jambswater").value=data[0]["jambswater"];
		document.getElementById("pipe").value=data[0]["pipe"];
		document.getElementById("gs").value=data[0]["gs"];


		document.getElementById("staples").value=data[0]["staples"];
		document.getElementById("lock").value=data[0]["lockk"];
		document.getElementById("skin").value=data[0]["skin"];
		document.getElementById("emitters").value=data[0]["emitters"];



		document.getElementById("modulus").value=data[0]["modulus"];
		document.getElementById("skinadd").value=data[0]["skinadd"];
		document.getElementById("skintype1").value=data[0]["skintype1"];
		document.getElementById("skintype").value=data[0]["skintype"];
		document.getElementById("skinqty").value=data[0]["skinqty"];
		document.getElementById("staplespersqm").value=data[0]["staplespersqm"];
		


		document.getElementById("staplesqty").value=data[0]["staplesqty"];
		document.getElementById("gutterwalls").value=data[0]["gutterwalls"];
		document.getElementById("gutterwindows").value=data[0]["gutterwindows"];
		document.getElementById("gutterdoors").value=data[0]["gutterdoors"];
		document.getElementById("sensorssm150t").value=data[0]["sensorssm150t"];
		document.getElementById("microtype").value=data[0]["microtype"];
		document.getElementById("sensorsflow").value=data[0]["sensorsflow"];
		document.getElementById("microqty").value=data[0]["microqty"];

		document.getElementById("corners").value=data[0]["corners"];

		document.getElementById("pipesize").value=data[0]["pipesize"];

			document.getElementById("pcemitters").value=data[0]["pcemitters"];

			document.getElementById("elbow").value=data[0]["elbow"];
			document.getElementById("ball").value=data[0]["ball"];
			document.getElementById("adapter").value=data[0]["adapter"];
	 

	        document.getElementById("elbowqty").value=data[0]["elbowqty"];
			document.getElementById("ballqty").value=data[0]["ballqty"];
			document.getElementById("adapterqty").value=data[0]["adapterqty"];

			document.getElementById("plumbsys").value=data[0]["plumbsys"];
			document.getElementById("plumbsysqty").value=data[0]["plumbsysqty"];


			document.getElementById("closetype").value=data[0]["closetype"];
			document.getElementById("watertype").value=data[0]["watertype"];
			document.getElementById("omegatype").value=data[0]["omegatype"];

			document.getElementById("screwstype").value=data[0]["screwstype"];
			document.getElementById("anchorstype").value=data[0]["anchorstype"];
			document.getElementById("watersealanttype").value=data[0]["watersealanttype"];


			
			document.getElementById("watersealant2type").value=data[0]["watersealant2type"];
			document.getElementById("jambstype").value=data[0]["jambstype"];
			document.getElementById("staplestype").value=data[0]["staplestype"];

	 

	 



			}
	}
	else
	
		showError(serial);
		}
	

});

