$(function() {
	
	fillyears();
datee="All";
value="All";
document.getElementById("year1").value =datee;
fillChart(datee,value);
fillDonut(datee,value);

fillCountry();
getDetails(datee,value);
$('#fromdate1').change(function() {
    fromdate = $("#fromdate1").val();  
});
$('#todate1').change(function() {
    toate = $("#todate1").val();
});
$(document).on('click',"[id^='search1']",function(){	
	
	if($('#year1').val()=="All")
{
	fillChart1($("#fromdate1").val(),$("#todate1").val(),$("#country1").val());
getDetails1($("#fromdate1").val(),$("#todate1").val(),$("#country1").val());	
}

	});
 $('select[id="country1"]').change(function () {
 	value=$("#country1").val();
fillChart($("#year1").val(),value);
fillDonut($("#year1").val(),value);
    });
    
if (datee=="All"){
	
document.getElementById("morris-area-chart").style.visibility='hidden';
document.getElementById("morris-bar-chart").style.visibility='visible';
}
else{
document.getElementById("morris-area-chart").style.visibility='visible';
document.getElementById("morris-bar-chart").style.visibility='hidden';
}

/////////////////////////////////////////////////////////////////////
function fillCountry()
	{
		
			//$("#LoadingImage").show();
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_country.php",
			  data: ({}),
			  
			  dataType: 'json',
			  timeout: 10000,
			  success: function(data, textStatus, xhr) 
			  {
			  	
		  		//  $("#LoadingImage").hide();				  
				 
				  if(data==0)
					  alert("Data couldn't be loaded!");
				  else{
				  	
				  	data = JSON.parse(xhr.responseText);				  				 
				  	count=data.length;
				  	
		var items;
		
		//$("#country").html("");
		
		if(count>0)
		{
			items="";
			  $.each(data,function(index,item) 
    {
      $("#country1").append("<option value='"+item.country+"'>"+item.country+"</option>");
    //  alert(items);
      
    });
    $("#country1").val(value);
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
///////////////////////////////////////////////////////////////////
	   $('select[id="year1"]').change(function () {
   	
 	datee=$("#year1").val();
 	getDetails(datee,$("#country1").val());
 	fillChart(datee,$("#country1").val());
fillDonut(datee,$("#country1").val());
getDetails(datee);
if (datee=="All"){
document.getElementById("morris-area-chart").style.visibility='hidden';
document.getElementById("morris-bar-chart").style.visibility='visible';
}
else{
document.getElementById("morris-area-chart").style.visibility='visible';
document.getElementById("morris-bar-chart").style.visibility='hidden';
}
    });
     $('select[id="sum"]').change(function () {

 	datee=$("#year1").val();
 	fillChart(datee,$("#country1").val());
fillDonut(datee,$("#country1").val());
getDetails(datee);
    });
      function fillyears()
	{
		$("#year1").html("");
		$("#year1").append("<option value='All'>All</option>");
		now=new Date().getFullYear();
	for(year=2014;year<=now;year=Number(year)+1)
		 	{
		 	
		 		$("#year1").append("<option value='"+year+"'>"+year+"</option>");
		 		
		 	}
	}
    function getDetails(dat,country)
	{

	//$("#LoadingImage").show();
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_getdetails.php",
			  data: ({action:1,country:country,year:dat}),			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			 
			  {
			
				// $("#LoadingImage").hide();
				  data = JSON.parse(xhr.responseText);	
				  decide(data);				  
			  },
			  
			  error: function(xhr, status, errorThrown) 
			  {
			  
  				//  $("#LoadingImage").hide();
				 //alert(status + errorThrown);
				  
			  }
		  });  	
	}
	function getDetails1(fromdate,todate,country)
	{

	//$("#LoadingImage").show();
		  $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_getdetails.php",
			  data: ({action:2,country:country,todate:todate,fromdate:fromdate}),			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			 
			  {
			
				// $("#LoadingImage").hide();
				  data = JSON.parse(xhr.responseText);	
				  decide(data);				  
			  },
			  
			  error: function(xhr, status, errorThrown) 
			  {
			  
  				//  $("#LoadingImage").hide();
				 //alert(status + errorThrown);
				  
			  }
		  });  	
	}
	function decide(data)
	{		

		
		
	if(data!=null)
	{	
			//var item;
			//$.each(data, function(index, row) {	
			//item = row.serial;
			//fillI(data[0]["directorate"]);
		
			$("#tdoffer").html(Math.round(data[0]["OfferValue"]));
			$("#tdmaintenance").html(Math.round(data[0]["Valuee"]));
			if(isNaN(data[0]["Valuee"]*100/data[0]["OfferValue"]) || data[0]["OfferValue"]==0 || data[0]["OfferValue"]==null)
			$("#tdperc").html("0%");
			else
			$("#tdperc").html((data[0]["Valuee"]*100/data[0]["OfferValue"]).toFixed(2)+"%");
			
			$("#tdrgoffer").html(Math.round(data[0]["sRGoffer"]));
			$("#tdrgmaintenance").html(Math.round(data[0]["sRGmaintenance"]));
			
			if(isNaN(data[0]["sRGmaintenance"]*100/data[0]["sRGoffer"]) || data[0]["sRGoffer"]==0 || data[0]["sRGoffer"]==null)
			$("#tdrgperc").html("0%");
			else
			$("#tdrgperc").html((data[0]["sRGmaintenance"]*100/data[0]["sRGoffer"]).toFixed(2)+"%");
		  
		  $("#tdgwoffer").html(Math.round(data[0]["sGWoffer"]));
			$("#tdgwmaintenance").html(Math.round(data[0]["sGWmaintenance"]));
			if(isNaN(data[0]["sGWmaintenance"]*100/data[0]["sGWoffer"]) || data[0]["sGWoffer"]==0 || data[0]["sGWoffer"]==null)
			$("#tdgwperc").html("0%");
			else
			$("#tdgwperc").html((data[0]["sGWmaintenance"]*100/data[0]["sGWoffer"]).toFixed(2)+"%");
			
			$("#tdcoffer").html(Math.round(data[0]["COfferValue"]));
			$("#tdcmaintenance").html(Math.round(data[0]["CValuee"]));
			if(isNaN(data[0]["CValuee"]*100/data[0]["COfferValue"]) || data[0]["COfferValue"]==0 || data[0]["COfferValue"]==null)
			$("#tdcperc").html("0%");
			else
			$("#tdcperc").html((data[0]["CValuee"]*100/data[0]["COfferValue"]).toFixed(2)+"%");
		//alert(document.getElementById("rginhandbudget").value = data[0]["sInHandRGBudget"];data[0]["office"]);sInHandBudget			
	}
	else{
			
	$("#tdoffer").html(0);
			$("#tdmaintenance").html(0);
		
			$("#tdperc").html(0+"%");
			
			$("#tdrgoffer").html(0);
			$("#tdrgmaintenance").html(0);
			
			
			$("#tdrgperc").html(0+"%");
		  
		  $("#tdgwoffer").html(0);
			$("#tdgwmaintenance").html(0);
		
			$("#tdgwperc").html(0+"%");
			
			$("#tdcoffer").html(0);
			$("#tdcmaintenance").html(0);
			//if(isNaN(data[0]["CValuee"]*100/data[0]["COfferValue"]) || data[0]["COfferValue"]==0 || data[0]["COfferValue"]==null)
			$("#tdcperc").html("0%");
		
	//	showError(serial);
	}
		}
function fillChart(dat,country){
	//alert($("#sum").val());

if($("#sum").val()=="Sum")
action=1;
else
action=2;

 $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_gettotal.php",
			  data: ({action:action,year:dat,country:country}),
			  
			  dataType: 'json',
			  timeout: 10000,
			  success: function(data, textStatus, xhr) 
			  {
		
				  
				  if(data==null)
				  	{
				  		if(dat=="All")
				  		{$("#morris-bar-chart").html("");
				  			  Morris.Bar({
        element: 'morris-bar-chart',
        data: [{
            y: 'Budgets',
            a: 0,
      		b:0,
      		c:0,
      		d:0,
      		e:0,
      		f:0,
      		g:0
      		
        }],
        xkey: 'y',
        ykeys: ['a','b','c','d','e','f','g'],
        labels: ['In Hand Budget','Offer Budget','Cancelled Budget','Completed Budget','HP Budget','Business Dev','Agent'],
        hideHover: 'auto',
        barColors:['lightblue','lightgreen','red','violet','purple','brown','orange'],
       
        resize: true
    });
				  		}
				  		else {
				  		$("#morris-area-chart").html("");
				  			Morris.Area({
        element: 'morris-area-chart',
        data: [{
            period: datee+'-01',
            TotalBudget: null,
            InHandBudget: null,
            OfferBudget: null,
            CancelledBudget: null,
            CompletedBudget: null,
            HighProbBudget:null,
            BusinessDevelopment:null,
            Agent:null
        }, {
            period: datee+'-02',
            TotalBudget: null,
            InHandBudget: null,
            OfferBudget: null,
            CancelledBudget: null,
            CompletedBudget: null,
            HighProbBudget:null,
            BusinessDevelopment:null,
            Agent:null
        }, {
            period: datee+'-03',
            TotalBudget: null,
            InHandBudget: null,
            OfferBudget: null,
            CancelledBudget: null,
            CompletedBudget: null,
            HighProbBudget:null,
            BusinessDevelopment:null,
            Agent:null
        }, {
            period: datee+'-04',
            TotalBudget: null,
            InHandBudget: null,
            OfferBudget: null,
            CancelledBudget: null,
            CompletedBudget: null,
            HighProbBudget:null,
            BusinessDevelopment:null,
            Agent:null
        }, {
            period: datee+'-05',
            TotalBudget: null,
            InHandBudget: null,
            OfferBudget: null,
            CancelledBudget: null,
            CompletedBudget: null,
            HighProbBudget:null,
            BusinessDevelopment:null,
            Agent:null
        }, {
            period: datee+'-06',
            TotalBudget: null,
            InHandBudget: null,
            OfferBudget: null,
            CancelledBudget: null,
            CompletedBudget: null,
            HighProbBudget:null,
            BusinessDevelopment:null,
            Agent:null
        }, {
            period: datee+'-07',
            TotalBudget: null,
            InHandBudget: null,
            OfferBudget: null,
            CancelledBudget: null,
            CompletedBudget: null,
            HighProbBudget:null,
            BusinessDevelopment:null,
            Agent:null
        }, {
            period: datee+'-08',
            TotalBudget: null,
            InHandBudget: null,
            OfferBudget: null,
            CancelledBudget: null,
            CompletedBudget: null,
            HighProbBudget:null,
            BusinessDevelopment:null,
            Agent:null
        }, {
            period: datee+'-09',
            TotalBudget: null,
            InHandBudget: null,
            OfferBudget: null,
            CancelledBudget: null,
            CompletedBudget: null,
            HighProbBudget:null,
            BusinessDevelopment:null,
            Agent:null
        }, {
            period: datee+'-10',
            TotalBudget: null,
            InHandBudget: null,
            OfferBudget: null,
            CancelledBudget: null,
            CompletedBudget: null,
            HighProbBudget:null,
            BusinessDevelopment:null,
            Agent:null
              }, {
            period: datee+'-11',
            TotalBudget: null,
            InHandBudget: null,
            OfferBudget: null,
            CancelledBudget: null,
            CompletedBudget: null,
            HighProbBudget:null,
            BusinessDevelopment:null,
            Agent:null
              }, {
            period: datee+'-12',
            TotalBudget: null,
            InHandBudget: null,
            OfferBudget: null,
            CancelledBudget: null,
            CompletedBudget: null,
            HighProbBudget:null,
            BusinessDevelopment:null,
            Agent:null
        }],
        xkey: 'period',
        ykeys: ['TotalBudget', 'InHandBudget', 'OfferBudget','CancelledBudget','CompletedBudget','HighProbBudget','BusinessDevelopment','Agent'],
        labels: ['TotalBudget', 'InHandBudget', 'OfferBudget','CancelledBudget','CompletedBudget','HighProbBudget','BusinessDevelopment','Agent'],
        pointSize: 2,
        hideHover: 'auto',
        lineColors: ['green', 'lightblue','lightgreen','red','violet','purple','brown','orange'],
        resize: true
    });	
				// 
				 }}
				  else
  				  	{data1 = JSON.parse(xhr.responseText);	
  				  		//alert(data1[0]["sCompletedBudget"]);
  				  		count=data.length;
		if(dat=="All")
				  		{$("#morris-bar-chart").html("");
				  			  Morris.Bar({
        element: 'morris-bar-chart',
        data: [{
            y: 'Budgets',
            a: Math.round(data1[0]["sInHandBudget"]).toFixed(2),
      		b:Math.round(data1[0]["sOFFERBudget"]).toFixed(2),
      		c:Math.round(data1[0]["sCancelledBudget"]).toFixed(2),
      		d:Math.round(data1[0]["sCompletedBudget"]).toFixed(2),
      		e:Math.round(data1[0]["sHPBudget"]).toFixed(2),
      		f:Math.round(data1[0]["sBusinessD"]).toFixed(2),
      		g:Math.round(data1[0]["sAgent"]).toFixed(2)
      		
        }],
        xkey: 'y',
        ykeys: ['a','b','c','d','e','f','g'],
        labels: ['In Hand Budget','Offer Budget','Cancelled Budget','Completed Budget','HP Budget','Business Development','Agent'],
        hideHover: 'auto',
        barColors:['lightblue','lightgreen','red','violet','purple','brown','orange'],
        resize: true
    });
				  		}
else{
	
				$("#morris-area-chart").html("");
			
		   		//alert(data1[0]["sAgentm1"]+" "+data1[0]["sOFFERVALUEm1"]+" "+data1[0]["sInHandBudgetm1"]+" "+data1[0]["sOFFERBudgetm1"]+" "+data1[0]["sCancelledBudgetm1"]+" "+data1[0]["sCompletedBudgetm1"]+" "+data1[0]["sHPBudget1"]+" "+data1[0]["sBusinessD1"]+" "+data1[0]["sAgentm1"]);
				Morris.Area({
        element: 'morris-area-chart',
        data: [{
            period: datee+'-01',
            TotalBudget: Math.round(data1[0]["sOFFERVALUEm1"]*100).toFixed(2)/100,
            InHandBudget: Math.round(data1[0]["sInHandBudgetm1"]*100).toFixed(2)/100,
            OfferBudget: Math.round(data1[0]["sOFFERBudgetm1"]*100).toFixed(2)/100,
            CancelledBudget: Math.round(data1[0]["sCancelledBudgetm1"]*100).toFixed(2)/100,
            CompletedBudget: Math.round(data1[0]["sCompletedBudgetm1"]*100).toFixed(2)/100,
            HighProbBudget:Math.round(data1[0]["sHPBudget1"]*100).toFixed(2)/100,
            BusinessDevelopment:Math.round(data1[0]["sBusinessD1"]*100).toFixed(2)/100,
            Agent:Math.round(data1[0]["sAgentm1"]*100).toFixed(2)/100
        }, {
            period: datee+'-02',
            TotalBudget: Math.round(data1[0]["sOFFERVALUEm2"]*100).toFixed(2)/100,
          InHandBudget: Math.round(data1[0]["sInHandBudgetm2"]*100).toFixed(2)/100,
           OfferBudget: Math.round(data1[0]["sOFFERBudgetm2"]*100).toFixed(2)/100,
            CancelledBudget: Math.round(data1[0]["sCancelledBudgetm2"]*100).toFixed(2)/100,
            CompletedBudget: Math.round(data1[0]["sCompletedBudgetm2"]*100).toFixed(2)/100,
            HighProbBudget:Math.round(data1[0]["sHPBudget1"]*100).toFixed(2)/100,
             BusinessDevelopment:Math.round(data1[0]["sBusinessD2"]*100).toFixed(2)/100,
            Agent:Math.round(data1[0]["sAgentm2"]*100).toFixed(2)/100
        }, {
            period: datee+'-03',
            TotalBudget: Math.round(data1[0]["sOFFERVALUEm3"]*100).toFixed(2)/100,
            InHandBudget: Math.round(data1[0]["sInHandBudgetm3"]*100).toFixed(2)/100,
            OfferBudget: Math.round(data1[0]["sOFFERBudgetm3"]*100).toFixed(2)/100,
            CancelledBudget: Math.round(data1[0]["sCancelledBudgetm3"]*100).toFixed(2)/100,
            CompletedBudget: Math.round(data1[0]["sCompletedBudgetm3"]*100).toFixed(2)/100,
            HighProbBudget:Math.round(data1[0]["sHPBudget3"]*100).toFixed(2)/100,
             BusinessDevelopment:Math.round(data1[0]["sBusinessD3"]*100).toFixed(2)/100,
            Agent:Math.round(data1[0]["sAgentm3"]*100).toFixed(2)/100
        }, {
            period: datee+'-04',
           TotalBudget: Math.round(data1[0]["sOFFERVALUEm4"]*100).toFixed(2)/100,
            InHandBudget: Math.round(data1[0]["sInHandBudgetm4"]*100).toFixed(2)/100,
            OfferBudget: Math.round(data1[0]["sOFFERBudgetm4"]*100).toFixed(2)/100,
            CancelledBudget: Math.round(data1[0]["sCancelledBudgetm4"]*100).toFixed(2)/100,
            CompletedBudget: Math.round(data1[0]["sCompletedBudgetm4"]*100).toFixed(2)/100,
            HighProbBudget:Math.round(data1[0]["sHPBudget4"]*100).toFixed(2)/100,
            BusinessDevelopment:Math.round(data1[0]["sBusinessD4"]*100).toFixed(2)/100,
            Agent:Math.round(data1[0]["sAgentm4"]*100).toFixed(2)/100
        }, {
            period: datee+'-05',
            TotalBudget: Math.round(data1[0]["sOFFERVALUEm5"]*100).toFixed(2)/100,
            InHandBudget: Math.round(data1[0]["sInHandBudgetm5"]*100).toFixed(2)/100,
            OfferBudget: Math.round(data1[0]["sOFFERBudgetm5"]*100).toFixed(2)/100,
            CancelledBudget: Math.round(data1[0]["sCancelledBudgetm5"]*100).toFixed(2)/100,
            CompletedBudget: Math.round(data1[0]["sCompletedBudgetm5"]*100).toFixed(2)/100,
            HighProbBudget:Math.round(data1[0]["sHPBudget5"]*100).toFixed(2)/100,
             BusinessDevelopment:Math.round(data1[0]["sBusinessD5"]*100).toFixed(2)/100,
            Agent:Math.round(data1[0]["sAgentm5"]*100).toFixed(2)/100
        }, {
            period: datee+'-06',
            TotalBudget: Math.round(data1[0]["sOFFERVALUEm6"]*100).toFixed(2)/100,
            InHandBudget: Math.round(data1[0]["sInHandBudgetm6"]*100).toFixed(2)/100,
            OfferBudget: Math.round(data1[0]["sOFFERBudgetm6"]*100).toFixed(2)/100,
            CancelledBudget: Math.round(data1[0]["sCancelledBudgetm6"]*100).toFixed(2)/100,
            CompletedBudget: Math.round(data1[0]["sCompletedBudgetm6"]*100).toFixed(2)/100,
            HighProbBudget:Math.round(data1[0]["sHPBudget6"]*100).toFixed(2)/100,
            BusinessDevelopment:Math.round(data1[0]["sBusinessD6"]*100).toFixed(2)/100,
            Agent:Math.round(data1[0]["sAgentm6"]*100).toFixed(2)/100
        }, {
            period: datee+'-07',
            TotalBudget: Math.round(data1[0]["sOFFERVALUEm7"]*100).toFixed(2)/100,
            InHandBudget: Math.round(data1[0]["sInHandBudgetm7"]*100).toFixed(2)/100,
            OfferBudget: Math.round(data1[0]["sOFFERBudgetm7"]*100).toFixed(2)/100,
            CancelledBudget: Math.round(data1[0]["sCancelledBudgetm7"]*100).toFixed(2)/100,
            CompletedBudget: Math.round(data1[0]["sCompletedBudgetm7"]*100).toFixed(2)/100,
            HighProbBudget:Math.round(data1[0]["sHPBudget7"]*100).toFixed(2)/100,
            BusinessDevelopment:Math.round(data1[0]["sBusinessD7"]*100).toFixed(2)/100,
            Agent:Math.round(data1[0]["sAgentm7"]*100).toFixed(2)/100
        }, {
            period: datee+'-08',
            TotalBudget: Math.round(data1[0]["sOFFERVALUEm8"]*100).toFixed(2)/100,
            InHandBudget: Math.round(data1[0]["sInHandBudgetm8"]*100).toFixed(2)/100,
            OfferBudget: Math.round(data1[0]["sOFFERBudgetm8"]*100).toFixed(2)/100,
            CancelledBudget: Math.round(data1[0]["sCancelledBudgetm8"]*100).toFixed(2)/100,
            CompletedBudget: Math.round(data1[0]["sCompletedBudgetm8"]*100).toFixed(2)/100,
            HighProbBudget:Math.round(data1[0]["sHPBudget8"]*100).toFixed(2)/100,
            BusinessDevelopment:Math.round(data1[0]["sBusinessD8"]*100).toFixed(2)/100,
            Agent:Math.round(data1[0]["sAgentm8"]*100).toFixed(2)/100
        }, {
            period: datee+'-09',
            TotalBudget: Math.round(data1[0]["sOFFERVALUEm9"]*100).toFixed(2)/100,
            InHandBudget: Math.round(data1[0]["sInHandBudgetm9"]*100).toFixed(2)/100,
            OfferBudget: Math.round(data1[0]["sOFFERBudgetm9"]*100).toFixed(2)/100,
            CancelledBudget: Math.round(data1[0]["sCancelledBudgetm9"]*100).toFixed(2)/100,
            CompletedBudget: Math.round(data1[0]["sCompletedBudgetm9"]*100).toFixed(2)/100,
            HighProbBudget:Math.round(data1[0]["sHPBudget9"]*100).toFixed(2)/100,
            BusinessDevelopment:Math.round(data1[0]["sBusinessD9"]*100).toFixed(2)/100,
            Agent:Math.round(data1[0]["sAgentm9"]*100).toFixed(2)/100
        }, {
            period: datee+'-10',
            TotalBudget: Math.round(data1[0]["sOFFERVALUEm10"]*100).toFixed(2)/100,
            InHandBudget: Math.round(data1[0]["sInHandBudgetm10"]*100).toFixed(2)/100,
            OfferBudget: Math.round(data1[0]["sOFFERBudgetm10"]*100).toFixed(2)/100,
            CancelledBudget: Math.round(data1[0]["sCancelledBudgetm10"]*100).toFixed(2)/100,
            CompletedBudget: Math.round(data1[0]["sCompletedBudgetm10"]*100).toFixed(2)/100,
            HighProbBudget:Math.round(data1[0]["sHPBudget10"]*100).toFixed(2)/100,
            BusinessDevelopment:Math.round(data1[0]["sBusinessD10"]*100).toFixed(2)/100,
            Agent:Math.round(data1[0]["sAgentm10"]*100).toFixed(2)/100
              }, {
            period: datee+'-11',
            TotalBudget: Math.round(data1[0]["sOFFERVALUEm11"]*100).toFixed(2)/100,
            InHandBudget: Math.round(data1[0]["sInHandBudgetm11"]*100).toFixed(2)/100,
            OfferBudget: Math.round(data1[0]["sOFFERBudgetm11"]*100).toFixed(2)/100,
            CancelledBudget: Math.round(data1[0]["sCancelledBudgetm11"]*100).toFixed(2)/100,
            CompletedBudget: Math.round(data1[0]["sCompletedBudgetm11"]*100).toFixed(2)/100,
            HighProbBudget:Math.round(data1[0]["sHPBudget11"]*100).toFixed(2)/100,
            BusinessDevelopment:Math.round(data1[0]["sBusinessD11"]*100).toFixed(2)/100,
            Agent:Math.round(data1[0]["sAgentm11"]*100).toFixed(2)/100
              }, {
            period: datee+'-12',
            TotalBudget: Math.round(data1[0]["sOFFERVALUEm12"]*100).toFixed(2)/100,
            InHandBudget: Math.round(data1[0]["sInHandBudgetm12"]*100).toFixed(2)/100,
            OfferBudget: Math.round(data1[0]["sOFFERBudgetm12"]*100).toFixed(2)/100,
            CancelledBudget: Math.round(data1[0]["sCancelledBudgetm12"]*100).toFixed(2)/100,
            CompletedBudget: Math.round(data1[0]["sCompletedBudgetm12"]*100).toFixed(2)/100,
            HighProbBudget:Math.round(data1[0]["sHPBudget12"]*100).toFixed(2)/100,
            BusinessDevelopment:Math.round(data1[0]["sBusinessD12"]*100).toFixed(2)/100,
            Agent:Math.round(data1[0]["sAgentm12"]*100).toFixed(2)/100
        }],
        xkey: 'period',
        ykeys: ['TotalBudget', 'InHandBudget', 'OfferBudget','CancelledBudget','CompletedBudget','HighProbBudget','BusinessDevelopment','Agent'],
        labels: ['TotalBudget', 'InHandBudget', 'OfferBudget','CancelledBudget','CompletedBudget','HighProbBudget','BusinessDevelopment','Agent'],
        pointSize: 2,
        hideHover: 'auto',
        
  
         lineColors: ['green', 'lightblue','lightgreen','red','violet','purple','brown','orange'],
        resize: true
    });		
			
			}
		
  			 			  
					}
			  },
			  error: function(xhr, status, errorThrown) 
			  {
			 	//alert("2");
				 // $("#LoadingImage").hide();
				//  alert(status + errorThrown);
			  }
			  
		  }); 
    
}
function fillDonut(dat,country){
				setTimeout(function(){
					
				if($("#sum").val()=="Sum")
action=1;
else
action=2;
 $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_gettotalyear.php",
			  data: ({action:action,year:dat,country:country}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
		
				
				  if(data==null)
				  	{
				  		if(dat=="All"){
				  			$("#morris-donut-chart").html("");
  Morris.Donut({
        element: 'morris-donut-chart',
        colors: ['lightblue','lightgreen','red','violet','purple','brown','orange'],
        data: [{
        
            label: "In Hand Budget",
            value:0
        }, {
            label: "Budget",
            value: 0
             }, {
            label: "Cancelled Budget",
            value: 0
             }, {
            label: "Complete Budget",
            value: 0
             }, {
            label: "High Prob Budget",
            value: 0
            }, {
            label: "Business Devlp",
            value: 0
            }, {
            label: "Agent",
            value: 0
        }],
        
        resize: true
    });	
				  		}
				  		else{
				  		$("#morris-donut-chart").html("");
  Morris.Donut({
        element: 'morris-donut-chart',
        colors: ['green', 'lightblue','lightgreen','red','violet','purple','brown','orange'],
        data: [{
            label: "Total Budget",
            value: 0
             
        }, {
            label: "In Hand Budget",
            value:0
        }, {
            label: "Budget",
            value: 0
             }, {
            label: "Cancelled Budget",
            value: 0
             }, {
            label: "Complete Budget",
            value: 0
             }, {
            label: "High Prob Budget",
            value: 0
             }, {
            label: "Business Devlp",
            value: 0
            }, {
            label: "Agent",
            value: 0
        }],
        
        resize: true
    });	
					}}
					else {
						if(dat=="All"){
							
				  			$("#morris-donut-chart").html("");
				  			 
  Morris.Donut({
        element: 'morris-donut-chart',
        colors: ['lightblue','lightgreen','red','violet','purple','brown','orange'],
        data: [{
        
            label: "In Hand Budget",
            value:0+Math.round(data[0]["sInHandBudget"])//Math.round(data1[0]["sInHandBudget"]).toFixed(2)
        }, {
            label: "Budget",
            value: 0+Math.round(data[0]["sOFFERBudget"])
             }, {
            label: "Cancelled Budget",
            value: 0+Math.round(data[0]["sCancelledBudget"])
             }, {
            label: "Complete Budget",
            value: 0+Math.round(data[0]["sCompletedBudget"])
             }, {
            label: "High Prob Budget",
            value: 0+Math.round(data[0]["sHPBudget"])
             }, {
            label: "Business Devlp",
            value: 0+Math.round(data[0]["sBusinessD"])
             }, {
            label: "Agent",
            value: 0+Math.round(data[0]["sAgent"])
        }],
        
        resize: true
    });	
				  		}
				  		else{
						$("#morris-donut-chart").html("");
						data1 = JSON.parse(xhr.responseText);
						
						Morris.Donut({
        element: 'morris-donut-chart',
        colors: ['green', 'lightblue','lightgreen','red','violet','purple','brown','orange'],
        data: [{
            label: "Total Budget",
            value: 0+Math.round(data1[0]["sOFFERVALUE"])
        }, {
            label: "In Hand Budget",
            value:0+Math.round(data1[0]["sInHandBudget"])
        }, {
            label: "Budget",
            value: 0+Math.round(data1[0]["sOFFERBudget"])
             }, {
            label: "Cancelled Budget",
            value: 0+Math.round(data1[0]["sCancelledBudget"])
             }, {
            label: "Complete Budget",
            value: 0+Math.round(data1[0]["sCompletedBudget"])
             }, {
            label: "High Prob Budget",
            value: 0+Math.round(data1[0]["sHPBudget"])
              }, {
            label: "Business Devlp",
            value: 0+Math.round(data1[0]["sBusinessD"])
 				}, {
            label: "Agent",
            value: 0+Math.round(data1[0]["sAgent"])
        }],
        resize: true
    });	
					}}
			  },
			  error: function(xhr, status, errorThrown) 
			  {
			  //	alert("2");
				 // $("#LoadingImage").hide();
				//  alert(status + errorThrown);
			  }
			  
		  }); 	
    //do what you need here
}, 250);

    
}
		  	function fillChart1(fromdate,todate,country){
	//alert($("#sum").val());

if($("#sum").val()=="Sum")
action=1;
else
action=2;
 $.ajax({
			  type: 'GET',
			  url: "../../ws/ws_gettotal1.php",
			  data: ({action:action,fromdate:fromdate,todate:todate,country:country}),
			  
			  dataType: 'json',
			  timeout: 5000,
			  success: function(data, textStatus, xhr) 
			  {
		
				  
				  if(data==null)
				  	{
				  		
				  		$("#morris-bar-chart").html("");
				  			  Morris.Bar({
        element: 'morris-bar-chart',
        data: [{
            y: 'Budgets',
            a: 0,
      		b:0,
      		c:0,
      		d:0,
      		e:0,
      		f:0,
      		g:0
      		
        }],
        xkey: 'y',
        ykeys: ['a','b','c','d','e','f','g'],
        labels: ['In Hand Budget','Offer Budget','Cancelled Budget','Completed Budget','HP Budget','Business Dev','Agent'],
        hideHover: 'auto',
        barColors:['lightblue','lightgreen','red','violet','purple','brown','orange'],
       
        resize: true
    });
				  		
				  		
				  		// 
				 }
				  else
  				  	{data1 = JSON.parse(xhr.responseText);	
  				  		//alert(data1[0]["sCompletedBudget"]);
  				  		count=data.length;
	$("#morris-bar-chart").html("");
				  			  Morris.Bar({
        element: 'morris-bar-chart',
        data: [{
            y: 'Budgets',
            a: Math.round(data1[0]["sInHandBudget"]).toFixed(2),
      		b:Math.round(data1[0]["sOFFERBudget"]).toFixed(2),
      		c:Math.round(data1[0]["sCancelledBudget"]).toFixed(2),
      		d:Math.round(data1[0]["sCompletedBudget"]).toFixed(2),
      		e:Math.round(data1[0]["sHPBudget"]).toFixed(2),
      		f:Math.round(data1[0]["sBusinessD"]).toFixed(2),
      		g:Math.round(data1[0]["sAgent"]).toFixed(2)
      		
        }],
        xkey: 'y',
        ykeys: ['a','b','c','d','e','f','g'],
        labels: ['In Hand Budget','Offer Budget','Cancelled Budget','Completed Budget','HP Budget','Business Development','Agent'],
        hideHover: 'auto',
        barColors:['lightblue','lightgreen','red','violet','purple','brown','orange'],
        resize: true
    });

		
  			 			  
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
  
    
});
