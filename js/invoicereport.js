$(document).ready(function() {
var Longitude=0;
var Latitude=0;
ID=0;
var invoice=0;
AreaID=0;
InvoiceID=0;
globalamount=0;
currencysymbol=0;
tocurrency=0;
setprice=0;
MainID=0;
 change=0;
fromcurrency=0;
tocurrency=0;
proposalchange=1;
proposal1=0;
mcode=0;
ItemID=0;
$('#dataTables-example1 tbody').on( 'click', 'tr', function (event) {
	
	thiss=this;

   row= $('#dataTables-example1').DataTable().row( this ).data() ;
  
    index= $(event.target.parentNode).index() +1;
 
} );
 function filltable(fidol,group,serial){
		//alert(fidol+' '+group+' '+serial);
if ( $.fn.DataTable.isDataTable('#dataTables-example1') ) {
  $('#dataTables-example1').DataTable().destroy();
}

$('#dataTables-example1 tbody').empty();

$.ajax({
  type: 'GET',
  url: "../../ws/ws_getitems.php",
  data: ({action:2,fidol:fidol,group:group,serial:serial}),
  cache: false,
  dataType: 'json',
  timeout: 10000,
  success: function(data, textStatus, xhr) 
  {
  
   data = JSON.parse(xhr.responseText);
   columns=[
    
        { "data": null, "name": "", "title": "",
        "render": function ( data, type, row, meta ) {
			return '<input type="checkbox" class="chcktbl_" name="Cedit" value="'+data.serial+'" id="Cedit_'+data.serial+'"/>';
		} },
		{ "data": "code", "name": "Code", "title": "Code" }
	];
	if(data[0]['currencyS']=='USD'){
		columns.push({"data": null, "name": "Price USD", "title": "Price USD",
	   "render": function ( data, type, row, meta ) {
		  return '<a href="#" class="editor123" data-type="text" data-placement="right" data-title="Enter price">'+data.priceusd+'</a>';	
	  }  });
	}
	else if(data[0]['currencyS']=='AED'){
		columns.push({"data": null, "name": "Price AED", "title": "Price AED",
	   "render": function ( data, type, row, meta ) {
		  return '<a href="#" class="editor123" data-type="text" data-placement="right" data-title="Enter price">'+data.priceaed+'</a>';	
	  }  });
	}
	else if(data[0]['currencyS']=='KD'){
		columns.push({"data": null, "name": "Price KD", "title": "Price KD",
	   "render": function ( data, type, row, meta ) {
		  return '<a href="#" class="editor123" data-type="text" data-placement="right" data-title="Enter price">'+data.pricekd+'</a>';	
	  }  });
	}
	else {
		columns.push({"data": null, "name": "Price USD", "title": "Price USD",
	   "render": function ( data, type, row, meta ) {
		  return '<a href="#" class="editor123" data-type="text" data-placement="right" data-title="Enter price">'+data.priceusd+'</a>';	
	  }  });
	}
	
	columns.push({"data": null, "name": "Quantity", "title": "Quantity",
		"render": function ( data, type, row, meta ) {
		   
		  return '<a href="#" class="editor12" data-type="text" data-placement="right" data-title="Enter quantity">1</a>';
	  } });
	  columns.push(
        { "data": "description", "name": "Description", "title": "Description" },
        { "data": "dimension", "name": "Dimension", "title": "Dimension" },
        { "data": "ddesc", "name": "Detailed Description", "title": "Detailed Description" },
        { "data": "groupdesc", "name": "Group", "title": "Group" },
        { "data": "unit", "name": "Unit", "title": "Unit" },
      );
     
     
      if(data[0]['canedit']==1 && data[0]['candelete']==1){
      	columns.push({ "data":  null, "name": "Action", "title": "Action",
		"render": function ( data, type, row, meta ) {
			return '<a id="edit" href="#" <p class="fa fa-edit"></p></a> &nbsp;&nbsp;&nbsp;&nbsp;<a id="delete" href="#" <p class="fa fa-trash"></p></a>';
		} });
      }
      else if(data[0]['canedit']==1){
      		columns.push({ "data":  null, "name": "Action", "title": "Action",
		"render": function ( data, type, row, meta ) {
			return '<a id="edit" href="#" <p class="fa fa-edit"></p></a>';
		} });
      }
      else if(data[0]['candelete']==1){
      		columns.push({ "data":  null, "name": "Action", "title": "Action",
		"render": function ( data, type, row, meta ) {
			return '<a id="delete" href="#" <p class="fa fa-trash"></p></a>';
		} });
      }
$('#dataTables-example1').DataTable({
	
     data: data,
	responsive: true,
	
	
			"aaSorting": [],
			"lengthMenu": [[-1], ["All"]],
		 "columns": columns,
		
          "createdRow": function( row, data, dataIndex){
               
                     $('td', row).css('background-color', data.color);
                
            }
			   }); 
		
                $('.editor123').editable();
                                $('.editor12').editable();
  },
  error: function(xhr, status, errorThrown) 
  {

  }
  });


}
	$('body').on('hidden.bs.modal', function () {
    if($('.modal.in').length > 0)
    {
        $('body').addClass('modal-open');
    }
});
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
offer=findGetParameter('x');

//fillSections();
//getUsers();
 $('select[id="offer"]').change(function () {
 	serial=$("#offer").val();
	 company=$("#company").val();
 	
	 fillincluding1(company);
	 fillrequirement1(company);
if(ID==0){
 	comp=document.getElementById('company').value;
 	fillnewreq(serial,comp);

 }
 	if(proposalchange==1)
 	{
 		fillOffer(serial);
 	}
 	else{
 		proposalchange=1;
 	}
 	document.getElementById('offerdesc').value=this.options[this.selectedIndex].text;
 	//document.getElementById('offerdesc').value=$('#offer').text();
 	

    });
     $('select[id="fgroup"]').change(function () {
 	group=$("#fgroup").val();
 	
	fidol = $('#fidol').val();
	//alert(fidol);
	
 	filltable(fidol,group,ID);
 	
 	//document.getElementById('offerdesc').value=$('#offer').text();
 	
    });
 $('select[id="company"]').change(function () {
 	
 	company=$("#company").val();
 	
fillincluding1(company);
fillrequirement1(company);
bringData1(company);
 	//fillOffer(serial);
 	
    });
    function fillOffer(serial)
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
		
		
				  	count=data.length;
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

if(change==0)
$("#client").val(data[0]["CustomerID"]).trigger("change");	
else
change=0;
						tocurrency=data[0]['currency'];
						  currencysymbol=data[0]['currencyS'];
						  	
						 
						  mcode=Number(data[0]['mcode'])+1;
						
						 if(data[0]['RG']==1){
						 
						 	document.getElementById('proposal').value=yyyy+'/'+data[0]['Country']+'/RG'+mcode+"/"+data[0]['ProjectName'];
						 }
						 else{
						 	
						 	document.getElementById('proposal').value=yyyy+'/'+data[0]['Country']+'/GW'+mcode+"/"+data[0]['ProjectName'];
						 }
			  },
			  
			  error: function(xhr, status, errorThrown) 
			  {
			  
  				//  $("#LoadingImage").hide();
			//	 //alert(status + errorThrown);
				  
			  }
		  });  	
	}
	$("#myModal4").on('shown.bs.modal', function () {
document.getElementById("mlblalert").style.visibility='hidden';
document.getElementById("email").value="hello@greenstudios.net";
document.getElementById("phone").value="+96170411331";
document.getElementById("visits").value=12;
 if(MainID > 0)
	 
	{
		$("#mtitle").html("Edit Maintenance");

		bringMaintenance(MainID);
		}
	else
	$("#mtitle").html("Add Maintenance");
		
});
$("#myModal").on('shown.bs.modal', function () {
document.getElementById("lblalert").style.visibility='hidden';

 if(ID > 0)
	 
	{
		$("#title").html("Edit Report");

		bringData(ID);
		getAreas(ID);
		getInvoices(ID);
		getMaintenances(ID);
		
		}
	else
	{$("#title").html("Add Report");
	$("#tblarea").empty();
	$("#tblinv").empty();
	}
});
$("#myModal3").on('shown.bs.modal', function () {
	
document.getElementById("ilblalert").style.visibility='hidden';

 if(InvoiceID > 0)
	 
	{
		$("#ititle").html("Edit Invoice");

		bringInvoices(InvoiceID);
		}
	else
	$("#ititle").html("Add Invoice");
		
});
$("#myModal1").on('shown.bs.modal', function () {
document.getElementById("alblalert").style.visibility='hidden';

 if(AreaID > 0)
	 
	{
		$("#title1").html("Edit Area");

		bringDataArea(AreaID);
		}
	else
	{$("#title1").html("Add Area");
	
	}
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
  
     $.ajax({
			
			  type: 'GET',
			  url: "../../ws/ws_tinvoicereport.php",
			  data: ({action:5}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
			  },
			  error: function(xhr, status, errorThrown) 
			  {
			  }
		  });    
});
$("#myModal4").on('hidden.bs.modal', function (e) {
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
$(document).on('click',"[id='Add']",function(){

			ID=0;
			proposal1=0;
			client=findGetParameter('c');
		if(offer != null)
		{document.getElementById("offer").value=offer;
		$("#offer").val(offer).trigger("change");
}



	  $.ajax({
			
			  type: 'GET',
			  url: "../../ws/ws_tinvoicereport.php",
			  data: ({action:4,offer:offer,client:client}),
			  
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
		  });
		  
	});
$(document).on('click',"[id='Addarea']",function(){

		AreaID=0;
		
		if(ID == 0)
		{document.getElementById("lblalert2").style.visibility='visible';} 
		else{$('#myModal1').modal('show');
}
	});
	$(document).on('click',"[id='AddInv']",function(){

		InvoiceID=0;
		
		if(ID == 0)
		{document.getElementById("lblalert3").style.visibility='visible'; }
		else{
		
			filltable($("#fidol").val(),$("#fgroup").val(),ID);
			$('#myModal2').modal('show');
}
	});
	$(document).on('click',"[id='AddMain']",function(){

		MainID=0;
		
		if(ID == 0)
		{document.getElementById("mlblalert3").style.visibility='visible'; }
		else{
			
			$('#myModal4').modal('show');
}
	});
	$(document).on('click',"[id^='del_']",function(){	
			//$(this).parent().parent().remove();
	  		strID=$(this).attr('id');			
			ID = strID.substring(4);
			var answer = confirm("Are You Sure You Want To Delete This Invoice Report");
    if (answer)
			deleteAttachment(ID);
		
			
	});
	$(document).on('click',"[id^='dell1_']",function(){	
			//$(this).parent().parent().remove();
	  		strID=$(this).attr('id');			
			AreaID = strID.substring(6);
			var answer = confirm("Are You Sure You Want To Delete This Area");
    if (answer)
			deleteArea(AreaID);
		
			
	});
	$(document).on('click',"[id^='delll1_']",function(){	
			//$(this).parent().parent().remove();
	  		strID=$(this).attr('id');			
			InvoiceID = strID.substring(7);
			var answer = confirm("Are You Sure You Want To Delete This Invoice");
    if (answer)
			deleteInvoice(InvoiceID);
		
			
	});
	$(document).on('click',"[id^='dellll1_']",function(){	
			//$(this).parent().parent().remove();
	  		strID=$(this).attr('id');			
			MainID = strID.substring(8);
			var answer = confirm("Are You Sure You Want To Delete This Maintenance");
    if (answer)
			deleteMaintenance(MainID);
		
			
	});
	//Update users
	$(document).on('click',"[id^='Edit_']",function(){
	  		strID=$(this).attr('id');			
			ID = strID.substring(5);
		
	});
	$(document).on('click',"[id^='Dup_']",function(){
	  		strID=$(this).attr('id');		
	  			proposal1=1;
			invoice = strID.substring(4);
		
		$.ajax({
			  type: 'GET',
			  url: "../../ws/ws_tinvoicereport.php",
			  data: ({action:6,id :invoice}),
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  { 
			  	data = JSON.parse(xhr.responseText);
			  	ID=data;
			  	$('#myModal').modal('show');
			  },
			  error: function(xhr, status, errorThrown) 
			  {
			//	alert(status+' '+errorThrown);
			  }
		  });
	});
	$(document).on('click',"[id^='Editt_']",function(){
	  		strID=$(this).attr('id');			
			AreaID = strID.substring(6);
			
	});
	$(document).on('click',"[id^='Edittt_']",function(){
	  		strID=$(this).attr('id');			
			InvoiceID = strID.substring(7);
			
	});

$(document).on('click',"[id^='check_']",function(){
	  		strID=$(this).attr('id');			
			ItemID = strID.substring(6);
			//alert(ItemID);
			
 
			if(document.getElementById("check_"+ItemID).checked == true){
				 


$.ajax({
			  type: 'GET',
			  url: "../../ws/ws_tupdate.php",
			  data: ({action:1,id :ItemID,flag:1}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
				 // $("#LoadingImage").hide();
				
				  // if(data==0)
				  // 	alert("Row not deleted!");
		 
			  },
			  error: function(xhr, status, errorThrown) 
			  {
				 
		 
				 alert(status + errorThrown);
			  }
		  });  //	





			}
			 else
			 {

			 	$.ajax({
			  type: 'GET',
			  url: "../../ws/ws_tupdate.php",
			  data: ({action:1,id :ItemID,flag:0}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
				 // $("#LoadingImage").hide();
				
				  // if(data==0)
				  // 	alert("Row not deleted!");
		 
			  },
			  error: function(xhr, status, errorThrown) 
			  {
				 
		 
				 alert(status + errorThrown);
			  }
		  });  //	
			 }
			 


  





















			
	});



		$(document).on('click',"[id^='Editttt_']",function(){
	  		strID=$(this).attr('id');			
			MainID = strID.substring(8);
			
	});
	function deleteInvoice(idval)
	{
		
		//$("#LoadingImage").show();
		 
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_tinvoicedetail.php",
			  data: ({action:2,id :idval}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
				 // $("#LoadingImage").hide();
				
				  if(data==0)
				  	alert("Row not deleted!");
			getInvoices(ID);
			  },
			  error: function(xhr, status, errorThrown) 
			  {
				 
			getInvoices(ID);
				//  //alert(status + errorThrown);
			  }
		  });  //	

	}
	function deleteMaintenance(idval)
	{
		
		//$("#LoadingImage").show();
		 
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_toffermaintenance.php",
			  data: ({action:2,id :idval}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
				 // $("#LoadingImage").hide();
				
				  if(data==0)
				  	alert("Row not deleted!");
			getMaintenances(ID);
			  },
			  error: function(xhr, status, errorThrown) 
			  {
				 
			getMaintenances(ID);
				//  //alert(status + errorThrown);
			  }
		  });  //	

	}
	function deleteArea(idval)
	{
		
		//$("#LoadingImage").show();
		 
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_tarea.php",
			  data: ({action:2,id :idval}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
				 // $("#LoadingImage").hide();
				
				  if(data==0)
				  	alert("Row not deleted!");
			getAreas(ID);
			  },
			  error: function(xhr, status, errorThrown) 
			  {
				 
			
				//  //alert(status + errorThrown);
			  }
		  });  //	

	}
	//-----------------------------------------------------------------------------
		function fillrequirement(requirement,company)
	{
	
	
			//$("#LoadingImage").show();
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_requirement.php",
			  data: ({action:0,id:company,project:$('#offer').val()}),
			  
			  dataType: 'json',
			  timeout: 10000,
			  success: function(data, textStatus, xhr) 
			  {
			 
		  		//  $("#LoadingImage").hide();				  
				
				  if(data==0)
					 {}// alert("Data couldn't be loaded!");
				  else{
				  	
				  	data = JSON.parse(xhr.responseText);				  				 
				  	count=data.length;
				  	
		var items;
		//$("#employee").html("");
		$("#requirement").html("");
		if(count>0)
		{
			items="";
			var str_array = requirement.split(',');
			  $.each(data,function(index,item) 
    {
    	y="";
    	
    	if(str_array.indexOf(item.serial)>=0){
    		
    		y=" selected";
    	}
    	
    //  $("#employee").append("<option value='"+item.serial+"'>"+item.fullname+"</option>");
      $("#requirement").append("<option value='"+item.serial+"'" +y+ ">"+item.description+"</option>");
    //  alert(items);
      
    }); 
}
//$("#employee").val(0);
	 }
	  },
	 error: function(xhr, status, errorThrown) 
		 {
		
		//  $("#LoadingImage").hide();				  
		//  //alert(status + errorThrown);				  
		}
		  });  	
		
	}
	////////////////////////////////////////////////////////////////////////////
		function fillrequirement1(company)
	{
	
		
			//$("#LoadingImage").show();
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_requirement.php",
			  data: ({action:0,id:company,project:$('#offer').val()}),
			  
			  dataType: 'json',
			  timeout: 10000,
			  success: function(data, textStatus, xhr) 
			  {
			  
		  		//  $("#LoadingImage").hide();				  
				
				  if(data==0)
					 {}// alert("Data couldn't be loaded!");
				  else{
				  	
				  	data = JSON.parse(xhr.responseText);				  				 
				  	count=data.length;
				  	
		var items;
		//$("#employee").html("");
		$("#requirement").html("");
		if(count>0)
		{
			items="";
			
			  $.each(data,function(index,item) 
    {
    
    	
    //  $("#employee").append("<option value='"+item.serial+"'>"+item.fullname+"</option>");
      $("#requirement").append("<option value='"+item.serial+"'>"+item.description+"</option>");
    //  alert(items);
      
    }); 
}
//$("#employee").val(0);
	 }
	  },
	 error: function(xhr, status, errorThrown) 
		 {
		
		//  $("#LoadingImage").hide();				  
		//  //alert(status + errorThrown);				  
		}
		  });  	
		
	}
	//=======================================================================================
	 $('#quantity').change(function () {

 	//itemchange();
 	document.getElementById("total").value=Number($("#quantity").val()*$("#price").val());
 	
    });
     $('#fees').change(function () {
 
 	document.getElementById('mtotal').value= $('#fees').val()*$('#visits').val();
 	
    });
     $('#visits').change(function () {
 	document.getElementById('mtotal').value= $('#fees').val()*$('#visits').val();
    });
    $('#price').change(function () {
 	document.getElementById("total").value=Number($("#quantity").val()*$("#price").val());
    });
    function itemchange(){
    	globalamount=0;
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
		
	
		 if(currencysymbol!='KD' && currencysymbol!='AED' && currencysymbol!='USD')
		 {
		 	
		 
		 		$.ajax({
			  type: 'GET',
			  url: "../../ws/ws_getCurrency.php",
			  data: ({action:1,dat:today,fromcurrency:fromcurrency,tocurrency:tocurrency}),			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			 
			  {
			
			  	  data1 = JSON.parse(xhr.responseText);
			  	 
			
				    globalamount =globalamount+ ($('#price').val() * data1[0]['ToAmount'] / data1[0]['FromAmount'])	;		  
				 	
				  document.getElementById("total").value=Number($("#quantity").val()*globalamount);
			  },
			  
			  error: function(xhr, status, errorThrown) 
			  {
				  
			  }
		  }); 
		 }
else{

		document.getElementById("total").value=Number($("#quantity").val()*$('#price').val());	}
    }
	//===========================================================================================
	/////////////////////////////////////////////////////////////////////////////////
	function fillincluding(including,company)
	{
	
	
			//$("#LoadingImage").show();
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_including.php",
			  data: ({action:0,id:company,project:$('#offer').val()}),
			  
			  dataType: 'json',
			  timeout: 10000,
			  success: function(data, textStatus, xhr) 
			  {
			 
		  		//  $("#LoadingImage").hide();				  
				  $("#including").html("");
				  if(data==0 || data==null)
					 {}// alert("Data couldn't be loaded!");
				  else{
				  	
				  	data = JSON.parse(xhr.responseText);				  				 
				  	count=data.length;
				  	
		var items;
		//$("#employee").html("");
		
		if(count>0)
		{
			items="";
			var str_array = including.split(',');
			  $.each(data,function(index,item) 
    {
    	y="";
    	
    	if(str_array.indexOf(item.serial)>=0){
    		
    		y=" selected";
    	}
    	
    //  $("#employee").append("<option value='"+item.serial+"'>"+item.fullname+"</option>");
      $("#including").append("<option value='"+item.serial+"'" +y+ ">"+item.description+"</option>");
    //  alert(items);
      
    }); 
}
//$("#employee").val(0);
	 }
	  },
	 error: function(xhr, status, errorThrown) 
		 {
		
		//  $("#LoadingImage").hide();				  
		//  //alert(status + errorThrown);				  
		}
		  });  	
		
	}
	$('select[id="item"]').change(function () {
		
 	if(setprice==1){
 		setprice=0;
 	}
 	else{
 	item=$("#item").val();
 	
getItem(item);
}
    });
    function getItem(serial)
	{

	//$("#LoadingImage").show();
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_items.php",
			  data: ({id:serial}),			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			 
			  {
			 
				// $("#LoadingImage").hide();
				  data = JSON.parse(xhr.responseText);	
				  
				  if(currencysymbol!='KD' && currencysymbol !='AED')
					{price=data[0]['priceusd'];	
					}
					else  if(currencysymbol=='USD')
					price=data[0]['priceusd'];
					else  if(currencysymbol=='KD')
					price=data[0]['pricekd'];
					else  if(currencysymbol=='AED')
					price=data[0]['priceaed'];
					
					
					//alert(price);
					if(setprice==1){
					fromcurrency=2; 
					document.getElementById('price').value=price;
					}
					itemchange();
			  },
			  
			  error: function(xhr, status, errorThrown) 
			  {
			  
  				//  $("#LoadingImage").hide();
				// //alert(status + errorThrown);
				  
			  }
		  });  	
	}
	//===================================================================================================
	$("#add3").click(function(){
	 var table = $('#dataTables-example1').DataTable();
	  j=0;
	  data1=[];

$("input:checkbox[name=Cedit]:checked").each(function(){
	price=$('#Cedit_'+$(this).val()).parent().parent().children(thiss).children('.editor123').html();
      
      	quantity=$('#Cedit_'+$(this).val()).parent().parent().children(thiss).children('.editor12').html();
       
      	total=Number(price)*Number(quantity);
      	data1.push({item:$(this).val(),price :price,quantity:quantity,total:total});
  
});
if(data1 != ''){
 $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_tinvoicedetail.php",
			  data: ({action:4,data1:data1,invoice:ID}),			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 			 
			  {
			  	getInvoices(ID);
			//location.reload();
			  },
			  
			  error: function(xhr, status, errorThrown) 
			  {				  
			  }
		  }); 
		  } 
//$('#item').val(data1);
//$('#item').trigger('change');
$('#myModal2').modal('hide');

//$.each($('#item'),function (){
//	$(this).select2('val', data1);
//	});
});

$("#Invadd1").click(function(){
	 var table = $('#dataTables-example1').DataTable();
	  j=0;
	  data1=[];

$("input:checkbox[name=Cedit]:checked").each(function(){
	price=$('#Cedit_'+$(this).val()).parent().parent().children(thiss).children('.editor123').html();
      
      	quantity=$('#Cedit_'+$(this).val()).parent().parent().children(thiss).children('.editor12').html();
      	total=Number(price)*Number(quantity);
      	data1.push({item:$(this).val(),price :price,quantity:quantity,total:total});
  
});
if(data1 != ''){
 $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_tinvoicedetail.php",
			  data: ({action:4,data1:data1,invoice:ID}),			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 			 
			  {
			  	getInvoices(ID);
			//location.reload();
			  },
			  
			  error: function(xhr, status, errorThrown) 
			  {				  
			  }
		  }); 
		  } 
//$('#item').val(data1);
//$('#item').trigger('change');
$('#myModal2').modal('hide');

//$.each($('#item'),function (){
//	$(this).select2('val', data1);
//	});
});
	//====================================================================================================	
	function fillincluding1(company)
	{
	
	
			//$("#LoadingImage").show();
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_including.php",
			  data: ({action:0,id:company,project:$('#offer').val()}),
			  
			  dataType: 'json',
			  timeout: 10000,
			  success: function(data, textStatus, xhr) 
			  {
			  	
		  		//  $("#LoadingImage").hide();				  
				  $("#including").html("");
				  if(data==0)
					 {}// alert("Data couldn't be loaded!");
				  else{
				  
				  	data = JSON.parse(xhr.responseText);		
				 	  				 
				  	count=data.length;
				  		
		var items;
		//$("#employee").html("");
		
		
		if(count>0)
		{
			
			items="";
			  $.each(data,function(index,item) 
    {

    	
    //  $("#employee").append("<option value='"+item.serial+"'>"+item.fullname+"</option>");
      $("#including").append("<option value='"+item.serial+"'>"+item.description+"</option>");
    //  alert(items);
      
    }); 
}
//$("#employee").val(0);
	 }
	  },
	 error: function(xhr, status, errorThrown) 
		 {
		
		//  $("#LoadingImage").hide();				  
		//  //alert(status + errorThrown);				  
		}
		  });  	
		
	}	
	//==============================================================================
		$("#fidol").change(function(){
if(document.getElementById('fidol').checked==true)
	fidol = 1;
	else fidol=0;
	fidol=$('#fidol').val();
	
	filltable(fidol,$('#fgroup').val(),ID);
});

	//===============================================================================
	$("#madd1").click(function(){

visits= $("#visits").val();
email= $("#email").val();
phone= $("#phone").val();
currency= 0+$("#currency1").val();
total= $("#mtotal").val();
fees= $("#fees").val();
spotfees= $("#spotfees").val();
agreement= $("#agreement").val();
if( agreement=='')
document.getElementById("lblalert").style.visibility='visible';
else{
if(MainID==0)	
				{
						
					//window.open("../pages/upload.php?x="+ document.getElementById("attachment").value,"_blank","width=0,height=0");
					addNote(ID,visits,currency,total,fees,agreement,email,phone,spotfees);
					
					
				}
		else{ 
		//	window.open("../pages/upload.php?x="+ attachment,"_blank","width=0,height=0");
		UpdateNote(MainID,ID,visits,currency,total,fees,agreement,email,phone,spotfees);
			
			}	
	//	}
	
}

});
function UpdateNote(serial,offerid,visits,currency,total,fees,agreement,email,phone,spotfees)
	{
		
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_toffermaintenance.php",
			  data: ({action:3,serial :serial,spotfees:spotfees,offerid:offerid,visits:visits,currency:currency,total:total,fees:fees,agreement:agreement,email:email,phone:phone}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
			
				
				  if(data==0)
				  	alert("No Update!");
				  else	  {
  				  	data = JSON.parse(xhr.responseText);	
				  getMaintenances(ID);
				  $('#myModal4').modal('hide');
				  }
  				  				  				 			  

			  },
			  error: function(xhr, status, errorThrown) 
			  {
			  //	alert("2");
				 // $("#LoadingImage").hide();
				//  //alert(status + errorThrown);
			  }
			  
		  }); 
		  
		  } //	

//=====================================================================================
function addNote(offerid,visits,currency,total,fees,agreement,email,phone,spotfees)
	{		
	
//	alert(attachment+" "+paperid+" "+notes);
		  $.ajax({
			
			  type: 'GET',
			  url: "../../ws/ws_toffermaintenance.php",
			  data: ({action:1,spotfees:spotfees,offerid:offerid,visits:visits,currency:currency,total:total,fees:fees,agreement:agreement,email:email,phone:phone}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
	//	alert("1");
				  if(data==0)
					  alert("Data is not inserted");  
				  else	  {
  				  	data = JSON.parse(xhr.responseText);	
				  getMaintenances(ID);
				  document.getElementById("currency1").value='';
		document.getElementById("fees").value='';
		
		document.getElementById("agreement").value='';
		document.getElementById("mtotal").value='';
		
		document.getElementById("spotfees").value='';}			  
				
			  },
			  error: function(xhr, status, errorThrown) 
			  {
			//	alert("2");
				//  //alert(status + errorThrown);
			  }
		  });  //	

	}
	//=================================================================================
	
$("#add1").click(function(){


//title= $("#title1").val();
company=0+$("#company").val();
body3=$("#body3").val();
discount=0+$("#discount").val();
subject= $("#subject").val();
project= $("#offer").val();
requirement= $("#requirement").val();
including= $("#including").val();
delivery= $("#delivery").val();
excluding= $("#excluding").val();
notes= $("#notes").val();
payment= $("#payment").val();
paymentd= $("#paymentd").val();
warranty= $("#warranty").val();
validity= $("#validity").val();
//address=$("#address").val();
proposal=$("#proposal").val();
body1=$("#body1").val();
body2=$("#body2").val();
client=0+$("#client").val();
offerdesc=$("#offerdesc").val();
if(document.getElementById('ispercentage').checked==true)
	ispercentage = 1;
	else ispercentage=0;
	rarea=0;
	ritem=0;
if(document.getElementById('rarea').checked==true)
	rarea=1;
	else
	ritem=1;
including=0;
	include=$("#including").val();
	
	if (include.length>0){
		including=include[0];
		
		for(i=1;i<include.length;i++)
	{
		including=including+","+include[i];
		
	}
	}
	requirement=0;
	require=$("#requirement").val();
	
	if (require.length>0){
		requirement=require[0];
		
		for(i=1;i<require.length;i++)
	{
		requirement=requirement+","+require[i];
		
	}
	}
	
	if( title=='' || project=='')
document.getElementById("lblalert").style.visibility='visible';
else{
if(ID==0)	
				{
						
					//window.open("../pages/upload.php?x="+ document.getElementById("attachment").value,"_blank","width=0,height=0");
					addAttachment(body3,mcode,ritem,rarea,paymentd,offerdesc,client,ispercentage,discount,company,excluding,notes,subject,project,requirement,including,delivery,payment,warranty,validity,proposal,body1,body2);
					
					
				}
		else{ 
			
		//	window.open("../pages/upload.php?x="+ attachment,"_blank","width=0,height=0");
		UpdateAttachment(body3,ID,ritem,rarea,paymentd,offerdesc,client,ispercentage,discount,company,excluding,notes,subject,project,requirement,including,delivery,payment,warranty,validity,proposal,body1,body2);
			
			}	
	//	}
	
}

});
$("#aadd1").click(function(){


description= $("#adescription").val();
total= $("#atotal").val();
if( description=='' || total=='')
document.getElementById("alblalert").style.visibility='visible';
else{
if(AreaID==0)	
				{
						
					//window.open("../pages/upload.php?x="+ document.getElementById("attachment").value,"_blank","width=0,height=0");
					addArea(description,total,ID);
					
					
				}
		else{ 
		//	window.open("../pages/upload.php?x="+ attachment,"_blank","width=0,height=0");
		UpdateArea(AreaID,description,total,ID);
			
			}	
	//	}
	
}

});
$("#iadd1").click(function(){


item= 0+$("#item").val();
quantity= 0+$("#quantity").val();
total= 0+$("#total").val();
price=$('#price').val();
//alert(item+" "+quantity+" "+total);
if( item=='' || item==0)
document.getElementById("lblalert").style.visibility='visible';
else{

		UpdateInvoice(InvoiceID,price,item,total,quantity,ID);
	
}

});
function UpdateInvoice(serial,price,item,total,quantity,invoice)
	{
		
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_tinvoicedetail.php",
			  data: ({action:3,serial :serial,price:price,item:item,total:total,invoice:invoice,quantity:quantity}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
			
				
				  if(data==0)
				  	alert("No Update!");
				 	  else	  {
  				  	data = JSON.parse(xhr.responseText);
  				  	getInvoices(invoice);	
				  $('#myModal3').modal('hide');}			  				 			  

			  },
			  error: function(xhr, status, errorThrown) 
			  {
			  //	alert("2");
				 // $("#LoadingImage").hide();
				//  //alert(status + errorThrown);
			  }
			  
		  }); 
		  
		  }
function UpdateArea(serial,description,total,invoice)
	{
		
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_tarea.php",
			  data: ({action:3,serial :serial,description:description,total:total,invoice:invoice}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
			
				
				  if(data==0)
				  	alert("No Update!");
				 	  else	  {
  				  	data = JSON.parse(xhr.responseText);	
				  getAreas(invoice);
				  $('#myModal1').modal('hide');}			  				 			  

			  },
			  error: function(xhr, status, errorThrown) 
			  {
			  //	alert("2");
				 // $("#LoadingImage").hide();
				//  //alert(status + errorThrown);
			  }
			  
		  }); 
		  
		  }
function addArea(description,total,invoice)
	{		
	
//	alert(attachment+" "+paperid+" "+notes);
		  $.ajax({
			
			  type: 'GET',
			  url: "../../ws/ws_tarea.php",
			  data: ({action:1,description:description,total:total,invoice:invoice}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
	//	alert("1");
				  if(data==0)
					  alert("Data is not inserted");  
				 	  else	  {
  				  	data = JSON.parse(xhr.responseText);	
				  getAreas(invoice);
				  document.getElementById("adescription").value=0;
			document.getElementById("atotal").value=0;
				  }		  
				
			  },
			  error: function(xhr, status, errorThrown) 
			  {
			//	alert("2");
				//  //alert(status + errorThrown);
			  }
		  });  //	

	}
	function getAreas(serial)
	{
	
	//$("#LoadingImage").show();
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_area.php",
			  data: ({action:2,id:serial}),			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			 
			  {
				
				// $("#LoadingImage").hide();
				  data = JSON.parse(xhr.responseText);	
				  populateArea(data);				  
			  },
			  
			  error: function(xhr, status, errorThrown) 
			  {
			  
  				//  $("#LoadingImage").hide();
				 ////alert(status + errorThrown);
				  
			  }
		  });  	
	}	
		function getInvoices(serial)
	{
	
	//$("#LoadingImage").show();
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_invoicedetail.php",
			  data: ({action:2,id:serial}),			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			 
			  {
				
				// $("#LoadingImage").hide();
				  data = JSON.parse(xhr.responseText);	
				
				  populateInvoice(data);				  
			  },
			  
			  error: function(xhr, status, errorThrown) 
			  {
			  
  				//  $("#LoadingImage").hide();
				 //alert(status + errorThrown);
				  
			  }
		  });  	
	}	
	function getMaintenances(serial)
	{
	
	//$("#LoadingImage").show();
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_offermaintenance.php",
			  data: ({action:2,id:serial}),			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			 
			  {
				
				// $("#LoadingImage").hide();
				  data = JSON.parse(xhr.responseText);	
				
				  populateMain(data);				  
			  },
			  
			  error: function(xhr, status, errorThrown) 
			  {
			  
  				//  $("#LoadingImage").hide();
				 ////alert(status + errorThrown);
				  
			  }
		  });  	
	}
	function populateArea(data)
	{		
		
	$("#tblarea").empty();
		count=data.length;
		var item;

		if(count>0)
		{			
			
		   $.each(data, function(index, row) {
				item = "<tr id='tr_"+row.serial+"'>";
                item+=   "<td>"+row.description+"</td>";
                 item+=   "<td>"+row.total+"</td>";
                item+="<td><a  id='Editt_"+row.serial+"'  data-toggle='modal' data-target='#myModal1' ><p class='fa fa-edit'></p></a></td>";
  
               item+="<td><a  id='dell1_"+row.serial+"' ><p class='fa fa-trash-o'></p></a></td>";
                item+= "</tr>";
				$("#tblarea").append(item);
			});
			
		}
	}
	function populateInvoice(data)
	{		
		
	$("#tblinv").empty();
		count=data.length;
		var item;

		if(count>0)
		{			
			
		   $.each(data, function(index, row) {
				item = "<tr id='tr_"+row.serial+"'>";
				 item+=   "<td>"+row.itemN+"</td>";
				 if(row.viewprices==0){ item+=   "<td><input type='checkbox'  id='check_"+row.serial+"' ></td>";}
               else  item+=   "<td><input type='checkbox' checked  id='check_"+row.serial+"' ></td>";
                 item+=   "<td>"+row.price+"</td>";
                  item+=   "<td>"+row.quantity+"</td>";
                   item+=   "<td>"+row.total+"</td>";
                item+="<td><a  id='Edittt_"+row.serial+"'  data-toggle='modal' data-target='#myModal3' ><p class='fa fa-edit'></p></a></td>";
  
               item+="<td><a  id='delll1_"+row.serial+"' ><p class='fa fa-trash-o'></p></a></td>";
                item+= "</tr>";
				$("#tblinv").append(item);
			});
			
		}
	}
	function populateMain(data)
	{		
		
	$("#tblmain").empty();
		count=data.length;
		var item;

		if(count>0)
		{			
			
		   $.each(data, function(index, row) {
				item = "<tr id='tr_"+row.serial+"'>";
                item+=   "<td>"+row.projectname+"</td>";
                 item+=   "<td>"+row.agreement+"</td>";
                  item+=   "<td>"+row.currencyS+"</td>";
                   item+=   "<td>"+row.total+"</td>";
                item+="<td><a  id='Editttt_"+row.serial+"'  data-toggle='modal' data-target='#myModal4' ><p class='fa fa-edit'></p></a></td>";
  
               item+="<td><a  id='dellll1_"+row.serial+"' ><p class='fa fa-trash-o'></p></a></td>";
                item+= "</tr>";
				$("#tblmain").append(item);
			});
			
		}
	}
//===================================================================================

function UpdateAttachment(body3,serial,ritem,rarea,paymentd,offerdesc,client,ispercentage,discount,company,excluding,notes,subject,project,requirement,including,delivery,payment,warranty,validity,proposal,body1,body2)
	{
	//	alert(serial+' -- '+ritem+' -- '+rarea+' -- '+paymentd+' -- '+offerdesc+' -- '+client+' -- '+ispercentage+' -- '+discount+' -- '+company+' -- '+excluding+' -- '+notes+' -- '+subject+' -- '+project+' -- '+requirement+' -- '+including+' -- '+delivery+' -- '+payment+' -- '+warranty+' -- '+validity+' -- '+proposal+' -- '+body1+' -- '+body2);
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_tinvoicereport.php",
			  data: ({action:3,body3:body3,serial :serial,ritem:ritem,rarea:rarea,paymentd:paymentd,offerdesc:offerdesc,client:client,ispercentage:ispercentage,discount:discount,company:company,excluding:excluding,notes:notes,subject:subject,project:project,requirement:requirement,including:including,delivery:delivery,payment:payment,warranty:warranty,validity:validity,proposal:proposal,body1:body1,body2:body2}),
			  
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
			  //	location.reload();
			  //	alert("2");
				 // $("#LoadingImage").hide();
				//  //alert(status + errorThrown);
			  }
			  
		  }); 
		  
		  } //	

//=====================================================================================
function addAttachment(body3,mcode,ritem,rarea,paymentd,offerdesc,client,ispercentage,discount,company,excluding,notes,subject,project,requirement,including,delivery,payment,warranty,validity,proposal,body1,body2)
	{		
	
//	alert(attachment+" "+paperid+" "+notes);
		  $.ajax({
			
			  type: 'GET',
			  url: "../../ws/ws_tinvoicereport.php",
			  data: ({action:1,body3:body3,mcode:mcode,ritem:ritem,rarea:rarea,paymentd:paymentd,offerdesc:offerdesc,client:client,ispercentage:ispercentage,discount:discount,company:company,excluding:excluding,notes:notes,subject:subject,project:project,requirement:requirement,including:including,delivery:delivery,payment:payment,warranty:warranty,validity:validity,proposal:proposal,body1:body1,body2:body2}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
	//	alert("1");
				  if(data==0)
					  alert("Data is not inserted");  
				 	  else	  {
  				  	data = JSON.parse(xhr.responseText);
  				  	invoice=data;
  				  	location.reload();
  				 // 	bringData2();
  				  
  				  
				 }		  
				
			  },
			  error: function(xhr, status, errorThrown) 
			  {
			  	location.reload();
			//	alert("2");
				//  //alert(status + errorThrown);
			  }
		  });  //	

	}
	function bringData2(serial)
	{
	
	//$("#LoadingImage").show();
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_genpar.php",
			  data: ({}),			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			 
			  {
			  
				// $("#LoadingImage").hide();
				  data = JSON.parse(xhr.responseText);	
				  decide2(data,serial);				  
			  },
			  
			  error: function(xhr, status, errorThrown) 
			  {
			  
  				//  $("#LoadingImage").hide();
				 //alert(status + errorThrown);
				  
			  }
		  });  	
	}
	function decide2(data,serial)
	{		

		count=data.length;
	if(count>0)
	{
		if( serial==0)
			alert("user exist");	
		else 
			{		
					for (i=1;i<=7;i++)
			{
  				  			addAttachment1(data[0]['description'+i],0,'M2',0,1,invoice);
  				  			//alert("'description'"+i+"'"+" "+0+" "+0+" "+invoice);
  				  	}	
  				  	
  				  	 location.reload();
			
			}
	}
	else
	
		showError(serial);
		}	
		function addAttachment1(description,total,unit,price,quantity,invoice)
	{		
	
//	alert(attachment+" "+paperid+" "+notes);
		  $.ajax({
			
			  type: 'GET',
			  url: "../../ws/ws_tinvoicedetail.php",
			  data: ({action:1,description:description,total:total,invoice:invoice,unit:unit,quantity:quantity,price:price}),
			  
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
				//  //alert(status + errorThrown);
			  }
		  });  //	

	}
	function bringData1(serial)
	{
	
	//$("#LoadingImage").show();
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_genpar.php",
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
		//		 //alert(status + errorThrown);
				  
			  }
		  });  	
	}
	
	function bringData(serial)
	{
	
	//$("#LoadingImage").show();
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_InvoiceReport.php",
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
				 ////alert(status + errorThrown);
				  
			  }
		  });  	
	}
	function bringMaintenance(serial)
	{
	
	//$("#LoadingImage").show();
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_offermaintenance.php",
			  data: ({action:1,id:serial}),			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			 
			  {
			  
				// $("#LoadingImage").hide();
				  data = JSON.parse(xhr.responseText);	
				  decideMain(data,serial);				  
			  },
			  
			  error: function(xhr, status, errorThrown) 
			  {
			  
  				//  $("#LoadingImage").hide();
				//// //alert(status + errorThrown);
				  
			  }
		  });  	
	}
	function bringDataArea(serial)
	{
	
	//$("#LoadingImage").show();
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_area.php",
			  data: ({action:1,id:serial}),			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			 
			  {
			  
				// $("#LoadingImage").hide();
				  data = JSON.parse(xhr.responseText);	
				  decideArea(data,serial);				  
			  },
			  
			  error: function(xhr, status, errorThrown) 
			  {
			  
  				//  $("#LoadingImage").hide();
				 //alert(status + errorThrown);
				  
			  }
		  });  	
	}
	function bringInvoices(serial)
	{
	
	//$("#LoadingImage").show();
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_invoicedetail.php",
			  data: ({action:1,id:serial}),			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			 
			  {
			
				// $("#LoadingImage").hide();
				  data = JSON.parse(xhr.responseText);	
				  decideInvoice(data,serial);				  
			  },
			  
			  error: function(xhr, status, errorThrown) 
			  {
			  
  				//  $("#LoadingImage").hide();
				 //alert(status + errorThrown);
				  
			  }
		  });  	
	}
	function decideInvoice(data,serial)
	{		

		count=data.length;
	if(count>0)
	{
		if( serial==0)
			alert("user exist");	
		else 
			{		
	setprice=1;
		document.getElementById("item").value=data[0]["item"];
		$("#item").val(data[0]["item"]).trigger("change");
	
			document.getElementById("total").value=data[0]["total"];
			
			document.getElementById("price").value=data[0]["price"];
			document.getElementById("quantity").value=data[0]["quantity"];
			
			}
	}
	else
	
		showError(serial);
		}
		function decideMain(data,serial)
	{		

		count=data.length;
	if(count>0)
	{
		if( serial==0)
			alert("user exist");	
		else 
			{		
	document.getElementById("currency1").value=data[0]["currency"];
		document.getElementById("fees").value=data[0]["fees"];
		document.getElementById("visits").value=data[0]["visits"];
		document.getElementById("agreement").value=data[0]["agreement"];
		document.getElementById("mtotal").value=data[0]["total"];
		document.getElementById("email").value=data[0]["email"];
		document.getElementById("phone").value=data[0]["phone"];
		document.getElementById("spotfees").value=data[0]["spotfees"];
			
			}
	}
	else
	
		showError(serial);
		}
	function decideArea(data,serial)
	{		

		count=data.length;
	if(count>0)
	{
		if( serial==0)
			alert("user exist");	
		else 
			{		
		
		document.getElementById("adescription").value=data[0]["description"];
			document.getElementById("atotal").value=data[0]["total"];
			
			}
	}
	else
	
		showError(serial);
		}
	//delete person from server
	function deleteAttachment(idval)
	{
		
		//$("#LoadingImage").show();
		 
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_tinvoicereport.php",
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
				//  //alert(status + errorThrown);
			  }
		  });  //	

	}
////////////////////////////////////////////////////////////////////////////////////
function populate(data)
	{		
		
		count=data.length;
		var item;

		if(count>0)
		{			
			
		   $.each(data, function(index, row) {
				item = "<tr id='tr_"+row.serial+"'>";
                item+=   "<td>"+row.projectN+"</td>";
                item+=   "<td>"+row.title+"</td>";
                item+=   "<td>"+row.subject+"</td>";
    
				//item+=   "<td>"+row.admin+"</td>";
                item+=   "<td><a  id='Edit_"+row.serial+"'  data-toggle='modal' data-target='#myModal' ><p class='fa fa-edit'></p> Edit</a></td>";
               item+=   "<td><button type='button' class='btn btn-success del' id='del_"+row.serial+"'> Delete</button></td>";
                item+= "</tr>";
				$("#tableareas").append(item);
			});
			
		}
	}
////////////////////////////////////////////////////////////////////////////////////////
	function decide1(data,serial)
	{		

		count=data.length;
	if(count>0)
	{
		if( serial==0)
			alert("user exist");	
		else 
			{		
		 
			document.getElementById("requirement").value=data[0]["requirement"];
			document.getElementById("including").value=data[0]["including"];
			document.getElementById("body1").value=data[0]["body1"];
			document.getElementById("body2").value=data[0]["body2"];
			document.getElementById("body3").value=data[0]["body3"];
			document.getElementById("warranty").value=data[0]["warranty"];
			document.getElementById("validity").value=data[0]["offerV"];
			}
	}
	else
	
		showError(serial);
		}	
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
				
				proposalchange=0;
		document.getElementById("discount").value=data[0]["discount"];
		document.getElementById("company").value=data[0]["companyid"];
	
		document.getElementById("client").value=data[0]["clientid"];
			$("#client").val(data[0]["clientid"]).trigger("change");
		change=1;
			document.getElementById("subject").value=data[0]["subject"];
			document.getElementById("offer").value=data[0]["project"];
			$("#offer").val(data[0]["project"]).trigger("change");
			fillrequirement(data[0]["requirement"],data[0]["companyid"]);
			fillincluding(data[0]["including"],data[0]["companyid"]);
		document.getElementById("excluding").value=data[0]["excluding"];
			document.getElementById("notes").value=data[0]["notes"];
		
			document.getElementById("delivery").value=data[0]["delivery"];
			document.getElementById("payment").value=data[0]["payment"];
			document.getElementById("paymentd").value=data[0]["paymentdetails"];
			document.getElementById("validity").value=data[0]["validity"];
			document.getElementById("warranty").value=data[0]["warranty"];
			document.getElementById("proposal").value=data[0]["proposal"];
			
			//document.getElementById("address").value=data[0]["address"];
			document.getElementById("body1").value=data[0]["body1"];
			document.getElementById("body2").value=data[0]["body2"];
			document.getElementById("body3").value=data[0]["body3"];
			
			if(	data[0]["ispercentage"]==1)
			document.getElementById("ispercentage").checked = true;
			else
			document.getElementById("ispercentage").checked = false;
			
			if(	data[0]["rarea"]==1)
			document.getElementById("rarea").checked = true;
			else
			document.getElementById("rarea").checked = false;
			if(	data[0]["ritem"]==1)
			document.getElementById("ritem").checked = true;
			else
			document.getElementById("ritem").checked = false;
			
			}
	}
	else
	
		showError(serial);
		}
	

	function fillnewreq(offerid,company){
 
 $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_getnewreq.php",
			  data: ({offerid:offerid,company:company}),			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			 
			  {
			  		$('#requirement').html('');

				
						var $dropdown = $("#requirement");
		  
$.each(data, function() {
    $dropdown.append($("<option />").val(this.serial).text(this.description));
}); 
			  
			 		  
			  },
			  
			  error: function(xhr, status, errorThrown) 
			  {
			  
  				//  $("#LoadingImage").hide();
				 alert(status + errorThrown);
				  
			  }
		  });  	



	}

});

