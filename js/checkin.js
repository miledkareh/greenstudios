$(document).ready(function() {
var rate=0;
var Latitude=0;
var Longitude=0;
ID=0;
//fillSections();
//getUsers();

function getLocation() {
		
    if (navigator.geolocation) {
      
        navigator.geolocation.getCurrentPosition(showPosition);
       
    } else { 
        x.innerHTML = "Geolocation is not supported by this browser.";
        
    }
  
}

function showPosition(position) {
  
  Latitude=position.coords.latitude;
  Longitude=position.coords.longitude;
      
}
$(document).on('click',"[id^='span1']",function(){
		
		rate=1;
		if($("#span2").css('color')=="rgb(255, 255, 0)")
		{$("#span2").css("color", "");
		$("#span2").toggleClass('glyphicon-star-empty glyphicon-star');
		
		if($("#span3").css('color')=="rgb(255, 255, 0)")
		{$("#span3").css("color", "");
		$("#span3").toggleClass('glyphicon-star-empty glyphicon-star');}
		if($("#span4").css('color')=="rgb(255, 255, 0)")
		{$("#span4").css("color", "");
		$("#span4").toggleClass('glyphicon-star-empty glyphicon-star');}
		if($("#span5").css('color')=="rgb(255, 255, 0)")
		{$("#span5").css("color", "");
		$("#span5").toggleClass('glyphicon-star-empty glyphicon-star');}
		}
		else if($("#span1").css('color')=="rgb(255, 255, 0)")
		{$(this).css("color", "");
		$(this).toggleClass('glyphicon-star-empty glyphicon-star');
		rate=0;}
		else
		{$(this).css("color", "yellow");
		$(this).toggleClass('glyphicon-star-empty glyphicon-star');}

	});
$(document).on('click',"[id^='span2']",function(){

			rate=2;
		if($("#span3").css('color')=="rgb(255, 255, 0)")
		{$("#span3").css("color", "");
		$("#span3").toggleClass('glyphicon-star-empty glyphicon-star');
		if($("#span4").css('color')=="rgb(255, 255, 0)")
		{$("#span4").css("color", "");
		$("#span4").toggleClass('glyphicon-star-empty glyphicon-star');}
		if($("#span5").css('color')=="rgb(255, 255, 0)")
		{$("#span5").css("color", "");
		$("#span5").toggleClass('glyphicon-star-empty glyphicon-star');}
		}
		else if ($("#span1").css('color')=="rgb(255, 255, 0)" && $("#span2").css('color')=="rgb(255, 255, 0)")
		{$(this).css("color", "");
		$("#span1").css("color", "");
		$("#span1").toggleClass('glyphicon-star-empty glyphicon-star');
		$(this).toggleClass('glyphicon-star-empty glyphicon-star');
		rate=0;}
		else if ($("#span1").css('color')=="rgb(255, 255, 0)")
		{$(this).css("color", "yellow");
		$(this).toggleClass('glyphicon-star-empty glyphicon-star');
		rate=2;}
		else
		{$(this).css("color", "yellow");
		$("#span1").css("color", "yellow");
		$("#span1").toggleClass('glyphicon-star-empty glyphicon-star');
		$(this).toggleClass('glyphicon-star-empty glyphicon-star');}

	});
	$(document).on('click',"[id^='span3']",function(){
		rate=3;
		if($("#span4").css('color')=="rgb(255, 255, 0)")
		{$("#span4").css("color", "");
		$("#span4").toggleClass('glyphicon-star-empty glyphicon-star');
		if($("#span5").css('color')=="rgb(255, 255, 0)")
		{$("#span5").css("color", "");
		$("#span5").toggleClass('glyphicon-star-empty glyphicon-star');}
		}
		else if ($("#span1").css('color')=="rgb(255, 255, 0)" && $("#span2").css('color')=="rgb(255, 255, 0)" && $("#span3").css('color')=="rgb(255, 255, 0)")
		{$(this).css("color", "");
		$("#span2").css("color", "");
		$("#span1").css("color", "");
		$("#span2").toggleClass('glyphicon-star-empty glyphicon-star');
		$("#span1").toggleClass('glyphicon-star-empty glyphicon-star');
		$(this).toggleClass('glyphicon-star-empty glyphicon-star');
		rate=0;}
		else if ($("#span1").css('color')=="rgb(255, 255, 0)" && $("#span2").css('color')=="rgb(255, 255, 0)")
		{$(this).css("color", "yellow");
		$(this).toggleClass('glyphicon-star-empty glyphicon-star');
		rate=3;}
		else if ($("#span1").css('color')=="rgb(255, 255, 0)")
		{$(this).css("color", "yellow");
		$("#span2").css("color", "yellow");
		$("#span2").toggleClass('glyphicon-star-empty glyphicon-star');
		$(this).toggleClass('glyphicon-star-empty glyphicon-star');
		rate=3;}
		
		else
		{
			$(this).css("color", "yellow");
			$("#span2").css("color", "yellow");
			$("#span1").css("color", "yellow");
			$("#span1").toggleClass('glyphicon-star-empty glyphicon-star');
			$("#span2").toggleClass('glyphicon-star-empty glyphicon-star');
			$("#span3").toggleClass('glyphicon-star-empty glyphicon-star');
		}

	});
	$(document).on('click',"[id^='span4']",function(){
rate=4;
		if($("#span5").css('color')=="rgb(255, 255, 0)")
		{$("#span5").css("color", "");
		$("#span5").toggleClass('glyphicon-star-empty glyphicon-star');}
		
		else if ($("#span1").css('color')=="rgb(255, 255, 0)" && $("#span2").css('color')=="rgb(255, 255, 0)" && $("#span3").css('color')=="rgb(255, 255, 0)" &&$("#span4").css('color')=="rgb(255, 255, 0)")
		{$(this).css("color", "");
		$("#span2").css("color", "");
		$("#span1").css("color", "");
		$("#span3").css("color", "");
		$("#span2").toggleClass('glyphicon-star-empty glyphicon-star');
		$("#span1").toggleClass('glyphicon-star-empty glyphicon-star');
		$("#span3").toggleClass('glyphicon-star-empty glyphicon-star');
		$(this).toggleClass('glyphicon-star-empty glyphicon-star');
		rate=0;}
		else if ($("#span1").css('color')=="rgb(255, 255, 0)" && $("#span2").css('color')=="rgb(255, 255, 0)"&&$("#span3").css('color')=="rgb(255, 255, 0)")
		{$(this).css("color", "yellow");
		$(this).toggleClass('glyphicon-star-empty glyphicon-star');
		rate=4;}
		
		else if ($("#span1").css('color')=="rgb(255, 255, 0)" && $("#span2").css('color')=="rgb(255, 255, 0)")
		{$(this).css("color", "yellow");
		$("#span3").css("color", "yellow");
		$("#span3").toggleClass('glyphicon-star-empty glyphicon-star');
		$(this).toggleClass('glyphicon-star-empty glyphicon-star');
		rate=4;}
		
		else if ($("#span1").css('color')=="rgb(255, 255, 0)")
		{$(this).css("color", "yellow");
		$("#span2").css("color", "yellow");
		$("#span3").css("color", "yellow");
		$("#span2").toggleClass('glyphicon-star-empty glyphicon-star');
		$("#span3").toggleClass('glyphicon-star-empty glyphicon-star');
		$(this).toggleClass('glyphicon-star-empty glyphicon-star');
		rate=4;}

		else
		{
			$(this).css("color", "yellow");
			$("#span2").css("color", "yellow");
			$("#span1").css("color", "yellow");
			$("#span3").css("color", "yellow");
			$("#span1").toggleClass('glyphicon-star-empty glyphicon-star');
			$("#span2").toggleClass('glyphicon-star-empty glyphicon-star');
			$("#span3").toggleClass('glyphicon-star-empty glyphicon-star');
			$("#span4").toggleClass('glyphicon-star-empty glyphicon-star');
		}

	});
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	$(document).on('click',"[id^='span5']",function(){

		rate=5;
		 if ($("#span1").css('color')=="rgb(255, 255, 0)" && $("#span2").css('color')=="rgb(255, 255, 0)" && $("#span3").css('color')=="rgb(255, 255, 0)" &&$("#span4").css('color')=="rgb(255, 255, 0)"&&$("#span5").css('color')=="rgb(255, 255, 0)")
		{$(this).css("color", "");
		$("#span2").css("color", "");
		$("#span1").css("color", "");
		$("#span3").css("color", "");
		$("#span4").css("color", "");
		$("#span2").toggleClass('glyphicon-star-empty glyphicon-star');
		$("#span1").toggleClass('glyphicon-star-empty glyphicon-star');
		$("#span3").toggleClass('glyphicon-star-empty glyphicon-star');
		$("#span4").toggleClass('glyphicon-star-empty glyphicon-star');
		$(this).toggleClass('glyphicon-star-empty glyphicon-star');
		rate=0;}
		else if ($("#span1").css('color')=="rgb(255, 255, 0)" && $("#span2").css('color')=="rgb(255, 255, 0)"&&$("#span3").css('color')=="rgb(255, 255, 0)"&&$("#span4").css('color')=="rgb(255, 255, 0)")
		{$(this).css("color", "yellow");
		$(this).toggleClass('glyphicon-star-empty glyphicon-star');
		rate=5;}
		
		else if ($("#span1").css('color')=="rgb(255, 255, 0)" && $("#span2").css('color')=="rgb(255, 255, 0)"&& $("#span3").css('color')=="rgb(255, 255, 0)")
		{$(this).css("color", "yellow");
		$("#span4").css("color", "yellow");
		$("#span4").toggleClass('glyphicon-star-empty glyphicon-star');
		$(this).toggleClass('glyphicon-star-empty glyphicon-star');
		rate=5;}
		
		else if ($("#span1").css('color')=="rgb(255, 255, 0)"&&$("#span2").css('color')=="rgb(255, 255, 0)")
		{$(this).css("color", "yellow");
		$("#span3").css("color", "yellow");
		$("#span4").css("color", "yellow");
		$("#span3").toggleClass('glyphicon-star-empty glyphicon-star');
		$("#span4").toggleClass('glyphicon-star-empty glyphicon-star');
		$(this).toggleClass('glyphicon-star-empty glyphicon-star');
		rate=5;}
		else if ($("#span1").css('color')=="rgb(255, 255, 0)")
		{$(this).css("color", "yellow");
		$("#span2").css("color", "yellow");
		$("#span3").css("color", "yellow");
		$("#span4").css("color", "yellow");
		$("#span2").toggleClass('glyphicon-star-empty glyphicon-star');
		$("#span3").toggleClass('glyphicon-star-empty glyphicon-star');
		$("#span4").toggleClass('glyphicon-star-empty glyphicon-star');
		$(this).toggleClass('glyphicon-star-empty glyphicon-star');
		rate=5;}
		
		else
		{
			$(this).css("color", "yellow");
			$("#span2").css("color", "yellow");
			$("#span1").css("color", "yellow");
			$("#span3").css("color", "yellow");
			$("#span4").css("color", "yellow");
			$("#span1").toggleClass('glyphicon-star-empty glyphicon-star');
			$("#span2").toggleClass('glyphicon-star-empty glyphicon-star');
			$("#span3").toggleClass('glyphicon-star-empty glyphicon-star');
			$("#span4").toggleClass('glyphicon-star-empty glyphicon-star');
			$("#span5").toggleClass('glyphicon-star-empty glyphicon-star');
		}
	});

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$("#myModal").on('shown.bs.modal', function () {
document.getElementById("lblalert").style.visibility='hidden';
 if(ID > 0)
	 
	{
		$("#title").html("Check In");

		bringData(ID);
		}
	else
	$("#title").html("Check In");
		
});
$("#myModal1").on('shown.bs.modal', function () {
document.getElementById("lblalert").style.visibility='hidden';
 if(ID > 0)
	 
	{
		$("#title").html("Check Out");

		bringData1(ID);
		}
	else
	$("#title").html("Check Out");
		
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

$("#myModal1").on('hidden.bs.modal', function (e) {
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

// ADD User
$(document).on('click',"[id^='Add']",function(){

			ID=0;
		getLocation();

	});

	$(document).on('click',"[id^='del_']",function(){	
			//$(this).parent().parent().remove();
	  		strID=$(this).attr('id');			
			ID = strID.substring(4);
			var answer = confirm("Are You Sure You Want To Delete This Check in");
    if (answer)
			deleteAttachment(ID);
		
			
	});
	
	//Update users
	$(document).on('click',"[id^='Edit_']",function(){
	  		strID=$(this).attr('id');			
			ID = strID.substring(5);
	});
	$(document).on('click',"[id^='check_']",function(){
	  		strID=$(this).attr('id');			
			ID = strID.substring(6);
			getLocation();
	});
	//-----------------------------------------------------------------------------
	
$("#add1").click(function(){
project= $("#project").val();
description= $("#description").val();
location1= $("#location").val();
var currentdate = new Date(); 
var today = currentdate.getFullYear() + "-"
                + (currentdate.getMonth()+1)  + "-" 
                + currentdate.getDate() + " "  
                + currentdate.getHours() + ":"  
                + currentdate.getMinutes() + ":" 
                + currentdate.getSeconds();

if( project==''||location=='')
document.getElementById("lblalert").style.visibility='visible';
else{
if(ID==0)	
				{
						
					//window.open("../pages/upload.php?x="+ document.getElementById("attachment").value,"_blank","width=0,height=0");
					addAttachment(Latitude,Longitude,project,description,today,location1);
					
					
				}
		else{ 
		//	window.open("../pages/upload.php?x="+ attachment,"_blank","width=0,height=0");
		UpdateAttachment(ID,project,description,location1);
			
			}	
	//	}
	
}

});
//===================================================================================
$("#add2").click(function(){
notes= $("#notes").val();
location1= $("#location1").val();
var currentdate = new Date(); 
var today = currentdate.getFullYear() + "-"
                + (currentdate.getMonth()+1)  + "-" 
                + currentdate.getDate() + " "  
                + currentdate.getHours() + ":"  
                + currentdate.getMinutes() + ":" 
                + currentdate.getSeconds();

if( notes=='')
document.getElementById("lblalert").style.visibility='visible';
else{
if(ID==0)	
				{
						
					//window.open("../pages/upload.php?x="+ document.getElementById("attachment").value,"_blank","width=0,height=0");
					addAttachment1(Latitude,Longitude,notes,today);
					
					
				}
		else{ 
		//	window.open("../pages/upload.php?x="+ attachment,"_blank","width=0,height=0");
		UpdateAttachment1(ID,Latitude,Longitude,notes,today,rate,location1);
			
			}	
	//	}
	
}

});
//=====================================================================================
function UpdateAttachment1(serial,Latitude,Longitude,notes,today,rate,location1)
	{
		
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_tcheckin.php",
			  data: ({action:4,serial :serial,Latitude:Latitude,Longitude:Longitude,notes:notes,today:today,rate:rate,location:location1}),
			  
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
//=====================================================================================
function UpdateAttachment(serial,project,description,location1)
	{
		
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_tcheckin.php",
			  data: ({action:3,serial :serial,project:project,description:description,location:location1}),
			  
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

//=====================================================================================
function addAttachment(Latitude,Longitude,project,description,today,location1)
	{		
	
	
		  $.ajax({
			
			  type: 'GET',
			  url: "../../ws/ws_tcheckin.php",
			  data: ({action:1,Latitude:Latitude,Longitude:Longitude,project:project,description:description,today:today,location:location1}),
			  
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
			  url: "../../ws/ws_checkin.php",
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
			  url: "../../ws/ws_tcheckin.php",
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
			document.getElementById("description").value=data[0]["description"];
		document.getElementById("project").value=data[0]["project"];		
		document.getElementById("location").value=data[0]["checkinlocation"];
			
			
			
			}
	}
	else
	
		showError(serial);
		}
	

});

