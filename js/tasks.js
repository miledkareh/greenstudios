$(document).ready(function() {

ID=0;

var maintenanceid=0;
canedit=0;
newassign=0;
offerid=0;
followup=0;
prestatus=0;
update=0;
follow=0;

	$('body').on('hidden.bs.modal', function () {
    if($('.modal.in').length > 0)
    {
        $('body').addClass('modal-open');
    }
});
//fillSections();
//getUsers();

    
    ///////////////////////////////////////////
    
 
    //////////////////////////////////////////////////
    $(document).on('click',"[id^='done']",function(){	
			//$(this).parent().parent().remove();
			
		if(document.getElementById('done').checked==true){
document.getElementById("add1").disabled=false;
document.getElementById("taskstatus").value=4;}
else
document.getElementById("add1").disabled=true;

});
    ///////////////////////////////////////////////////////
$(document).on('click',"[id^='Col_']",function(){	
			//$(this).parent().parent().remove();
			
	  		strID=$(this).attr('id');			
			ID = strID.substring(4);
			UpdateNotification(ID);
			location.reload();
	//OpenUserEdit(Id);
});
///////////////////////////////////////////////////////////////////
$(document).on('click',"[id^='Editt_']",function(){
	  		strID=$(this).attr('id');			
			followup = strID.substring(6);
			
	});
/////////////////////////////////////////////////////////////////
$(document).on('click',"[id^='Ad']",function(){
follow=2;
			followup=0;
			
			if(ID==0)
document.getElementById("lblalert4").style.visibility='visible';
else{
			prestatus=$("#taskstatus").val();
			document.getElementById("status3").value=$("#taskstatus").val();
			$('#myModal2').modal('show');		//window.open("../pages/upload.php?x="+ document.getElementById("attachment").value,"_blank","width=0,height=0");
}
	});
	//================================================================================
	$(document).on('click',"[id^='ad1']",function(){
		
		follow=1;
if(ID==0)
document.getElementById("lblalert4").style.visibility='visible';
else{
			followup=0;
			prestatus=$("#taskstatus").val();
			document.getElementById("status3").value=$("#taskstatus1").val();
			$('#myModal2').modal('show');		//window.open("../pages/upload.php?x="+ document.getElementById("attachment").value,"_blank","width=0,height=0");
}
	});
	///////////////////////////////////////////////////////////////////////////////
	$(document).on('click',"[id^='ADD']",function(){

			ID=0;
			offerid=findGetParameter('z');
			if(offerid!=null && offerid!=0)
			document.getElementById('project').value=offerid;
			document.getElementById('taskstatus1').value=5;
					//window.open("../pages/upload.php?x="+ document.getElementById("attachment").value,"_blank","width=0,height=0");

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
/////////////////////////////////////////////////////////////
		$(document).on('click',"[id^='dell_']",function(){	
			//$(this).parent().parent().remove();
	  		strID=$(this).attr('id');			
			followup = strID.substring(5);
			var answer = confirm("Are You Sure You Want To Delete This Follow Up");
    if (answer)
			deleteFollowUp(followup);
		
			
	});
	///////////////////////////////////////////////////////////////////////
	function deleteFollowUp(idval)
	{
		
		//$("#LoadingImage").show();
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_ttaskfollowup.php",
			  data: ({action:2,id :idval}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
				 // $("#LoadingImage").hide();
				
				  if(data==0)
				  	alert("Row not deleted!");
				  	
			getFollowUp(ID);
			  },
			  error: function(xhr, status, errorThrown) 
			  {
				 
		
				//  alert(status + errorThrown);
			  }
		  });  //	

	}
/////////////////////////////////////////////////////////////////
function UpdateNotification(serial)
	{
	
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_UpdateTask.php",
			  data: ({action:1,serial :serial}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
			
				 
					  				 			  
				
			  },
			  error: function(xhr, status, errorThrown) 
			  {
			  //	alert("2");
				 // $("#LoadingImage").hide();
				//  alert(status + errorThrown);
			  }
			  
		  }); 
		  
		  } //	
		  
/////////////////////////////////////////////////////////////////////
function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;

    return [year, month, day].join('-');
}		  
//////////////////////////////////////////////////////////////
$("#myModal2").on('shown.bs.modal', function () {
	
document.getElementById("lblalert2").style.visibility='hidden';
$('#dat').val(formatDate(Date.now()));

 if(followup > 0)
	 
	{
		$("#title2").html("Edit Follow Up");

		bringData1(followup);
		}
	else
	$("#title2").html("Add Follow Up");
		
});
/////////////////////////////////////////////////////////////////////
$("#myModal2").on('hidden.bs.modal', function (e) {
document.getElementById("lblalert2").style.visibility='hidden';
document.getElementById("lblalert4").style.visibility='hidden';
  $(this)
    .find("input,textarea,select")
       .val('')
       .end()
    .find("input[type=checkbox], input[type=radio]")
       .prop("checked", "")
       .end();
       
});
/////////////////////////////////////////////////////////////////////
function bringData1(serial)
	{
	
	//$("#LoadingImage").show();
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_getfollowup.php",
			  data: ({action:4,id:serial}),			  
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
	/////////////////////////////////////////////////////////////
	function decide1(data,serial)
	{		

		count=data.length;
	if(count>0)
	{
		if( serial==0)
			alert("user exist");	
		else 
			{		
		
		var s =data[0]["fromdate"];
var t =s.split("-");
var t3= (t[2].split(" "))[0];
document.getElementById("fromdate1").value=t[0]+"-"+t[1]+"-"+ t3;
		document.getElementById("fromtime1").value = (t[2].split(" "))[1];
			s =data[0]["todate"];
 t =s.split("-");
 t3= (t[2].split(" "))[0];
document.getElementById("todate1").value=t[0]+"-"+t[1]+"-"+ t3;
		document.getElementById("totime1").value = (t[2].split(" "))[1];
		document.getElementById("description1").value=data[0]["description"];
		document.getElementById("status3").value=data[0]["status"];
		prestatus=data[0]["status"];
			}
	}
	else
	
		showError(serial);
		}				  
////////////////////////////////////////////////////////////
$("#myModal").on('shown.bs.modal', function () {
update=0;
follow=2;

document.getElementById("lblalert").style.visibility='hidden';
if(canedit==0){
	document.getElementById("subject").disabled=true;
document.getElementById("description").disabled=true;
document.getElementById("employee").disabled=true;
document.getElementById("viewer").disabled=true;


document.getElementById("done").disabled=false;
document.getElementById("taskstatus").disabled=false;

}
else if (canedit==1)
{
	document.getElementById("subject").disabled=false;
	document.getElementById("taskstatus").disabled=false;
	document.getElementById("description").disabled=false;
document.getElementById("employee").disabled=false;
document.getElementById("viewer").disabled=false;



document.getElementById("done").disabled=true;
document.getElementById("add2").disabled=false;
}
else
{
	document.getElementById("subject").disabled=true;
	document.getElementById("description").disabled=true;
document.getElementById("employee").disabled=true;
document.getElementById("viewer").disabled=true;

document.getElementById("done").disabled=true;
document.getElementById("add2").disabled=true;
document.getElementById("taskstatus").disabled=true;
}

 if(ID > 0)
	 
	{
		$("#title").html("Edit Task");

		bringData(ID);
		bringData2(ID);
		}
	else
	$("#title").html("Add Task");
		
});
////////////////////////////////////////////////////////////////////
$("#myModal1").on('shown.bs.modal', function () {
	update=0;
	follow=1;
	
$("#lblalert5").show().delay(-1).fadeOut();
document.getElementById("lblalert3").style.visibility='hidden';

 if(ID > 0)
	 
	{
		$("#title1").html("Edit Task");

		bringData(ID);
		bringData2(ID);
		}
	else
	$("#title1").html("Add Task");
		
});
///////////////////////////////////////////////////////////
	function bringData2(serial)
	{
	
	//$("#LoadingImage").show();
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_getfollowup.php",
			  data: ({action:3,id:serial}),			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			 
			  {
			  
				// $("#LoadingImage").hide();
				  data = JSON.parse(xhr.responseText);	
				  populate(data);				  
			  },
			  
			  error: function(xhr, status, errorThrown) 
			  {
			  
  				//  $("#LoadingImage").hide();
  				// populate(data);
				// alert(status + errorThrown);
				  
			  }
		  });  	
	}
///////////////////////////////////////////////////////////////////
$("#myModal").on('hidden.bs.modal', function (e) {
document.getElementById("lblalert").style.visibility='hidden';
  $(this)
    .find("input,textarea,select")
       .val('')
       .end()
    .find("input[type=checkbox], input[type=radio]")
       .prop("checked", "")
       .end();
       if(update==1)
       location.reload();
});

$("#myModal1").on('hidden.bs.modal', function (e) {
document.getElementById("lblalert").style.visibility='hidden';
  $(this)
    .find("input,textarea,select")
       .val('')
       .end()
    .find("input[type=checkbox], input[type=radio]")
       .prop("checked", "")
       .end();
       if(update==1)
       location.reload();
});

// ADD User
$(document).on('click',"[id^='Add']",function(){
$("#followup").empty();
			ID=0;

	});

	$(document).on('click',"[id^='del_']",function(){	
			//$(this).parent().parent().remove();
	  		strID=$(this).attr('id');			
			ID = strID.substring(4);
			var answer = confirm("Are You Sure You Want To Delete This Task");
    if (answer)
			deleteAttachment(ID);
		
			
	});
		$(document).on('dblclick',"[id^='TR_']",function(){
	  		strID=$(this).attr('id');			
			ID = strID.substring(3);
			status=$("#changeto").val();
			if(status!=0)
			UpdateTaskStatus(ID,status);
			
	});
	//Update users
	$(document).on('click',"[id^='Edit_']",function(){
	  		strID=$(this).attr('id');			
			ID = strID.substring(5);
			
			isnew=0;
			var str_array = ID.split(',');
			ID=str_array[0];
			
			offerid=str_array[1];
			canedit=str_array[2];
			if (canedit==0)
			UpdateNotification(ID);
	});
	//-----------------------------------------------------------------------------
	
$("#add1").click(function(){
	canedit=1;
	taskstatus=$("#taskstatus").val();
if(document.getElementById('done').checked==true)
{done=1;
	taskstatus=4;}
else
	done=0;
	if (done==0)
	document.getElementById("lblalert1").style.visibility='visible';
	else{
	newassign=1;

					//window.open("../pages/upload.php?x="+ document.getElementById("attachment").value,"_blank","width=0,height=0");
					UpdateAttachment(ID,done,taskstatus);
				}	


});

//===================================================================================
$("#add2").click(function(){
	

description=$("#description").val();	
employee=$("#employee").val();
taskstatus=$("#taskstatus").val();
subject= $("#subject").val();
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

viewer=0;
	view=$("#viewer").val();
	
	if (view.length>0){
		viewer=view[0];
		
		for(i=1;i<view.length;i++)
	{
		viewer=viewer+","+view[i];
		
	}
	}
if( employee=='')
document.getElementById("lblalert").style.visibility='visible';
else{
	
	if(canedit==0){
		if(document.getElementById('done').checked==true)
done=1;
else
	done=0;
	

					//window.open("../pages/upload.php?x="+ document.getElementById("attachment").value,"_blank","width=0,height=0");
					UpdateAttachment1(ID,done,taskstatus);
					
	}
	else{
if(newassign==0){		
		//	alert(offerid+' '+maintenanceid);
					//window.open("../pages/upload.php?x="+ document.getElementById("attachment").value,"_blank","width=0,height=0");
					UpdateTask(ID,subject,description,employee,viewer,today,0,offerid,taskstatus,maintenanceid);						
				}
			
		else{
			
			UpdateActive(subject,description,employee,viewer,today,0,offerid,taskstatus,maintenanceid);
			
		}
	//	}
}
}

});
//===================================================================================================
$("#add3").click(function(){
	update=1;
	project=0+$("#project").val();
	maintenance=0+$("#maintenance").val();

description=$("#description2").val();	
employee=0+$("#employee1").val();
taskstatus=$("#taskstatus1").val();
subject= $("#subject1").val();

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

viewer=0;
	view=$("#viewer1").val();
	
	if (view.length>0){
		viewer=view[0];
		
		for(i=1;i<view.length;i++)
	{
		viewer=viewer+","+view[i];
		
	}
	}

if( employee==0)
document.getElementById("lblalert3").style.visibility='visible';
else if(ID==0){
	
						//window.open("../pages/upload.php?x="+ document.getElementById("attachment").value,"_blank","width=0,height=0");
					addAssign(subject,description,employee,viewer,today,0,project,taskstatus,maintenance);				
					
				}
		else
		{
			UpdateTask(ID,subject,description,employee,viewer,today,0,project,taskstatus,maintenance);	
		}
	//	}
	


});
function addAssign(subject,description,employee,viewer,today,department,offerid,taskstatus,maintenanceid)
	{
				
	//alert(description+" "+employee+" "+viewer+" "+today+" "+department+" "+offerid);
		// alert(direct+section+office+interest+department+description+employee+userid+"paper "+ID+"date "+date+descriptionto+viewer);
		  $.ajax({
			
			  type: 'GET',
			  url: "../../ws/ws_tassign.php",
			  data: ({action:1,subject:subject,description:description,employee:employee,viewer:viewer,today:today,department:department,offerid:offerid,taskstatus:taskstatus,maintenanceid:maintenanceid}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
		
				  if(data==0)
					 {}// alert("Data is not inserted");  
				  else
				  {
				  	data = JSON.parse(xhr.responseText);	
				  	location.reload();  				 
				
				  }				  
				
			  },
			  error: function(xhr, status, errorThrown) 
			  {
			  
				//alert("error1");
				//  alert(status + errorThrown);
			  }
		  });  //	

	}
//=======================================================================================
$("#add4").click(function(){
update=1;
fromdate= $("#fromdate1").val();
description= $("#description1").val();
todate= $("#todate1").val();
fromtime= $("#fromtime1").val();
totime= $("#totime1").val();
status1= $("#status3").val();

if( description=='')
document.getElementById("lblalert2").style.visibility='visible';
else{
if(followup==0)	
				{
						//alert(dat+" "+ID+" "+description+" "+status1);
					//window.open("../pages/upload.php?x="+ document.getElementById("attachment").value,"_blank","width=0,height=0");
					addNote(fromdate,todate,fromtime,totime,ID,description,status1);
						document.getElementById("description1").value="";
		document.getElementById("status3").value="";
					
				}
		else{ 
		//	window.open("../pages/upload.php?x="+ attachment,"_blank","width=0,height=0");
		UpdateNote(followup,fromdate,todate,fromtime,totime,ID,description,status1);
			
			}	
	//	}

}

});	
//=====================================================================================
function addNote(fromdate,todate,fromtime,totime,taskid,description,status1)
	{		
	//alert(dat +" "+taskid+" "+description+" "+status1);
//	alert(attachment+" "+paperid+" "+notes);
		  $.ajax({
			
			  type: 'GET',
			  url: "../../ws/ws_ttaskfollowup.php",
			  data: ({action:1,fromdate:fromdate,todate:todate,fromtime:fromtime,totime:totime,taskid:taskid,description:description,status1:status1}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
		
				  if(data==0)
					  alert("Data is not inserted");  
				  else	  {
  				  	data = JSON.parse(xhr.responseText);	
				 //   addStatusUpdate1(status,offerid);
				 if(prestatus!=status1)
				{Updatetask(status1,taskid);
					document.getElementById("taskstatus").value=status1;
					}
				getFollowUp(ID);}			  
				
			  },
			  error: function(xhr, status, errorThrown) 
			  {
			//	alert("2");
				//  alert(status + errorThrown);
			  }
		  });  //	

	}
	//=======================================================================================
	function Updatetask(status,serial)
	{
		
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_ttasks.php",
			  data: ({action:4,serial :serial,status:status}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
			
				
				  if(data==0)
				  	alert("No Update!");
				  else	  {
  				  	data = JSON.parse(xhr.responseText);
				  }
  				  				  				 			  

			  },
			  error: function(xhr, status, errorThrown) 
			  {
			  
				 // $("#LoadingImage").hide();
				//  alert(status + errorThrown);
			  }
			  
		  }); 
		  
		  } //
	//==================================================================================
	function UpdateNote(serial,fromdate,todate,fromtime,totime,taskid,description,status1)
	{
		
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_ttaskfollowup.php",
			  data: ({action:3,serial :serial,fromdate:fromdate,todate:todate,fromtime:fromtime,totime:totime,taskid:taskid,description:description,status1:status1}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
			
				
				  if(data==0)
				  	alert("No Update!");
				  else	  {
  				  	data = JSON.parse(xhr.responseText);
  				  
  				  	 if(prestatus!=status1)
				//  addStatusUpdate(status,offerid);
				{Updatetask(status1,taskid);
					document.getElementById("taskstatus").value=status1;}
				getFollowUp(ID);
				$('#myModal2').modal('hide');
				  }
  				  				  				 			  

			  },
			  error: function(xhr, status, errorThrown) 
			  {
			  
				 // $("#LoadingImage").hide();
				//  alert(status + errorThrown);
			  }
			  
		  }); 
		  
		  } //
		  //=============================================================================
		  function getFollowUp(serial)
	{
	
	//$("#LoadingImage").show();
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_getfollowup.php",
			  data: ({action:3,id:serial}),			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			 
			  {
			  
				// $("#LoadingImage").hide();
				  data = JSON.parse(xhr.responseText);	
				  populate(data);				  
			  },
			  
			  error: function(xhr, status, errorThrown) 
			  {
			  
  				//  $("#LoadingImage").hide();
				 alert(status + errorThrown);
				  
			  }
		  });  	
	}
	//===============================================================================================
	function populate(data)
	{	
		if(follow==1)	
	$("#followup1").empty();
else
$("#followup").empty();
		count=data.length;
		var item;

		if(count>0)
		{			
			
		   $.each(data, function(index, row) {
				item = "<tr id='tr_"+row.serial+"'>";
                item+=   "<td>"+row.fromdate+"</td>";
                item+=   "<td>"+row.description+"</td>";
                item+=   "<td>"+row.statusN+"</td>";
                item+=   "<td>"+row.userN+"</td>";
                
              //  item+=   "<td>"+row.password+"</td>";
				//item+=   "<td>"+row.admin+"</td>";
              //  item+=   "<td><button type='button' data-toggle= 'modal' data-target='#myModal1' class='btn btn-success del' id='Editt_"+row.serial+"'> Edit</button></td>";
                item+="<td><a  id='Editt_"+row.serial+"'  data-toggle='modal' data-target='#myModal2' ><p class='fa fa-edit'></p> Edit</a></td>";
              // item+=   "<td><button type='button' class='btn btn-success del' id='dell_"+row.serial+"'> Delete</button></td>";
               item+="<td><a  id='dell_"+row.serial+"' ><p class='fa fa-trash-o'></p> Delete</a></td>";
                item+= "</tr>";
             
                if(follow==1)	
	$("#followup1").append(item);
	else
				$("#followup").append(item);
			});
			
		}
	}	
//==================================================================================
function UpdateActive(subject,description,employee,viewer,today,department,offerid,taskstatus,maintenanceid)
	{
				
	//alert(description+" "+employee+" "+viewer+" "+today+" "+department+" "+offerid);
		// alert(direct+section+office+interest+department+description+employee+userid+"paper "+ID+"date "+date+descriptionto+viewer);
		
		  $.ajax({
			
			  type: 'GET',
			  url: "../../ws/ws_tassign.php",
			  data: ({action:4,offerid:offerid}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
		
				  if(data==0)
					 {}// alert("Data is not inserted");  
				  else
				  {
				  	data = JSON.parse(xhr.responseText);				  				 
					addTask(subject,description,employee,viewer,today,department,offerid,taskstatus,maintenanceid);
				  }				  
				
			  },
			  error: function(xhr, status, errorThrown) 
			  {
			  
				//alert("error1");
				//  alert(status + errorThrown);
			  }
		  });  //	

	}
//==================================================================================
function addTask(subject,description,employee,viewer,today,department,offerid,taskstatus,maintenanceid)
	{
				
	//alert(description+" "+employee+" "+viewer+" "+today+" "+department+" "+offerid);
		// alert(direct+section+office+interest+department+description+employee+userid+"paper "+ID+"date "+date+descriptionto+viewer);
		  $.ajax({
			
			  type: 'GET',
			  url: "../../ws/ws_tassign.php",
			  data: ({action:1,subject:subject,description:description,employee:employee,viewer:viewer,today:today,department:department,offerid:offerid,taskstatus:taskstatus,maintenanceid:maintenanceid}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
		
				  if(data==0)
					 {}// alert("Data is not inserted");  
				  else
				  {
				  	data = JSON.parse(xhr.responseText);				  				 
					location.reload();
				  }				  
				
			  },
			  error: function(xhr, status, errorThrown) 
			  {
			  
				//alert("error1");
				//  alert(status + errorThrown);
			  }
		  });  //	

	}
	//=================================================================================================
	function UpdateTaskStatus(ID,status)
	{
				

		// alert(direct+section+office+interest+department+description+employee+userid+"paper "+ID+"date "+date+descriptionto+viewer);
		  $.ajax({
			
			  type: 'GET',
			  url: "../../ws/ws_tassign.php",
			  data: ({action:5,serial:ID,status:status}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
		
				  if(data==0)
					 {}// alert("Data is not inserted");  
				  else
				  {
				  	data = JSON.parse(xhr.responseText);	
				  				  				 
					 $("#tdstatus_"+ID).css("background-color", "red");
				  }				  
				
			  },
			  error: function(xhr, status, errorThrown) 
			  {
			 
				//alert("error1");
				//  alert(status + errorThrown);
			  }
		  });  //	

	}

//==================================================================================
function UpdateTask(ID,subject,description,employee,viewer,today,department,offerid,taskstatus,maintenanceid)
	{
		
		// alert(direct+section+office+interest+department+description+employee+userid+"paper "+ID+"date "+date+descriptionto+viewer);
		  $.ajax({
			
			  type: 'GET',
			  url: "../../ws/ws_tassign.php",
			  data: ({action:3,serial:ID,subject:subject,description:description,employee:employee,viewer:viewer,today:today,department:department,offerid:offerid,taskstatus:taskstatus,maintenanceid:maintenanceid}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
		
				  if(data==0)
					 {}// alert("Data is not inserted");  
				  else
				  {
				  	data = JSON.parse(xhr.responseText);	
				  				  				 
					location.reload();
				  }				  
				
			  },
			  error: function(xhr, status, errorThrown) 
			  {
			 
				//alert("error1");
				//  alert(status + errorThrown);
			  }
		  });  //	

	}

//===================================================================================

function UpdateAttachment(serial,done,taskstatus)
	{
		
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_ttasks.php",
			  data: ({action:3,serial :serial,done:done,taskstatus:taskstatus}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
			
				
				  if(data==0)
				  	alert("No Update!");
				  else	  {
				  
  				  	data = JSON.parse(xhr.responseText);
  				  
  				  document.getElementById("subject").value="";
  				  
  				  	
		document.getElementById("employee").value=0;
		document.getElementById("description").value="";
		document.getElementById("viewer").value=0;
		document.getElementById("description").disabled=false;
document.getElementById("employee").disabled=false;
document.getElementById("viewer").disabled=false;

document.getElementById('done').checked=false;

document.getElementById("add1").disabled=true;
document.getElementById("add2").disabled=false;
document.getElementById("taskstatus").disabled=false;
document.getElementById("subject").disabled=false;

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
//==========================================================================================
function UpdateAttachment1(serial,done,taskstatus)
	{
		
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_ttasks.php",
			  data: ({action:3,serial :serial,done:done,taskstatus:taskstatus}),
			  
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
		  
		  }
//=====================================================================================
function addAttachment(status,color,nocolor)
	{		
	
//	alert(attachment+" "+paperid+" "+notes);
		  $.ajax({
			
			  type: 'GET',
			  url: "../../ws/ws_tstatus.php",
			  data: ({action:1,status:status,color:color,nocolor:nocolor}),
			  
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
			  url: "../../ws/ws_tasks.php",
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
			  url: "../../ws/ws_ttasks.php",
			  data: ({action:2,id :idval}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
				 // $("#LoadingImage").hide();
				
				  if(data==0)
				  	alert("Row not deleted!");
			location.reload();
			  },
			  error: function(xhr, status, errorThrown) 
			  {
				 
			location.reload();
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
			//	alert("hi");
				document.getElementById("subject").value=data[0]["subject"];
			
		document.getElementById("employee").value=data[0]["toemployee"];
		document.getElementById("description").value=data[0]["description"];
		document.getElementById("taskstatus").value=data[0]["taskstatus"];
			maintenanceid=data[0]["maintenanceid"];
			
			fillEmployee1(data[0]["viewer"],data[0]["toemployee"]);
			
			
			if(data[0]["done"]==1)
			{document.getElementById('done').checked=true;
			}
			else{
			document.getElementById('done').checked=false;
			}
		}
	}
	else
	
		showError(serial);
		}
	function fillEmployee1(viewer,employee)
	{
	
	
			//$("#LoadingImage").show();
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_employee.php",
			  data: ({action:1,id:employee}),
			  
			  dataType: 'json',
			  timeout: 10000,
			  success: function(data, textStatus, xhr) 
			  {
			  	
		  		//  $("#LoadingImage").hide();				  
				  if(data==0)
				{}//	  alert("Data couldn't be loaded!");
				  else{
				  	
				  	data = JSON.parse(xhr.responseText);				  				 
				  	count=data.length;
				  	
		var items;
		$("#viewer").html("");
		if(count>0)
		{
			items="";
			var str_array = viewer.split(',');
			  $.each(data,function(index,item) 
    {
    	y="";
    	
    	if(str_array.indexOf(item.Serial)>=0){
    		
    		y=" selected";
    	}
      $("#viewer").append("<option value='"+item.Serial+"'" +y+ ">"+item.Fullname+"</option>");
    //  alert(items);
      
    }); 
}
//$("#employee").val(0);
	 }
	  },
	 error: function(xhr, status, errorThrown) 
		 {
		
		//  $("#LoadingImage").hide();				  
		//  alert(status + errorThrown);				  
		}
		  });  	
		
	}	

});

