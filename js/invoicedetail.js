$(document).ready(function() {
ID=0;
setprice=0;
var invoice= findGetParameter("y");
price=0;
fromcurrency=0;
tocurrency=findGetParameter('c');
globalamount=0;
var data1=[];
;//fillSections();
//getUsers();
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

 


 $('#quantity').change(function () {
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
		 currencysymbol=findGetParameter('s');
		
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
else
		document.getElementById("total").value=Number($("#quantity").val()*$('#price').val());	
 	//fillOffer(serial);
 	
    });
    $('#price').change(function () {
    	
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
		 currencysymbol=findGetParameter('s');
		
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
 	//fillOffer(serial);
 	
    });
   
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
				  currencysymbol=findGetParameter('s');
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
					fromcurrency=2; 
					document.getElementById('price').value=price;
			  },
			  
			  error: function(xhr, status, errorThrown) 
			  {
			  
  				//  $("#LoadingImage").hide();
				// alert(status + errorThrown);
				  
			  }
		  });  	
	}
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
				  
	if(count>0)
	{
		
		if( serial==0)
			alert("user exist");	
		else 
			{	
				//alert(data[0]['GW']);
				$("#tableareas").empty();
				item = "<tr id='tr_"+data[0]['Serial']+"'>";
               	if(data[0]['GW']==1)
                item+=   "<td style='width:30%;'>  Gw INDOOR  </td>";
                else 	if(data[0]['RG']==1)
                item+=   "<td style='width:30%;'>  RG INDOOR  </td>";
                item+=   "<td style='width:30%;'>Area</td>";                        
				item+=   "<td style='width:15%;'>Save</td>";
                item+= "</tr>";
                item+= "<tr><td><input type='text'   name='title'  id='title' style='width:100%;'></td><td><input type='text'   name='title'  id='title' style='width:100%;'></td><td><button type='button' style='width:100%;' id='addarea'  >Save</button></td></tr>";
                item+=   "<tr><td style='width:30%;' align='right'>  Total Area  </td><td colspan='2'>&nbsp;</td></tr>";
				$("#tableareas").append(item);
				}
	}				  
			  },
			  
			  error: function(xhr, status, errorThrown) 
			  {
			  
  				//  $("#LoadingImage").hide();
				// alert(status + errorThrown);
				  
			  }
		  });  	
	}
$("#myModal").on('shown.bs.modal', function () {
document.getElementById("lblalert").style.visibility='hidden';
 if(ID > 0)
	 
	{
		$("#title").html("Edit Invoice");

		bringData(ID);
		}
	else
	$("#title").html("Add Invoice");
		
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
$(document).on('click',"[id^='Add']",function(){

			ID=0;
		

	});

	$(document).on('click',"[id^='del_']",function(){	
			//$(this).parent().parent().remove();
	  		strID=$(this).attr('id');			
			ID = strID.substring(4);
			var answer = confirm("Are You Sure You Want To Delete This Invoice");
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


item= 0+$("#item").val();
quantity= 0+$("#quantity").val();
total= 0+$("#total").val();
price=$('#price').val();
//alert(item+" "+quantity+" "+total);
if( item=='' || item==0)
document.getElementById("lblalert").style.visibility='visible';
else{
if(ID==0)	
				{
						
					//window.open("../pages/upload.php?x="+ document.getElementById("attachment").value,"_blank","width=0,height=0");
					addAttachment(price,item,total,quantity,invoice);
					
					
				}
		else{ 
		//	window.open("../pages/upload.php?x="+ attachment,"_blank","width=0,height=0");
		UpdateAttachment(ID,price,item,total,quantity,invoice);
			
			}	
	//	}
	
}

});
//===================================================================================
$("#add2").click(function(){
	 var table = $('#dataTables-example1').DataTable();
	  j=0;
	  data1=[];
	table.rows().every( function ( rowIdx, tableLoop, rowLoop ) {
		
    var d = this.data();
 	ID=d[0].split('id="Cedit_')[1].split('"')[0];
 	
 	 	if($('#Cedit_'+ID).is(':checked'))
      { price=$('#Cedit_'+ID).parent().parent().children('.tdprice').children('.editor123').html();
      	quantity=$('#Cedit_'+ID).parent().parent().children('.tdquantity').children('.editor123').html();
      	total=Number(price)*Number(quantity);
      	data1.push({item:ID,price :price,quantity:quantity,total:total});
      	 j++;}
       if(ID=='')
       ID=0;	
    d.counter++; // update data source for the row

    this.invalidate();
    
    // invalidate the data DataTables has cached for this row
});
 $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_tinvoicedetail.php",
			  data: ({action:4,data1:data1,invoice:invoice}),			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 			 
			  {
			location.reload();
			  },
			  
			  error: function(xhr, status, errorThrown) 
			  {				  
			  }
		  });  
//$('#item').val(data1);
//$('#item').trigger('change');
$('#myModal1').modal('hide');

//$.each($('#item'),function (){
//	$(this).select2('val', data1);
//	});
});
//===================================================================================

function UpdateAttachment(serial,price,item,total,quantity,invoice)
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
function addAttachment(price,item,total,quantity,invoice)
	{		
	
//	alert(attachment+" "+paperid+" "+notes);
		  $.ajax({
			
			  type: 'GET',
			  url: "../../ws/ws_tinvoicedetail.php",
			  data: ({action:1,price:price,item:item,total:total,invoice:invoice,quantity:quantity}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
	//	alert("1");
				  if(data==0)
					  alert("Data is not inserted");  
				 	  else	  {
  				  	data = JSON.parse(xhr.responseText);	
				 document.getElementById("item").value='';
		
			document.getElementById("total").value='';
			document.getElementById("quantity").value='';
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
			  url: "../../ws/ws_invoicedetail.php",
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
			//	 alert(status + errorThrown);
				  
			  }
		  });  	
	}
	
	//delete person from server
	function deleteAttachment(idval)
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
			location.reload();
			  },
			  error: function(xhr, status, errorThrown) 
			  {
				 
			location.reload();
				//  alert(status + errorThrown);
			  }
		  });  //	

	}
//////////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////////////////	

		function decide(data,serial)
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
			document.getElementById("quantity").value=data[0]["quantity"];
document.getElementById('price').value=data[0]['price'];

			}
	}
	else
	
		showError(serial);
		}


});

