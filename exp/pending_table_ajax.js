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
			
			xmlHttp.open("GET","pending.php",true);
			xmlHttp.onreadystatechange=handleserverresponse;
			xmlHttp.send(null);
			
		}
		else setTimeout('process()',1000);
		
	}
	
	
	
	function handleserverresponse(){
		if(xmlHttp.readyState==4){
			if(xmlHttp.status==200){
				xmlResponse=xmlHttp.responseXML;
				xmlDocumentElement=xmlResponse.documentElement;
				message=xmlDocumentElement.firstChild.data;
		
				document.getElementById("pend").innerHTML=message;
				setTimeout('process()',1000);
			}
			else alert('server is not willing to cooperate');
		}
	}
	
	
