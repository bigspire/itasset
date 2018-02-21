$(document).ready(function() {
		/* when the form submitted */
		$('#formID').submit(function(){ 		
			// Disable the 'Next' button to prevent multiple clicks		
			$('input[type=submit]', this).attr('value', 'Processing...');		
			$('input[type=submit]', this).attr('disabled', 'disabled');
			
		});
		
			
		
	/* check browser compatibility */	
	if($('#browserChk').length > 0){ 
		var browser=get_browser_info();
		//alert(browser.name);alert(browser.version);
		if(browser.name == 'MSIE' && browser.version < 9){
			$('#disablingDiv').show();
			// show browser version model
			$('#myBrowser').modal({show:true})
		}
	}
			
});
	
	
function get_browser_info(){
		var ua=navigator.userAgent,tem,M=ua.match(/(opera|chrome|safari|firefox|msie|trident(?=\/))\/?\s*(\d+)/i) || []; 
		if(/trident/i.test(M[1])){
			tem=/\brv[ :]+(\d+)/g.exec(ua) || []; 
			return {name:'IE ',version:(tem[1]||'')};
			}   
		if(M[1]==='Chrome'){
			tem=ua.match(/\bOPR\/(\d+)/)
			if(tem!=null)   {return {name:'Opera', version:tem[1]};}
			}   
		M=M[2]? [M[1], M[2]]: [navigator.appName, navigator.appVersion, '-?'];
		if((tem=ua.match(/version\/(\d+)/i))!=null) {M.splice(1,1,tem[1]);}
		return {
		  name: M[0],
		  version: M[1]
		};
}