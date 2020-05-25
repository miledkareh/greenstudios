$(document).ready(function() {
ID=0;
var visit=0;
var Latitude=0;
var Longitude=0;
rate=0;
plantID=0;
edit=0;
var projectname=findGetParameter('y');
var offerid=findGetParameter('z');
$('#images').on('filebeforedelete', function(event, key, data) {
		return swal({
   position: 'top',
  title: "Are You Sure You Want To Delete This Image !",
  text: "Once deleted, you will not be able to recover this information!",
  type: 'warning',
  showCancelButton: true,
  cancelButtonColor: '#d33',
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
  return false;
  } 
  else{return true;}
});
        return abort;
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

//fillOffice();


$(document).on('click',"[id='AdPlant']",function(){

				if(ID==0)
					document.getElementById("lblalert6").style.visibility='visible';	
			else
			{
			plantID=0;
			$('#myModal5').modal('show');		//window.open("../pages/upload.php?x="+ document.getElementById("attachment").value,"_blank","width=0,height=0");
			}
		

	});

//===============================================================================================================
$("#approved").click(function(){

maintenancedetails=findGetParameter("x");

	  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_accept.php",
			  data: ({action:1,maintenancedetails:maintenancedetails}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
				 location.reload();
				 		  
				
			  },
			  error: function(xhr, status, errorThrown) 
			  {
				 
				   alert(status + errorThrown);
			  }
		  });  


 

});
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	$("#add6").click(function(){

plant= 0+$("#plant").val();

plantnumber= 0+$("#plantnumber").val();


if( plant==0 || plant=='')
document.getElementById("lblalert5").style.visibility='visible';
else{
if(plantID==0)	
				{
					
						addPlant(plant,plantnumber,ID);	
					
				}
		else{ 
		//	window.open("../pages/upload.php?x="+ attachment,"_blank","width=0,height=0");
			
			UpdatePlant(plantID,plant,plantnumber,ID);
			}	
	//	}
	
}

});
function UpdatePlant(serial,plant,plantnumber,readingm)
	{		
		  
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_treadingmplants.php",
			  data: ({action:3,serial:serial,plant:plant,plantnumber:plantnumber,readingm:readingm}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
				  
				  if(data==0)
					  alert("Data is not inserted");  
				  else
				  {
				  	data = JSON.parse(xhr.responseText);				  				 
				  	//updateData(1,newName,newUsrName,newPwd);
				  	getPlants(readingm);
				  	$('#myModal5').modal('hide');
				  	
				  }				  
				
			  },
			  error: function(xhr, status, errorThrown) 
			  {
				 
				  //alert(status + errorThrown);
			  }
		  });  //	
	}
//========================================================================================
function addPlant(plant,plantnumber,readingm)
	{		
		  
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_treadingmplants.php",
			  data: ({action:1,plant:plant,plantnumber:plantnumber,readingm:readingm}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
				  
				  if(data==0)
					  alert("Data is not inserted");  
				  else
				  {
				  	data = JSON.parse(xhr.responseText);				  				 
				  	//updateData(1,newName,newUsrName,newPwd);
				  	getPlants(readingm);
				  	document.getElementById("plant").value="";
	
		document.getElementById("plantnumber").value="";
				  }				  
				
			  },
			  error: function(xhr, status, errorThrown) 
			  {
				 
				  //alert(status + errorThrown);
			  }
		  });  //	

	}
function getPlants(id)
	{
		
		
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_readingmplants.php",
			  data: ({action:2,id :id}),
			  
			  dataType: 'json',
			  timeout: 10000,
			  success: function(data, textStatus, xhr) 
			  {
		  		 				  
				 
				  if(data==0)
					  alert("Data couldn't be loaded!");
				  else{
				  	data = JSON.parse(xhr.responseText);	
				  			  				 
				  	populate(data);
				  	
	
				  }
			  },
			  error: function(xhr, status, errorThrown) 
			  {
								  
				//  alert(status + errorThrown);				  
			  }
		  });  //	
		 

	}
	function populate(data)
	{		
		
	$("#clientbody").empty();
		count=data.length;
		var item;

		if(count>0)
		{			
			
		   $.each(data, function(index, row) {
				item = "<tr id='tr_"+row.serial+"'>";
                item+=   "<td>"+row.plantN+"</td>";
              
                item+=   "<td>"+row.plantnumber+"</td>";
             
              //  item+=   "<td>"+row.password+"</td>";
				//item+=   "<td>"+row.admin+"</td>";
              //  item+=   "<td><button type='button' data-toggle= 'modal' data-target='#myModal1' class='btn btn-success del' id='Editt_"+row.serial+"'> Edit</button></td>";
                item+="<td><a href='#' id='Editt1_"+row.serial+"'  data-toggle='modal' data-target='#myModal5' ><p class='fa fa-edit'></p> Edit</a></td>";
              // item+=   "<td><button type='button' class='btn btn-success del' id='dell_"+row.serial+"'> Delete</button></td>";
               item+="<td><a href='#' id='del2_"+row.serial+"' ><p class='fa fa-trash-o'></p> Delete</a></td>";
                item+= "</tr>";
				$("#clientbody").append(item);
			});
			
		}
	}
	$(document).on('click',"[id^='Editt1_']",function(){
	  		strID=$(this).attr('id');			
			plantID = strID.substring(7);
	});
	$(document).on('click',"[id^='del2_']",function(){	
			//$(this).parent().parent().remove();
	  		strID=$(this).attr('id');			
			ID = strID.substring(5);
			var answer = confirm("Are You Sure You Want To Delete This Record");
    if (answer)
			deletePlant(ID);
		
			
	});
	function deletePlant(idval)
	{
		
		//$("#LoadingImage").show();
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_treadingmplants.php",
			  data: ({action:2,id :idval}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
				 // $("#LoadingImage").hide();
				
				  if(data==0)
				  	alert("Row not deleted!");
				  	
			getPlants(ID);
			  },
			  error: function(xhr, status, errorThrown) 
			  {
				 
		
				//  alert(status + errorThrown);
			  }
		  });  //	

	}
$("#myModal2").on('shown.bs.modal', function () {

document.getElementById("lblalert2").style.visibility='hidden';

 if(ID > 0)
	 
	{
		$("#title2").html("Edit");
		bringData2(ID);
		getPlants(ID);
		}
	else
	$("#title2").html("Add");
		
});



var serial=0;
maintenance= findGetParameter("x");
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
function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;

    return [year, month, day].join('-');
}
$("#myModal").on('shown.bs.modal', function () {
document.getElementById("lblalert").style.visibility='hidden';

 if(ID > 0)
	 
	{
		$("#title").html("Edit");

		bringData(ID);}
	else
	$("#title").html("Add");
		
});
$("#myModal1").on('shown.bs.modal', function () {
document.getElementById("lblalert1").style.visibility='hidden';

 if(ID > 0)
	 
	{
		$("#title1").html("Edit");

		bringData1(ID);}
	else
	$("#title1").html("Add");
		
});
$("#myModal5").on('shown.bs.modal', function () {
document.getElementById("lblalert5").style.visibility='hidden';
 if(plantID > 0)
	 
	{
		$("#title5").html("Edit Plant");

		bringPlant(plantID);
		}
	else
	$("#title5").html("Add Plant");
		
});
function bringPlant(serial)
	{
	
	//$("#LoadingImage").show();
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_readingmplants.php",
			  data: ({action:1,id:serial}),			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			 
			  {
			  
				// $("#LoadingImage").hide();
				  data = JSON.parse(xhr.responseText);	
				 document.getElementById("plant").value=data[0]["plantid"];
		$("#plant").val(data[0]["plantid"]).trigger("change");
		document.getElementById("plantnumber").value=data[0]["plantnumber"];
			  
			  },
			  
			  error: function(xhr, status, errorThrown) 
			  {
			  
  				//  $("#LoadingImage").hide();
				 alert(status + errorThrown);
				  
			  }
		  });  	
	}
$("#myModal4").on('shown.bs.modal', function () {
document.getElementById("lblalert4").style.visibility='hidden';

 if(ID > 0)
	 
	{
		$("#title4").html("Edit");

		bringData4(ID);}
	else
	$("#title4").html("Add");
		
});
$("#myModal1").on('hidden.bs.modal', function (e) {

  $(this)
    .find("input,textarea,select")
       .val('')
       .end()
    .find("input[type=checkbox], input[type=radio]")
       .prop("checked", "")
       .end();
       
});
$("#myModal2").on('hidden.bs.modal', function (e) {
 
  $(this)
    .find("input,textarea,select")
       .val('')
       .end()
    .find("input[type=checkbox], input[type=radio]")
       .prop("checked", "")
       .end(); 
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
       
});
$("#myModal3").on('shown.bs.modal', function () {
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
	var d = new Date(),        
        h = d.getHours(),
        m = d.getMinutes();
       
    if(h < 10) h = '0' + h; 
    if(m < 10) m = '0' + m; 
    today=today+" "+h+":"+m;
  
		$('#images').fileinput('destroy');
		        $("#images").fileinput({
               'uploadUrl': '../../ws/ws_uploadimage13.php',
          overwriteInitial: false,
        validateInitialCount: true,
			 initialPreviewAsData: true,
    maxImageWidth: 1200,
    resizeImage: true,
     initialPreview: [],
    initialPreviewConfig: [],
			uploadExtraData: function() {
            return {
                serial: maintenance,dat:today
            };
           }
        });
	
document.getElementById("lblalert3").style.visibility='hidden';

 if(ID > 0)
	 
	{
		$("#title").html("Edit");

		bringData3(ID);}
	else
	$("#title").html("Add");
		
});
// ADD User
$("#Add").click(function(){
	ID=0;
	

});
$("#AddTime").click(function(){
	ID=0;
});
$("#AddMaintenance").click(function(){
	ID=0;
});
$("#AddLux").click(function(){
	ID=0;
 $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_tlux.php",
			  data: ({action:4,maintenance:maintenance}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
						  			 			  

			  },
			  error: function(xhr, status, errorThrown) 
			  {
			  }
			  
		  }); 
});
$("#emittertype").change(function(){
	emittertype=$("#emittertype").val();
	
	if(emittertype=='GPH 1')
	document.getElementById('emitterflow').value=0.063;
	else if(emittertype=='GPH 2')
	document.getElementById('emitterflow').value=0.126;
	else if(emittertype=='GPH 5')
	document.getElementById('emitterflow').value=0.316;
	else if(emittertype=='GPH 7')
	document.getElementById('emitterflow').value=0.4416;
	else if(emittertype=='GPH 10')
	document.getElementById('emitterflow').value=0.6309;
	else if(emittertype=='3 mm')
	document.getElementById('emitterflow').value=0.063;
	document.getElementById('totalflow').value=$("#emitternumber").val()*$("#emitterflow").val();
	document.getElementById('watercons').value=$("#totalflow").val()*$("#minday").val();
});	
$("#linearmeter").blur(function(){
	
	document.getElementById('emitternumber').value=Math.round(($("#linearmeter").val()*100)/20,2);
	document.getElementById('totalflow').value=$("#emitternumber").val()*$("#emitterflow").val();
});
$("#emitternumber").blur(function(){
	
	document.getElementById('totalflow').value=$("#emitternumber").val()*$("#emitterflow").val();
});
$("#emitterflow").blur(function(){
	
	document.getElementById('totalflow').value=$("#emitternumber").val()*$("#emitterflow").val();
});	
$("#totalflow").blur(function(){
	
	document.getElementById('watercons').value=$("#totalflow").val()*$("#minday").val();
});	

$("#minday").blur(function(){
	
	document.getElementById('watercons').value=$("#totalflow").val()*$("#minday").val();
});
	//delete a selcted person
	$(document).on('click',"[id^='del_']",function(){	
			//$(this).parent().parent().remove();
	  		strID=$(this).attr('id');			
			ID = strID.substring(4);
		
			var answer = confirm("Are You Sure You Want To Delete This Visit");
    if (answer)
			deleteIrrigationTime(ID);
		
			
	});
	$(document).on('click',"[id^='dell_']",function(){	
			//$(this).parent().parent().remove();
	  		strID=$(this).attr('id');			
			ID = strID.substring(5);
	
			var answer = confirm("Are You Sure You Want To Delete This Record");
    if (answer)
			deleteIrrigationFlow(ID);
		
			
	});
	
		$(document).on('click',"[id^='delll_']",function(){	
			//$(this).parent().parent().remove();
	  		strID=$(this).attr('id');			
			ID = strID.substring(6);
			 
			var answer = confirm("Are You Sure You Want To Delete This Record");
    if (answer)
			deletepesticide(ID);
		
			
	});
	$(document).on('click',"[id^='dellll_']",function(){	
			//$(this).parent().parent().remove();
	  		strID=$(this).attr('id');			
			ID = strID.substring(7);
	
			var answer = confirm("Are You Sure You Want To Delete This Record");
    if (answer)
			deleteLux(ID);
		
			
	});
	
	//Update users
	$(document).on('click',"[id^='Edit_']",function(){

		
	  		strID=$(this).attr('id');			
			ID = strID.substring(5);
			
edit=1;

	});
	$(document).on('click',"[id^='Editt_']",function(){

		
	  		strID=$(this).attr('id');			
			ID = strID.substring(6);
	});
	$(document).on('click',"[id^='Edittt_']",function(){

		
	  		strID=$(this).attr('id');			
			ID = strID.substring(7);
	});
	$(document).on('click',"[id^='Editttt_']",function(){

		
	  		strID=$(this).attr('id');			
			ID = strID.substring(8);
	});

		$(document).on('click',"[id^='Email_']",function(){
	  		strID=$(this).attr('id');			
			ID = strID.substring(6);
			
	});
	

//////////////////////////////////////////////////////////////////////////////////////////////////////////
function addReminder(today,notes,rate,ID,subject,offerid)
	{		
	
		//alert(today+notes+rate+ID);
		  $.ajax({
			
			  type: 'GET',
			  url: "../../ws/ws_tcomplain.php",
			  data: ({action:4,today:today,notes:notes,rate:rate,serial:ID,subject:subject,offerid:offerid}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
	
				  if(data==0)
					  alert("Data is not inserted");  
					  else	  {
  				  	data = JSON.parse(xhr.responseText);
  				  
				  }		  
				
			  },
			  error: function(xhr, status, errorThrown) 
			  {
				//alert("1");
				//  alert(status + errorThrown);
			  }
		  });  //	

	}
/////////////////////////////////////////////////////////////////////////////////////////////////////
function addComplain(ID,today,notes,rate)
	{		
	
	//alert(ID+" "+today+" "+notes+" "+rate);
		  $.ajax({
			
			  type: 'GET',
			  url: "../../ws/ws_tcomplain.php",
			  data: ({action:1,serial:ID,notes:notes,today:today,rate:rate}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
	//	alert("1");
				  if(data==0)
					  alert("Data is not inserted");  
				  else	  {
  				  	data = JSON.parse(xhr.responseText);	
				 }			  
				
			  },
			  error: function(xhr, status, errorThrown) 
			  {
			//	alert("2");
				//  alert(status + errorThrown);
			  }
		  });  //	

	}
//////////////////////////////////////////////////////////////////////////////////////////////////
function UpdateAttachment1(serial,sent,gsnotes,Latitude,Longitude,notes,today,rate,client,checkoutdate,dataa)
	{
	//	alert(serial);
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_tcheckin.php",
			  data: ({action:4,serial :serial,sent:sent,gsnotes:gsnotes,dataa:dataa,checkoutdate:checkoutdate,Latitude:Latitude,Longitude:Longitude,notes:notes,today:today,rate:rate,client:client}),
			  
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
		  ///////////////////////////////////////////////////////////////////////////////////////////
	function UpdateAttachment(Latitude,Longitude,project,description,today,location1,checkindate)
	{		
	
	
		  $.ajax({
			
			  type: 'GET',
			  url: "../../ws/ws_tcheckin.php",
			  data: ({action:1,checkindate:checkindate,Latitude:Latitude,Longitude:Longitude,project:project,description:description,today:today,location:location1}),
			  
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
function addAttachment(Latitude,Longitude,project,description,today,location1,checkindate)
	{		
	
	
		  $.ajax({
			
			  type: 'GET',
			  url: "../../ws/ws_tcheckin.php",
			  data: ({action:1,checkindate:checkindate,Latitude:Latitude,Longitude:Longitude,project:project,description:description,today:today,location:location1}),
			  
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
/////////////////////////////////////////////////////////////////////////////////////////////////	
$("#add1").click(function(){
dat= $("#dat").val();

zone = $("#zone").val();

linearmeter=$("#linearmeter").val();
emittertype=$("#emittertype").val();
emitternumber=$("#emitternumber").val();
emitterflow=$("#emitterflow").val();
totalflow=$("#totalflow").val();
minday=$("#minday").val();
watercons=$("#watercons").val();

 	 
	
//	alert(dataa);
	//alert(supervisor + "/"+ employees + "/"+ data + "/"+ dataa);
	//alert(location1+" "+supervisor+" "+notes+" "+data+" "+dataa+" "+maintenance+" "+today);
	
	if( dat =='')
	{
	document.getElementById("lblalert").style.visibility='visible';
	
}
	else if(ID==0)	
				{	
			
					addIrrigationFlow(dat,zone,linearmeter,emittertype,emitternumber,emitterflow,totalflow,minday,watercons,maintenance);
				
				}
		else{
			
		UpdateIrrigationFlow(ID,dat,zone,linearmeter,emittertype,emitternumber,emitterflow,totalflow,minday,watercons,maintenance);
			}	
	//	}
	
	

});


	

//-----------------------------------------------------------------------------------
function UpdateIrrigationFlow(serial,dat,zone,linearmeter,emittertype,emitternumber,emitterflow,totalflow,minday,watercons,maintenance)
	{
		
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_tirrigationflow.php",
			  data: ({action:3,serial :serial,dat:dat,zone:zone,linearmeter:linearmeter,emittertype:emittertype,emitternumber:emitternumber,emitterflow:emitterflow,totalflow:totalflow,minday:minday,watercons:watercons,maintenance:maintenance}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
			
				  
				  if(data==0)
				  	alert("No Update!");
				 	  else	  {
  				  	data = JSON.parse(xhr.responseText);
  				  	location.reload();	
				   }			  				 			  

			  },
			  error: function(xhr, status, errorThrown) 
			  {
			  //	alert("2");
				 // $("#LoadingImage").hide();
				//  alert(status + errorThrown);
			  }
			  
		  }); 
		  
		  } //	

//=====================================================================================
function addIrrigationFlow(dat,zone,linearmeter,emittertype,emitternumber,emitterflow,totalflow,minday,watercons,maintenance)
	{		
	
	//	alert(supervisor + "/"+ notes + "/"+ data + "/"+ dataa+ "/"+ maintenance);
		  $.ajax({
			
			  type: 'GET',
			  url: "../../ws/ws_tirrigationflow.php",
			  data: ({action:1,dat:dat,zone:zone,linearmeter:linearmeter,emittertype:emittertype,emitternumber:emitternumber,emitterflow:emitterflow,totalflow:totalflow,minday:minday,watercons:watercons,maintenance:maintenance}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
		
				  if(data==0)
					  alert("Data is not inserted");  
					  else	  {
  				  	data = JSON.parse(xhr.responseText);	
				 location.reload();}		  
				
			  },
			  error: function(xhr, status, errorThrown) 
			  {
				//alert("1");
				//  alert(status + errorThrown);
			  }
		  });  //	

	}
	//================================================================================================================================
		$("#add5").click(function(){
dat= $("#dat4").val();

trade = $("#trade").val();

ingredient=$("#ingredient").val();
dose=$("#dose").val();
method=$("#method").val();
	if( dat =='')
	{
	document.getElementById("lblalert4").style.visibility='visible';
	
}
	else if(ID==0)	
				{	
			
					addPesticide(dat,trade,ingredient,dose,method,maintenance);
				
				}
		else{
			
		UpdatePesticide(ID,dat,trade,ingredient,dose,method,maintenance);
			}	
	//	}
	
	

});
//=======================================================================================================================
function UpdatePesticide(serial,dat,trade,ingredient,dose,method,maintenance)
	{
		
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_tpesticide.php",
			  data: ({action:3,serial :serial,dat:dat,trade:trade,ingredient:ingredient,dose:dose,method:method,maintenance:maintenance}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
			
				  
				  if(data==0)
				  	alert("No Update!");
				 	  else	  {
  				  	data = JSON.parse(xhr.responseText);
  				  	location.reload();	
				   }			  				 			  

			  },
			  error: function(xhr, status, errorThrown) 
			  {
		
			  }
			  
		  }); 
		  
		  } //	

//=====================================================================================
function addPesticide(dat,trade,ingredient,dose,method,maintenance)
	{		
//	alert(dat+' '+trade+' '+ingredient+' '+dose+' '+method+' '+maintenance);
	//	alert(supervisor + "/"+ notes + "/"+ data + "/"+ dataa+ "/"+ maintenance);
		  $.ajax({
			
			  type: 'GET',
			  url: "../../ws/ws_tpesticide.php",
			  data: ({action:1,dat:dat,trade:trade,ingredient:ingredient,dose:dose,method:method,maintenance:maintenance}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
		
				  if(data==0)
					  alert("Data is not inserted");  
					  else	  {
  				  	data = JSON.parse(xhr.responseText);	
				 location.reload();}		  
				
			  },
			  error: function(xhr, status, errorThrown) 
			  {
			
			  }
		  });  //	

	}
	//===========================================================================================================================
	$("#add2").click(function(){
dat= $("#dat1").val();

zone = $("#zone1").val();

starttime=$("#starttime").val();
endtime=$("#endtime").val();

	if( dat =='')
	{
	document.getElementById("lblalert").style.visibility='visible';
	
}
	else if(ID==0)	
				{	
			//alert(dat+' '+zone+' '+starttime+' '+endtime+' '+maintenance);
					addIrrigationTime(dat,zone,starttime,endtime,maintenance);
				
				}
		else{
			
		UpdateIrrigationTime(ID,dat,zone,starttime,endtime,maintenance);
			}	
	//	}
	
	

});
//-----------------------------------------------------------------------------------
function UpdateIrrigationTime(serial,dat,zone,starttime,endtime,maintenance)
	{
		
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_tirrigationtime.php",
			  data: ({action:3,serial :serial,dat:dat,zone:zone,endtime:endtime,starttime:starttime,maintenance:maintenance}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
			
				  
				  if(data==0)
				  	alert("No Update!");
				 	  else	  {
  				  	data = JSON.parse(xhr.responseText);
  				  	location.reload();	
				   }			  				 			  

			  },
			  error: function(xhr, status, errorThrown) 
			  {
			  //	alert("2");
				 // $("#LoadingImage").hide();
				//  alert(status + errorThrown);
			  }
			  
		  }); 
		  
		  } //	

//=====================================================================================
function addIrrigationTime(dat,zone,starttime,endtime,maintenance)
	{		
	
	//	alert(supervisor + "/"+ notes + "/"+ data + "/"+ dataa+ "/"+ maintenance);
		  $.ajax({
			
			  type: 'GET',
			  url: "../../ws/ws_tirrigationtime.php",
			  data: ({action:1,dat:dat,zone:zone,endtime:endtime,starttime:starttime,maintenance:maintenance}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
		
				  if(data==0)
					  alert("Data is not inserted");  
					  else	  {
  				  	data = JSON.parse(xhr.responseText);	
				 location.reload();}		  
				
			  },
			  error: function(xhr, status, errorThrown) 
			  {
				//alert("1");
				//  alert(status + errorThrown);
			  }
		  });  //	

	}
		$("#add4").click(function(){
			datelux= $("#datelux").val();
 $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_tlux.php",
			  data: ({action:3,maintenance:maintenance,datelux:datelux}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
			
				  
				  if(data==0)
				  	alert("No Update!");
				 	  else	  {
  				  	data = JSON.parse(xhr.responseText);
  				  	location.reload();	
				   }			  				 			  

			  },
			  error: function(xhr, status, errorThrown) 
			  {
			  //	alert("2");
				 // $("#LoadingImage").hide();
				//  alert(status + errorThrown);
			  }
			  
		  }); 
});
		$("#add3").click(function(){
			
dat= $("#dat2").val();
galonnn= $("#galonnn").val();
fertelizedmix=$("#fertelizedmix").val();
alarm= $("#alarm").val();
ecclean = $("#ecclean").val();

ecfertilized=$("#ecfertilized").val();
nbplants=$("#nbplants").val();

ph=$("#ph").val();
injector=0+$("#injector").val();


	if( dat =='')
	{
	document.getElementById("lblalert2").style.visibility='visible';
	
}
	else if(ID==0)	
				{	
				
					addReadingM(dat,ecclean,ecfertilized,ph,injector,fertelizedmix,alarm,nbplants,galonnn);
				
				}
		else{
			
		UpdateReadingM(ID,dat,ecclean,ecfertilized,ph,injector,fertelizedmix,alarm,nbplants,galonnn);
			}	
	//	}
	
	

});
//=============================================================================================
function UpdateReadingM(serial,dat,ecclean,ecfertilized,ph,injector,fertelizedmix,alarm,nbplants,galonnn)
	{
		 
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_treadingm.php",
			  data: ({action:3,serial :serial,injector:injector,nbplants:nbplants,dat:dat,galonnn:galonnn,ecclean:ecclean,ecfertilized:ecfertilized,ph:ph,maintenance:maintenance,fertelizedmix:fertelizedmix,alarm:alarm}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
			
				  
				  if(data==0)
				  	alert("No Update!");
				 	  else	  {
  				  	data = JSON.parse(xhr.responseText);
  				  	location.reload();	
				   }			  				 			  

			  },
			  error: function(xhr, status, errorThrown) 
			  {
			  //	alert("2");
				 // $("#LoadingImage").hide();
				//  alert(status + errorThrown);
			  }
			  
		  }); 
		  
		  } //	

//=====================================================================================
function addReadingM(dat,ecclean,ecfertilized,ph,injector,fertelizedmix,alarm,nbplants,galonnn)
	{		
	
	//	alert(supervisor + "/"+ notes + "/"+ data + "/"+ dataa+ "/"+ maintenance);
		  $.ajax({
			
			  type: 'GET',
			  url: "../../ws/ws_treadingm.php",
			  data: ({action:1,dat:dat,nbplants:nbplants,ecclean:ecclean,galonnn:galonnn,ecfertilized:ecfertilized,ph:ph,maintenance:maintenance,injector:injector,fertelizedmix:fertelizedmix,alarm:alarm}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
		
				  if(data==0)
					  alert("Data is not inserted");  
					  else	  {
  				  	data = JSON.parse(xhr.responseText);	
				 location.reload();}		  
				
			  },
			  error: function(xhr, status, errorThrown) 
			  {
				//alert("1");
				//  alert(status + errorThrown);
			  }
		  });  //	

	}
	function bringData(serial)
	{
//	alert(serial);
	//$("#LoadingImage").show();
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_irrigationflow.php",
			  data: ({action:1,id:serial}),			  
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
		function bringData1(serial)
	{
//	alert(serial);
	//$("#LoadingImage").show();
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_irrigationtime.php",
			  data: ({action:1,id:serial}),			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			 
			  {
	
				// $("#LoadingImage").hide();
				  data = JSON.parse(xhr.responseText);	
				  decide1(data,serial);				  
			  },
			  
			  error: function(xhr, status, errorThrown) 
			  {
			  
  				//  $("#LoadingImage").hide();
				 alert(status + errorThrown);
				  
			  }
		  });  	
	}
		function bringData3(serial)
	{
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_lux.php",
			  data: ({action:1,id:serial}),			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			 
			  {
				  data = JSON.parse(xhr.responseText);	
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
	var d = new Date(),        
        h = d.getHours(),
        m = d.getMinutes();
       
    if(h < 10) h = '0' + h; 
    if(m < 10) m = '0' + m; 
    today=today+" "+h+":"+m;
				  	var initialPreview = [];
var initialPreviewConfig = [];
				 for(var i= 0; i < data.length; i++)
{

initialPreview.push('../../att/Lux/'+data[i]["description"] );

	type=data[i]['description'].split(/[\s.]+/);
type=type[type.length-1];

switch(type){
	case 'jpg': initialPreviewConfig.push({caption: data[i]["description"], width: "120px", url: "../../ws/ws_deleteimage.php?id=" + data[i]["serial"] + "&tablename=lux"   , key: data[i]["serial"],downloadUrl: "../../att/Lux/"+data[i]["description"] });
				break;
	case 'png': initialPreviewConfig.push({caption: data[i]["description"], width: "120px", url: "../../ws/ws_deleteimage.php?id=" + data[i]["serial"] + "&tablename=lux"   , key: data[i]["serial"],downloadUrl: "../../att/Lux/"+data[i]["description"]});
				break;
	case 'gif': initialPreviewConfig.push({caption: data[i]["description"], width: "120px", url: "../../ws/ws_deleteimage.php?id=" + data[i]["serial"] + "&tablename=lux"   , key: data[i]["serial"],downloadUrl: "../../att/Lux/"+data[i]["description"]});
				break;
	case 'jpeg': initialPreviewConfig.push({caption: data[i]["description"], width: "120px", url: "../../ws/ws_deleteimage.php?id=" + data[i]["serial"] + "&tablename=lux"   , key: data[i]["serial"],downloadUrl: "../../att/Lux/"+data[i]["description"]});
				break;
	case 'pdf': initialPreviewConfig.push(  {type: "pdf", caption: data[i]["description"], url: "../../ws/ws_deleteimage.php?id=" + data[i]["serial"] + "&tablename=lux"   , key: data[i]["serial"],downloadUrl: "../../att/Lux/"+data[i]["description"]});
				break;
	case 'mp4': initialPreviewConfig.push(  {   
            type: "video", 
            size: 375000,
            filetype: "video/mp4",
            caption: data[i]["description"], 
            url: "../../ws/ws_deleteimage.php?id=" + data[i]["serial"] + "&tablename=lux",
            key: 3,
            downloadUrl: "../../att/Lux/"+data[i]["description"], // override url
            filename: data[i]["description"] // override download filename
        });
				break;
	case 'MP4': initialPreviewConfig.push(  {   
            type: "video", 
            size: 375000,
            filetype: "video/mp4",
            caption: data[i]["description"], 
            url: "../../ws/ws_deleteimage.php?id=" + data[i]["serial"] + "&tablename=lux",
            key: 3,
            downloadUrl: "../../att/Lux/"+data[i]["description"], // override url
            filename: data[i]["description"] // override download filename
        });
				break;
	default :initialPreviewConfig.push({caption: data[i]["description"], width: "120px", url: "../../ws/ws_deleteimage.php?id=" + data[i]["serial"] + "&tablename=lux"   , key: data[i]["serial"],downloadUrl: "../../att/Lux/"+data[i]["description"]});
				break;
}}	
				  		if(data.length>0){
				$('#images').fileinput('destroy');
		        $("#images").fileinput({
               'uploadUrl': '../../ws/ws_uploadimage13.php',
          overwriteInitial: false,
        validateInitialCount: true,
		 initialPreviewAsData: true,
		 		
    maxImageWidth: 1200,
    resizeImage: true,
            initialPreview: initialPreview,
            initialPreviewConfig: initialPreviewConfig,
			uploadExtraData: function() {
            return {
               serial: maintenance, dat:today
            };
           }
        });
		}			  
			





document.getElementById('datelux').value=data[0]['dat'];

			  },
			  
			  error: function(xhr, status, errorThrown) 
			  {
			  
				  
			  }
		  });  	
	}
		function bringData4(serial)
	{
//	alert(serial);
	//$("#LoadingImage").show();
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_pesticide.php",
			  data: ({action:1,id:serial}),			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			 
			  {
	
				// $("#LoadingImage").hide();
				  data = JSON.parse(xhr.responseText);	
			document.getElementById("trade").value = data[0]["trade"];
		var s =data[0]["dat"];
		var t =s.split("-");
var t3= (t[2].split(" "))[0];
document.getElementById("dat4").value=t[0]+"-"+t[1]+"-"+ t3;
		document.getElementById("method").value =data[0]["method"];
document.getElementById("ingredient").value = data[0]["ingredient"];
document.getElementById("dose").value = data[0]["dose"];	  
			  },
			  
			  error: function(xhr, status, errorThrown) 
			  {
			  
  				//  $("#LoadingImage").hide();
				 alert(status + errorThrown);
				  
			  }
		  });  	
	}
		function bringData2(serial)
	{
//	alert(serial);
	//$("#LoadingImage").show();
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_readingm.php",
			  data: ({action:1,id:serial}),			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			 
			  {
	
				// $("#LoadingImage").hide();
				  data = JSON.parse(xhr.responseText);	
				  decide2(data,serial);				  
			  },
			  
			  error: function(xhr, status, errorThrown) 
			  {
			  
  				//  $("#LoadingImage").hide();
				 alert(status + errorThrown);
				  
			  }
		  });  	
	}
	//delete person from server
		function deleteLux(idval)
	{
	//	alert("aaa" + idval);
		//$("#LoadingImage").show();
		 
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_tlux.php",
			  data: ({action:2,id :idval}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
				 // $("#LoadingImage").hide();
				  
				  location.reload();
			
			  },
			  error: function(xhr, status, errorThrown) 
			  {
				 // alert("345");
				//  $("#LoadingImage").hide();
				//  alert(status + errorThrown);
			  }
		  });  //	
}
			function deleteReadingm(idval)
	{
	//	alert("aaa" + idval);
		//$("#LoadingImage").show();
		 
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_treadingm.php",
			  data: ({action:2,id :idval}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
				 // $("#LoadingImage").hide();
				  
				  location.reload();
			
			  },
			  error: function(xhr, status, errorThrown) 
			  {
				 // alert("345");
				//  $("#LoadingImage").hide();
				//  alert(status + errorThrown);
			  }
		  });  //	
}
		function deleteIrrigationTime(idval)
	{
	//	alert("aaa" + idval);
		//$("#LoadingImage").show();
		 
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_tirrigationtime.php",
			  data: ({action:2,id :idval}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
				 // $("#LoadingImage").hide();
				  
				  location.reload();
			
			  },
			  error: function(xhr, status, errorThrown) 
			  {
				 // alert("345");
				//  $("#LoadingImage").hide();
				//  alert(status + errorThrown);
			  }
		  });  //	

	}
	function deleteIrrigationFlow(idval)
	{
	//	alert("aaa" + idval);
		//$("#LoadingImage").show();
		 
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_tirrigationflow.php",
			  data: ({action:2,id :idval}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
				 // $("#LoadingImage").hide();
				  
				  location.reload();
			
			  },
			  error: function(xhr, status, errorThrown) 
			  {
				 // alert("345");
				//  $("#LoadingImage").hide();
				//  alert(status + errorThrown);
			  }
		  });  //	

	}

		function deletepesticide(idval)
	{
	//	alert("aaa" + idval);
		//$("#LoadingImage").show();
		 
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_tpesticide.php",
			  data: ({action:2,id :idval}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
				 // $("#LoadingImage").hide();
				  
				  location.reload();
			
			  },
			  error: function(xhr, status, errorThrown) 
			  {
				 // alert("345");
				//  $("#LoadingImage").hide();
				//  alert(status + errorThrown);
			  }
		  });  //	

	}
	//================================================================================
	
////////////////////////////////////////////////////////////////////////////////////
function decide2(data,serial)
	{		

		count=data.length;
	if(count>0)
	{
		if( serial==0)
			alert("user exist");	
		else 
			{		
			
		  
		document.getElementById("ecclean").value = data[0]["ecclean"];
		var s =data[0]["dat"];
		var t =s.split("-");
var t3= (t[2].split(" "))[0];
document.getElementById("dat2").value=t[0]+"-"+t[1]+"-"+ t3;
		document.getElementById("ecfertilized").value =data[0]["ecfertilized"];
		document.getElementById("fertelizedmix").value =data[0]["fertelizedmix"];
		document.getElementById("alarm").value =data[0]["alarm"];
		 
document.getElementById("galonnn").value =data[0]["galonsnb"];


document.getElementById("ph").value = data[0]["ph"];
document.getElementById("injector").value = data[0]["injector"];
document.getElementById("nbplants").value = data[0]["nbplants"];
}
	}
	else
	
		showError(serial);
		}
//========================================================================================
	function decide1(data,serial)
	{		

		count=data.length;
	if(count>0)
	{
		if( serial==0)
			alert("user exist");	
		else 
			{		
			
		  
		document.getElementById("zone1").value = data[0]["zone"];
		var s =data[0]["dat"];
		var t =s.split("-");
var t3= (t[2].split(" "))[0];
document.getElementById("dat1").value=t[0]+"-"+t[1]+"-"+ t3;
		document.getElementById("starttime").value =data[0]["starttime"];
document.getElementById("endtime").value = data[0]["endtime"];


}
	}
	else
	
		showError(serial);
		}
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
			
		  	document.getElementById("linearmeter").value = data[0]["linearmeter"];
		document.getElementById("zone").value = data[0]["zone"];
		var s =data[0]["dat"];
		var t =s.split("-");
var t3= (t[2].split(" "))[0];
document.getElementById("dat").value=t[0]+"-"+t[1]+"-"+ t3;
		document.getElementById("emittertype").value = data[0]["emittertype"];
document.getElementById("emitternumber").value = data[0]["emitternumber"];
document.getElementById("emitterflow").value = data[0]["emitterflow"];
document.getElementById("totalflow").value = data[0]["totalflow"];
document.getElementById("minday").value = data[0]["minday"];
document.getElementById("watercons").value = data[0]["watercons"];

}
	}
	else
	
		showError(serial);
		}
});

