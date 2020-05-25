$(document).ready(function() {
ID=0;
userid=0;
ndetail=0;
userselected=0;
seen=0;



function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;

    return [year, month, day].join('-');
}
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
var serial=0;
$("#myModal").on('shown.bs.modal', function () {
document.getElementById("lblalert").style.visibility='hidden';

 if(ID > 0)
	 
	{
		$("#title").html("Edit");

		bringData(ID);
		bringDataa(ndetail);}
	else
	$("#title").html("Add");
		
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

// ADD User
$(document).on('click',"[id^='Add_']",function(){	
			//$(this).parent().parent().remove();
			ID=0;
			ndetail=0;
	  		strID=$(this).attr('id');			
			userid = strID.substring(4);
			seen=0;
		document.getElementById("done").disabled=true;
		document.getElementById("confirm").disabled=true;
		$('#dat').val(formatDate(Date.now()));
$('#duedate').val(formatDate(Date.now()));
	//OpenUserEdit(Id);
});

$(document).on('click',"[id^='Col_']",function(){	
			//$(this).parent().parent().remove();
			
	  		strID=$(this).attr('id');			
			ID = strID.substring(4);
			UpdateNotification(ID);
	//OpenUserEdit(Id);
});
	//delete a selcted person
	$(document).on('click',"[id^='del_']",function(){	
			//$(this).parent().parent().remove();
	  		strID=$(this).attr('id');			
			ID = strID.substring(4);
		
			var answer = confirm("Are You Sure You Want To Delete This Notification");
    if (answer)
			deleteReminder(ID);
		
			
	});
	
	//Update users
	$(document).on('click',"[id^='Edit_']",function(){
	
	  		strID=$(this).attr('id');			
			ID = strID.substring(5);
			var str_array = ID.split(',');
			ID=str_array[0];
			userid=str_array[1];
			ndetail=str_array[2];
			userselected=str_array[3];
			seen=str_array[4];
			document.getElementById("done").disabled=false;
			document.getElementById("confirm").disabled=false;
	});


	
$("#add1").click(function(){

dat = $("#dat").val();
duedate = $("#duedate").val();
dat=dat.replace(/(\d\d)\/(\d\d)\/(\d{4})/, "$3-$1-$2");
duedate=duedate.replace(/(\d\d)\/(\d\d)\/(\d{4})/, "$3-$1-$2");
	subject = $("#subject").val();
	description = $("#description").val();
	employee=0+$("#employee").val();
	viewer=0;
	view=$("#viewer").val();
	
	if (view.length>0){
		viewer=view[0];
		
		for(i=1;i<view.length;i++)
	{
		viewer=viewer+","+view[i];
		
	}
	}
	if(document.getElementById('confirm').checked==true)
	confirm=1;
	else
	confirm=0;
	 if($('#notification').is(':checked'))
		
		type=1;
	else
	type=0;
	
	offer=0+$("#offer").val();
	if(document.getElementById('done').checked==true)
	done=1;
	else
	done=0;
	if(  offer ==0)
	{
	document.getElementById("lblalert").style.visibility='visible';
	
}
	else if(ID==0)	
				{	
					
					addReminder(dat,duedate,subject,description,offer,employee,done,type,confirm,viewer);
					
			
				//		
					
				}
		else{ 
		UpdateReminder(ID,dat,duedate,subject,description,offer,employee,done,confirm,type,viewer);

			}	
	//	}
	
	

});

	
//-----------------------------------------------------------------------------------
function UpdateReminder(serial,dat,duedate,subject,description,offer,employee,done,confirm,type,viewer)
	{
		 
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_treminder.php",
			  data: ({action:3,serial :serial,dat:dat,duedate:duedate,subject:subject,description:description,offer:offer,done:done,type:type,confirm:confirm,viewer:viewer,employee:employee}),
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
			
				 
				  if(data==0)
				  	alert("No Update!");
				 	  else{
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
		   //	
//========================================================================================
function Updatenotification(serial,done,confirm)
	{
		// alert("hi"+serial+ done + confirm);
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_UpdateNotification.php",
			  data: ({action:2,serial :serial,done:done,confirm:confirm}),
			  
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
			  //	alert("2");
				 // $("#LoadingImage").hide();
				//  alert(status + errorThrown);
			  }
			  
		  }); 
		  
		  } //			  
//======================================================================================
function addnotification(employee,userid,notification,done,confirm,seen)
	{		
	
		//alert(employee+userid+notification+done+type);
		  $.ajax({
			
			  type: 'GET',
			  url: "../../ws/ws_tnotification.php",
			  data: ({action:1,employee:employee,userid:userid,notification:notification,done:done,confirm:confirm,seen:seen}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
	//alert("success");
				  if(data==0)
					  alert("Data is not inserted");  
					  else	  {
  				  	data = JSON.parse(xhr.responseText);
  				  	
				  }		  
				
			  },
			  error: function(xhr, status, errorThrown) 
			  {
				
				//  alert(status + errorThrown);
			  }
		  });  //	

	}
	function Updatenotif(employee,notification,done,confirm)
	{		
	
		//alert(employee+userid+notification+done+type);
		  $.ajax({
			
			  type: 'GET',
			  url: "../../ws/ws_tnotification.php",
			  data: ({action:4,employee:employee,notification:notification,done:done,confirm:confirm}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
	//alert("success");
				  if(data==0)
					  alert("Data is not inserted");  
					  else	  {
  				  	data = JSON.parse(xhr.responseText);
  				  	
				  }		  
				
			  },
			  error: function(xhr, status, errorThrown) 
			  {
				
				//  alert(status + errorThrown);
			  }
		  });  //	

	}
//====================================================================================
function UpdateNotification(serial)
	{
	
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_UpdateNotification.php",
			  data: ({action:1,serial :serial}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
			
				 
				location.reload();	  				 			  
				
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
function addReminder(dat,duedate,subject,description,offer,employee,done,type,confirm,viewer)
	{		
		
					
					
					  $.ajax({
			
			  type: 'GET',
			  url: "../../ws/ws_treminder.php",
			  data: ({action:1,dat:dat,duedate:duedate,subject:subject,description:description,offer:offer,employee:employee,done:done,type:type,viewer:viewer}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
	
				  if(data==0)
					  alert("Data is not inserted");  
					  else	  {
  				  	data = JSON.parse(xhr.responseText);
  				  location.reload();
  				  	
				  }		  
				
			  },
			  error: function(xhr, status, errorThrown) 
			  {
				//alert("1");
				//  alert(status + errorThrown);
			  }
		  });  	
					
		//alert(dat+duedate+subject+description+userid+offer+employee+done+type);
		//	

	}
	
	function bringData(serial)
	{
	//$("#LoadingImage").show();
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_reminder.php",
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
	function bringDataa(serial)
	{
	//$("#LoadingImage").show();
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_reminder.php",
			  data: ({action:2,id:serial}),			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			 
			  {
	
				// $("#LoadingImage").hide();
				  data = JSON.parse(xhr.responseText);
				  	count=data.length;
				  	
	if(count>0)
	{
				
			if(	data[0]["done"]==1)
			document.getElementById("done").checked = true;
			else
			document.getElementById("done").checked = false;
			
			if(	data[0]["confirm"]==1)
			
			document.getElementById("confirm").checked = true;
			else
			document.getElementById("confirm").checked = false;
			
	}
	else
	
		showError(serial);	
				  			  
			  },
			  
			  error: function(xhr, status, errorThrown) 
			  {
			  
  				//  $("#LoadingImage").hide();
				 alert(status + errorThrown);
				  
			  }
		  });  	
	}
	//delete person from server
	function deleteReminder(idval)
	{
	//	alert("aaa" + idval);
		//$("#LoadingImage").show();
		 
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_treminder.php",
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
				 // alert("345");
				//  $("#LoadingImage").hide();
				  //alert(status + errorThrown);
			  }
		  });  //	

	}
////////////////////////////////////////////////////////////////////////////////////
function deleteNotificationD(idval)
	{
	//	alert("aaa" + idval);
		//$("#LoadingImage").show();
		 
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_treminder.php",
			  data: ({action:4,id :idval}),
			  
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
				 // alert("345");
				//  $("#LoadingImage").hide();
				  //alert(status + errorThrown);
			  }
		  });  //	

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
		var s =data[0]["dat"];
var t =s.split("-");
var t3= (t[2].split(" "))[0];
document.getElementById("dat").value=t[0]+"-"+t[1]+"-"+ t3;
			s =data[0]["duedate"];
 t =s.split("-");
 t3= (t[2].split(" "))[0];
document.getElementById("duedate").value=t[0]+"-"+t[1]+"-"+ t3;
		  	document.getElementById("subject").value = data[0]["subject"];
			document.getElementById("description").value = data[0]["description"];
			if(	data[0]["done"]==1)
			document.getElementById("done").checked = true;
			else
			document.getElementById("done").checked = false;
			if(	data[0]["isnotification"]==1){
			$("#notification").prop("checked", true);
			
			}
			else
			$("#reminder").prop("checked", true);
			document.getElementById("offer").value = data[0]["offerid"];
			$("#offer").val(data[0]["offerid"]).trigger("change");
			document.getElementById("employee").value = data[0]["employee"];
			fillEmployee1(data[0]["viewer"]);
			if(	data[0]["confirm"]==1)
			
			document.getElementById("confirm").checked = true;
			else
			document.getElementById("confirm").checked = false;
			/*if(userid==data[0]['userid'])
			document.getElementById("done").disabled=true;
			else
			document.getElementById("done").disabled=false;
			if(userid==data[0]['employee'])
			document.getElementById("confirm").disabled=true;
			else
			document.getElementById("confirm").disabled=false;
			*/
			}
	}
	else
	
		showError(serial);
		}
		
function getmaxserial(table)
	{
	//	$("#LoadingImage").show();
		
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_getmax.php",
			  data: ({table :table}),
			  
			  dataType: 'json',
			  timeout: 10000,
			  success: function(data, textStatus, xhr) 
			  {
		  		 // $("#LoadingImage").hide();				  
				 
				  if(data==0)
					{}//  alert("Data couldn't be loaded!");
				  else{
				  	data = JSON.parse(xhr.responseText);				  				 
				  	count=data.length;
				  	
		var items;
		
		if(count>0)
		{
			items="";
			  $.each(data,function(index,item) 
    {
      ID=item.mserial;
      
    
    });
				  }}
			  },
			  error: function(xhr, status, errorThrown) 
			  {
				//  $("#LoadingImage").hide();	
					  
				//  alert(status + errorThrown);				  
			  }
		  });  //	
		 

	}		
function fillEmployee1(viewer)
	{
	
	
			//$("#LoadingImage").show();
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_useredit.php",
			  data: ({action:1}),
			  
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
 }
	  },
	 error: function(xhr, status, errorThrown) 
		 {
		
		//  $("#LoadingImage").hide();				  
		//  alert(status + errorThrown);				  
		}
		  });  	
		
	}	
function fillEmployee()
	{
		
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_useredit.php",
			  data: ({action:1}),
			  
			  dataType: 'json',
			  timeout: 10000,
			  success: function(data, textStatus, xhr) 
			  {
		 		//  $("#LoadingImage").hide();				  
		
				  if(data==null){
					  //alert("Data couldn't be loaded!");
					  $("#employee").html("");
					 }
				  else{
				  	data = JSON.parse(xhr.responseText);				  				 
				  	count=data.length;
				  	
		var items;
	  $("#employee").html("");
		if(count>0)
		{
			items="";
			
			  $.each(data,function(index,item) 
    {
      $("#employee").append("<option value='"+item.Serial+"'>"+item.Fullname+"</option>");
    });
 

		}
				  }
			  },
			  error: function(xhr, status, errorThrown) 
			  {
			  	 
			  
			  }
		  });  //	
		
	}
	

});

