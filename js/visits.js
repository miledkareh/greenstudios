$(document).ready(function() {
ID=0;
var visit=0;
var Latitude=0;
var Longitude=0;
var email="";
rate=0;
edit=0;
var projectname=findGetParameter('y');
var offerid=findGetParameter('z');
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
$('#dataTables-example2 tbody').on( 'click', 'tr', function (event) {
	
	thiss=this;

   row= $('#dataTables-example2').DataTable().row( this ).data() ;
  
    index= $(event.target.parentNode).index() +1;
 
} );
function filltable(serial){
	//alert(fidol+' '+group+' '+serial);
if ( $.fn.DataTable.isDataTable('#dataTables-example2') ) {
$('#dataTables-example2').DataTable().destroy();
}

$('#dataTables-example2 tbody').empty();

$.ajax({
type: 'GET',
url: "../../ws/ws_getEmails.php",
data: ({action:1,id:serial}),
cache: false,
dataType: 'json',
timeout: 10000,
success: function(data, textStatus, xhr) 
{

data = JSON.parse(xhr.responseText);
columns=[

	{ "data": null, "name": "", "title": "",
	"render": function ( data, type, row, meta ) {
		return '<input type="checkbox" class="chcktbl_" name="Cedit" value="'+data.email+'" id="Cedit_'+data.email+'"/>';
	} },
	{ "data": "email", "name": "Email", "title": "Email" },
  ];
 
$('#dataTables-example2').DataTable({

 data: data,
responsive: true,
		"aaSorting": [],
		"lengthMenu": [[-1], ["All"]],
	 "columns": columns,
	
		   }); 







			
},
error: function(xhr, status, errorThrown) 
{

}
});


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












function checkcheckbox(serial) {
	
		 $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_getemailstocheck.php",
			  data: ({id:serial}),			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			 
			  {
			  document.getElementById("email").value = data[0]["emails"];
				   
			  },
			  
			  error: function(xhr, status, errorThrown) 
			  {
			  
  				//  $("#LoadingImage").hide();
				 alert(status + errorThrown);
				  
			  }
		  }); 
		
 
  
}






//fillOffice();
function getLocation() {
	
		 $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_getclientvisit.php",
			  data: ({id:offerid}),			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			 
			  {
			  
				// $("#LoadingImage").hide();
				  data = JSON.parse(xhr.responseText);	
				  	
				  	document.getElementById('location').value=data[0]['caddress'];		  
			  },
			  
			  error: function(xhr, status, errorThrown) 
			  {
			  
  				//  $("#LoadingImage").hide();
				 alert(status + errorThrown);
				  
			  }
		  }); 
		
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

$("#myModal1").on('shown.bs.modal', function () {
document.getElementById("elblalert").style.visibility='hidden';
 checkcheckbox(ID);
});

$("#myModal2").on('shown.bs.modal', function () {
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
    $('#checkoutdate').val(formatDate(Date.now()));
var d = new Date(),        
        h = d.getHours(),
        m = d.getMinutes();
       
    if(h < 10) h = '0' + h; 
    if(m < 10) m = '0' + m; 
    $('#checkouttime').val(h+":"+m);
		$('#images').fileinput('destroy');
		        $("#images").fileinput({
               'uploadUrl': '../../ws/ws_uploadimage6.php',
          overwriteInitial: false,
        validateInitialCount: true,
			 initialPreviewAsData: true,
    maxImageWidth: 1200,
    resizeImage: true,
     initialPreview: [],
    initialPreviewConfig: [],
			uploadExtraData: function() {
            return {
                serial: ID,dat:today
            };
           }
        });
document.getElementById("lblalert").style.visibility='hidden';

 if(ID > 0)
	 
	{
		$("#title2").html("Check Out");
if(edit==1)
		bringData1(ID);
		}
	else
	$("#title2").html("Check Out");
		
});
function bringData1(serial)
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
				  decide1(data,serial);				  
			  },
			  
			  error: function(xhr, status, errorThrown) 
			  {
			  
  				//  $("#LoadingImage").hide();
				 alert(status + errorThrown);
				  
			  }
		  });  	
	}
		function decide1(data,serial)
	{		

		count=data.length;
	if(count>0)
	{
		if( serial==0)
			alert("user exist");	
		else 
			{		
			document.getElementById("client").value=data[0]["client"];
			var values=data[0]["work"];
$.each(values.split(","), function(i,e){
    $("#work option[value='" + e + "']").prop("selected", true);
});
var s =data[0]["checkoutdate"];
		var t =s.split("-");
var t3= (t[2].split(" "))[0];
document.getElementById("checkoutdate").value=t[0]+"-"+t[1]+"-"+ t3;
document.getElementById("checkouttime").value = (t[2].split(" "))[1];
		document.getElementById("note").value=data[0]["notes"];
		document.getElementById("gsnote").value=data[0]["gsnotes"];		
		if(	data[0]["sent"]==1)
			document.getElementById("sent").checked = true;
			else
			document.getElementById("sent").checked = false;
			
			
		 if (data[0]["rate"]==0)
		{$('#span5').css("color", "");
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
		else if (data[0]["rate"]==5)
		{$("#span5").css("color", "yellow");
			$("#span2").css("color", "yellow");
			$("#span1").css("color", "yellow");
			$("#span3").css("color", "yellow");
			$("#span4").css("color", "yellow");
			$("#span1").toggleClass('glyphicon-star-empty glyphicon-star');
			$("#span2").toggleClass('glyphicon-star-empty glyphicon-star');
			$("#span3").toggleClass('glyphicon-star-empty glyphicon-star');
			$("#span4").toggleClass('glyphicon-star-empty glyphicon-star');
			$("#span5").toggleClass('glyphicon-star-empty glyphicon-star');
		rate=5;}
		
		else if (data[0]["rate"]==4)
		{$("#span5").css("color", "");
			$("#span2").css("color", "yellow");
			$("#span1").css("color", "yellow");
			$("#span3").css("color", "yellow");
			$("#span4").css("color", "yellow");
			$("#span1").toggleClass('glyphicon-star-empty glyphicon-star');	
			$("#span2").toggleClass('glyphicon-star-empty glyphicon-star');
			$("#span3").toggleClass('glyphicon-star-empty glyphicon-star');
			$("#span4").toggleClass('glyphicon-star-empty glyphicon-star');
			$("#span5").toggleClass('glyphicon-star glyphicon-star');
		rate=4;}
		
		else if (data[0]["rate"]==3)
		{$("#span5").css("color", "");
			$("#span2").css("color", "yellow");
			$("#span1").css("color", "yellow");
			$("#span3").css("color", "yellow");
			$("#span4").css("color", "");
			$("#span1").toggleClass('glyphicon-star-empty glyphicon-star');	
			$("#span2").toggleClass('glyphicon-star-empty glyphicon-star');
			$("#span3").toggleClass('glyphicon-star-empty glyphicon-star');
			$("#span4").toggleClass('glyphicon-star glyphicon-star');
			$("#span5").toggleClass('glyphicon-star glyphicon-star');
		rate=3;}
		else if (data[0]["rate"]==2)
		{$("#span5").css("color", "");
			$("#span2").css("color", "yellow");
			$("#span1").css("color", "yellow");
			$("#span3").css("color", "");
			$("#span4").css("color", "");
			$("#span1").toggleClass('glyphicon-star-empty glyphicon-star');	
			$("#span2").toggleClass('glyphicon-star-empty glyphicon-star');
			$("#span3").toggleClass('glyphicon-star glyphicon-star');
			$("#span4").toggleClass('glyphicon-star glyphicon-star');
			$("#span5").toggleClass('glyphicon-star glyphicon-star');
		rate=2;}
		
		else
		{
			$("#span5").css("color", "");
			$("#span2").css("color", "");
			$("#span1").css("color", "yellow");
			$("#span3").css("color", "");
			$("#span4").css("color", "");
			$("#span1").toggleClass('glyphicon-star-empty glyphicon-star');	
			$("#span2").toggleClass('glyphicon-star glyphicon-star');
			$("#span3").toggleClass('glyphicon-star glyphicon-star');
			$("#span4").toggleClass('glyphicon-star glyphicon-star');
			$("#span5").toggleClass('glyphicon-star glyphicon-star');
			rate=1;
		}
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
		
			$.ajax({
			  type: 'GET',
			  url: "../../ws/ws_mattachments.php",
			  data: ({id:ID,action:5}),			  
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

initialPreview.push('../../att/visits/'+data[i]["visitid"]+'/'+data[i]["description"] );

	type=data[i]['description'].split(/[\s.]+/);
type=type[type.length-1];

switch(type){
	case 'jpg': initialPreviewConfig.push({caption: data[i]["description"], width: "120px", url: "../../ws/ws_deleteimage.php?id=" + data[i]["serial"] + "&tablename=visitattachment"   , key: data[i]["serial"],downloadUrl: "../../att/visits/"+data[i]["description"]+"/"+data[i]["description"] });
				break;
	case 'png': initialPreviewConfig.push({caption: data[i]["description"], width: "120px", url: "../../ws/ws_deleteimage.php?id=" + data[i]["serial"] + "&tablename=visitattachment"   , key: data[i]["serial"],downloadUrl: "../../att/visits/"+data[i]["description"]+"/"+data[i]["description"]});
				break;
	case 'gif': initialPreviewConfig.push({caption: data[i]["description"], width: "120px", url: "../../ws/ws_deleteimage.php?id=" + data[i]["serial"] + "&tablename=visitattachment"   , key: data[i]["serial"],downloadUrl: "../../att/visits/"+data[i]["description"]+"/"+data[i]["description"]});
				break;
	case 'jpeg': initialPreviewConfig.push({caption: data[i]["description"], width: "120px", url: "../../ws/ws_deleteimage.php?id=" + data[i]["serial"] + "&tablename=visitattachment"   , key: data[i]["serial"],downloadUrl: "../../att/visits/"+data[i]["description"]+"/"+data[i]["description"]});
				break;
	case 'pdf': initialPreviewConfig.push(  {type: "pdf", caption: data[i]["description"], url: "../../ws/ws_deleteimage.php?id=" + data[i]["serial"] + "&tablename=visitattachment"   , key: data[i]["serial"],downloadUrl: "../../att/visits/"+data[i]["description"]+"/"+data[i]["description"]});
				break;
	case 'mp4': initialPreviewConfig.push(  {   
            type: "video", 
            size: 375000,
            filetype: "video/mp4",
            caption: data[i]["description"], 
            url: "../../ws/ws_deleteimage.php?id=" + data[i]["serial"] + "&tablename=visitattachment",
            key: 3,
            downloadUrl: "../../att/visits/"+data[i]["visitid"]+'/'+data[i]["description"], // override url
            filename: data[i]["description"] // override download filename
        });
				break;
	case 'MP4': initialPreviewConfig.push(  {   
            type: "video", 
            size: 375000,
            filetype: "video/mp4",
            caption: data[i]["description"], 
            url: "../../ws/ws_deleteimage.php?id=" + data[i]["serial"] + "&tablename=visitattachment",
            key: 3,
            downloadUrl: "../../att/visits/"+data[i]["visitid"]+'/'+data[i]["description"], // override url
            filename: data[i]["description"] // override download filename
        });
				break;
	default :initialPreviewConfig.push({caption: data[i]["description"], width: "120px", url: "../../ws/ws_deleteimage.php?id=" + data[i]["serial"] + "&tablename=visitattachment"   , key: data[i]["serial"],downloadUrl: "../../att/visits/"+data[i]["description"]+"/"+data[i]["description"]});
				break;
}}	
				  		if(data.length>0){
				$('#images').fileinput('destroy');
		        $("#images").fileinput({
               'uploadUrl': '../../ws/ws_uploadimage6.php',
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
		
$(document).on('click',"[id^='Checkout_']",function(){
	  		strID=$(this).attr('id');			
			ID = strID.substring(9);	
		
				edit=0;
			//getLocation();
	});

$(document).on('click',"[id^='Checkin_']",function(){

	  		strID=$(this).attr('id');			
			visit = strID.substring(8);
			//alert(visit);
			ID=0;
			
	});
	
var serial=0;
maintenance= findGetParameter("x");
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
function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;

    return [year, month, day].join('-');
}
$("#myModal3").on('shown.bs.modal', function () {
	filltable(ID);
			
	});
	
$("#myModal").on('shown.bs.modal', function () {
document.getElementById("lblalert").style.visibility='hidden';
$('#checkindate').val(formatDate(Date.now()));
var d = new Date(),        
        h = d.getHours(),
        m = d.getMinutes();
       
    if(h < 10) h = '0' + h; 
    if(m < 10) m = '0' + m; 
    $('#checkintime').val(h+":"+m);
     
 if(ID > 0)
	 
	{
		$("#title").html("Edit Visit");

		bringData(ID);}
	else
	$("#title").html("Add Visit");
		
});

$("#myModal1").on('hidden.bs.modal', function (e) {
location.reload();
  $(this)
    .find("input,textarea,select")
       .val('')
       .end()
    .find("input[type=checkbox], input[type=radio]")
       .prop("checked", "")
       .end();
       
});
$("#myModal2").on('hidden.bs.modal', function (e) {
 
  $(this)
    .find("input,textarea,select")
       .val('')
       .end()
    .find("input[type=checkbox], input[type=radio]")
       .prop("checked", "")
       .end();
     location.reload();  
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
	getLocation();

});

	//delete a selcted person
	$(document).on('click',"[id^='del_']",function(){	
			//$(this).parent().parent().remove();
	  		strID=$(this).attr('id');			
			ID = strID.substring(4);
		
			var answer = confirm("Are You Sure You Want To Delete This Visit");
    if (answer)
			deleteUser(ID);
		
			
	});
	
	//Update users
	$(document).on('click',"[id^='Edit_']",function(){

		
	  		strID=$(this).attr('id');			
			ID = strID.substring(5);
			
edit=1;

	});
	$("#add4").click(function(){
		document.getElementById('email').value="";
	var table = $('#dataTables-example2').DataTable();
	j=0;
	data1=[];
str='';
$("input:checkbox[name=Cedit]:checked").each(function(){
  
str+=$(this).val()+";";
	
});
var newStr = str.substring(0, str.length - 1);
	document.getElementById('email').value=newStr;
$('#myModal3').modal('hide');
	});
	$("#add3").click(function(){
	
		subject=$('#subject').val();
			description=$('#description').val();
			email=$('#email').val();
			gsnote=$('#gsnote').val();
			if(subject=='' || description=='' || email=='')
			document.getElementById("elblalert").style.visibility='visible';
			else{
				
			 $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_sendemail.php",
			  data: ({id:ID,gsnote:gsnote,subject:subject,description:description,email:email}),
			  
			  dataType: 'json',
			  timeout: 10000,
			  success: function(data, textStatus, xhr) 
			  {
				  //alert(data);
  				  	if(data==1)
  				  	alert("Client doesn't have any email !");
				    else if(data==0)
				    alert("Error while sending please try again !");
				    else if(data==2){
				    alert("Email Sent !");
				    location.reload();}
				    
				
			  },
			  error: function(xhr, status, errorThrown) 
			  {

			    alert("Email Sent !");
				    location.reload();
			  }
		  });
		 }
	});
		$(document).on('click',"[id^='Email_']",function(){
	  		strID=$(this).attr('id');			
			ID = strID.substring(6);
			
	});
	
$("#add2").click(function(){
	
	var currentdate = new Date();
	var today = currentdate.getFullYear() + "-"
                + (currentdate.getMonth()+1)  + "-" 
                + currentdate.getDate() + " "  
                + currentdate.getHours() + ":"  
                + currentdate.getMinutes() + ":" 
                + currentdate.getSeconds();

client= $("#client").val();
work=$("#work").val();
if (work.length>0){
		dataa=work[0];
//			alert(1);
		for(i=1;i<work.length;i++)
	{
		dataa=dataa+","+work[i];
		
	}
	}
	else
	dataa='';
checkoutdate= $("#checkoutdate").val()+' '+$('#checkouttime').val();
notes= $("#note").val();
gsnotes= $("#gsnote").val();
	if(document.getElementById('sent').checked==true)
	sent = 1;
	else sent=0;
	
	
	if(rate<3)
	{
		addReminder(today,notes,rate,ID,projectname,offerid);
						//addComplain(ID,today,notes,rate);
						
		}

if(ID==0)	
				{
						
					//window.open("../pages/upload.php?x="+ document.getElementById("attachment").value,"_blank","width=0,height=0");
					addAttachment1(sent,gsnotes,Latitude,Longitude,notes,today,dataa);
					
					
				}
		else{ 
	//		alert(sent+' '+gsnotes+' '+Latitude+' '+Longitude+' '+notes+' '+today+' '+rate+' '+client+' '+checkoutdate+' '+dataa);
		//	window.open("../pages/upload.php?x="+ attachment,"_blank","width=0,height=0");
		UpdateAttachment1(ID,sent,gsnotes,Latitude,Longitude,notes,today,rate,client,checkoutdate,dataa);
			
			}	
	//	}
	


});
//////////////////////////////////////////////////////////////////////////////////////////////////////////
function addReminder(today,notes,rate,ID,subject,offerid)
	{		
	
		//alert(today+notes+rate+ID);
		  $.ajax({
			
			  type: 'GET',
			  url: "../../ws/ws_tcomplain.php",
			  data: ({action:4,today:today,notes:notes,rate:rate,serial:ID,subject:subject,offerid:offerid}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
	
				  if(data==0)
					  alert("Data is not inserted");  
					  else	  {
  				  	data = JSON.parse(xhr.responseText);
  				  
				  }		  
				
			  },
			  error: function(xhr, status, errorThrown) 
			  {
				//alert("1");
				//  alert(status + errorThrown);
			  }
		  });  //	

	}
/////////////////////////////////////////////////////////////////////////////////////////////////////
function addComplain(ID,today,notes,rate)
	{		
	
	//alert(ID+" "+today+" "+notes+" "+rate);
		  $.ajax({
			
			  type: 'GET',
			  url: "../../ws/ws_tcomplain.php",
			  data: ({action:1,serial:ID,notes:notes,today:today,rate:rate}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
	//	alert("1");
				  if(data==0)
					  alert("Data is not inserted");  
				  else	  {
  				  	data = JSON.parse(xhr.responseText);	
				 }			  
				
			  },
			  error: function(xhr, status, errorThrown) 
			  {
			//	alert("2");
				//  alert(status + errorThrown);
			  }
		  });  //	

	}
//////////////////////////////////////////////////////////////////////////////////////////////////
function UpdateAttachment1(serial,sent,gsnotes,Latitude,Longitude,notes,today,rate,client,checkoutdate,dataa)
	{
	 	//alert(serial);
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_tcheckin.php",
			  data: ({action:5,serial :serial,sent:sent,gsnotes:gsnotes,dataa:dataa,checkoutdate:checkoutdate,Latitude:Latitude,Longitude:Longitude,notes:notes,today:today,rate:rate,client:client}),
			  
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
		  ///////////////////////////////////////////////////////////////////////////////////////////
	function UpdateAttachment(Latitude,Longitude,project,description,today,location1,checkindate)
	{		
	
	
		  $.ajax({
			
			  type: 'GET',
			  url: "../../ws/ws_tcheckin.php",
			  data: ({action:1,checkindate:checkindate,Latitude:Latitude,Longitude:Longitude,project:project,description:description,today:today,location:location1}),
			  
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
function addAttachment(Latitude,Longitude,project,description,today,location1,checkindate)
	{		
	
	
		  $.ajax({
			
			  type: 'GET',
			  url: "../../ws/ws_tcheckin.php",
			  data: ({action:1,checkindate:checkindate,Latitude:Latitude,Longitude:Longitude,project:project,description:description,today:today,location:location1}),
			  
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
/////////////////////////////////////////////////////////////////////////////////////////////////	
$("#add1").click(function(){
location1= $("#location").val();

supervisor = $("#supervisor").val();

employees=$("#employees").val();



notes=$("#notes").val();

data="";
dataa="";
var currentdate = new Date(); 
today = currentdate.getFullYear() + "-"
                + (currentdate.getMonth()+1)  + "-" 
                + currentdate.getDate() + " "  
                + currentdate.getHours() + ":"  
                + currentdate.getMinutes() + ":" 
                + currentdate.getSeconds();
checkindate=$("#checkindate").val()+' '+$("#checkintime").val();


	if (employees.length>0){
	//	alert(1);
		data=employees[0];
		
		for(i=1;i<employees.length;i++)
	{
		
		data=data+","+employees[i];
		
	}
	}
//	alert(data);
	
//	alert(dataa);
	//alert(supervisor + "/"+ employees + "/"+ data + "/"+ dataa);
	//alert(location1+" "+supervisor+" "+notes+" "+data+" "+dataa+" "+maintenance+" "+today);
	
	if( supervisor =='')
	{
	document.getElementById("lblalert").style.visibility='visible';
	
}
	else if(ID==0)	
				{	
			
					addUser(supervisor,notes,data,maintenance,location1,today,checkindate);
				
				}
		else{
			
		UpdateUsers(ID,supervisor,notes,data,maintenance,checkindate);
			}	
	//	}
	
	

});


	

//-----------------------------------------------------------------------------------
function UpdateUsers(serial,supervisor,notes,data,maintenance,checkindate)
	{
		 
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_tvisits.php",
			  data: ({action:3,serial :serial,checkindate:checkindate,supervisor:supervisor,notes:notes,data:data,maintenance:maintenance}),
			  
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
			  //	alert("2");
				 // $("#LoadingImage").hide();
				  alert(status + errorThrown);
			  }
			  
		  }); 
		  
		  } //	

//=====================================================================================
function addUser(supervisor,notes,data,maintenance,location1,today,checkindate)
	{		
	
	//	alert(supervisor + "/"+ notes + "/"+ data + "/"+ dataa+ "/"+ maintenance);
		  $.ajax({
			
			  type: 'GET',
			  url: "../../ws/ws_tvisits.php",
			  data: ({action:1,supervisor:supervisor,notes:notes,data:data,maintenance:maintenance,checkindate:checkindate}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
		
				  if(data==0)
					  alert("Data is not inserted");  
					  else	  {
  				  	data = JSON.parse(xhr.responseText);	
				 addAttachment(Latitude,Longitude,data,notes,today,location1,checkindate);}		  
				
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
			  url: "../../ws/ws_visits.php",
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
			  url: "../../ws/ws_tvisits.php",
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
			
		  	document.getElementById("supervisor").value = data[0]["UserId"];
		document.getElementById("notes").value = data[0]["Notes"];
		var s =data[0]["checkindate"];
		var t =s.split("-");
var t3= (t[2].split(" "))[0];
document.getElementById("checkindate").value=t[0]+"-"+t[1]+"-"+ t3;
		document.getElementById("checkintime").value = (t[2].split(" "))[1];
var values=data[0]["Employees"];
$.each(values.split(","), function(i,e){
    $("#employees option[value='" + e + "']").prop("selected", true);
});

}
	}
	else
	
		showError(serial);
		}
});

