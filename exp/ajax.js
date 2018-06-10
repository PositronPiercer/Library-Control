

var xmlHttp=createHttpRequestObject();
function createHttpRequestObject(){
	var xmlHttp;
	//for internet Explorer
	if(window.ActiveXObject){
		try{
			xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
	catch(e){
		xmlHttp=false;
	}
	}
	//other browsers
	else{
		try{xmlHttp=new XMLHttpRequest();
		}
		catch(e){
			xmlHttp=false;
	}}
		
	if(!xmlHttp)
alert('Ajax is not willing to cooperate');
else return xmlHttp;		
	}
	
	
	
	
	function process(){
	

		
		
		if(xmlHttp.readyState==0||xmlHttp.readyState==4){
			//alert('1');
			xmlHttp.open("GET","pending.php",true);
			xmlHttp.onreadystatechange=handleserverresponse;
			xmlHttp.send(null);
			
			
			//process2();
			
		}
		else setTimeout('process()',1000);
		
	}
	
	function process2(){
		//alert('hello');
		//alert($('#impentry').val().length);
		if($('#temt').val().length<11){
			document.getElementById("return").innerHTML='Welcome Admin!';
		}
		
		if(($('#temt').val().length>10)&&(xmlHttp.readyState==0||xmlHttp.readyState==4)){
				//alert('2');
			xmlHttp.open("POST","show_issued.php",true);
			xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			xmlHttp.onreadystatechange=function(){
				if(xmlHttp.readyState==4){
			if(xmlHttp.status==200){
				xmlResponse=xmlHttp.responseXML;
				xmlDocumentElement=xmlResponse.documentElement;
				message=xmlDocumentElement.firstChild.data;
		
				document.getElementById("return").innerHTML=message;
				
			}
			else alert('server is not willing to cooperate');
				
			}}
			xmlHttp.send("entry="+$('#temt').val());
			
			}
		
		
			setTimeout('process()',1000);
	}
	
	function handleserverresponse(){
		//alert('3');
		if(xmlHttp.readyState==4){
			if(xmlHttp.status==200){
				xmlResponse=xmlHttp.responseXML;
				xmlDocumentElement=xmlResponse.documentElement;
				message=xmlDocumentElement.firstChild.data;
		
				document.getElementById("pend").innerHTML=message;
				setTimeout('process2()',1000);
			}
			else alert('server is not willing to cooperate');
		}
	}
	
	
