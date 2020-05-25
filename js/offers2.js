$(document).ready(function() {
	ID=0;
		$('body').on('hidden.bs.modal', function () {
    if($('.modal.in').length > 0)
    {
        $('body').addClass('modal-open');
    }
});

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

//deleteImages(0,'offerattachment');

function deleteImages(idval,page)
	{
		
		//$("#LoadingImage").show();
			$('#images').fileinput('destroy');
		        $("#images").fileinput({
		        	
               'uploadUrl': '../../ws/ws_uploadimage2.php',
                 theme: "explorer-fa",
		 		mainClass: "input-group-lg",
          overwriteInitial: false,
        validateInitialCount: true,
			 initialPreviewAsData: true,
		
            initialPreview: [
            ],
            initialPreviewConfig: [
                  ],
			uploadExtraData: function() {
            return {
                page: 'offerattachment',serial: ID
            };
           }
        });
			$('#images1').fileinput('destroy');
		        $("#images1").fileinput({
		        	
		        	
               'uploadUrl': '../../ws/ws_uploadimage3.php',
                 theme: "explorer-fa",
		 		mainClass: "input-group-lg",
          overwriteInitial: false,
        validateInitialCount: true,
			 initialPreviewAsData: true,
			
            initialPreview: [
            ],
            initialPreviewConfig: [
                  ],
			uploadExtraData: function() {
            return {
                page: 'offerattachment',serial: ID
            };
           }
        });
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_deleteimages.php",
			  data: ({action:2,table:page}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
				  if(ID==0){
				  		$.ajax({
			  type: 'GET',
			  url: "../../ws/ws_tproducts.php",
			  data: ({action:4}),
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {

				  data = JSON.parse(xhr.responseText);	
			ID=data;
			
						  
				
			  },
			  error: function(xhr, status, errorThrown) 
			  {
		
			  }
		  });  //
				  }
			  },
			  error: function(xhr, status, errorThrown) 
			  {
				 
			
				//  alert(status + errorThrown);
			  }
		  });  //	

	}
clientid="";
clientID=0;
clientSerial=0;
	var image1="";
	var image2="";
	var image3="";
	var image4="";
	var image5="";
	var image6="";
	var image7="";
	var image8="";
	var image9="";
	var image10="";
	var image11="";
	var image12="";
	duplicate=0;
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
$("#fileToUpload1").change(function(){
	
var files = $("#fileToUpload1")[0].files;
var result = "";

for (var i = 0; i < files.length; i++)
{
 result =result +files[i].name;
 if (i<files.length-1){
 	
	 result =result +","; 
 }
}
document.getElementById("attachment13").value= result;
	
	//OpenUserEdit(Id);
});	
//////////////////////////////////////////////////////////////////////////////////////////////////////////
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
//=====================================================================================================
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
//======================================================================================================
$(document).on('click',"[id^='Ad1']",function(){

				if(ID==0)
					document.getElementById("lblalert2").style.visibility='visible';	
			else
			{
			followup=0;
			$('#myModal2').modal('show');		//window.open("../pages/upload.php?x="+ document.getElementById("attachment").value,"_blank","width=0,height=0");
			}
		

	});
	//===================================================================================================
	$(document).on('click',"[id^='Ad2']",function(){
				
				if($("#client").val()!=0)
				bringClientData($("#client").val());
				clientid="Owner";

	});
	//=======================================================================================
	$(document).on('click',"[id^='Ad3']",function(){
				if($("#clien").val()!=0)
				bringClientData($("#clien").val());
				clientid="Rep";

	});
	//==========================================================================================
		$(document).on('click',"[id^='Ad4']",function(){
				if($("#consultant").val()!=0)
				bringClientData($("#consultant").val());
				clientid="Consultant";

	});
	//============================================================================================
		$(document).on('click',"[id^='Ad5']",function(){
if($("#architect").val()!=0)
				bringClientData($("#architect").val());
				clientid="Architect";

	});
	//============================================================================================
		$(document).on('click',"[id^='Ad6']",function(){
if($("#larchitect").val()!=0)
				bringClientData($("#larchitect").val());
				clientid="Larchitect";

	});
	//============================================================================================
		$(document).on('click',"[id^='Ad7']",function(){
if($("#contractor").val()!=0)
				bringClientData($("#contractor").val());
				clientid="Contractor";

	});
	//============================================================================================
		$(document).on('click',"[id^='Ad8']",function(){
if($("#refferal").val()!=0)
				bringClientData($("#refferal").val());
				clientid="Refferal";

	});
	//============================================================================================
		$(document).on('click',"[id^='Ad9']",function(){
if($("#maincontractor").val()!=0)
				bringClientData($("#maincontractor").val());
				clientid="MainContractor";

	});
	//============================================================================================
		$(document).on('click',"[id^='Ad10']",function(){
if($("#maincontractorreferral").val()!=0)
				bringClientData($("#maincontractorreferral").val());
				clientid="MainContractorReferral";

	});
	//=========================================================================================
	function bringClientData(serial)
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
				  decideClient(data,serial);				  
			  },
			  
			  error: function(xhr, status, errorThrown) 
			  {
			  
  				//  $("#LoadingImage").hide();
				 alert(status + errorThrown);
				  
			  }
		  });  	
	}
	function decideClient(data,serial)
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
		document.getElementById("ccountry").value=data[0]["country"];
		document.getElementById("ccity").value=data[0]["city"];
		document.getElementById("tel").value=data[0]["Telephone"];
		document.getElementById("fax").value=data[0]["fax"];
		document.getElementById("fname").value=data[0]["fname"];
		document.getElementById("lname").value=data[0]["lname"];
		document.getElementById("titlee").value=data[0]["activity"];
		document.getElementById("email").value=data[0]["email"];
		document.getElementById("mobile").value=data[0]["Mobile"];
		document.getElementById("cnotes").value=data[0]["notes"];
		document.getElementById("ccategory").value=data[0]["ccategory"];
			document.getElementById("referral").value=data[0]["referral"];
			
			
			}
	}
	else
	
		showError(serial);
		}
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
//==============================================================================================================
$('select[id="client"]').change(function () {
 	if($("#client").val()!=0)
 	$("#Ad2").html("Edit");
 	else
 	$("#Ad2").html("Add");
 	clientID=$("#client").val();
    });
 //==============================================================================================================
$('select[id="clien"]').change(function () {
 	if($("#clien").val()!=0)
 	$("#Ad3").html("Edit");
 	else
 	$("#Ad3").html("Add");
 	clientID=$("#clien").val();
    });   
     //==============================================================================================================
$('select[id="consultant"]').change(function () {
 	if($("#consultant").val()!=0)
 	$("#Ad4").html("Edit");
 	else
 	$("#Ad4").html("Add");
 	clientID=$("#consultant").val();
    }); 
     //==============================================================================================================
$('select[id="architect"]').change(function () {
 	if($("#architect").val()!=0)
 	$("#Ad5").html("Edit");
 	else
 	$("#Ad5").html("Add");
 	clientID=$("#architect").val();
    });
        //==============================================================================================================
$('select[id="larchitect"]').change(function () {
 	if($("#larchitect").val()!=0)
 	$("#Ad6").html("Edit");
 	else
 	$("#Ad6").html("Add");
 	clientID=$("#larchitect").val();
    });  
       //==============================================================================================================
$('select[id="contractor"]').change(function () {
 	if($("#contractor").val()!=0)
 	$("#Ad7").html("Edit");
 	else
 	$("#Ad7").html("Add");
 	clientID=$("#contractor").val();
    });   
        //==============================================================================================================
$('select[id="refferal"]').change(function () {
 	if($("#refferal").val()!=0)
 	$("#Ad8").html("Edit");
 	else
 	$("#Ad8").html("Add");
 	clientID=$("#refferal").val();
    }); 
      //==============================================================================================================
$('select[id="maincontractor"]').change(function () {
 	if($("#maincontractor").val()!=0)
 	$("#Ad9").html("Edit");
 	else
 	$("#Ad9").html("Add");
 	clientID=$("#maincontractor").val();
    });   
      //==============================================================================================================
$('select[id="maincontractorreferral"]').change(function () {
 	if($("#maincontractorreferral").val()!=0)
 	$("#Ad10").html("Edit");
 	else
 	$("#Ad10").html("Add");
 	clientID=$("#maincontractorreferral").val();
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
/////////////////////////////////////////////////////////////////////////////////////////////////////////
$("#imageToUpload9").change(function(){
	
var files = $("#imageToUpload9")[0].files;
var result = "";

for (var i = 0; i < files.length; i++)
{
 result =result +files[i].name;
 if (i<files.length-1){
	 result =result +","; 
 }
}

document.getElementById("formimage9").action="upload1.php?x="+ID+"&y=9";
document.getElementById("formimage9").submit();
image9=result;

	//OpenUserEdit(Id);
});	
/////////////////////////////////////////////////////////////////////////////////////////////////////////
$("#imageToUpload10").change(function(){
	
var files = $("#imageToUpload10")[0].files;
var result = "";

for (var i = 0; i < files.length; i++)
{
 result =result +files[i].name;
 if (i<files.length-1){
	 result =result +","; 
 }
}

document.getElementById("formimage10").action="upload1.php?x="+ID+"&y=10";
document.getElementById("formimage10").submit();
image10=result;

	//OpenUserEdit(Id);
});	
/////////////////////////////////////////////////////////////////////////////////////////////////////////
$("#imageToUpload11").change(function(){
	
var files = $("#imageToUpload11")[0].files;
var result = "";

for (var i = 0; i < files.length; i++)
{
 result =result +files[i].name;
 if (i<files.length-1){
	 result =result +","; 
 }
}

document.getElementById("formimage11").action="upload1.php?x="+ID+"&y=11";
document.getElementById("formimage11").submit();
image11=result;

	//OpenUserEdit(Id);
});	
/////////////////////////////////////////////////////////////////////////////////////////////////////////
$("#imageToUpload12").change(function(){
	
var files = $("#imageToUpload12")[0].files;
var result = "";

for (var i = 0; i < files.length; i++)
{
 result =result +files[i].name;
 if (i<files.length-1){
	 result =result +","; 
 }
}
document.getElementById("formimage12").action="upload1.php?x="+ID+"&y=12";
document.getElementById("formimage12").submit();
image12=result;

	//OpenUserEdit(Id);
});	
/////////////////////////////////////////////////////////////////////////////////////////////////////////
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
//============================================================
var src9 = document.getElementById("imageToUpload9");
var target9 = document.getElementById("image9");
showImage(src9,target9);
//============================================================
var src10 = document.getElementById("imageToUpload10");
var target10 = document.getElementById("image10");
showImage(src10,target10);
//============================================================
var src11 = document.getElementById("imageToUpload11");
var target11 = document.getElementById("image11");
showImage(src11,target11);
//============================================================
var src12 = document.getElementById("imageToUpload12");
var target12 = document.getElementById("image12");
showImage(src12,target12);
//=========================================================================================================
$("#fileToUpload").change(function(){
	
var files = $("#fileToUpload")[0].files;
var result = "";

for (var i = 0; i < files.length; i++)
{
 result =result +files[i].name;
 if (i<files.length-1){
 	
	 result =result +","; 
 }
}
document.getElementById("attachment12").value= result;
	
	//OpenUserEdit(Id);
});

 $('select[id="status"]').change(function () {
 	status=$("#status").val();
$('#statusdate').val(formatDate(Date.now()));

if(status=="COMPLETED")
document.getElementById("hprobability").checked = false;
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
function UpdateAtt()
	{
		
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_tattachments.php",
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
			  {
			  //	alert("2");
				 // $("#LoadingImage").hide();
				//  alert(status + errorThrown);
			  }
			  
		  }); 
		  
		  } 
$("#myModal").on('shown.bs.modal', function () {
	
	UpdateAtt();
document.getElementById("lblalert").style.visibility='hidden';
document.getElementById("lblalert1").style.visibility='hidden';
document.getElementById("lblalert2").style.visibility='hidden';
$('#date').val(formatDate(Date.now()));
$('#duedate').val(formatDate(Date.now()));
$('#statusdate').val(formatDate(Date.now()));
$('#tstartdate').val(formatDate(Date.now()));
$('#tenddate').val(formatDate(Date.now()));
$('#dstartdate').val(formatDate(Date.now()));
$('#denddate').val(formatDate(Date.now()));
$('#kdate').val(formatDate(Date.now()));

$("#btnsearch").val("Select Attachment");
$("#btnsearch1").val("Select Attachment");
$("#save").val("Save");
$("#sav1").val("Save");

 if(ID > 0)
	 
	{
		

		bringData(ID);
		bringData2(ID);
		
		//getAttachment(ID);
		//getAttachment1(ID);
		}
	else{
	
	
	}
		
});
$("#myModal3").on('shown.bs.modal', function () {

		$("#ctitle").html("Add Client");
	
});
$(document).on('click',"[id^='del1_']",function(){	
			//$(this).parent().parent().remove();
			
	  		strID=$(this).attr('id');			
			attachmentid = strID.substring(5);
			
			var answer = confirm("Are You Sure You Want To Delete This Attachment");
    if (answer)
			deleteAttachment2(attachmentid);
		
			
	});
$(document).on('click',"[id^='dell_']",function(){	
			//$(this).parent().parent().remove();
			
	  		strID=$(this).attr('id');			
			attachmentid = strID.substring(5);
			
			var answer = confirm("Are You Sure You Want To Delete This Attachment");
    if (answer)
			deleteAttachment1(attachmentid);
		
			
	});
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
			  url: "../../ws/ws_tofferfollowup.php",
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
	function deleteAttachment2(idval)
	{
		
		//$("#LoadingImage").show();
		 
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_tattachments.php",
			  data: ({action:2,id :idval}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
				 // $("#LoadingImage").hide();
				
				  if(data==0)
				  	alert("Row not deleted!");
			getAttachment1(ID);
			  },
			  error: function(xhr, status, errorThrown) 
			  {
				 
			getAttachment1(ID);
				//  alert(status + errorThrown);
			  }
		  });  //	

	}
		function bringData2(serial)
	{
	
	//$("#LoadingImage").show();
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_getfollowup.php",
			  data: ({action:2,id:serial}),			  
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
  				// populate(data);
				// alert(status + errorThrown);
				  
			  }
		  });  	
	}
function deleteAttachment1(idval)
	{
		
		//$("#LoadingImage").show();
		 
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_tattachments.php",
			  data: ({action:2,id :idval}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
				 // $("#LoadingImage").hide();
				
				  if(data==0)
				  	alert("Row not deleted!");
			getAttachment(ID);
			  },
			  error: function(xhr, status, errorThrown) 
			  {
				 
			getAttachment(ID);
				//  alert(status + errorThrown);
			  }
		  });  //	

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

 $("#btnExport").click(function(e) {
	 window.open('./excel.php?fromdate=' + $("#fromdate").val()+'&todate='+$("#todate").val(),'_blank');
 });
$("#myModal").on('hidden.bs.modal', function (e) {
document.getElementById("lblalert").style.visibility='hidden';
document.getElementById("lblalert1").style.visibility='hidden';
  $(this)
    .find("input,textarea,select")
       .val('')
       .end()
    .find("input[type=checkbox], input[type=radio]")
       .prop("checked", "")
       .end();
        $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_toffers.php",
			  data: ({action:5}),
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {	  },
			  error: function(xhr, status, errorThrown) 
			  { }
		  });
       
});
$("#myModal2").on('hidden.bs.modal', function (e) {
document.getElementById("lblalert").style.visibility='hidden';
document.getElementById("lblalert1").style.visibility='hidden';
  $(this)
    .find("input,textarea,select")
       .val('')
       .end()
    .find("input[type=checkbox], input[type=radio]")
       .prop("checked", "")
       .end();
       
});
$("#myModal3").on('hidden.bs.modal', function (e) {
document.getElementById("clblalert").style.visibility='hidden';

  $(this)
    .find("input,textarea,select")
       .val('')
       .end()
    .find("input[type=checkbox], input[type=radio]")
       .prop("checked", "")
       .end();
       
});

// ADD User
$(document).on('click',"[id^='Add']",function(){
$("#title").html("Add Project");
			ID=0;
			$('#image1').attr('src','');
			$('#image2').attr('src','');
			$('#image3').attr('src','');
			$('#image4').attr('src','');
			$('#image5').attr('src','');
			$('#image6').attr('src','');
			$('#image7').attr('src','');
			$('#image8').attr('src','');
			$('#image9').attr('src','');
			$('#image10').attr('src','');
			$('#image11').attr('src','');
			$('#image12').attr('src','');
			$("#tableattachment").empty();
			$('#status').val('INQUIRIES');
			 $.ajax({
			
			  type: 'GET',
			  url: "../../ws/ws_toffers.php",
			  data: ({action:4}),
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
				  	ID=data;
				  $('#images').fileinput('destroy');
		        $("#images").fileinput({
		        	
		        	
               'uploadUrl': '../../ws/ws_uploadimage2.php',
                 theme: "explorer-fa",
		 		mainClass: "input-group-lg",
          overwriteInitial: false,
        validateInitialCount: true,
			 initialPreviewAsData: true,
   
     initialPreview: [],
    initialPreviewConfig: [],
			uploadExtraData: function() {
            return {
                serial: ID
            };
           }
        });
        
        $('#images1').fileinput('destroy');
		        $("#images1").fileinput({
		        	
		        	
               'uploadUrl': '../../ws/ws_uploadimage3.php',
                 theme: "explorer-fa",
		 		mainClass: "input-group-lg",
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
				  	 window.history.replaceState(null, null, "index.php?x="+ID);
				 }			  
			  },
			  error: function(xhr, status, errorThrown) 
			  {
			//	alert("2");
		
				//  alert(status + errorThrown);
			  }
		  });
		 

	});

	$(document).on('click',"[id^='del_']",function(){	
			//$(this).parent().parent().remove();
	  		strID=$(this).attr('id');			
			ID = strID.substring(4);
			var answer = confirm("Are You Sure You Want To Delete This Offer");
    if (answer)
			deleteAttachment(ID);
		
			
	});
	
	//Update users
	$(document).on('click',"[id^='Edit_']",function(){
		$("#title").html("Edit Project");
	  		strID=$(this).attr('id');			
			ID = strID.substring(5);
			duplicate=0;
			 document.getElementById('att1').style.visibility = 'visible';
			 document.getElementById('ref').style.visibility = 'visible';
			 document.getElementById('save').style.visibility = 'visible';
			 document.getElementById('sav1').style.visibility = 'visible';
			 window.history.replaceState(null, null, "index.php?x="+ID);
			 
	});
	
		$(document).on('click',"[id^='Dup_']",function(){
	  		strID=$(this).attr('id');			
			ID = strID.substring(4);
			duplicate=1;
			 document.getElementById('att1').style.visibility = 'hidden';
			 document.getElementById('ref').style.visibility = 'hidden';
			 document.getElementById('save').style.visibility = 'hidden';
			 document.getElementById('sav1').style.visibility = 'hidden';
			 window.history.replaceState(null, null, "index.php?x="+ID);
	});
	
		$(document).on('click',"[id^='Img_']",function(){
	  		strID=$(this).attr('id');			
			path = strID.substring(4);
			// document.getElementById('att1').style.visibility = 'visible';
	
			document.getElementById("oimage").src="../../att/"+path;
	});
	//==============================================================================
	$(document).on('click',"[id^='Editt_']",function(){
	  		strID=$(this).attr('id');			
			followup = strID.substring(6);
			
	});
	//-----------------------------------------------------------------------------
	$("#att1").click(function(){
		 window.open('./attachments.php?x=' + ID, '_blank');
	});
	
	$("#ref").click(function(){
		 window.open('./refferalnotes.php?x=' + ID, '_blank');
	});
	/////////////////////////////////////////////////////
	$("#save").click(function(){

attachment=$("#attachment12").val();
offerid = ID;
status="wip";
if(attachment=='')
document.getElementById("lblalert1").style.visibility='visible';
else{
if(ID!=0)	
				{
						

					addAttachment1(attachment,0,offerid,0,0,status);
				//	location.reload();
					
				}
	//	}
	
}

});
///////////////////////////////////////////////////////////////////
	$("#sav1").click(function(){

attachment=$("#attachment13").val();
offerid = ID;
status="regular";
if(attachment=='')
document.getElementById("lblalert1").style.visibility='visible';
else{
if(ID!=0)	
				{
						

					addAttachment3(attachment,0,offerid,0,0,status);
				//	location.reload();
					
				}
	//	}
	
}

});
$("#add5").click(function(){


company= $("#company").val();
specialty= $("#specialty").val();
website= $("#website").val();
country= $("#ccountry").val();
city= $("#ccity").val();
tel= $("#tel").val();
fax= $("#fax").val();
fname= $("#fname").val();
lname= $("#lname").val();
title= $("#titlee").val();
email= $("#email").val();
mobile= $("#mobile").val();
notes= $("#cnotes").val();
referred= $("#referral").val();
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
if( company=='' || specialty=='')
document.getElementById("clblalert").style.visibility='visible';
else{

	if(clientID==0)					
					//window.open("../pages/upload.php?x="+ document.getElementById("attachment").value,"_blank","width=0,height=0");
				
					addClient(referred,category,company,specialty,website,country,city,tel,fax,fname,lname,title,email,mobile,notes,today);
				else
				UpdateClient(clientID,referred,category,company,specialty,website,country,city,tel,fax,fname,lname,title,email,mobile,notes,today);	
	//	}
	
}

});
function UpdateClient(serial,referred,category,company,specialty,website,country,city,tel,fax,fname,lname,title,email,mobile,notes,today)
	{
		
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_tclients.php",
			  data: ({action:3,serial :serial,referred:referred,category:category,company:company,specialty:specialty,website:website,country:country,city:city,tel:tel,fax:fax,fname:fname,lname:lname,title:title,email:email,mobile:mobile,notes:notes,today:today}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
			
				
				  if(data==0)
				  	alert("No Update!");
				 	  else	  {
  				  	data = JSON.parse(xhr.responseText);	
					$('#myModal3').modal('hide');}			  				 			  

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
function addClient(referred,category,company,specialty,website,country,city,tel,fax,fname,lname,title,email,mobile,notes,today)
	{		

//	alert(attachment+" "+paperid+" "+notes);
		  $.ajax({
			
			  type: 'GET',
			  url: "../../ws/ws_tclients.php",
			  data: ({action:1,referred:referred,category:category,company:company,specialty:specialty,website:website,country:country,city:city,tel:tel,fax:fax,fname:fname,lname:lname,title:title,email:email,mobile:mobile,notes:notes,today:today}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
	//	alert("1");

				  if(data==0)
					  alert("Data is not inserted");  
				 	  else	  {
  				  	data = JSON.parse(xhr.responseText);
  				  	clientSerial=data;
  				  	fillClients(clientSerial);
  				  	
				$('#myModal3').modal('hide');
				 }		  
				
			  },
			  error: function(xhr, status, errorThrown) 
			  {
			//	alert("2");
				//  alert(status + errorThrown);
			  }
		  });  //	

	}
//=====================================================================
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
//==================================================================
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
			  data: ({action:2,id:serial}),			  
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
				 alert(status + errorThrown);
				  
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
/////////////////////////////////////////////////////////////////
function addAttachment3(attachment,privatee,offerid,main,confidential,status)
	{		
		//alert("offerid "+offerid+attachment);
//	alert(attachment+" "+paperid+" "+notes);
		  $.ajax({
			
			  type: 'GET',
			  url: "../../ws/ws_tattachments.php",
			  data: ({action:1,attachment :attachment,privatee:privatee,offerid:offerid,main:main,confidential:confidential,status:status,dat:formatDate(Date.now())}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
		
				  if(data==0)
					  alert("Data is not inserted");  
				 	  {
  				  	data = JSON.parse(xhr.responseText);
  				  	
				  getAttachment1(offerid);
				// alert("hi");
				  document.getElementById("formattachment1").submit();
				
				  }		  
				
			  },
			  error: function(xhr, status, errorThrown) 
			  {
				 
  				  
				  getAttachment1(offerid);
				  document.getElementById("formattachment1").submit();
				//  alert(status + errorThrown);
			  
			  }
		  });  //	

	}
	////////////////////////////////////////////////////////
	function addAttachment1(attachment,privatee,offerid,main,confidential,status)
	{		
		//alert("offerid "+offerid+attachment);
//	alert(attachment+" "+paperid+" "+notes);
		  $.ajax({
			
			  type: 'GET',
			  url: "../../ws/ws_tattachments.php",
			  data: ({action:1,attachment :attachment,privatee:privatee,offerid:offerid,main:main,confidential:confidential,status:status,dat:formatDate(Date.now())}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
		
				  if(data==0)
					  alert("Data is not inserted");  
				 	  {
  				  	data = JSON.parse(xhr.responseText);
  				  	
				  getAttachment(offerid);
				 
				 // document.getElementById("formattachment").submit();
				
				  }		  
				
			  },
			  error: function(xhr, status, errorThrown) 
			  {
				 
  				  
				  getAttachment(offerid);
				//  document.getElementById("formattachment").submit();
				//  alert(status + errorThrown);
			  
			  }
		  });  //	

	}
	/////////////////////////////////////////////////////////////////////////
		function addAttachment2(attachment,privatee,offerid,main,confidential,status,today)
	{		
		//alert("offerid "+offerid+attachment);
//	alert(attachment+" "+paperid+" "+notes);
		  $.ajax({
			
			  type: 'GET',
			  url: "../../ws/ws_tattachments.php",
			  data: ({action:1,today:today,attachment :attachment,privatee:privatee,offerid:offerid,main:main,confidential:confidential,status:status,dat:formatDate(Date.now())}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
		
				  if(data==0)
					  alert("Data is not inserted");  
				 	  {
  				  	data = JSON.parse(xhr.responseText);
  				
					//	document.getElementById("formattachment").submit();
						setTimeout(function(){
						location.reload();
						}, 500);
						
				
				  }		  
				
			  },
			  error: function(xhr, status, errorThrown) 
			  {
				
			
					
						//document.getElementById("formattachment").submit();
						setTimeout(function(){
						location.reload();
						}, 500);
			  }
		  });  //	

	}
	//////////////////////////////////////////////////////////////
	function addAttachment4(attachment,privatee,offerid,main,confidential,status,today)
	{		
		//alert("offerid "+offerid+attachment);
//	alert(attachment+" "+paperid+" "+notes);
		  $.ajax({
			
			  type: 'GET',
			  url: "../../ws/ws_tattachments.php",
			  data: ({action:1,today:today,attachment :attachment,privatee:privatee,offerid:offerid,main:main,confidential:confidential,status:status,dat:formatDate(Date.now())}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
		
				  if(data==0)
					  alert("Data is not inserted");  
				 	  {
  				  	data = JSON.parse(xhr.responseText);
  				
						document.getElementById("formattachment1").submit();
						setTimeout(function(){
						location.reload();
						}, 500);
						
				
				  }		  
				
			  },
			  error: function(xhr, status, errorThrown) 
			  {
				
			
					
						document.getElementById("formattachment1").submit();
						setTimeout(function(){
						location.reload();
						}, 500);
			  }
		  });  //	

	}
	//========================================================
	$("#printout").click(function(){
	
		if(ID != 0)
		{
			window.open("../InvoiceReport/index.php?x="+ ID,"_blank");
		}
	});
	///////////////////////////////////////////////////////////
	
$("#add1").click(function(){
//	alert(image1+" "+image2+" "+image3+" "+image4+" "+image5+" "+image6+" "+image7+" "+image8+" "+image9+" "+image10+" "+image11+" "+image12);

if(duplicate==1)
ID=0;
attachment=$("#attachment12").val();	
attachment1=$("#attachment13").val();
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
if(ID==0)	
				{
						
					//window.open("../pages/upload.php?x="+ document.getElementById("attachment").value,"_blank","width=0,height=0");
					addAttachment(kickoffna,maincontractor,maincontractorreferral,currency,projectname,date,duedate,country,city,pe,client,clien,consultant,architect,larchitect,contractor,refferal,refferaln,gw,intt,ext,areaa,rg,rgarea,ls,lsarea,buildup,tsupport,tstartdate,tenddate,design,dstartdate,denddate,kdate,offerref,offervalue,offerremaining,cancelreason,notes,today,dealer,bd,troom,status,statusdate,hp,attachment,hpdate,bddate,agentdate,attachment1,image1,image2,image3,image4,image5,image6,image7,image8,image9,image10,image11,image12);
					
					
				}
		else{ 
			
		//	window.open("../pages/upload.php?x="+ attachment,"_blank","width=0,height=0");
		UpdateAttachment(ID,kickoffna,maincontractor,maincontractorreferral,currency,projectname,date,duedate,country,city,pe,client,clien,consultant,architect,larchitect,contractor,refferal,refferaln,gw,intt,ext,areaa,rg,rgarea,ls,lsarea,buildup,tsupport,tstartdate,tenddate,design,dstartdate,denddate,kdate,offerref,offervalue,offerremaining,cancelreason,notes,today,dealer,bd,troom,status,statusdate,hp,hpdate,bddate,agentdate,image1,image2,image3,image4,image5,image6,image7,image8,image9,image10,image11,image12);
			}	
	//	}
	
}

});
//===================================================================================

function UpdateAttachment(serial,kickoffna,maincontractor,maincontractorreferral,currency,projectname,date,duedate,country,city,pe,client,clien,consultant,architect,larchitect,contractor,refferal,refferaln,gw,intt,ext,areaa,rg,rgarea,ls,lsarea,buildup,tsupport,tstartdate,tenddate,design,dstartdate,denddate,kdate,offerref,offervalue,offerremaining,cancelreason,notes,today,dealer,bd,troom,status,statusdate,hp,hpdate,bddate,agentdate,image1,image2,image3,image4,image5,image6,image7,image8,image9,image10,image11,image12)
	{
	//	alert(pe);
//alert("hi");
//	alert(projectname+date+duedate+country+city+pe+client+clien+consultant+architect+larchitect+contractor+refferal+refferaln+gw+intt+ext+areaa+rg+rgarea+ls+lsarea+buildup+hp+tsupport+tstartdate+tenddate+design+dstartdate+denddate+kdate+offerref+offervalue+offerremaining+cancelreason+notes);
//alert(image1+" "+image2+" "+image3+" "+image4+" "+image5+" "+image6+" "+image7+" "+image8+" "+image9+" "+image10+" "+image11+" "+image12);	
		
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_toffers.php",
			  data: ({action:3,serial :serial,kickoffna:kickoffna,maincontractor:maincontractor,maincontractorreferral:maincontractorreferral,currency:currency,projectname:projectname,date:date,duedate:duedate,country:country,city:city,pe:pe,client:client,clien:clien,consultant:consultant,architect:architect,larchitect:larchitect,contractor:contractor,refferal:refferal,refferaln:refferaln,gw:gw,intt:intt,ext:ext,areaa:areaa,rg:rg,rgarea:rgarea,ls:ls,lsarea:lsarea,buildup:buildup,tsupport:tsupport,tstartdate:tstartdate,tenddate:tenddate,design:design,dstartdate:dstartdate,denddate:denddate,kdate:kdate,offerref:offerref,offervalue:offervalue,offerremaining:offerremaining,cancelreason:cancelreason,notes:notes,today:today,dealer:dealer,bd:bd,troom:troom,status:status,statusdate:statusdate,hprobability:hp,hpdate:hpdate,bddate:bddate,agentdate:agentdate,image1:image1,image2:image2,image3:image3,image4:image4,image5:image5,image6:image6,image7:image7,image8:image8,image9:image9,image10:image10,image11:image11,image12:image12}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
			
				
				  if(data==0){
				  alert("No Update!");}
				  else{
  				  	data = JSON.parse(xhr.responseText);	
				  location.reload();	}			

			  },
			  error: function(xhr, status, errorThrown) 
			  {
			  //	alert("2");
			  	location.reload();
			 	
				 // $("#LoadingImage").hide();
				//  alert(status + errorThrown);
			  }
			  
		  }); 
		  
		  } //	

//=====================================================================================
function addAttachment(kickoffna,maincontractor,maincontractorreferral,currency,projectname,date,duedate,country,city,pe,client,clien,consultant,architect,larchitect,contractor,refferal,refferaln,gw,intt,ext,areaa,rg,rgarea,ls,lsarea,buildup,tsupport,tstartdate,tenddate,design,dstartdate,denddate,kdate,offerref,offervalue,offerremaining,cancelreason,notes,today,dealer,bd,troom,status,statusdate,hp,attachment,hpdate,bddate,agentdate,attachment1,image1,image2,image3,image4,image5,image6,image7,image8,image9,image10,image11,image12)
	{		
	//	alert("hi");
//	alert(projectname+date+duedate+country+city+pe+client+clien+consultant+architect+larchitect+contractor+refferal+refferaln+gw+intt+ext+areaa+rg+rgarea+ls+lsarea+buildup+hprobability+tsupport+tstartdate+tenddate+design+dstartdate+denddate+kdate+offerref+offervalue+offerremaining+cancelreason+notes);
//	alert(attachment+" "+paperid+" "+notes);

		  $.ajax({
			
			  type: 'GET',
			  url: "../../ws/ws_toffers.php",
			  data: ({action:1,kickoffna:kickoffna,maincontractor:maincontractor,maincontractorreferral:maincontractorreferral,currency:currency,projectname:projectname,date:date,duedate:duedate,country:country,city:city,pe:pe,client:client,clien:clien,consultant:consultant,architect:architect,larchitect:larchitect,contractor:contractor,refferal:refferal,refferaln:refferaln,gw:gw,intt:intt,ext:ext,areaa:areaa,rg:rg,rgarea:rgarea,ls:ls,lsarea:lsarea,buildup:buildup,tsupport:tsupport,tstartdate:tstartdate,tenddate:tenddate,design:design,dstartdate:dstartdate,denddate:denddate,kdate:kdate,offerref:offerref,offervalue:offervalue,offerremaining:offerremaining,cancelreason:cancelreason,notes:notes,today:today,dealer:dealer,bd:bd,troom:troom,status:status,statusdate:statusdate,hprobability:hp,hpdate:hpdate,bddate:bddate,agentdate:agentdate,image1:image1,image2:image2,image3:image3,image4:image4,image5:image5,image6:image6,image7:image7,image8:image8,image9:image9,image10:image10,image11:image11,image12:image12}),
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
		//alert("asdads"+data);
	
				  if(data==0)
					  alert("Data is not inserted");  
				  else
				  {
				location.reload();
				  }				  
				
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
			  url: "../../ws/ws_offers.php",
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
	//========================================================================
	function bringData1(serial)
	{
	
	//$("#LoadingImage").show();
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_getfollowup.php",
			  data: ({action:1,id:serial}),			  
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
	//======================================================================
	function decide1(data,serial)
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
		document.getElementById("description1").value=data[0]["description"];
		
	
		
			
			
			
			}
	}
	else
	
		showError(serial);
		}	
	///////////////////////////////////////////////////////////////////////
	function getAttachment(serial)
	{
	
	//$("#LoadingImage").show();
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_offerattachment.php",
			  data: ({action:1,id:serial}),			  
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
	//////////////////////////////////////////////////////////////////////////////
	function getAttachment1(serial)
	{
	
	//$("#LoadingImage").show();
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_offerattachment.php",
			  data: ({action:2,id:serial}),			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			 
			  {
			 
				// $("#LoadingImage").hide();
				  data = JSON.parse(xhr.responseText);	
				  populate1(data);				  
			  },
			  
			  error: function(xhr, status, errorThrown) 
			  {
			  
  				//  $("#LoadingImage").hide();
				 alert(status + errorThrown);
				  
			  }
		  });  	
	}
	//////////////////////////////////////////////////////////////////////////
	function populate(data)
	{		
		
	$("#tableattachment").empty();
		count=data.length;
		var item;

		if(count>0)
		{			
			
		   $.each(data, function(index, row) {
		
					if(row.description!=''){
				$('#images1').fileinput('destroy');
		        $("#images1").fileinput({
		        	
		        	
               'uploadUrl': '../../ws/ws_uploadimage3.php',
                theme: "explorer-fa",
		 		mainClass: "input-group-lg",
          overwriteInitial: false,
        validateInitialCount: true,
		 initialPreviewAsData: true,
            initialPreview: [ ("../../att/"+row.status+"/"+row.offerid+"/" + row.description )],
            initialPreviewConfig: [
                {caption:row.description, width: "120px", url: "../../ws/ws_deleteimage.php?id=" + row.serial + "&tablename=offerattachment&name=" + row.description, key: row.serial }
            ],
			uploadExtraData: function() {
            return {
                page: 'offerattachment',serial:ID
            };
           }
        });
			}
			});
			$("#tableattachment").append(item);
		}
	}
	
	function populate1(data)
	{		
		
	$("#tableattachment1").empty();
		count=data.length;
		var item;

		if(count>0)
		{			
			item = "<tr><td><b>Date</b></td>";
			item += "<td><b>Description</b></td>";
			item += "<td><b>Delete</b></td></tr>";
		   $.each(data, function(index, row) {
				item += "<tr id='tr_"+row.serial+"'>";
				item+=   "<td>"+row.attachementdate+"</td>";
                item+=   "<td><a href='../../att/regular/"+row.offerid+"/"+row.description+"' target='_blank'>"+row.description+"</td>";
                 item+="<td><a  id='del1_"+row.serial+"' ><p class='fa fa-trash-o'></p> Delete</a></td>";
              //  item+=   "<td>"+row.password+"</td>";
				//item+=   "<td>"+row.admin+"</td>";
                item+= "</tr>";
				
			});
			$("#tableattachment1").append(item);
		}
	}
	/////////////////////////////////////////////////////////////////////////////////
	//delete person from server
	function deleteAttachment(idval)
	{
		
		//$("#LoadingImage").show();
		 
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_toffers.php",
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

		//////////////////////////////////////////////////////////////////////////////////
		
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
					
document.getElementById("pname").value=data[0]["ProjectName"];
var s =data[0]["Dat"];
var t =s.split("-");
var t3= (t[2].split(" "))[0];
document.getElementById("date").value=t[0]+"-"+t[1]+"-"+ t3;
s =data[0]["duedate"];
t =s.split("-");
 t3= (t[2].split(" "))[0];
document.getElementById("duedate").value=t[0]+"-"+t[1]+"-"+ t3;

s =data[0]["hpdate"];
t =s.split("-");
 t3= (t[2].split(" "))[0];
document.getElementById("hpdate").value=t[0]+"-"+t[1]+"-"+ t3;

s =data[0]["bddate"];
t =s.split("-");
 t3= (t[2].split(" "))[0];
document.getElementById("bddate").value=t[0]+"-"+t[1]+"-"+ t3;

s =data[0]["agentdate"];
t =s.split("-");
 t3= (t[2].split(" "))[0];
document.getElementById("agentdate").value=t[0]+"-"+t[1]+"-"+ t3;
	
document.getElementById("country").value=data[0]["Country"];
document.getElementById("city").value=data[0]["city"];
document.getElementById("pe").value=data[0]["pe"];
document.getElementById("client").value=data[0]["CustomerID"];

		$("#client").val(data[0]["CustomerID"]).trigger("change");
document.getElementById("clien").value=data[0]["clientrep"];
$("#clien").val(data[0]["clientrep"]).trigger("change");
document.getElementById("consultant").value=data[0]["Consultantid"];
$("#consultant").val(data[0]["Consultantid"]).trigger("change");
document.getElementById("architect").value=data[0]["ArchitectID"];
$("#architect").val(data[0]["ArchitectID"]).trigger("change");
document.getElementById("larchitect").value=data[0]["landscapearchitect"];
$("#larchitect").val(data[0]["landscapearchitect"]).trigger("change");
document.getElementById("contractor").value=data[0]["ContractorID"];
$("#contractor").val(data[0]["ContractorID"]).trigger("change");
document.getElementById("maincontractor").value=data[0]["maincontractor"];
$("#maincontractor").val(data[0]["maincontractor"]).trigger("change");

document.getElementById("refferal").value=data[0]["Referral"];
$("#refferal").val(data[0]["Referral"]).trigger("change");
document.getElementById("refferaln").value=data[0]["referalnotes"];

document.getElementById("currency1").value=data[0]["currency"];
document.getElementById("status").value=data[0]["status"];
var s =data[0]["statusdate"];
var t =s.split("-");
var t3= (t[2].split(" "))[0];
document.getElementById("statusdate").value=t[0]+"-"+t[1]+"-"+ t3;
	if(	data[0]["GW"]==1)
			document.getElementById("gw").checked = true;
			else
			document.getElementById("gw").checked = false;
	
	if(	data[0]["bd"]==1)
			document.getElementById("bd").checked = true;
			else
			document.getElementById("bd").checked = false;

		if(	data[0]["GWINT"]==1)
			document.getElementById("int").checked = true;
			else
			document.getElementById("int").checked = false;
		
			if(	data[0]["GWEXT"]==1)
			document.getElementById("ext").checked = true;
			else
			document.getElementById("ext").checked = false;
	document.getElementById("area").value=data[0]["GWAREA"];	

		if(	data[0]["RG"]==1)
			document.getElementById("rg").checked = true;
			else
			document.getElementById("rg").checked = false;
	document.getElementById("rgarea").value=data[0]["RGAREA"];	

if(	data[0]["ls"]==1)
			document.getElementById("ls").checked = true;
			else
			document.getElementById("ls").checked = false;
			
			if(	data[0]["kickoffna"]==1)
			document.getElementById("kickoffna").checked = true;
			else
			document.getElementById("kickoffna").checked = false;
		
document.getElementById("lsarea").value=data[0]["lsarea"];	
document.getElementById("buildup").value=data[0]["buildup"];
document.getElementById("troom").value=data[0]["troom"];	


		if(	data[0]["hp"]==1)
			document.getElementById("hprobability").checked = true;
			else
			document.getElementById("hprobability").checked = false;
		
		
		if(	data[0]["techsupport"]==1)
			document.getElementById("tsupport").checked = true;
			else
			document.getElementById("tsupport").checked = false;
						var s =data[0]["techsupportstartdate"];
var t =s.split("-");
var t3= (t[2].split(" "))[0];
document.getElementById("tstartdate").value=t[0]+"-"+t[1]+"-"+ t3;
						var s =data[0]["techsupportenddate"];
var t =s.split("-");
var t3= (t[2].split(" "))[0];
document.getElementById("tenddate").value=t[0]+"-"+t[1]+"-"+ t3;


		if(	data[0]["design"]==1)
			document.getElementById("design").checked = true;
			else
			document.getElementById("design").checked = false;
					var s =data[0]["designstartdate"];
var t =s.split("-");
var t3= (t[2].split(" "))[0];
document.getElementById("dstartdate").value=t[0]+"-"+t[1]+"-"+ t3;
				var s =data[0]["designenddate"];
var t =s.split("-");
var t3= (t[2].split(" "))[0];
	document.getElementById("denddate").value=t[0]+"-"+t[1]+"-"+ t3;

			var s =data[0]["kickoff"];
var t =s.split("-");
var t3= (t[2].split(" "))[0];
document.getElementById("kdate").value=t[0]+"-"+t[1]+"-"+ t3;
document.getElementById("offerref").value=data[0]["OfferRef"];
document.getElementById("offervalue").value=data[0]["OfferValue"];
document.getElementById("offerremaining").value=data[0]["remaining"];


	document.getElementById("cancelreason").value=data[0]["cancelreason"];
document.getElementById("notes").value=data[0]["notes"];

			if(	data[0]["dealer"]==1)
			document.getElementById("dealer").checked = true;
			else
			document.getElementById("dealer").checked = false;
			if(data[0]['image1']!='')
			 $('#image1').attr('src','../../att/images/'+data[0]['Serial']+'/'+data[0]['image1']);
			 else
			 $('#image1').attr('src','');
			 
			 if(data[0]['image2']!='')
			 $('#image2').attr('src','../../att/images/'+data[0]['Serial']+'/'+data[0]['image2']);
			 else
			 $('#image2').attr('src','');
			 
			 if(data[0]['image3']!='')
			 $('#image3').attr('src','../../att/images/'+data[0]['Serial']+'/'+data[0]['image3']);
			 else
			 $('#image3').attr('src','');
			 
			 if(data[0]['image4']!='')
			 $('#image4').attr('src','../../att/images/'+data[0]['Serial']+'/'+data[0]['image4']);
			 else
			 $('#image4').attr('src','');
			 
			 if(data[0]['image5']!='')
			 $('#image5').attr('src','../../att/images/'+data[0]['Serial']+'/'+data[0]['image5']);
			 else
			 $('#image5').attr('src','');
			 
			 if(data[0]['image6']!='')
			 $('#image6').attr('src','../../att/images/'+data[0]['Serial']+'/'+data[0]['image6']);
			 else
			 $('#image6').attr('src','');
			 
			  if(data[0]['image7']!='')
			 $('#image7').attr('src','../../att/images/'+data[0]['Serial']+'/'+data[0]['image7']);
			 else
			 $('#image7').attr('src','');
			 
			 if(data[0]['image8']!='')
			 $('#image8').attr('src','../../att/images/'+data[0]['Serial']+'/'+data[0]['image8']);
			 else
			 $('#image8').attr('src','');
			 
			 if(data[0]['image9']!='')
			 $('#image9').attr('src','../../att/images/'+data[0]['Serial']+'/'+data[0]['image9']);
			 else
			 $('#image9').attr('src','');
			 
			 if(data[0]['image10']!='')
			 $('#image10').attr('src','../../att/images/'+data[0]['Serial']+'/'+data[0]['image10']);
			 else
			 $('#image10').attr('src','');
			 
			  if(data[0]['image11']!='')
			 $('#image11').attr('src','../../att/images/'+data[0]['Serial']+'/'+data[0]['image11']);
			 else
			 $('#image11').attr('src','');
			 
			  if(data[0]['image12']!='')
			 $('#image12').attr('src','../../att/images/'+data[0]['Serial']+'/'+data[0]['image12']);
			 else
			 $('#image12').attr('src','');
			 image1=data[0]['image1'];
			 image2=data[0]['image2'];
			 image3=data[0]['image3'];
			 image4=data[0]['image4'];
			 image5=data[0]['image5'];
			 image6=data[0]['image6'];
			 image7=data[0]['image7'];
			 image8=data[0]['image8'];
			 image9=data[0]['image9'];
			 image10=data[0]['image10'];
			 image11=data[0]['image11'];
			 image12=data[0]['image12'];
			 
			 //===================================================================================
			 $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_offerattachment.php",
			  data: ({id:ID,action:1}),			  
			  dataType: 'json',
			   cache: false,
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			 
			  {
			  
				  				  data = JSON.parse(xhr.responseText);	
				  				  
				  				  if(data==null){
				  				  	$('#images').fileinput('destroy');
		        $("#images").fileinput({
		        	
		        	
               'uploadUrl': '../../ws/ws_uploadimage2.php',
                 theme: "explorer-fa",
		 		mainClass: "input-group-lg",
          overwriteInitial: false,
        validateInitialCount: true,
			 initialPreviewAsData: true,
 
     initialPreview: [],
    initialPreviewConfig: [],
			uploadExtraData: function() {
            return {
                serial: ID
            };
           }
        });
        
        $('#images1').fileinput('destroy');
		        $("#images1").fileinput({
		        	
		        	
               'uploadUrl': '../../ws/ws_uploadimage3.php',
                 theme: "explorer-fa",
		 		mainClass: "input-group-lg",
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
				  				  }
				  				  else{
		var initialPreview = [];
var initialPreviewConfig = [];
				 for(var i= 0; i < data.length; i++)
{

initialPreview.push('../../att/wip/'+data[i]["offerid"]+"/"+data[i]["description"] );

	type=data[i]['description'].split(/[\s.]+/);
type=type[type.length-1];

switch(type){
	case 'jpg': initialPreviewConfig.push({caption: data[i]["description"], width: "120px", url: "../../ws/ws_deleteimage.php?id=" + data[i]["serial"] + "&tablename=offerattachment"   , key: data[i]["serial"],downloadUrl: "../../att/wip/"+data[i]["offerid"]+"/"+data[i]["description"] });
				break;
	case 'png': initialPreviewConfig.push({caption: data[i]["description"], width: "120px", url: "../../ws/ws_deleteimage.php?id=" + data[i]["serial"] + "&tablename=offerattachment"   , key: data[i]["serial"],downloadUrl: "../../att/wip/"+data[i]["offerid"]+"/"+data[i]["description"] });
				break;
	case 'gif': initialPreviewConfig.push({caption: data[i]["description"], width: "120px", url: "../../ws/ws_deleteimage.php?id=" + data[i]["serial"] + "&tablename=offerattachment"   , key: data[i]["serial"],downloadUrl: "../../att/wip/"+data[i]["offerid"]+"/"+data[i]["description"] });
				break;
	case 'jpeg': initialPreviewConfig.push({caption: data[i]["description"], width: "120px", url: "../../ws/ws_deleteimage.php?id=" + data[i]["serial"] + "&tablename=offerattachment"   , key: data[i]["serial"],downloadUrl: "../../att/wip/"+data[i]["offerid"]+"/"+data[i]["description"] });
				break;
	case 'pdf': initialPreviewConfig.push(  {type: "pdf", caption: data[i]["description"], url: "../../ws/ws_deleteimage.php?id=" + data[i]["serial"] + "&tablename=offerattachment"   , key: data[i]["serial"],downloadUrl: "../../att/wip/"+data[i]["offerid"]+"/"+data[i]["description"]});
				break;
	case 'mp4': initialPreviewConfig.push(  {   
            type: "video", 
            size: 375000,
            filetype: "video/mp4",
            caption: data[i]["description"], 
            url: "../../ws/ws_deleteimage.php?id=" + data[i]["serial"] + "&tablename=offerattachment",
            key: 3,
            downloadUrl: "../../att/wip/"+data[i]["offerid"]+"/"+data[i]["description"], // override url
            filename: data[i]["description"] // override download filename
        });
				break;
	case 'MP4': initialPreviewConfig.push(  {   
            type: "video", 
            size: 375000,
            filetype: "video/mp4",
            caption: data[i]["description"], 
            url: "../../ws/ws_deleteimage.php?id=" + data[i]["serial"] + "&tablename=offerattachment",
            key: 3,
            downloadUrl: "../../att/wip/"+data[i]["offerid"]+"/"+data[i]["description"], // override url
            filename: data[i]["description"] // override download filename
        });
				break;
	default :initialPreviewConfig.push({caption: data[i]["description"], width: "120px", url: "../../ws/ws_deleteimage.php?id=" + data[i]["serial"] + "&tablename=offerattachment"   , key: data[i]["serial"],downloadUrl: "../../att/wip/"+data[i]["offerid"]+"/"+data[i]["description"] });
				break;
}}	
				  		if(data.length>0){
				$('#images').fileinput('destroy');
		        $("#images").fileinput({
		        	
               'uploadUrl': '../../ws/ws_uploadimage2.php',
                 theme: "explorer-fa",
		 		mainClass: "input-group-lg",
          overwriteInitial: false,
        validateInitialCount: true,
		 initialPreviewAsData: true,
		 		
   
   
            initialPreview: initialPreview,
            initialPreviewConfig: initialPreviewConfig,
			uploadExtraData: function() {
            return {
               serial: ID
            };
           }
        });
		}}
			  },
			  
			  error: function(xhr, status, errorThrown) 
			  {
				   
			  }
		  }); 

		//====================================REGULAR====================================================
			
					$.ajax({
			  type: 'GET',
			  url: "../../ws/ws_offerattachment.php",
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

initialPreview.push('../../att/regular/'+data[i]["offerid"]+"/"+data[i]["description"] );

	type=data[i]['description'].split(/[\s.]+/);
type=type[type.length-1];

switch(type){
	case 'jpg': initialPreviewConfig.push({caption: data[i]["description"], width: "120px", url: "../../ws/ws_deleteimage.php?id=" + data[i]["serial"] + "&tablename=offerattachment"   , key: data[i]["serial"],downloadUrl: "../../att/regular/"+data[i]["offerid"]+"/"+data[i]["description"] });
				break;
	case 'png': initialPreviewConfig.push({caption: data[i]["description"], width: "120px", url: "../../ws/ws_deleteimage.php?id=" + data[i]["serial"] + "&tablename=offerattachment"   , key: data[i]["serial"],downloadUrl: "../../att/regular/"+data[i]["offerid"]+"/"+data[i]["description"] });
				break;
	case 'gif': initialPreviewConfig.push({caption: data[i]["description"], width: "120px", url: "../../ws/ws_deleteimage.php?id=" + data[i]["serial"] + "&tablename=offerattachment"   , key: data[i]["serial"],downloadUrl: "../../att/regular/"+data[i]["offerid"]+"/"+data[i]["description"] });
				break;
	case 'jpeg': initialPreviewConfig.push({caption: data[i]["description"], width: "120px", url: "../../ws/ws_deleteimage.php?id=" + data[i]["serial"] + "&tablename=offerattachment"   , key: data[i]["serial"],downloadUrl: "../../att/regular/"+data[i]["offerid"]+"/"+data[i]["description"] });
				break;
	case 'pdf': initialPreviewConfig.push(  {type: "pdf", caption: data[i]["description"], url: "../../ws/ws_deleteimage.php?id=" + data[i]["serial"] + "&tablename=offerattachment"   , key: data[i]["serial"],downloadUrl: "../../att/regular/"+data[i]["offerid"]+"/"+data[i]["description"]});
				break;
	case 'mp4': initialPreviewConfig.push(  {   
            type: "video", 
            size: 375000,
            filetype: "video/mp4",
            caption: data[i]["description"], 
            url: "../../ws/ws_deleteimage.php?id=" + data[i]["serial"] + "&tablename=offerattachment",
            key: 3,
            downloadUrl: "../../att/regular/"+data[i]["offerid"]+"/"+data[i]["description"], // override url
            filename: data[i]["description"] // override download filename
        });
				break;
	case 'MP4': initialPreviewConfig.push(  {   
            type: "video", 
            size: 375000,
            filetype: "video/mp4",
            caption: data[i]["description"], 
            url: "../../ws/ws_deleteimage.php?id=" + data[i]["serial"] + "&tablename=offerattachment",
            key: 3,
            downloadUrl: "../../att/regular/"+data[i]["offerid"]+"/"+data[i]["description"], // override url
            filename: data[i]["description"] // override download filename
        });
				break;
	default :initialPreviewConfig.push({caption: data[i]["description"], width: "120px", url: "../../ws/ws_deleteimage.php?id=" + data[i]["serial"] + "&tablename=offerattachment"   , key: data[i]["serial"],downloadUrl: "../../att/regular/"+data[i]["offerid"]+"/"+data[i]["description"] });
				break;
}}	
				  		if(data.length>0){
				$('#images1').fileinput('destroy');
		        $("#images1").fileinput({
		        	
		        	
               'uploadUrl': '../../ws/ws_uploadimage3.php',
                 theme: "explorer-fa",
		 		mainClass: "input-group-lg",
          overwriteInitial: false,
        validateInitialCount: true,
		 initialPreviewAsData: true,
		 		
   
            initialPreview: initialPreview,
            initialPreviewConfig: initialPreviewConfig,
			uploadExtraData: function() {
            return {
               serial: ID
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
		function fillOwner()
	{
	
		
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_userconf.php",
			  data: ({action:4}),
			  
			  dataType: 'json',
			  timeout: 10000,
			  success: function(data, textStatus, xhr) 
			  {
				 
		 		//  $("#LoadingImage").hide();				  
		
				  if(data==null){
					  //alert("Data couldn't be loaded!");
					  $("#client").html("");
				//	$("#clien").html("");
				//	$("#consultant").html("");
				//	$("#architect").html("");
				//	$("#larchitect").html("");
				//	$("#contractor").html("");
				//	$("#refferal").html("");
					 }
				  else{
				  	data = JSON.parse(xhr.responseText);				  				 
				  	count=data.length;
				  	
		var items;
	 $("#client").html("");
					//    $("#clien").html("");
					//	 $("#consultant").html("");
					//	  $("#architect").html("");
					//	   $("#larchitect").html("");
					//	    $("#contractor").html("");
					//		$("#refferal").html("");
							 $("#client").append("<option value='0' selected></option>");
							//  $("#clien").append("<option value='0' selected></option>");
							//   $("#consultant").append("<option value='0' selected></option>");
							  //  $("#architect").append("<option value='0' selected></option>");
								// $("#larchitect").append("<option value='0' selected></option>");
								//  $("#contractor").append("<option value='0' selected></option>");
								 //  $("#refferal").append("<option value='0' selected></option>");
		if(count>0)
		{
			items="";
			  $.each(data,function(index,item) 
    {
      $("#client").append("<option value='"+item.Serial+"'>"+item.fname +" "+ item.lname +"/" + item.company +"</option>");
	//  $("#clien").append("<option value='"+item.Serial+"'>"+item.fname +" "+ item.lname +"/" + item.company +"</option>");
	//  $("#consultant").append("<option value='"+item.Serial+"'>"+item.fname +" "+ item.lname +"/" + item.company +"</option>");
	//  $("#architect").append("<option value='"+item.Serial+"'>"+item.fname +" "+ item.lname +"/" + item.company +"</option>");
	//  $("#larchitect").append("<option value='"+item.Serial+"'>"+item.fname +" "+ item.lname +"/" + item.company +"</option>");
	//  $("#contractor").append("<option value='"+item.Serial+"'>"+item.fname +" "+ item.lname +"/" + item.company +"</option>");
	//  $("#refferal").append("<option value='"+item.Serial+"'>"+item.fname +" "+ item.lname +"/" + item.company +"</option>");
    });


		}
				  }
			  },
			  error: function(xhr, status, errorThrown) 
			  {
			  
			  
			  }
		  });  //	
		
	}	
		
		
	function fillClients(clientSerial)
	{
	
	
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_userconf.php",
			  data: ({action:4,id:clientSerial}),
			  
			  dataType: 'json',
			  timeout: 10000,
			  success: function(data, textStatus, xhr) 
			  {
				
				  if(data==null){
					  //alert("Data couldn't be loaded!");

					 }
				  else{
				  	data = JSON.parse(xhr.responseText);				  				 
				  	count=data.length;
				  	
		var items;
		  
		if(count>0)
		{
			items="";
			  $.each(data,function(index,item) 
    {
    		
				$("#client").append("<option value='"+item.Serial+"'>"+item.fname +" "+ item.lname +"/" + item.company +"</option>");
					
				$("#clien").append("<option value='"+item.Serial+"'>"+item.fname +" "+ item.lname +"/" + item.company +"</option>");
				
				 $("#consultant").append("<option value='"+item.Serial+"'>"+item.fname +" "+ item.lname +"/" + item.company +"</option>");
				
				 $("#architect").append("<option value='"+item.Serial+"'>"+item.fname +" "+ item.lname +"/" + item.company +"</option>");
				
				$("#larchitect").append("<option value='"+item.Serial+"'>"+item.fname +" "+ item.lname +"/" + item.company +"</option>");
			
				$("#contractor").append("<option value='"+item.Serial+"'>"+item.fname +" "+ item.lname +"/" + item.company +"</option>");
				
				
				$("#refferal").append("<option value='"+item.Serial+"'>"+item.fname +" "+ item.lname +"/" + item.company +"</option>");
				
				$("#maincontractor").append("<option value='"+item.Serial+"'>"+item.fname +" "+ item.lname +"/" + item.company +"</option>");
				
				$("#maincontractorreferral").append("<option value='"+item.Serial+"'>"+item.fname +" "+ item.lname +"/" + item.company +"</option>");
    });
if(clientid=="Owner")	
				{document.getElementById("client").value=clientSerial;
				$("#client").val(clientSerial).trigger("change");
			}
				else if(clientid=="Rep")	
				{document.getElementById("clien").value=clientSerial;
				$("#clien").val(clientSerial).trigger("change");
				}else if(clientid=="Consultant")	
				{document.getElementById("consultant").value=clientSerial;
				$("#consultant").val(clientSerial).trigger("change");
				}else if(clientid=="Architect")	
				{document.getElementById("architect").value=clientSerial;
				$("#architect").val(clientSerial).trigger("change");
				}else if(clientid=="Larchitect")	
				{document.getElementById("larchitect").value=clientSerial;
				$("#larchitect").val(clientSerial).trigger("change");
				}else if(clientid=="Contractor")	
				{document.getElementById("contarctor").value=clientSerial;
				$("#contarctor").val(clientSerial).trigger("change");
				}else if(clientid=="Refferal")	
				{document.getElementById("refferal").value=clientSerial;
				$("#refferal").val(clientSerial).trigger("change");
				}else if(clientid=="MainContractor")	
				{document.getElementById("maincontractor").value=clientSerial;
				$("#maincontractor").val(clientSerial).trigger("change");
				}else if(clientid=="MainContractorReferral")	
				{document.getElementById("maincontractorreferral").value=clientSerial;
				}

		}
				  }
			  },
			  error: function(xhr, status, errorThrown) 
			  {
			  
			  
			  }
		  });  //	
		
	}
$(function () {
    'use strict';
    // Change this to the location of your server-side upload handler:
    var url = window.location.hostname === 'blueimp.github.io' ?
                '//jquery-file-upload.appspot.com/' : '../upload1/server/php/',
        uploadButton = $('<button/>')
            .addClass('btn btn-primary')
            .prop('disabled', true)
            .text('Processing...')
            .on('click', function () {
					$('#progress .progress-bar').css(
            'width',
            0 + '%'
        );
                var $this = $(this),
                    data = $this.data();
                $this
                    .off('click')
                    .text('Abort')
                    .on('click', function () {
                        $this.remove();
                        data.abort();
                    });
                data.submit().always(function () {
                    $this.remove();
                });
            });
    $('#fileupload').fileupload({
        url: url,
        dataType: 'json',
        autoUpload: false,
        acceptFileTypes: /(\.|\/)(gif|jpe?g|png|pdf)$/i,
        maxFileSize: 39990000,
        // Enable image resizing, except for Android and Opera,
        // which actually support image resizing, but fail to
        // send Blob objects via XHR requests:
        disableImageResize: /Android(?!.*Chrome)|Opera/
            .test(window.navigator.userAgent),
        previewMaxWidth: 100,
        previewMaxHeight: 100,
        previewCrop: true
    }).on('fileuploadadd', function (e, data) {
        data.context = $('<div/>').appendTo('#files');
        $.each(data.files, function (index, file) {
            var node = $('<p/>')
                    .append($('<span/>').text(file.name));
            if (!index) {
                node
                    .append('<br>')
                    .append(uploadButton.clone(true).data(data));
            }
            node.appendTo(data.context);
        });
    }).on('fileuploadprocessalways', function (e, data) {
        var index = data.index,
            file = data.files[index],
            node = $(data.context.children()[index]);
        if (file.preview) {
 
        }
        if (file.error) {
            node
                .append('<br>')
                .append($('<span class="text-danger"/>').text(file.error));
        }
        if (index + 1 === data.files.length) {
            data.context.find('button')
                .text('Upload')
                .prop('disabled', !!data.files.error);
        }
    }).on('fileuploadprogressall', function (e, data) {
        var progress = parseInt(data.loaded / data.total * 100, 10);
        $('#progress .progress-bar').css(
            'width',
            progress + '%'
        );
    }).on('fileuploaddone', function (e, data) {

        $.each(data.result.files, function (index, file) {
            if (file.url) {
                var link = $('<a>')
                    .attr('target', '_blank')
                    .prop('href', file.url);
                    name=file.name.replace(".",'');
                    name=name.replace(" ",'');
                    name=name.replace("(",'');
                    name=name.replace(")",'');
                $(data.context.children()[index])
                    .html("<div id='div1_"+name+"'><a href='"+file.url+"'>"+file.name+"</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a  id='del1_"+file.name+"' style='color: red;'><p class='fa fa-trash-o'></p></a></div>");
					    var link = $('<a>')
                    .attr('target', '_blank')
                    .prop('href', file.url);
                    alert(file.name);
							  $.ajax({
			
			  type: 'GET',
			  url: "../../ws/ws_tattachments.php",
			  data: ({action:1,url :file.url,name:file.name,offerid:ID,status:'wip'}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
			  	
				  if(data==0)
					  alert("Data is not inserted");  
						  else
				  {data = JSON.parse(xhr.responseText);	
				
					
				  }		  
				
			  },
			  error: function(xhr, status, errorThrown) 
			  {
			  	
			//	alert("2");
				//  alert(status + errorThrown);
			  }
		  });
            } else if (file.error) {
                var error = $('<span class="text-danger"/>').text(file.error);
                $(data.context.children()[index])
                    .append('<br>')
                    .append(error);
            }
        });
    }).on('fileuploadfail', function (e, data) {
        $.each(data.files, function (index) {
            var error = $('<span class="text-danger"/>').text('File upload failed.');
            $(data.context.children()[index])
                .append('<br>')
                .append(error);
        });
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');
});



});

