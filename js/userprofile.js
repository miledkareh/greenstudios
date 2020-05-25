$(document).ready(function() {
ID=0;
//fillOffice();
var serial=0;

document.getElementById('Div1').style.display = 'block';
document.getElementById('Div2').style.display = 'none';

$("#myModal").on('shown.bs.modal', function () {
document.getElementById("lblalert").style.visibility='hidden';
 if(ID > 0)
	 
	{
		$("#title").html("Edit User Profile");

		bringData(ID);}
	else
	$("#title").html("Add User Profile");
		
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
		document.getElementById("filter").value = 1;
			$("#datafilter").html("");
	//OpenUserEdit(Id);
});

	//delete a selcted person
	$(document).on('click',"[id^='del_']",function(){	
			//$(this).parent().parent().remove();
	  		strID=$(this).attr('id');			
			ID = strID.substring(4);
		
			var answer = confirm("Are You Sure You Want To Delete This User Profile");
    if (answer)
			deleteUser(ID);
		
			
	});
	
	//Update users
	$(document).on('click',"[id^='Edit_']",function(){

		
	  		strID=$(this).attr('id');			
			ID = strID.substring(5);


	});

	
$("#add1").click(function(){

description = $("#description").val();
data="";
dat=$("#datafilter").val();
filter=$("#filter").val();
if(filter==2){
	dat=$("#datafilter").val();
}
if(filter==3){
	dat=$("#datafilterr").val();
}
	if (dat.length>0){
		data=dat[0];
		
		for(i=1;i<dat.length;i++)
	{
		data=data+","+dat[i];
		
	}
	}
	if(document.getElementById('hide').checked==true)
	hide= 1;
	else hide=0;
	if( description =='')
	{
	document.getElementById("lblalert").style.visibility='visible';
	
}
	else if(ID==0)	
				{	
			
					addUser(description,filter,data,hide);
				
				}
		else{
			
		UpdateUsers(ID,description,filter,data,hide);
			}	
	//	}
	
	

});


	

//-----------------------------------------------------------------------------------
function UpdateUsers(serial,description,filter,data,hide)
	{
		
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_tuserprofile.php",
			  data: ({action:3,serial :serial,description:description,filter:filter,data:data,hide:hide}),
			  
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
function addUser(description,filter,data,hide)
	{		
	
		
		  $.ajax({
			
			  type: 'GET',
			  url: "../../ws/ws_tuserprofile.php",
			  data: ({action:1,description:description,filter:filter,data:data,hide:hide}),
			  
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
			  url: "../../ws/ws_userprofile.php",
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
			  url: "../../ws/ws_tuserprofile.php",
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
			
		  	document.getElementById("description").value = data[0]["Description"];
		document.getElementById("filter").value = data[0]["Filter"];
				var str = data[0]["DataFilter"];
var res = str.split(",");
		if (data[0]["Filter"]==2){ 
		fillCountry(data[0]["Filter"],res);
document.getElementById('Div1').style.display = 'block';
document.getElementById('Div2').style.display = 'none';
}
		else if (data[0]["Filter"]==3){ 
document.getElementById('Div1').style.display = 'none';
document.getElementById('Div2').style.display = 'block';
var values=data[0]["DataFilter"];
$.each(values.split(","), function(i,e){
    $("#datafilterr option[value='" + e + "']").prop("selected", true);
});
}
		else{$("#datafilter").html("");
	document.getElementById('Div1').style.display = 'block';
document.getElementById('Div2').style.display = 'none';}

if(	data[0]["hide"]==1)
			document.getElementById("hide").checked = true;
			else
			document.getElementById("hide").checked = false;
		
			
			}
	}
	else
	
		showError(serial);
		}
	function fillCountry(serial,dataa)
	{
		
		
			//$("#LoadingImage").show();
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_userconf.php",
			  data: ({action:2,serial:serial}),
			  
			  dataType: 'json',
			  timeout: 10000,
			  success: function(data, textStatus, xhr) 
			  {
			
		  		//  $("#LoadingImage").hide();				  
				  
				  if(data==null){
				  	
					 // alert("Data couldn't be loaded!");
					  $("#datafilter").html("");
					  }
				  else{
				  	
				  	data = JSON.parse(xhr.responseText);				  				 
				  	count=data.length;
				  	
		var items;
		$("#datafilter").html("");
		
		if(count>0)
		{
			items="";
			  $.each(data,function(index,item) 
    {
	
		if(dataa.indexOf(item.Country) >= 0){
			  $("#datafilter").append("<option value='"+item.Country+"' selected>"+item.Country+"</option>");
		}
		else{
		$("#datafilter").append("<option value='"+item.Country+"'>"+item.Country+"</option>");}
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
		  });  //	
		
	}
		function fillOffers(serial,dataa)
	{
			
			//$("#LoadingImage").show();
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_userconf.php",
			  data: ({action:3,serial:serial}),
			  
			  dataType: 'json',
			  timeout: 10000,
			  success: function(data, textStatus, xhr) 
			  {
			
		  		//  $("#LoadingImage").hide();				  
				  
				  if(data==null){
				  	
					 // alert("Data couldn't be loaded!");
					  $("#datafilter").html("");
					  }
				  else{
				  	
				  	data = JSON.parse(xhr.responseText);				  				 
				  	count=data.length;
				  	
		var items;
		$("#datafilter").html("");
		
		if(count>0)
		{
			
			items="";
			  $.each(data,function(index,item) 
    {
	
		if(dataa.indexOf(item.Serial) >= 0){
		$("#datafilter").append("<option value='"+item.Serial+"' selected>"+item.ProjectName+"</option>");	   
		}
		else{
 $("#datafilter").append("<option value='"+item.Serial+"'>"+item.ProjectName+"</option>");
		}
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
		  });  //	
		
	}
 $('select[id="filter"]').change(function () {

 	serial=$("#filter").val();
	if (serial=="2"){
	fillCountry(serial,"".split(0));

document.getElementById('Div1').style.display = 'block';
document.getElementById('Div2').style.display = 'none';
	}
	if (serial=="3"){
	fillOffers(serial,"".split(0));
document.getElementById('Div1').style.display = 'none';
document.getElementById('Div2').style.display = 'block';
	}
	else{$("#datafilter").html(""); 	
	document.getElementById('Div1').style.display = 'block';
document.getElementById('Div2').style.display = 'none';}

    });
});

