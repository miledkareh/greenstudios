$(document).ready(function() {
 
ID=0;
contactID=0;
zoness=0;
newvisit=0;
var image1="";
	var image2="";
	var image3="";
	var image4="";
	var image5="";
	var image6="";
	var image7="";
	var image8="";
	followup=0;
	function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;

    return [year, month, day].join('-');
}



$(document).on('click',"[id='Adcontact']",function(){

				if(ID==0)
					document.getElementById("lblalert1").style.visibility='visible';	
			else
			{
			contactID=0;
			$('#myModal1').modal('show');		//window.open("../pages/upload.php?x="+ document.getElementById("attachment").value,"_blank","width=0,height=0");
			}
		

	});
	$("#add3").click(function(){

fname= $("#fname").val();

title= $("#titlee").val();
email= $("#email").val();
mobile= $("#mobile1").val();
clientstatus = $("input[name='contactstatus']:checked").val();
if( fname=='')
document.getElementById("lblalert2").style.visibility='visible';
else{
if(contactID==0)	
				{
					
						addCustomer(fname,title,email,mobile,ID,clientstatus);	
					
				}
		else{ 
		//	window.open("../pages/upload.php?x="+ attachment,"_blank","width=0,height=0");
			
			UpdateCustomer(contactID,fname,title,email,mobile,ID,clientstatus);
			}	
	//	}
	
}

});

function UpdateCustomer(serial,fname,title,email,mobile,clientID,clientstatus)
	{		
	//	  alert(clientstatus);
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_tmcontact.php",
			  data: ({action:3,serial:serial,clientstatus:clientstatus,fname:fname,title:title,email:email,mobile:mobile,clientID:clientID}),
			  
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
				  	getCustomers(clientID);
				  	$('#myModal1').modal('hide');
				  	
				  }				  
				
			  },
			  error: function(xhr, status, errorThrown) 
			  {
				 
				  //alert(status + errorThrown);
			  }
		  });  //	

	}
//========================================================================================
function addCustomer(fname,title,email,mobile,clientID,clientstatus)
	{		
		  
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_tmcontact.php",
			  data: ({action:1,fname:fname,title:title,email:email,mobile:mobile,clientID:clientID,clientstatus:clientstatus}),
			  
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
				  	getCustomers(clientID);
				  }				  
				
			  },
			  error: function(xhr, status, errorThrown) 
			  {
				 
				  //alert(status + errorThrown);
			  }
		  });  //	

	}
function getCustomers(id)
	{
		
		
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_mcontact.php",
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
				  	document.getElementById("fname").value="";
	
		document.getElementById("titlee").value="";
		document.getElementById("email").value="";
		document.getElementById("mobile1").value="";
	
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

		if ( $.fn.DataTable.isDataTable('#dataTables-example2') ) {	
			$('#dataTables-example2').DataTable().destroy();
		  }
		  
		  $('#dataTables-example2 tbody').empty();

		  columns=[ 
		   
			{"data": "fullname", "name": "Fullname", "title": "Fullname"}
			,
			{"data": "mobile", "name": "Mobile", "title": "Mobile"}
			,
			{"data": null, "name": "Email", "title": "Email",
			"render": function ( data, type, row, meta ) {
				return "<a href='mailto:"+data.email+"'>"+data.email+"</a>";	  
			} }
			,
			{"data": "title", "name": "Title", "title": "Title"},

			{"data": null, "name": "Action", "title": "Action",
		   "render": function ( data, type, row, meta ) {
			   return "<a style='cursor:pointer' id='Editt1_"+data.serial+"'  data-toggle='modal' data-target='#myModal1' ><p class='fa fa-edit'></p></a>&nbsp;&nbsp;<a style='cursor:pointer'  id='dell_"+data.serial+"' ><p class='fa fa-trash-o'></p> </a>";

		   } }
		 ];
			$('#dataTables-example2').DataTable({
			
		   columns:columns,
		  data: data,
	   responsive: true,
			   "aaSorting": [],
				   "stateSave": true,		   
	   });


/*	$("#clientbody").empty();
		count=data.length;
		var item;

		if(count>0)
		{			 
			
		   $.each(data, function(index, row) {
				item = "<tr id='tr_"+row.serial+"'>";
                item+=   "<td>"+row.fullname+"</td>";
              
                item+=   "<td>"+row.mobile+"</td>";
                item+=   "<td><a href='mailto:"+row.email+"'>"+row.email+"</a></td>";
                item+=   "<td>"+row.title+"</td>";
              //  item+=   "<td>"+row.password+"</td>";
				//item+=   "<td>"+row.admin+"</td>";
              //  item+=   "<td><button type='button' data-toggle= 'modal' data-target='#myModal1' class='btn btn-success del' id='Editt_"+row.serial+"'> Edit</button></td>";
                item+="<td><a  id='Editt1_"+row.serial+"'  data-toggle='modal' data-target='#myModal1' ><p class='fa fa-edit'></p> Edit</a></td>";
              // item+=   "<td><button type='button' class='btn btn-success del' id='dell_"+row.serial+"'> Delete</button></td>";
               item+="<td><a  id='dell_"+row.serial+"' ><p class='fa fa-trash-o'></p> Delete</a></td>";
                item+= "</tr>";
				$("#clientbody").append(item);
			});
			
		}
		*/
	}
		$(document).on('click',"[id^='Editt1_']",function(){
	  		strID=$(this).attr('id');			
			contactID = strID.substring(7);
	});
	
$("#myModal1").on('shown.bs.modal', function () {
document.getElementById("lblalert1").style.visibility='hidden';
 if(contactID > 0)
	 
	{
		$("#title1").html("Edit Contact");

		bringContact(contactID);
		}
	else
	$("#title1").html("Add Contact");
		
});
	function bringContact(serial)
	{
	
	//$("#LoadingImage").show();
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_mcontact.php",
			  data: ({action:1,id:serial}),			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			 
			  {
			  
				// $("#LoadingImage").hide();
				  data = JSON.parse(xhr.responseText);	
				 document.getElementById("fname").value=data[0]["fullname"];
		
		document.getElementById("titlee").value=data[0]["title"];
		document.getElementById("email").value=data[0]["email"];
		document.getElementById("mobile1").value=data[0]["mobile"];
		
		$('input[name=contactstatus][value=' + data[0]['clientstatus'] + ']').prop('checked',true)
			  },
			  
			  error: function(xhr, status, errorThrown) 
			  {
			  
  				//  $("#LoadingImage").hide();
				 alert(status + errorThrown);
				  
			  }
		  });  	
	}
	$("#myModal2").on('shown.bs.modal', function () {
		
document.getElementById("lblalert3").style.visibility='hidden';
$('#dat').val(formatDate(Date.now()));

 if(followup > 0)
	 
	{
		$("#title2").html("Edit Follow Up");

		bringData1(followup);
		}
	else
	$("#title2").html("Add Follow Up");
		
});
	function bringData1(serial)
	{
	
	//$("#LoadingImage").show();
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_getfollowup.php",
			  data: ({action:8,id:serial}),			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			 
			  {
			  
				// $("#LoadingImage").hide();
				  data = JSON.parse(xhr.responseText);	
				 	var s =data[0]["dat"];
var t =s.split("-");
var t3= (t[2].split(" "))[0];
document.getElementById("dat").value=t[0]+"-"+t[1]+"-"+ t3;
		document.getElementById("description1").value=data[0]["description"];		  
			  },
			  
			  error: function(xhr, status, errorThrown) 
			  {
			  
  				//  $("#LoadingImage").hide();
				// alert(status + errorThrown);
				  
			  }
		  });  	
	}	
$('#images1').on('filebeforedelete', function(event, key, data) {
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


//======================================================================================	
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

 $('select[id="project"]').change(function () {
 	getkickoffdate($("#project").val());

    });
    
    function getkickoffdate(serial)
	{
	
	//$("#LoadingImage").show();
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_offers.php",
			  data: ({id:serial}),			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			 
			  {
			 
				// $("#LoadingImage").hide();
				  data = JSON.parse(xhr.responseText);	
if(data[0]['status']=="COMPLETED")
 {  dat=data[0]["statusdate"];
    dat=new Date(dat);
     
     
 	dat1=dat.setMonth(dat.getMonth()+3);
    $('#kickoffdate').val(formatDate(dat1));
   } else{
				  var s =data[0]["kickoff"];
var t =s.split("-");
var t3= (t[2].split(" "))[0];
				 
				 	document.getElementById("kickoffdate").value= t[0]+"-"+t[1]+"-"+ t3;	  
				 }
			  },
			  
			  error: function(xhr, status, errorThrown) 
			  {
			  
  				//  $("#LoadingImage").hide();
				 alert(status + errorThrown);
				  
			  }
		  });  	
	}
    
		 document.getElementById("kickoff").value=$("#project").val();
		document.getElementById("kickoffdate").value=$("#kickoff>option:selected").html();
$("#myModal").on('shown.bs.modal', function () {
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
               'uploadUrl': '../../ws/ws_uploadimage.php',
          overwriteInitial: false,
        validateInitialCount: true,
			 initialPreviewAsData: true,
    maxImageWidth: 1200,
    resizeImage: true,
     initialPreview: [],
    initialPreviewConfig: [],
			uploadExtraData: function() {
            return {
                serial: ID, dat:today
            };
           }
        });
        
        $('#images1').fileinput('destroy');
		        $("#images1").fileinput({
               'uploadUrl': '../../ws/ws_uploadimage1.php',
          overwriteInitial: false,
        validateInitialCount: true,
			 initialPreviewAsData: true,
    maxImageWidth: 1200,
    resizeImage: true,
     initialPreview: [],
    initialPreviewConfig: [],
			uploadExtraData: function() {
            return {
                serial: ID, dat:today
            };
           }
        });
        UpdateAtt();
document.getElementById("lblalert").style.visibility='hidden';

 if(ID > 0)
	 
	{
		
	document.getElementById("taskattdiv").style.display='';
		bringData(ID);
		getFollowUp(ID);
		getCustomers(ID);
		}
	else{
	
	document.getElementById("taskattdiv").style.display='none';
	}
});
$(document).on('click',"[id^='Ad1']",function(){

				if(ID==0)
					document.getElementById("lblalert2").style.visibility='visible';	
			else
			{
			followup=0;
			$('#myModal2').modal('show');		//window.open("../pages/upload.php?x="+ document.getElementById("attachment").value,"_blank","width=0,height=0");
			}
		

	});
function UpdateAtt()
	{
  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_tmattachments.php",
			  data: ({action:4}),
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
			  { }
			  
		  }); 
		  
		  } 
$(document).on('hidden.bs.modal', '.modal', function () {
    $('.modal:visible').length && $(document.body).addClass('modal-open');
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

$("#imageToUpload1").change(function(){
	
var files = $("#imageToUpload1")[0].files;
var result = "";

for (var i = 0; i < files.length; i++)
{
 result =result +files[i].name;
 if (i<files.length-1){
	 result =result +","; 
 }
}

document.getElementById("formimage1").action="upload1.php?x="+ID+"&y=1";
document.getElementById("formimage1").submit();
image1=result;
	//OpenUserEdit(Id);
});
/////////////////////////////////////////////////////////////////////////////////////////////////////
$("#imageToUpload2").change(function(){
	
var files = $("#imageToUpload2")[0].files;
var result = "";

for (var i = 0; i < files.length; i++)
{
 result =result +files[i].name;
 if (i<files.length-1){
	 result =result +","; 
 }
}

document.getElementById("formimage2").action="upload1.php?x="+ID+"&y=2";
document.getElementById("formimage2").submit();
image2=result;
	//OpenUserEdit(Id);
});	
/////////////////////////////////////////////////////////////////////////////////////////////////////////
$("#imageToUpload3").change(function(){
	
var files = $("#imageToUpload3")[0].files;
var result = "";

for (var i = 0; i < files.length; i++)
{
 result =result +files[i].name;
 if (i<files.length-1){
	 result =result +","; 
 }
}

document.getElementById("formimage3").action="upload1.php?x="+ID+"&y=3";
document.getElementById("formimage3").submit();
image3=result;
	//OpenUserEdit(Id);
});	
/////////////////////////////////////////////////////////////////////////////////////////////////////////
$("#imageToUpload4").change(function(){
	
var files = $("#imageToUpload4")[0].files;
var result = "";

for (var i = 0; i < files.length; i++)
{
 result =result +files[i].name;
 if (i<files.length-1){
	 result =result +","; 
 }
}

document.getElementById("formimage4").action="upload1.php?x="+ID+"&y=4";
document.getElementById("formimage4").submit();
image4=result;

	//OpenUserEdit(Id);
});	
/////////////////////////////////////////////////////////////////////////////////////////////////////////
$("#imageToUpload5").change(function(){
	
var files = $("#imageToUpload5")[0].files;
var result = "";

for (var i = 0; i < files.length; i++)
{
 result =result +files[i].name;
 if (i<files.length-1){
	 result =result +","; 
 }
}

document.getElementById("formimage5").action="upload1.php?x="+ID+"&y=5";
document.getElementById("formimage5").submit();
image5=result;

	//OpenUserEdit(Id);
});	
/////////////////////////////////////////////////////////////////////////////////////////////////////////
$("#imageToUpload6").change(function(){
	
var files = $("#imageToUpload6")[0].files;
var result = "";

for (var i = 0; i < files.length; i++)
{
 result =result +files[i].name;
 if (i<files.length-1){
	 result =result +","; 
 }
}

document.getElementById("formimage6").action="upload1.php?x="+ID+"&y=6";
document.getElementById("formimage6").submit();
image6=result;

	//OpenUserEdit(Id);
});	
/////////////////////////////////////////////////////////////////////////////////////////////////////////
$("#imageToUpload7").change(function(){
	
var files = $("#imageToUpload7")[0].files;
var result = "";

for (var i = 0; i < files.length; i++)
{
 result =result +files[i].name;
 if (i<files.length-1){
	 result =result +","; 
 }
}

document.getElementById("formimage7").action="upload1.php?x="+ID+"&y=7";
document.getElementById("formimage7").submit();
image7=result;

	//OpenUserEdit(Id);
});	
/////////////////////////////////////////////////////////////////////////////////////////////////////////
$("#imageToUpload8").change(function(){
	
var files = $("#imageToUpload8")[0].files;
var result = "";

for (var i = 0; i < files.length; i++)
{
 result =result +files[i].name;
 if (i<files.length-1){
	 result =result +","; 
 }
}

document.getElementById("formimage8").action="upload1.php?x="+ID+"&y=8";
document.getElementById("formimage8").submit();
image8=result;

	//OpenUserEdit(Id);
});
function showImage(src,target) {
  var fr=new FileReader();
  // when image is loaded, set the src of the image where you want to display it
  fr.onload = function(e) { target.src = this.result; };
  src.addEventListener("change",function() {
    // fill fr with image data    
    fr.readAsDataURL(src.files[0]);
  });
}

var src1 = document.getElementById("imageToUpload1");
var target1 = document.getElementById("image1");
showImage(src1,target1);
//============================================================
var src2 = document.getElementById("imageToUpload2");
var target2 = document.getElementById("image2");
showImage(src2,target2);
//============================================================
var src3 = document.getElementById("imageToUpload3");
var target3 = document.getElementById("image3");
showImage(src3,target3);
//============================================================
var src4 = document.getElementById("imageToUpload4");
var target4 = document.getElementById("image4");
showImage(src4,target4);
//============================================================
var src5 = document.getElementById("imageToUpload5");
var target5 = document.getElementById("image5");
showImage(src5,target5);
//============================================================
var src6 = document.getElementById("imageToUpload6");
var target6 = document.getElementById("image6");
showImage(src6,target6);
//============================================================
var src7 = document.getElementById("imageToUpload7");
var target7 = document.getElementById("image7");
showImage(src7,target7);
//============================================================
var src8 = document.getElementById("imageToUpload8");
var target8 = document.getElementById("image8");
showImage(src8,target8);

// ADD User
$(document).on('click',"[id^='Add']",function(){
$("#title").html("Add Maintenance");
			ID=0;
		$('#image1').attr('src','');
			$('#image2').attr('src','');
			$('#image3').attr('src','');
			$('#image4').attr('src','');
			$('#image5').attr('src','');
			$('#image6').attr('src','');
			$('#image7').attr('src','');
			$('#image8').attr('src','');
			$.ajax({
			  type: 'GET',
			  url: "../../ws/ws_tmaintenances.php",
			  data: ({action:4}),
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
				  if(data==0)
					  alert("Data is not inserted");  
				  else
				  {
				  	data = JSON.parse(xhr.responseText);	
				  	ID=data;
				  	
				  	 window.history.replaceState(null, null, "index.php?x="+ID);
				 }			  
			  },
			  error: function(xhr, status, errorThrown) 
			  {
			  }
		  });

	});

	$(document).on('click',"[id^='del_']",function(){	
			//$(this).parent().parent().remove();
	  		strID=$(this).attr('id');			
			ID = strID.substring(4);
			var answer = confirm("Are You Sure You Want To Delete This Maintenance");
    if (answer)
			deleteAttachment(ID);
		
			
	});
		$(document).on('click',"[id^='dell_']",function(){	
			//$(this).parent().parent().remove();
	  		strID=$(this).attr('id');			
			ID = strID.substring(5);
			var answer = confirm("Are You Sure You Want To Delete This Contact");
    if (answer)
			deleteContact(ID);
		
			
	});
	function deleteContact(idval)
	{
		
		//$("#LoadingImage").show();
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_tmcontact.php",
			  data: ({action:2,id :idval}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
				 // $("#LoadingImage").hide();
				
				  if(data==0)
				  	alert("Row not deleted!");
				  	
			bringData2(ID);
			  },
			  error: function(xhr, status, errorThrown) 
			  {
				 
		
				//  alert(status + errorThrown);
			  }
		  });  //	

	}
	function bringData2(serial)
	{
	
	//$("#LoadingImage").show();
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_mcontact.php",
			  data: ({action:2,id:serial}),			  
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
	//Update users
	$(document).on('click',"[id^='Edit_']",function(){
	  		strID=$(this).attr('id');			
			ID = strID.substring(5);
			$("#title").html("Edit Maintenance");
	});
	//-----------------------------------------------------------------------------
	$("#add4").click(function(){

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
document.getElementById("lblalert3").style.visibility='visible';
else{
if(followup==0)	
				{
						
					//window.open("../pages/upload.php?x="+ document.getElementById("attachment").value,"_blank","width=0,height=0");
					addNote(dat,ID,description,today);
						document.getElementById("description1").value="";
		
					
				}
		else{ 
		//	window.open("../pages/upload.php?x="+ attachment,"_blank","width=0,height=0");
		UpdateNote(followup,dat,ID,description,today);
			
			}	
	//	}

}

});	
function addNote(dat,offerid,description,today)
	{		
	
//	alert(attachment+" "+paperid+" "+notes);
		  $.ajax({
			
			  type: 'GET',
			  url: "../../ws/ws_tmfollowup.php",
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
				    
				getFollowUp(offerid);}			  
				
			  },
			  error: function(xhr, status, errorThrown) 
			  {
			//	alert("2");
				//  alert(status + errorThrown);
			  }
		  });  //	

	}
	//========================================================
	function UpdateNote(serial,dat,offerid,description,today)
	{
		
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_tmfollowup.php",
			  data: ({action:3,serial :serial,dat:dat,offerid:offerid,description:description,today:today}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
			
				
				  if(data==0)
				  	alert("No Update!");
				  else	  {
  				  	data = JSON.parse(xhr.responseText);
  				  	
				getFollowUp(offerid);
				$('#myModal2').modal('hide');
				  }
  				  				  				 			  

			  },
			  error: function(xhr, status, errorThrown) 
			  {
			  
				 // $("#LoadingImage").hide();
				//  alert(status + errorThrown);
			  }
			  
		  }); 
		  
		  } 
		  	function getFollowUp(serial)
	{
	
	//$("#LoadingImage").show();
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_getfollowup.php",
			  data: ({action:7,id:serial}),			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			 
			  {
			  
				// $("#LoadingImage").hide();
				  data = JSON.parse(xhr.responseText);	
				  populatefollowup(data);				  
			  },
			  
			  error: function(xhr, status, errorThrown) 
			  {
			  
  				//  $("#LoadingImage").hide();
				// alert(status + errorThrown);
				  
			  }
		  });  	
	}	
	
	function populatefollowup(data)
	{		
	$("#followup").empty();
		count=data.length;
		var item;

		if(count>0)
		{			
			
		   $.each(data, function(index, row) {
				item = "<tr id='tr_"+row.serial+"'>";
                item+=   "<td>"+row.dat+"</td>";
                item+="<td><a  id='Editt_"+row.serial+"'  data-toggle='modal' data-target='#myModal2' ><p class='fa fa-edit'></p> "+row.description+"</a></td>";
               
                item+=   "<td>"+row.userN+"</td>";
                
              //  item+=   "<td>"+row.password+"</td>";
				//item+=   "<td>"+row.admin+"</td>";
              //  item+=   "<td><button type='button' data-toggle= 'modal' data-target='#myModal1' class='btn btn-success del' id='Editt_"+row.serial+"'> Edit</button></td>";
               
              // item+=   "<td><button type='button' class='btn btn-success del' id='dell_"+row.serial+"'> Delete</button></td>";
               item+="<td><a  id='dell1_"+row.serial+"' ><p class='fa fa-trash-o'></p> Delete</a></td>";
                item+= "</tr>";
				$("#followup").append(item);
			});
			
		}
	}
	$(document).on('click',"[id^='dell1_']",function(){	
			//$(this).parent().parent().remove();
	  		strID=$(this).attr('id');			
			followup = strID.substring(6);
			var answer = confirm("Are You Sure You Want To Delete This Follow Up");
    if (answer)
			deleteFollowUp(followup);
		
			
	});
	function deleteFollowUp(idval)
	{
		
		//$("#LoadingImage").show();
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_tmfollowup.php",
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
	if(document.getElementById('frg').checked==true)
	rg = 1;
	else rg=0;
	if(document.getElementById('fgw').checked==true)
	gw = 1;
	else gw=0;
	getDetails1($('#fcity').val(),rg,gw,$('#fcountry').val(),$('#fromdate').val(),$('#todate').val());
	
	$("#search").click(function(){
		country=$('#fcountry').val();
		city=$('#fcity').val();
		if(document.getElementById('frg').checked==true)
	rg = 1;
	else rg=0;
	if(document.getElementById('fgw').checked==true)
	gw = 1;
	else gw=0;
		
		getDetails1(city,rg,gw,country,$('#fromdate').val(),$('$todate').val());
	});
		function getDetails1(city,rg,gw,country,fromdate,todate)
	{
		
	//$("#LoadingImage").show();
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_getdetails.php",
			  data: ({action:3,city:city,rg:rg,gw:gw,country:country,fromdate:fromdate,todate:todate}),			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			 
			  {
		
				// $("#LoadingImage").hide();
				  data = JSON.parse(xhr.responseText);	
				  	$("#tdoffer").html(Math.round(data[0]["OfferValue"]));
			$("#tdmaintenance").html(Math.round(data[0]["Valuee"]));
			

			if(isNaN(data[0]["Valuee"]*100/data[0]["OfferValue"]) || data[0]["OfferValue"]==0 || data[0]["OfferValue"]==null)
			$("#tdperc").html("0%");
			else
			$("#tdperc").html((data[0]["Valuee"]*100/data[0]["OfferValue"]).toFixed(2)+"%");
$("#tdcost").html(Math.round(data[0]["costtotal"]));

if( data[0]["OfferValue"]==0 || data[0]["OfferValue"]==null)
			$("#tdcostperc").html("0%");
			else
			$("#tdcostperc").html((data[0]["costtotal"]*100/data[0]["OfferValue"]).toFixed(2)+"%");
////////////////////////////////////////////////////////////

			
			$("#tdrgoffer").html(Math.round(data[0]["sRGoffer"]));
			


			$("#tdrgmaintenance").html(Math.round(data[0]["sRGmaintenance"]));
			
			if(isNaN(data[0]["sRGmaintenance"]*100/data[0]["sRGoffer"]) || data[0]["sRGoffer"]==0 || data[0]["sRGoffer"]==null)
			$("#tdrgperc").html("0%");
			else
			$("#tdrgperc").html((data[0]["sRGmaintenance"]*100/data[0]["sRGoffer"]).toFixed(2)+"%");

$("#tdrgcost").html(Math.round(data[0]["costrg"]));

if(  data[0]["sRGoffer"]==0 || data[0]["sRGoffer"]==null)
			$("#tdrgcostperc").html("0%");
			else
			$("#tdrgcostperc").html((data[0]["costrg"]*100/data[0]["sRGoffer"]).toFixed(2)+"%");
//////////////////////////////////////////////////

		  
		  $("#tdgwoffer").html(Math.round(data[0]["sGWoffer"]));



			$("#tdgwmaintenance").html(Math.round(data[0]["sGWmaintenance"]));
			if(isNaN(data[0]["sGWmaintenance"]*100/data[0]["sGWoffer"]) || data[0]["sGWoffer"]==0 || data[0]["sGWoffer"]==null)
			$("#tdgwperc").html("0%");
			else
			$("#tdgwperc").html((data[0]["sGWmaintenance"]*100/data[0]["sGWoffer"]).toFixed(2)+"%");


  $("#tdgwcost").html(Math.round(data[0]["costgw"]));

  if(data[0]["sGWoffer"]==0 || data[0]["sGWoffer"]==null)
			$("#tdgwcostperc").html("0%");
			else
			$("#tdgwcostperc").html((data[0]["costgw"]*100/data[0]["sGWoffer"]).toFixed(2)+"%");

////////////////////////////////////////////////////////////

			
			$("#tdcoffer").html(Math.round(data[0]["COfferValue"]));
	 


			$("#tdcmaintenance").html(Math.round(data[0]["CValuee"]));
			if(isNaN(data[0]["CValuee"]*100/data[0]["COfferValue"]) || data[0]["COfferValue"]==0 || data[0]["COfferValue"]==null)
			$("#tdcperc").html("0%");
			else
			$("#tdcperc").html((data[0]["CValuee"]*100/data[0]["COfferValue"]).toFixed(2)+"%");

	$("#tdcancelcost").html(Math.round(data[0]["costc"]));
	if( data[0]["COfferValue"]==0 || data[0]["COfferValue"]==null)
			$("#tdcancelcostperc").html("0%");
			else
			$("#tdcancelcostperc").html((data[0]["costc"]*100/data[0]["COfferValue"]).toFixed(2)+"%");
			//==========================================================================================
			$("#tdrgactiveo").html(Math.round(data[0]["sRGactiveo"]));

			 


			$("#tdrgactivem").html(Math.round(data[0]["sRGactivem"]));
			if(isNaN(data[0]["sRGactivem"]*100/data[0]["sRGactiveo"]) || data[0]["sRGactiveo"]==0 || data[0]["sRGactiveo"]==null)
			$("#tdrgactivep").html("0%");
			else
			$("#tdrgactivep").html((data[0]["sRGactivem"]*100/data[0]["sRGactiveo"]).toFixed(2)+"%");	

$("#tdrgactivecost").html(Math.round(data[0]["costactiverg"]));

if(  data[0]["sRGactiveo"]==0 || data[0]["sRGactiveo"]==null)
			$("#tdrgactivecostperc").html("0%");
			else
			$("#tdrgactivecostperc").html((data[0]["costactiverg"]*100/data[0]["sRGactiveo"]).toFixed(2)+"%");	


			//=============================================================================================
			$("#tdgwactiveo").html(Math.round(data[0]["sGWactiveo"]));



			$("#tdgwactivem").html(Math.round(data[0]["sGWactivem"]));
			if(isNaN(data[0]["sGWactivem"]*100/data[0]["sGWactiveo"]) || data[0]["sGWactiveo"]==0 || data[0]["sGWactiveo"]==null)
			$("#tdgwactivep").html("0%");
			else
			$("#tdgwactivep").html((data[0]["sGWactivem"]*100/data[0]["sGWactiveo"]).toFixed(2)+"%");


		$("#tdgwactivecost").html(Math.round(data[0]["costactivegw"]));


		if( data[0]["sGWactiveo"]==0 || data[0]["sGWactiveo"]==null)
			$("#tdgwactivecostperc").html("0%");
			else
			$("#tdgwactivecostperc").html((data[0]["costactivegw"]*100/data[0]["sGWactiveo"]).toFixed(2)+"%");
			//=============================================================================================
			$("#tdgwfreeo").html(Math.round(data[0]["sGWfreeo"]));
			$("#tdgwfreem").html(Math.round(data[0]["sGWfreem"]));
			if(isNaN(data[0]["sGWfreem"]*100/data[0]["sGWfreeo"]) || data[0]["sGWfreeo"]==0 || data[0]["sGWfreeo"]==null)
			$("#tdgwfreep").html("0%");
			else
			$("#tdgwfreep").html((data[0]["sGWfreem"]*100/data[0]["sGWfreeo"]).toFixed(2)+"%");	


		$("#tdgwfreecost").html(Math.round(data[0]["costfgw"]));


		if( data[0]["sGWfreeo"]==0 || data[0]["sGWfreeo"]==null)
			$("#tdgwfreecostperc").html("0%");
			else
			$("#tdgwfreecostperc").html((data[0]["costfgw"]*100/data[0]["sGWfreeo"]).toFixed(2)+"%");	
				//=============================================================================================
			$("#tdrgfreeo").html(Math.round(data[0]["sRGfreeo"]));
			$("#tdrgfreem").html(Math.round(data[0]["sRGfreem"]));
			if(isNaN(data[0]["sRGfreem"]*100/data[0]["sRGfreeo"]) || data[0]["sRGfreeo"]==0 || data[0]["sRGfreeo"]==null)
			$("#tdrgfreep").html("0%");
			else
			$("#tdrgfreep").html((data[0]["sRGfreem"]*100/data[0]["sRGfreeo"]).toFixed(2)+"%");	


	$("#tdrgfreecost").html(Math.round(data[0]["costfrg"]));

		if(  data[0]["sRGfreeo"]==0 || data[0]["sRGfreeo"]==null)
			$("#tdrgfreecostperc").html("0%");
			else
			$("#tdrgfreecostperc").html((data[0]["costfrg"]*100/data[0]["sRGfreeo"]).toFixed(2)+"%");	

				//=============================================================================================
			$("#tdcrgo").html(Math.round(data[0]["sRGco"]));
			$("#tdcrgm").html(Math.round(data[0]["sRGcm"]));
			if(isNaN(data[0]["sRGcm"]*100/data[0]["sRGco"]) || data[0]["sRGco"]==0 || data[0]["sRGco"]==null)
			$("#tdcrgp").html("0%");
			else
			$("#tdcrgp").html((data[0]["sRGcm"]*100/data[0]["sRGco"]).toFixed(2)+"%");

			$("#tdcrgcost").html(Math.round(data[0]["costcrg"]));		


			if(  data[0]["sRGco"]==0 || data[0]["sRGco"]==null)
			$("#tdcrgcostperc").html("0%");
			else
			$("#tdcrgcostperc").html((data[0]["costcrg"]*100/data[0]["sRGco"]).toFixed(2)+"%");
			//=============================================================================================
			$("#tdcgwo").html(Math.round(data[0]["sGWco"]));
			$("#tdcgwm").html(Math.round(data[0]["sGWcm"]));
			if(isNaN(data[0]["sGWcm"]*100/data[0]["sGWco"]) || data[0]["sGWco"]==0 || data[0]["sGWco"]==null)
			$("#tdcgwp").html("0%");
			else
			$("#tdcgwp").html((data[0]["sGWcm"]*100/data[0]["sGWco"]).toFixed(2)+"%");	  

$("#tdcgwcost").html(Math.round(data[0]["costcgw"]));

if(  data[0]["sGWco"]==0 || data[0]["sGWco"]==null)
			$("#tdcgwcostperc").html("0%");
			else
			$("#tdcgwcostperc").html((data[0]["costcgw"]*100/data[0]["sGWco"]).toFixed(2)+"%");







			  },
			  
			  error: function(xhr, status, errorThrown) 
			  {
			  
  				//  $("#LoadingImage").hide();
				 //alert(status + errorThrown);
				  
			  }
		  });  	
	}

	
	 $("#bd").click(function(e) {
	if(document.getElementById('bd').checked==true)
	$('#bddate').val(formatDate(Date.now()));
	else document.getElementById('bddate').value='';
 });
 
  $("#hprobability").click(function(e) {
	if(document.getElementById('hprobability').checked==true)
	$('#hpdate').val(formatDate(Date.now()));
	else document.getElementById('hpdate').value='';
 });
 
  $("#dealer").click(function(e) {
	if(document.getElementById('dealer').checked==true)
	$('#agentdate').val(formatDate(Date.now()));
	else document.getElementById('agentdate').value='';
 });
	 $('select[id="status"]').change(function () {
 	status=$("#status").val();
$('#statusdate').val(formatDate(Date.now()));

if(status=="COMPLETED")
document.getElementById("hprobability").checked = false;
    });
	$(document).on('click',"[id^='Editt_']",function(){
	  		strID=$(this).attr('id');			
			followup = strID.substring(6);
			
	});
$("#add1").click(function(){


project= $("#project").val();
kickoff= $("#kickoffdate").val();
kickoff=kickoff.replace(/(\d\d)\/(\d\d)\/(\d{4})/, "$3-$1-$2");
expirydate= $("#expirydate").val();
expirydate=expirydate.replace(/(\d\d)\/(\d\d)\/(\d{4})/, "$3-$1-$2");
description= $("#description").val();
value= $("#value").val();
paid= $("#paid").val();
invoiced= $("#invoiced").val();
remaining= $("#remaining").val();
visits= $("#visits").val();
notes= $("#notes").val();
status= $("#mstatus").val();
phours= $("#phours").val();
average= $("#average").val();
if( project=='' )
document.getElementById("lblalert").style.visibility='visible';
else{
if(ID==0)	
				{
						
					//window.open("../pages/upload.php?x="+ document.getElementById("attachment").value,"_blank","width=0,height=0");
					addAttachment(phours,average,invoiced,status,project,expirydate,description,value,paid,remaining,visits,notes,kickoff,image1,image2,image3,image4,image5,image6,image7,image8);
					
					
				}
		else{ 
		//	window.open("../pages/upload.php?x="+ attachment,"_blank","width=0,height=0");
		UpdateAttachment(ID,phours,average,invoiced,status,project,expirydate,description,value,paid,remaining,visits,notes,kickoff,image1,image2,image3,image4,image5,image6,image7,image8);
			
			}	
	//	}
	
}

});
//===================================================================================
$("#add2").click(function(){
projectname= $("#pname").val();
date= $("#date").val();
date=date.replace(/(\d\d)\/(\d\d)\/(\d{4})/, "$3-$1-$2");
duedate= $("#duedate").val();
duedate=duedate.replace(/(\d\d)\/(\d\d)\/(\d{4})/, "$3-$1-$2");
country= $("#country").val();
hpdate= $("#hpdate").val();
hpdate=hpdate.replace(/(\d\d)\/(\d\d)\/(\d{4})/, "$3-$1-$2");

agentdate= $("#agentdate").val();
agentdate=agentdate.replace(/(\d\d)\/(\d\d)\/(\d{4})/, "$3-$1-$2");

bddate= $("#bddate").val();
bddate=bddate.replace(/(\d\d)\/(\d\d)\/(\d{4})/, "$3-$1-$2");

city= $("#city").val();
pe= $("#pe").val();
client= $("#client").val();
clien= $("#clien").val();

consultant= $("#consultant").val();
architect= $("#architect").val();
larchitect= $("#larchitect").val();
contractor= $("#contractor").val();
refferal= $("#refferal").val();
refferaln= $("#refferaln").val();
currency= 0+$("#currency1").val();
maincontractor= $("#maincontractor").val();
maincontractorreferral= 0;
if(document.getElementById('hprobability').checked==true)
	hp = 1;
	else hp=0;
if(document.getElementById('gw').checked==true)
	gw = 1;
	else gw=0;
	if(document.getElementById('int').checked==true)
	intt = 1;
	else intt=0;
	if(document.getElementById('ext').checked==true)
	ext = 1;
	else ext=0;
areaa= $("#area").val();
if(document.getElementById('rg').checked==true)
	rg = 1;
	else rg=0;
rgarea= $("#rgarea").val();
if(document.getElementById('ls').checked==true)
	ls = 1;
	else ls=0;
lsarea= $("#lsarea").val();
buildup= $("#buildup").val();
troom= $("#troom").val();

	if(document.getElementById('tsupport').checked==true)
	tsupport = 1;
	else tsupport=0;
tstartdate= $("#tstartdate").val();
tstartdate=tstartdate.replace(/(\d\d)\/(\d\d)\/(\d{4})/, "$3-$1-$2");
tenddate= $("#tenddate").val();
tenddate=tenddate.replace(/(\d\d)\/(\d\d)\/(\d{4})/, "$3-$1-$2");
	if(document.getElementById('design').checked==true)
	design = 1;
	else design=0;
	dstartdate= $("#dstartdate").val();
denddate= $("#denddate").val();
denddate=denddate.replace(/(\d\d)\/(\d\d)\/(\d{4})/, "$3-$1-$2");
kdate= $("#kdate").val();
kdate=kdate.replace(/(\d\d)\/(\d\d)\/(\d{4})/, "$3-$1-$2");
offerref= $("#offerref").val();
offervalue= $("#offervalue").val();
offerremaining= $("#offerremaining").val();
statusdate= $("#statusdate").val();
statusdate=statusdate.replace(/(\d\d)\/(\d\d)\/(\d{4})/, "$3-$1-$2");
status=$("#status").val();
cancelreason= $("#cancelreason").val();
notes= $("#notes").val();

if(status=="COMPLETED")
{hp=0;}
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
if(document.getElementById('kickoffna').checked==true)
	kickoffna = 1;
	else kickoffna=0;
if(document.getElementById('dealer').checked==true)
	dealer= 1;
	else dealer=0;
if(document.getElementById('bd').checked==true)
	bd = 1;
	else bd=0;
if( projectname=='')
document.getElementById("lblalert").style.visibility='visible';
else{
	
					//window.open("../pages/upload.php?x="+ document.getElementById("attachment").value,"_blank","width=0,height=0");
					addAttachmentt(kickoffna,maincontractor,maincontractorreferral,currency,projectname,date,duedate,country,city,pe,client,clien,consultant,architect,larchitect,contractor,refferal,refferaln,gw,intt,ext,areaa,rg,rgarea,ls,lsarea,buildup,tsupport,tstartdate,tenddate,design,dstartdate,denddate,kdate,offerref,offervalue,offerremaining,cancelreason,notes,today,dealer,bd,troom,status,statusdate,hp,hpdate,bddate,agentdate);			
					
				}
		
	//	}
	

});
//////////////////////////////////////////////////////////

function addAttachmentt(kickoffna,maincontractor,maincontractorreferral,currency,projectname,date,duedate,country,city,pe,client,clien,consultant,architect,larchitect,contractor,refferal,refferaln,gw,intt,ext,areaa,rg,rgarea,ls,lsarea,buildup,tsupport,tstartdate,tenddate,design,dstartdate,denddate,kdate,offerref,offervalue,offerremaining,cancelreason,notes,today,dealer,bd,troom,status,statusdate,hp,hpdate,bddate,agentdate)
	{		
	//alert(inquiry+projectname+date+duedate+country+city+pe+client+clien+consultant+architect+larchitect+contractor+refferal+refferaln+gw+intt+ext+areaa+rg+rgarea+ls+lsarea+buildup+offer+offerdate+hprobability+inhand+tsupport+tstartdate+tenddate+potential+design+dstartdate+denddate+wip+kdate+offerref+offervalue+offerremaining+offersigned+signeddate+offercanceled+canceleddate+cancelreason+notes+completed+completeddate);
//	alert(attachment+" "+paperid+" "+notes);
		  $.ajax({
			
			  type: 'GET',
			  url: "../../ws/ws_tmoffers.php",
			  data: ({action:1,kickoffna:kickoffna,maincontractor:maincontractor,maincontractorreferral:maincontractorreferral,currency:currency,projectname:projectname,date:date,duedate:duedate,country:country,city:city,pe:pe,client:client,clien:clien,consultant:consultant,architect:architect,larchitect:larchitect,contractor:contractor,refferal:refferal,refferaln:refferaln,gw:gw,intt:intt,ext:ext,areaa:areaa,rg:rg,rgarea:rgarea,ls:ls,lsarea:lsarea,buildup:buildup,tsupport:tsupport,tstartdate:tstartdate,tenddate:tenddate,design:design,dstartdate:dstartdate,denddate:denddate,kdate:kdate,offerref:offerref,offervalue:offervalue,offerremaining:offerremaining,cancelreason:cancelreason,notes:notes,today:today,dealer:dealer,bd:bd,troom:troom,status:status,statusdate:statusdate,hprobability:hp,hpdate:hpdate,bddate:bddate,agentdate:agentdate}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
		//alert("asdads"+data);
				  if(data==0)
					  alert("Data is not inserted");  
				  else
				  {
				  	data = JSON.parse(xhr.responseText);	
 project = document.getElementById('project');
 project.options[project.options.length] = new Option(projectname , data);	
document.getElementById("project").value=data; 
 kickoff = document.getElementById('kickoff');
  kickoff.options[project.options.length] = new Option(kdate , data);	
	 document.getElementById("kickoff").value=data;
		document.getElementById("kickoffdate").value=$("#kickoff>option:selected").html();

$('#myModall').modal('hide');
				//alert(data);
				  }				  
				
			  },
			  error: function(xhr, status, errorThrown) 
			  {
			//	alert("2");
				//  alert(status + errorThrown);
			  }
		  });  //	

	}
	////////////////////////////////////////////////////////////////
function UpdateAttachment(serial,phours,average,invoiced,status,project,expirydate,description,value,paid,remaining,visits,notes,kickoff,image1,image2,image3,image4,image5,image6,image7,image8)
	{
		//alert(kickoff);
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_tmaintenances.php",
			  data: ({action:3,serial :serial,phours:phours,average:average,invoiced:invoiced,status:status,project:project,expirydate:expirydate,description:description,value:value,paid:paid,remaining:remaining,visits:visits,notes:notes,kickoff:kickoff,image1:image1,image2:image2,image3:image3,image4:image4,image5:image5,image6:image6,image7:image7,image8:image8}),
			  
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
function addAttachment(phours,average,invoiced,status,project,expirydate,description,value,paid,remaining,visits,notes,kickoff,image1,image2,image3,image4,image5,image6,image7,image8)
	{		
	
//	alert(attachment+" "+paperid+" "+notes);
		  $.ajax({
			
			  type: 'GET',
			  url: "../../ws/ws_tmaintenances.php",
			  data: ({action:1,phours:phours,average:average,invoiced:invoiced,status:status,project:project,expirydate:expirydate,description:description,value:value,paid:paid,remaining:remaining,visits:visits,notes:notes,kickoff:kickoff,image1:image1,image2:image2,image3:image3,image4:image4,image5:image5,image6:image6,image7:image7,image8:image8}),
			  
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
			  url: "../../ws/ws_maintenances.php",
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
			  url: "../../ws/ws_tmaintenances.php",
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
		document.getElementById("project").value=data[0]["offerId"];
		$("#project").val(data[0]["offerId"]).trigger("change");
		 document.getElementById("kickoff").value=$("#project").val();
		 var s =data[0]["kickoff"];
var t =s.split("-");
var t3= (t[2].split(" "))[0];
document.getElementById("kickoffdate").value=t[0]+"-"+t[1]+"-"+ t3;
	//	document.getElementById("kickoffdate").value=$("#kickoff>option:selected").html();
		document.getElementById("description").value=data[0]["Description"];
		 var s =data[0]["ExpDate"];
var t =s.split("-");
var t3= (t[2].split(" "))[0];
document.getElementById("expirydate").value=t[0]+"-"+t[1]+"-"+ t3;
	
		document.getElementById("value").value=data[0]["Valuee"];
		document.getElementById("phours").value=data[0]["phours"];
		document.getElementById("average").value=data[0]["average"];
		document.getElementById("paid").value=data[0]["Paid"];
		document.getElementById("invoiced").value=data[0]["invoiced"];
		document.getElementById("visits").value=data[0]["NumOfVisits"];
		document.getElementById("notes").value=data[0]["Notes"];
		 document.getElementById("remaining").value=(0+$("#invoiced").val()) -(0+$("#paid").val()) ;
		document.getElementById("mstatus").value=data[0]["status"];
		if(data[0]['image1']!='')
			 $('#image1').attr('src','../../att/images/maintenance/'+data[0]['Serial']+'/'+data[0]['image1']);
			 else
			 $('#image1').attr('src','');
			 
			 if(data[0]['image2']!='')
			 $('#image2').attr('src','../../att/images/maintenance/'+data[0]['Serial']+'/'+data[0]['image2']);
			 else
			 $('#image2').attr('src','');
			 
			 if(data[0]['image3']!='')
			 $('#image3').attr('src','../../att/images/maintenance/'+data[0]['Serial']+'/'+data[0]['image3']);
			 else
			 $('#image3').attr('src','');
			 
			 if(data[0]['image4']!='')
			 $('#image4').attr('src','../../att/images/maintenance/'+data[0]['Serial']+'/'+data[0]['image4']);
			 else
			 $('#image4').attr('src','');
			 
			 if(data[0]['image5']!='')
			 $('#image5').attr('src','../../att/images/maintenance/'+data[0]['Serial']+'/'+data[0]['image5']);
			 else
			 $('#image5').attr('src','');
			 
			 if(data[0]['image6']!='')
			 $('#image6').attr('src','../../att/images/maintenance/'+data[0]['Serial']+'/'+data[0]['image6']);
			 else
			 $('#image6').attr('src','');
			 
			  if(data[0]['image7']!='')
			 $('#image7').attr('src','../../att/images/maintenance/'+data[0]['Serial']+'/'+data[0]['image7']);
			 else
			 $('#image7').attr('src','');
			 
			 if(data[0]['image8']!='')
			 $('#image8').attr('src','../../att/images/maintenance/'+data[0]['Serial']+'/'+data[0]['image8']);
			 else
			 $('#image8').attr('src','');
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
//====================WIP================================================================			
			$.ajax({
			  type: 'GET',
			  url: "../../ws/ws_mattachments.php",
			  data: ({id:ID,action:2}),			  
			  dataType: 'json',
			   cache: false,
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			 
			  {
				  				  data = JSON.parse(xhr.responseText);	
		var initialPreview = [];
var initialPreviewConfig = [];
				 for(var i= 0; i < data.length; i++)
{

initialPreview.push('../../att/wip/'+data[i]["description"] );

	type=data[i]['description'].split(/[\s.]+/);
type=type[type.length-1];

switch(type){
	case 'jpg': initialPreviewConfig.push({caption: data[i]["description"], width: "120px", url: "../../ws/ws_deleteimage.php?id=" + data[i]["Serial"] + "&tablename=maintenanceattachement"   , key: data[i]["Serial"],downloadUrl: "../../att/wip/"+data[i]["description"] });
				break;
	case 'png': initialPreviewConfig.push({caption: data[i]["description"], width: "120px", url: "../../ws/ws_deleteimage.php?id=" + data[i]["Serial"] + "&tablename=maintenanceattachement"   , key: data[i]["Serial"],downloadUrl: "../../att/wip/"+data[i]["description"] });
				break;
	case 'gif': initialPreviewConfig.push({caption: data[i]["description"], width: "120px", url: "../../ws/ws_deleteimage.php?id=" + data[i]["Serial"] + "&tablename=maintenanceattachement"   , key: data[i]["Serial"],downloadUrl: "../../att/wip/"+data[i]["description"] });
				break;
	case 'jpeg': initialPreviewConfig.push({caption: data[i]["description"], width: "120px", url: "../../ws/ws_deleteimage.php?id=" + data[i]["Serial"] + "&tablename=maintenanceattachement"   , key: data[i]["Serial"],downloadUrl: "../../att/wip/"+data[i]["description"] });
				break;
	case 'pdf': initialPreviewConfig.push(  {type: "pdf", caption: data[i]["description"], url: "../../ws/ws_deleteimage.php?id=" + data[i]["Serial"] + "&tablename=maintenanceattachement"   , key: data[i]["Serial"],downloadUrl: "../../att/wip/"+data[i]["description"]});
				break;
	case 'mp4': initialPreviewConfig.push(  {   
            type: "video", 
            size: 375000,
            filetype: "video/mp4",
            caption: data[i]["description"], 
            url: "../../ws/ws_deleteimage.php?id=" + data[i]["Serial"] + "&tablename=maintenanceattachement",
            key: 3,
            downloadUrl: "../../att/wip/"+data[i]["description"], // override url
            filename: data[i]["description"] // override download filename
        });
				break;
	case 'MP4': initialPreviewConfig.push(  {   
            type: "video", 
            size: 375000,
            filetype: "video/mp4",
            caption: data[i]["description"], 
            url: "../../ws/ws_deleteimage.php?id=" + data[i]["Serial"] + "&tablename=maintenanceattachement",
            key: 3,
            downloadUrl: "../../att/wip/"+data[i]["description"], // override url
            filename: data[i]["description"] // override download filename
        });
				break;
	default :initialPreviewConfig.push({caption: data[i]["description"], width: "120px", url: "../../ws/ws_deleteimage.php?id=" + data[i]["Serial"] + "&tablename=maintenanceattachement"   , key: data[i]["Serial"],downloadUrl: "../../att/wip/"+data[i]["description"] });
				break;
}}	
				  		if(data.length>0){
				$('#images').fileinput('destroy');
		        $("#images").fileinput({
               'uploadUrl': '../../ws/ws_uploadimage.php',
          overwriteInitial: false,
        validateInitialCount: true,
		 initialPreviewAsData: true,
		 		
    maxImageWidth: 1200,
    resizeImage: true,
            initialPreview: initialPreview,
            initialPreviewConfig: initialPreviewConfig,
			uploadExtraData: function() {
            return {
               serial: ID, dat:today
            };
           }
        });
		}
			  },
			  
			  error: function(xhr, status, errorThrown) 
			  {
				   
			  }
		  }); 

		//====================================REGULAR====================================================
			 
					$.ajax({
			  type: 'GET',
			  url: "../../ws/ws_mattachments.php",
			  data: ({id:ID,action:3}),			  
			  dataType: 'json',
			   cache: false,
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			 
			  {
			  
				  				  data = JSON.parse(xhr.responseText);	
		var initialPreview = [];
var initialPreviewConfig = [];
				 for(var i= 0; i < data.length; i++)
{

initialPreview.push('../../att/regular/'+data[i]["description"] );

	type=data[i]['description'].split(/[\s.]+/);
type=type[type.length-1];

switch(type){
	case 'jpg': initialPreviewConfig.push({caption: data[i]["description"], width: "120px", url: "../../ws/ws_deleteimage.php?id=" + data[i]["Serial"] + "&tablename=maintenanceattachement"   , key: data[i]["Serial"],downloadUrl: "../../att/regular/"+data[i]["description"] });
				break;
	case 'png': initialPreviewConfig.push({caption: data[i]["description"], width: "120px", url: "../../ws/ws_deleteimage.php?id=" + data[i]["Serial"] + "&tablename=maintenanceattachement"   , key: data[i]["Serial"],downloadUrl: "../../att/regular/"+data[i]["description"] });
				break;
	case 'gif': initialPreviewConfig.push({caption: data[i]["description"], width: "120px", url: "../../ws/ws_deleteimage.php?id=" + data[i]["Serial"] + "&tablename=maintenanceattachement"   , key: data[i]["Serial"],downloadUrl: "../../att/regular/"+data[i]["description"] });
				break;
	case 'jpeg': initialPreviewConfig.push({caption: data[i]["description"], width: "120px", url: "../../ws/ws_deleteimage.php?id=" + data[i]["Serial"] + "&tablename=maintenanceattachement"   , key: data[i]["Serial"],downloadUrl: "../../att/regular/"+data[i]["description"] });
				break;
	case 'pdf': initialPreviewConfig.push(  {type: "pdf", caption: data[i]["description"], url: "../../ws/ws_deleteimage.php?id=" + data[i]["Serial"] + "&tablename=maintenanceattachement"   , key: data[i]["Serial"],downloadUrl: "../../att/regular/"+data[i]["description"]});
				break;
	case 'mp4': initialPreviewConfig.push(  {   
            type: "video", 
            size: 375000,
            filetype: "video/mp4",
            caption: data[i]["description"], 
            url: "../../ws/ws_deleteimage.php?id=" + data[i]["Serial"] + "&tablename=maintenanceattachement",
            key: 3,
            downloadUrl: "../../att/regular/"+data[i]["description"], // override url
            filename: data[i]["description"] // override download filename
        });
				break;
	case 'MP4': initialPreviewConfig.push(  {   
            type: "video", 
            size: 375000,
            filetype: "video/mp4",
            caption: data[i]["description"], 
            url: "../../ws/ws_deleteimage.php?id=" + data[i]["Serial"] + "&tablename=maintenanceattachement",
            key: 3,
            downloadUrl: "../../att/regular/"+data[i]["description"], // override url
            filename: data[i]["description"] // override download filename
        });
				break;
	default :initialPreviewConfig.push({caption: data[i]["description"], width: "120px", url: "../../ws/ws_deleteimage.php?id=" + data[i]["Serial"] + "&tablename=maintenanceattachement"   , key: data[i]["Serial"],downloadUrl: "../../att/regular/"+data[i]["description"] });
				break;
}}	
				  		if(data.length>0){
				$('#images1').fileinput('destroy');
		        $("#images1").fileinput({
               'uploadUrl': '../../ws/ws_uploadimage1.php',
          overwriteInitial: false,
        validateInitialCount: true,
		 initialPreviewAsData: true,
		 		
    maxImageWidth: 1200,
    resizeImage: true,
            initialPreview: initialPreview,
            initialPreviewConfig: initialPreviewConfig,
			uploadExtraData: function() {
            return {
               serial: ID, dat:today
            };
           }
        });
		}
			  },
			  
			  error: function(xhr, status, errorThrown) 
			  {
				   
			  }
		  }); 	
			
			
			
			
			
			}
	}
	else
	
		showError(serial);
		}
		 $('select[id="project"]').change(function () {  

		 document.getElementById("kickoff").value=$("#project").val();
	
		document.getElementById("kickoffdate").value=$("#kickoff>option:selected").html();
		 });
	$( "#invoiced" ).keyup(function() {
  document.getElementById("remaining").value=(0+$("#invoiced").val()) -(0+$("#paid").val()) ;
});

	$( "#paid" ).keyup(function() {
  document.getElementById("remaining").value=(0+$("#invoiced").val()) -(0+$("#paid").val()) ;
});

//////////////////////////////////////////////////////////////////////////
$("#myModala").on('hidden.bs.modal', function (e) {
document.getElementById("lblalert").style.visibility='hidden';
document.getElementById("alert1").style.visibility='hidden';
  $(this)
    .find("input,textarea,select")
       .val('')
       .end()
    .find("input[type=checkbox], input[type=radio]")
       .prop("checked", "")
       .end();
       
});

$("#visitmodal").on('hidden.bs.modal', function (e) {
document.getElementById("lblalert").style.visibility='hidden';
document.getElementById("alert1").style.visibility='hidden';
  $(this)
    .find("input,textarea,select")
       .val('')
       .end()
    .find("input[type=checkbox], input[type=radio]")
       .prop("checked", "")
       .end();
       
});



function Updatezoness(serial,dat,offerid,description)
	{
		// alert(serial+" "+dat+" "+offerid+" "+description); 
		
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_tofferfollowup.php",
			  data: ({action:6,serial :serial,dat:dat,offerid:offerid,description:description }),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
			
				 
			 location.reload();
				 		  				 			  

			  },
			  error: function(xhr, status, errorThrown) 
			  {
			  
				 // $("#LoadingImage").hide();
				//  alert(status + errorThrown);
			  }
			  
		  }); 
		  
		  } 
////////////////////////////
function updatevisit(newvisit,eccleanwater,ecfertelizedmix,ph,pesticidesprayed,alarmworking,injector,fertelizedmix)
	{
		  
		
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_tofferfollowup.php",
			  data: ({action:8,serial:newvisit,eccleanwater:eccleanwater,ecfertelizedmix:ecfertelizedmix,ph:ph,pesticidesprayed:pesticidesprayed,alarmworking:alarmworking,injector:injector,fertelizedmix:fertelizedmix  }),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
			
				 
			 location.reload();
				 		  				 			  

			  },
			  error: function(xhr, status, errorThrown) 
			  {
			  
				 // $("#LoadingImage").hide();
				   alert(status + errorThrown);
			  }
			  
		  }); 
		  
		  } 
///////////////////////////
 


$(document).on('click',"[id^='addzones']",function(){

		zoness=0;
			$('#myModala').modal('show');		//window.open("../pages/upload.php?x="+ document.getElementById("attachment").value,"_blank","width=0,height=0");
		 
		

	});

$("#myModala").on('shown.bs.modal', function () {
document.getElementById("alert1").style.visibility='hidden';
$('#dat').val(formatDate(Date.now()));
  
 if(zoness > 0)
	 
	{ 
		$("#title22").html("Edit zones");

		 bringDataa(zoness);
		}
	else
	$("#title22").html("Add zones  ");
		
});




$(document).on('click',"[id^='delll1_']",function(){	
			 
	  		strID=$(this).attr('id');			
			zoness = strID.substring(7);
		
			var answer = confirm("Are You Sure You Want To Delete This   Zone");
    if (answer)
			deletezoness(zoness);
		
			
	});

$(document).on('click',"[id^='dellll1_']",function(){	
			 
	  		strID=$(this).attr('id');			
			newvisit = strID.substring(8);
		
			var answer = confirm("Are You Sure You Want To Delete This visit");
    if (answer)
			deletevisits(newvisit);
		
			
	});



function deletezoness(idval)
	{
		
		//$("#LoadingImage").show();
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_tofferfollowup.php",
			  data: ({action:5,id :idval}),
			  
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
				 
		
				//  alert(status + errorThrown);
			  }
		  });  //	

	}

///////////////////////////////////////////////////////////////
function deletevisits(idval)
	{
		
		//$("#LoadingImage").show();
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_tofferfollowup.php",
			  data: ({action:7,id :idval}),
			  
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
				 
		
				//  alert(status + errorThrown);
			  }
		  });  //	

	}
////////////////////////////////////////////////////////////////

 


$(document).on('click',"[id^='Edittt_']",function(){
	  		strID=$(this).attr('id');			
			zoness = strID.substring(7);

			
	});

$(document).on('click',"[id^='Editttt_']",function(){
	  		strID=$(this).attr('id');			
			newvisit = strID.substring(8);

			
	});


$("#adddd").click(function(){
	
maintenancezone= $("#maintenancezone").val();
dato= $("#dato").val();
descriptiona= $("#descriptiona").val();
 
if( descriptiona=='')
document.getElementById("alert1").style.visibility='visible';


else{
if(zoness==0)	
				{
						 	 
					//window.open("../pages/upload.php?x="+ document.getElementById("attachment").value,"_blank","width=0,height=0");
					addzoness(dato,maintenancezone,descriptiona);
					 
		
					
				}
		else{ 
		//	window.open("../pages/upload.php?x="+ attachment,"_blank","width=0,height=0");
		
		Updatezoness(zoness,dato,maintenancezone,descriptiona);
			
			}	
	//	}

}

});	

 

$("#addddd").click(function(){
 
 workdone= $("#work").val();
 alert(workdone);
 eccleanwater= $("#eccleanwater").val();
ecfertelizedmix= $("#ecfertelizedmix").val();
ph= $("#ph").val();
 

 pesticidesprayed= $("#pesticidesprayed").val();
alarmworking= $("#alarmworking").val();
injector= $("#injector").val();
fertelizedmix=$("#fertelizedmix").val();
 
 updatevisit(newvisit,eccleanwater,ecfertelizedmix,ph,pesticidesprayed,alarmworking,injector,fertelizedmix);

});	




function addzoness(dat,offerid,description)
	{		
	
 	 
		  $.ajax({
			
			  type: 'GET',
			  url: "../../ws/ws_tofferfollowup.php",
			  data: ({action:4,dat:dat,offerid:offerid,description:description }),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
  
  				  	 location.reload();
				 	  
				
			  },
			  error: function(xhr, status, errorThrown) 
			  {
			//	alert("2");
				//  alert(status + errorThrown);
			  }
		  });  //	

	}




 
 


		function bringDataa(serial)
	{
	
	//$("#LoadingImage").show();
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_zoness.php",
			  data: ({action:1,id:serial}),			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			 
			  {
			  
				// $("#LoadingImage").hide();
				  data = JSON.parse(xhr.responseText);	
				  decide1a(data,serial);				  
			  },
			  
			  error: function(xhr, status, errorThrown) 
			  {
			  
  				//  $("#LoadingImage").hide();
				// alert(status + errorThrown);
				  
			  }
		  });  	
	}	

		function decide1a(data,serial)
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
document.getElementById("dato").value=t[0]+"-"+t[1]+"-"+ t3;
		document.getElementById("descriptiona").value=data[0]["description"];
		
	
		
			
			
			
			}
	}
	else
	
		showError(serial);
		}	

});


