$(document).ready(function() {
ID=0;
 
var serial=0;
$("#myModal").on('shown.bs.modal', function () {
document.getElementById("lblalert").style.visibility='hidden';
 if(ID > 0)
	 
	{
		$("#title").html("Edit Follow Up");

		bringData(ID);}
	else
	$("#title").html("Add Follow Up");
		
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
$("#Add").click(function(){
	ID=0;
	//OpenUserEdit(Id);
});

	//delete a selcted person
	$(document).on('click',"[id^='del_']",function(){	
			//$(this).parent().parent().remove();
	  		strID=$(this).attr('id');			
			ID = strID.substring(4);
		
			var answer = confirm("Are You Sure You Want To Delete This Follow Up");
    if (answer)
			deleteUser(ID);
		
			
	});
	
	//Update users
	$(document).on('click',"[id^='Edit_']",function(){

		
	  		strID=$(this).attr('id');			
			ID = strID.substring(5);

	});

	
$("#add1").click(function(){

project = 0+$("#project").val();
dat= $("#dat").val();
description= $("#description1").val();
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
if( description=='')
document.getElementById("lblalert1").style.visibility='visible';
else{
if(ID==0)	
				{
						
					//window.open("../pages/upload.php?x="+ document.getElementById("attachment").value,"_blank","width=0,height=0");
					addNote(dat,project,description,today);
						
		
					
				}
		else{ 
		//	window.open("../pages/upload.php?x="+ attachment,"_blank","width=0,height=0");
		UpdateNote(ID,dat,project,description,today);
			
			}	
	//	}

}
	

});

	
//-----------------------------------------------------------------------------------
function UpdateNote(serial,dat,offerid,description,today)
	{
		
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_tofferfollowup.php",
			  data: ({action:3,serial :serial,dat:dat,offerid:offerid,description:description,today:today}),
			  
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
			  
				 // $("#LoadingImage").hide();
				//  alert(status + errorThrown);
			  }
			  
		  }); 
		  
		  } //	

//=====================================================================================
function addNote(dat,offerid,description,today)
	{		
	
//	alert(attachment+" "+paperid+" "+notes);
		  $.ajax({
			
			  type: 'GET',
			  url: "../../ws/ws_tofferfollowup.php",
			  data: ({action:1,dat:dat,offerid:offerid,description:description,today:today}),
			  
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
			  	location.reload();
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
			  url: "../../ws/ws_offerfollowup.php",
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
			  location.reload();
  				//  $("#LoadingImage").hide();
				 alert(status + errorThrown);
				  
			  }
		  });  	
	}
	
	//delete person from server
	function deleteUser(idval)
	{
	//	alert("aaa" + idval);
		//$("#LoadingImage").show();
		 
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_tofferfollowup.php",
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
				 // alert("345");
				//  $("#LoadingImage").hide();
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
		
			
		  	document.getElementById("project").value = data[0]["offerid"];
			document.getElementById("description1").value = data[0]["description"];
			var s =data[0]["dat"];
var t =s.split("-");
var t3= (t[2].split(" "))[0];
document.getElementById("dat").value=t[0]+"-"+t[1]+"-"+ t3;
			
			}
	}
	else
	
		showError(serial);
		}
		
		

function fillProfile()
	{
		
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_userconf.php",
			  data: ({action:1}),
			  
			  dataType: 'json',
			  timeout: 10000,
			  success: function(data, textStatus, xhr) 
			  {
		 		//  $("#LoadingImage").hide();				  
		
				  if(data==null){
					  //alert("Data couldn't be loaded!");
					  $("#profile").html("");
					 }
				  else{
				  	data = JSON.parse(xhr.responseText);				  				 
				  	count=data.length;
				  	
		var items;
	  $("#profile").html("");
		if(count>0)
		{
			items="";
			  $.each(data,function(index,item) 
    {
      $("#profile").append("<option value='"+item.Serial+"'>"+item.Description+"</option>");
    });
    $("#profile").val(1);

		}
				  }
			  },
			  error: function(xhr, status, errorThrown) 
			  {
			  	 
			  
			  }
		  });  //	
		
	}
	

});

