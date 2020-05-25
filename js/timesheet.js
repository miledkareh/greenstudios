$(document).ready(function() {

ID=0;
$('#fromdate').val(formatDate(Date.now()));
$('#todate').val(formatDate(Date.now()));

var d = new Date(),        
        h = d.getHours(),
        m = d.getMinutes();
       
    if(h < 10) h = '0' + h; 
    if(m < 10) m = '0' + m; 
    $('#fromtime').val(h+":"+m);
      $('#totime').val(h+":"+m);
//fillSections();
//getUsers();
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
$('#fromdate').val(formatDate(Date.now()));
$('#todate').val(formatDate(Date.now()));
var d = new Date(),        
        h = d.getHours(),
        m = d.getMinutes();
       
    if(h < 10) h = '0' + h; 
    if(m < 10) m = '0' + m; 
    $('#fromtime').val(h+":"+m);
      $('#totime').val(h+":"+m);
 if(ID > 0)
	 
	{
		$("#title").html("Edit Time Sheet");

		bringData(ID);
		}
	else
	$("#title").html("Add Time Sheet");
		
});
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
$("#myModal1").on('shown.bs.modal', function () {
$('#images').fileinput('destroy');
		        $("#images").fileinput({
		        	
		        	
               'uploadUrl': '../../ws/ws_uploadimage10.php',
          overwriteInitial: false,
        validateInitialCount: true,
			 initialPreviewAsData: true,
    maxImageWidth: 1200,
    resizeImage: true,
     initialPreview: [],
    initialPreviewConfig: [],
			uploadExtraData: function() {
            return {
                serial: ID
            };
           }
        });
 if(ID > 0)
		bringAtt(ID);	
});
function bringAtt(serial)
	{
	
	//$("#LoadingImage").show();
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_timesheetattachments.php",
			  data: ({id:serial}),			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			 
			  {
			  
				// $("#LoadingImage").hide();
				  data = JSON.parse(xhr.responseText);	
				  decideAtt(data,serial);				  
			  },
			  
			  error: function(xhr, status, errorThrown) 
			  {
			  
  				//  $("#LoadingImage").hide();
				 alert(status + errorThrown);
				  
			  }
		  });  	
	}
		function decideAtt(data,serial)
	{		

		count=data.length;
	if(count>0)
	{
		if( serial==0)
			alert("user exist");	
		else 
			{		
		
				var initialPreview = [];
var initialPreviewConfig = [];
				 for(var i= 0; i < data.length; i++)
{

initialPreview.push(data[i]["url"] );

	type=data[i]['description'].split(/[\s.]+/);
type=type[type.length-1];

switch(type){
	case 'jpg': initialPreviewConfig.push({caption: data[i]["description"], width: "120px", url: "../../ws/ws_deleteimage.php?id=" + data[i]["serial"] + "&tablename=timesheetattachments"   , key: data[i]["serial"],downloadUrl: data[i]["url"]});
				break;
	case 'png': initialPreviewConfig.push({caption: data[i]["description"], width: "120px", url: "../../ws/ws_deleteimage.php?id=" + data[i]["serial"] + "&tablename=timesheetattachments"   , key: data[i]["serial"],downloadUrl: data[i]["url"] });
				break;
	case 'gif': initialPreviewConfig.push({caption: data[i]["description"], width: "120px", url: "../../ws/ws_deleteimage.php?id=" + data[i]["serial"] + "&tablename=timesheetattachments"   , key: data[i]["serial"],downloadUrl: data[i]["url"] });
				break;
	case 'jpeg': initialPreviewConfig.push({caption: data[i]["description"], width: "120px", url: "../../ws/ws_deleteimage.php?id=" + data[i]["serial"] + "&tablename=timesheetattachments"   , key: data[i]["serial"],downloadUrl: data[i]["url"] });
				break;
	case 'pdf': initialPreviewConfig.push(  {type: "pdf", caption: data[i]["description"], url: "../../ws/ws_deleteimage.php?id=" + data[i]["serial"] + "&tablename=timesheetattachments"   , key: data[i]["serial"],downloadUrl: data[i]["url"]});
				break;
	case 'mp4': initialPreviewConfig.push(  {   
            type: "video", 
            size: 375000,
            filetype: "video/mp4",
            caption: data[i]["description"], 
            url: "../../ws/ws_deleteimage.php?id=" + data[i]["serial"] + "&tablename=timesheetattachments",
            key: 3,
            downloadUrl: data[i]["url"], // override url
            filename: data[i]["description"] // override download filename
        });
				break;
	case 'MP4': initialPreviewConfig.push(  {   
            type: "video", 
            size: 375000,
            filetype: "video/mp4",
            caption: data[i]["description"], 
            url: "../../ws/ws_deleteimage.php?id=" + data[i]["serial"] + "&tablename=timesheetattachments",
            key: 3,
            downloadUrl: data[i]["url"], // override url
            filename: data[i]["description"] // override download filename
        });
				break;
	default :initialPreviewConfig.push({caption: data[i]["description"], width: "120px", url: "ws/ws_deleteimage.php?id=" + data[i]["serial"] + "&tablename=timesheetattachments"   , key: data[i]["serial"],downloadUrl: data[i]["url"]});
				break;
}}	
				  		if(data.length>0){
				$('#images').fileinput('destroy');
		        $("#images").fileinput({
		        	
               'uploadUrl': '../../ws/ws_uploadimage10.php',
          overwriteInitial: false,
        validateInitialCount: true,
		 initialPreviewAsData: true,
		 		
    maxImageWidth: 1200,
    resizeImage: true,
            initialPreview: initialPreview,
            initialPreviewConfig: initialPreviewConfig,
			uploadExtraData: function() {
            return {
               serial: ID
            };
           }
        });
		}

			}
	}
	else
	
		showError(serial);
		}
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
		

	});

	$(document).on('click',"[id^='del_']",function(){	
			//$(this).parent().parent().remove();
	  		strID=$(this).attr('id');			
			ID = strID.substring(4);
			var answer = confirm("Are You Sure You Want To Delete This Department");
    if (answer)
			deleteAttachment(ID);
		
			
	});
	
	//Update users
	$(document).on('click',"[id^='Edit_']",function(){
	  		strID=$(this).attr('id');			
			ID = strID.substring(5);
			employee=0;
description= $("#description_"+ID).val();
fromdate= $("#fromdate_"+ID).val();
todate= $("#todate_"+ID).val();
fromtime= $("#fromtime_"+ID).val();
totime= $("#totime_"+ID).val();
project= 0+$("#project_"+ID).val();
UpdateAttachment(ID,description,fromdate,fromtime,todate,totime,employee,project);
	});
	$(document).on('click',"[id^='Att_']",function(){
	  		strID=$(this).attr('id');			
			ID = strID.substring(4);
	});
	$(document).on('click',"[id^='tdproject_']",function(){
	  		strID=$(this).attr('id');			
			ID = strID.substring(10);
			//$("#tdproject_"+ID).hide();
			//$("#tdproject1_"+ID).show();
	bringData1(ID);
	
		//documentq.getElementById("tdproject1_"+ID).style.display='initial';
	});
	$(document).on('click',"[id^='tdfromdate_']",function(){
	  		strID=$(this).attr('id');			
			ID = strID.substring(11);
			//$("#tdproject_"+ID).hide();
			//$("#tdproject1_"+ID).show();
	bringData1(ID);
	});
	
	$(document).on('click',"[id^='tddescription_']",function(){
	  		strID=$(this).attr('id');			
			ID = strID.substring(14);
			//$("#tdproject_"+ID).hide();
			//$("#tdproject1_"+ID).show();
	bringData1(ID);
	
		//documentq.getElementById("tdproject1_"+ID).style.display='initial';
	});
	$(document).on('click',"[id^='tdtodate_']",function(){
	  		strID=$(this).attr('id');			
			ID = strID.substring(9);
			//$("#tdproject_"+ID).hide();
			//$("#tdproject1_"+ID).show();
	bringData1(ID);
	
		//documentq.getElementById("tdproject1_"+ID).style.display='initial';
	});
	//-----------------------------------------------------------------------------

$("#add1").click(function(){
employee= 0+$("#employee").val();
description= $("#description").val();
fromdate= $("#fromdate").val();
todate= $("#todate").val();
fromtime= $("#fromtime").val();
totime= $("#totime").val();
project= 0+$("#project").val();
if( description=='')
document.getElementById("lblalert").style.visibility='visible';
else{
if(ID==0)	
				{
						
					//window.open("../pages/upload.php?x="+ document.getElementById("attachment").value,"_blank","width=0,height=0");
					addAttachment(description,fromdate,fromtime,todate,totime,employee,project);
					
					
				}
		else{ 
		//	window.open("../pages/upload.php?x="+ attachment,"_blank","width=0,height=0");
		UpdateAttachment(ID,description,fromdate,fromtime,todate,totime,employee,project);
			
			}	
	//	}
	
}

});
//===================================================================================

function UpdateAttachment(serial,description,fromdate,fromtime,todate,totime,employee,project)
	{
		
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_ttimesheet.php",
			  data: ({action:3,serial :serial,project:project,description:description,fromdate:fromdate,fromtime:fromtime,todate:todate,totime:totime,employee:employee}),
			  
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
function addAttachment(description,fromdate,fromtime,todate,totime,employee,project)
	{		
	
//	alert(attachment+" "+paperid+" "+notes);
		  $.ajax({
			
			  type: 'GET',
			  url: "../../ws/ws_ttimesheet.php",
			  data: ({action:1,project:project,description:description,fromdate:fromdate,fromtime:fromtime,todate:todate,totime:totime,employee:employee}),
			  
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
	
		function bringData1(serial)
	{
	
	//$("#LoadingImage").show();
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_timesheet.php",
			  data: ({id:serial}),			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			 
			  {
			  
				// $("#LoadingImage").hide();
				  data = JSON.parse(xhr.responseText);	
						document.getElementById("tdproject_"+ID).style.display='none';
						document.getElementById("tdfromdate_"+ID).style.display='none';
						document.getElementById("tdtodate_"+ID).style.display='none';
						document.getElementById("tddescription_"+ID).style.display='none';
					
	$('#tdproject1_'+ID).css('display', '');
	
	$('#tdfromdate1_'+ID).css('display', '');
	$('#tdtodate1_'+ID).css('display', '');
	$('#tddescription1_'+ID).css('display', '');
			 var s =data[0]["fromdate"];
var t =s.split("-");
var t3= (t[2].split(" "))[0];
document.getElementById("fromdate_"+ID).value=t[0]+"-"+t[1]+"-"+ t3;
document.getElementById("fromtime_"+ID).value = (t[2].split(" "))[1];
 var s =data[0]["todate"];
var t =s.split("-");
var t3= (t[2].split(" "))[0];
document.getElementById("todate_"+ID).value=t[0]+"-"+t[1]+"-"+ t3;
		
		document.getElementById("totime_"+ID).value = (t[2].split(" "))[1];
		document.getElementById("project_"+ID).value = data[0]['project'];
		document.getElementById("description_"+ID).value = data[0]['description'];
			  },
			  
			  error: function(xhr, status, errorThrown) 
			  {
			  
  				//  $("#LoadingImage").hide();
				 alert(status + errorThrown);
				  
			  }
		  });  	
	}
	
	
	function bringData(serial)
	{
	
	//$("#LoadingImage").show();
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_timesheet.php",
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
			  url: "../../ws/ws_ttimesheet.php",
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
			document.getElementById("description").value=data[0]["description"];
		
				var s =data[0]["fromdate"];
var t =s.split("-");
var t3= (t[2].split(" "))[0];
document.getElementById("fromdate").value=t[0]+"-"+t[1]+"-"+ t3;
		document.getElementById("fromtime").value = (t[2].split(" "))[1];
			s =data[0]["todate"];
 t =s.split("-");
 t3= (t[2].split(" "))[0];
document.getElementById("todate").value=t[0]+"-"+t[1]+"-"+ t3;
		document.getElementById("totime").value = (t[2].split(" "))[1];
			document.getElementById("employee").value=data[0]["employee"];
			document.getElementById("project").value=data[0]["project"];
			
			}
	}
	else
	
		showError(serial);
		}
	

});

