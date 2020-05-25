$(document).ready(function() {

ID=0;
//fillSections();
//getUsers();

$("#myModal").on('shown.bs.modal', function () {
document.getElementById("lblalert").style.visibility='hidden';
 if(ID > 0)
	 
	{
		$("#title").html("Edit Client");

		bringData(ID);
		}
	else
	$("#title").html("Add Client");
		
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
	
$("#add1").click(function(){


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
					addAttachment(phours,dat,referred,category,company,specialty,website,country,city,tel,fax,fname,lname,title,email,mobile,notes,today);
					
					
				}
		else{ 
		//	window.open("../pages/upload.php?x="+ attachment,"_blank","width=0,height=0");
		UpdateAttachment(ID,phours,dat,referred,category,company,specialty,website,country,city,tel,fax,fname,lname,title,email,mobile,notes,today);
			
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
function UpdateAttachment(serial,phours,dat,referred,category,company,specialty,website,country,city,tel,fax,fname,lname,title,email,mobile,notes,today)
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
function addAttachment(phours,dat,referred,category,company,specialty,website,country,city,tel,fax,fname,lname,title,email,mobile,notes,today)
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
			  url: "../../ws/ws_clients.php",
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
			  url: "../../ws/ws_tclients.php",
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
		document.getElementById("company").value=data[0]["company"];
		
		
		
		document.getElementById("specialty").value=data[0]["specialty"];
		document.getElementById("website").value=data[0]["website"];
		document.getElementById("country").value=data[0]["country"];
		document.getElementById("city").value=data[0]["city"];
		document.getElementById("tel").value=data[0]["Telephone"];
		document.getElementById("fax").value=data[0]["fax"];
		document.getElementById("fname").value=data[0]["fname"];
		document.getElementById("lname").value=data[0]["lname"];
		document.getElementById("titlee").value=data[0]["activity"];
		document.getElementById("email").value=data[0]["email"];
		document.getElementById("mobile").value=data[0]["Mobile"];
		document.getElementById("notes").value=data[0]["notes"];
		document.getElementById("category").value=data[0]["ccategory"];
			document.getElementById("phours").value=data[0]["phours"];
			document.getElementById("referral").value=data[0]["referral"];
			var s =data[0]["dat"];
var t =s.split("-");
var t3= (t[2].split(" "))[0];
document.getElementById("dat").value=t[0]+"-"+t[1]+"-"+ t3;
			}
	}
	else
	
		showError(serial);
		}
	

});

