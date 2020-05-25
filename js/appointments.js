$(document).ready(function() {
ID=0;
var serial=0;
$("#myModal").on('shown.bs.modal', function () {

	$("#title").html("Add Customer");
		
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

$("#add1").click(function(){

name = $("#name").val();
phone = $("#phone").val();
	email = $("#email").val();
	company = $("#company").val();
	address = $("#address").val();
	mof=$("#mof");
	notes=$("#notes");
	if( name =='')
	{
	document.getElementById("lblalert").style.visibility='visible';
	
}
	else if(ID==0)	
				{	
			
					addCustomer(name,phone,email,company,address,mof,notes);
					
				}
		else{ 
		UpdateCustomer(ID,name,phone,email,company,address,mof,notes);
			}	
	//	}
	
	

});

	
//-----------------------------------------------------------------------------------
function UpdateCustomer(serial,name,username,psw,country,admin,hide,profile)
	{
		
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_tusers.php",
			  data: ({action:3,serial :serial,name:name,username:username,psw:psw,admin:admin,hide:hide,profile:profile,country:country}),
			  
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
function addCustomer(name,phone,email,company,address,mof,notes)
	{		
	
		alert("hi");
		  $.ajax({
			
			  type: 'GET',
			  url: "../../ws/ws_tcustomers.php",
			  data: ({action:1,name:name,phone:phone,email:email,company:company,address:address,mof:mof,notes:notes}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
		alert("hrllo");
				  if(data==0)
					  alert("Data is not inserted");  
					  else	  {
  				  	data = JSON.parse(xhr.responseText);	
				  }		  
				
			  },
			  error: function(xhr, status, errorThrown) 
			  {
				alert("1");
				//  alert(status + errorThrown);
			  }
		  });  //	

	}

});

