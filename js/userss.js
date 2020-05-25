$(document).ready(function() {
ID=0;
 fillProfile();
var serial=0;
$("#myModal").on('shown.bs.modal', function () {
document.getElementById("lblalert").style.visibility='hidden';
 if(ID > 0)
	 
	{
		$("#title").html("Edit User");

		bringData(ID);}
	else
	$("#title").html("Add User");
		
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
		
			var answer = confirm("Are You Sure You Want To Delete This User");
    if (answer)
			deleteUser(ID);
		
			
	});
	
	//Update users
	$(document).on('click',"[id^='Edit_']",function(){

		
	  		strID=$(this).attr('id');			
			ID = strID.substring(5);

	});

	
$("#add1").click(function(){

name = $("#name").val();
country = $("#country").val();
cost=$("#cost").val();
if(document.getElementById('complaint').checked==true)
	complaint = 1;
	else complaint=0;
if(document.getElementById('issupervisor').checked==true)
	issupervisor = 1;
	else issupervisor=0;
	if(document.getElementById('ViewQuantity').checked==true)
	ViewQuantity = 1;
	else ViewQuantity=0;
	username = $("#username1").val();
	psw = $("#password").val();
	profile = 0+$("#profile").val();
	if(document.getElementById('admin').checked==true)
	admin = 1;
	else admin=0;
		if(document.getElementById('hide').checked==true)
	hide= 1;
	else hide=0;
	if(document.getElementById('isemployee').checked==true)
	isemployee= 1;
	else isemployee=0;
	if( (username =='' || psw =='') && isemployee==0)
	{
	document.getElementById("lblalert").style.visibility='visible';
	
}
	else if(ID==0)	
				{	
			
					addUser(ViewQuantity,name,username,psw,country,admin,hide,profile,cost,complaint,isemployee,issupervisor);
					
				}
		else{ 
		UpdateUsers(ID,ViewQuantity,name,username,psw,country,admin,hide,profile,cost,complaint,isemployee,issupervisor);
			}	
	//	}
	
	

});

	
//-----------------------------------------------------------------------------------
function UpdateUsers(serial,ViewQuantity,name,username,psw,country,admin,hide,profile,cost,complaint,isemployee,issupervisor)
	{
		
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_tusers.php",
			  data: ({action:3,serial :serial,ViewQuantity:ViewQuantity,name:name,username:username,psw:psw,admin:admin,hide:hide,profile:profile,country:country,cost:cost,complaint:complaint,isemployee:isemployee,issupervisor:issupervisor}),
			  
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
function addUser(ViewQuantity,name,username,psw,country,admin,hide,profile,cost,complaint,isemployee,issupervisor)
	{		
	
		
		  $.ajax({
			
			  type: 'GET',
			  url: "../../ws/ws_tusers.php",
			  data: ({action:1,ViewQuantity:ViewQuantity,name:name,username:username,psw:psw,admin:admin,hide:hide,profile:profile,country:country,cost:cost,complaint:complaint,isemployee:isemployee,issupervisor:issupervisor}),
			  
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
	//$("#LoadingImage").show();
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_useredit.php",
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
	
	//delete person from server
	function deleteUser(idval)
	{
	//	alert("aaa" + idval);
		//$("#LoadingImage").show();
		 
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_tusers.php",
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
				  alert(status + errorThrown);
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
		document.getElementById("name").value = data[0]["Fullname"];
			
		  	document.getElementById("username1").value = data[0]["Username"];
			document.getElementById("password").value = data[0]["password"];
			document.getElementById("country").value = data[0]["country"];
			if(	data[0]["isadmin"]==1)
			document.getElementById("admin").checked = true;
			else
			document.getElementById("admin").checked = false;


if(	data[0]["issupervisor"]==1)
			document.getElementById("issupervisor").checked = true;
			else
			document.getElementById("issupervisor").checked = false;

			if(	data[0]["ViewQuantity"]==1)
			document.getElementById("ViewQuantity").checked = true;
			else
			document.getElementById("ViewQuantity").checked = false;

			if(	data[0]["isemployee"]==1)
			document.getElementById("isemployee").checked = true;
			else
			document.getElementById("isemployee").checked = false;
				if(	data[0]["hidevalues"]==1)
			document.getElementById("hide").checked = true;
			else
			document.getElementById("hide").checked = false;
			document.getElementById("profile").value = data[0]["userprofile"];
			document.getElementById("cost").value = data[0]["cost"];
			if(	data[0]["Complaint"]==1)
			document.getElementById("complaint").checked = true;
			else
			document.getElementById("complaint").checked = false;
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

