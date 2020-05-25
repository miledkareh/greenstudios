$(document).ready(function() {

ID=0;
//fillSections();
//getUsers();

$(document).on('click',"[id^='print']",function(){
	fromdate=$("#fromdate").val();
	todate=$("#todate").val();
	userid=0+Number($("#employee").val());
	
	project=0+Number($("#project").val());
	
	if(fromdate!='')
	fromdate="&f="+fromdate+" 00:00";
	if(todate!='')
	todate="&t="+todate+" 23:59";
	if(userid!=0)
	userid="&u="+userid;
	else
	userid='';
	if(project != 0)
	project="&p="+project;
	else
	project='';
			window.open("./report.php?"+fromdate+todate+userid+project,"_blank");

	});

	
	

});

