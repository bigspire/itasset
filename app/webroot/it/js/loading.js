﻿/***************************/
//@Author: Adrian "yEnS" Mato Gondelle & Ivan Guardado Castro
//@website: www.yensdesign.com
//@email: yensamg@gmail.com
//@license: Feel free to use it, but keep this credits please!					
/***************************/


var LoadBar = function(){
	this.value = 0;
	this.sources = Array();
	this.sourcesDB = Array();
	this.totalFiles = 0;
	this.loadedFiles = 0;
};
//Show the loading bar interface
LoadBar.prototype.show = function() {
	this.locate();
	document.getElementById("loadingZone").style.display = "block";
};
//Hide the loading bar interface
LoadBar.prototype.hide = function() {
	document.getElementById("loadingZone").style.display = "none";
};
//Add all scripts to the DOM
LoadBar.prototype.run = function(){
	this.show();
	var i;
	root = document.getElementById('webroot').value;
	for (i=0; i<this.sourcesDB.length; i++){
		var source = this.sourcesDB[i];
		var head = document.getElementsByTagName("body")[0];
		var script = document.createElement("script");
		script.type = "text/javascript";
		script.src = root+"js/" + source
		head.appendChild(script);
	}	
};
//Center in the screen remember it from old tutorials? ;)
LoadBar.prototype.locate = function(){
	var loadingZone = document.getElementById("loadingZone");
	var windowWidth = document.documentElement.clientWidth;
	var windowHeight = document.documentElement.clientHeight;
	var popupHeight = loadingZone.clientHeight;
	var popupWidth = loadingZone.clientWidth;
	loadingZone.style.position = "absolute";
	loadingZone.style.top = parseInt(windowHeight/2-popupHeight/2) + "px";
	loadingZone.style.left = parseInt(windowWidth/2-popupWidth/2) + "px";
};
//Set the value position of the bar (Only 0-100 values are allowed)
LoadBar.prototype.setValue = function(value){
	if(value >= 0 && value <= 100){
		document.getElementById("progressBar").style.width = value + "%";
		document.getElementById("infoProgress").innerHTML = parseInt(value) + "%";
	}
};
//Set the bottom text value
LoadBar.prototype.setAction = function(action){
	document.getElementById("infoLoading").innerHTML = action;
};
//Add the specified script to the list
LoadBar.prototype.addScript = function(source){
	this.totalFiles++;
	this.sources[source] = source;
	this.sourcesDB.push(source);
};
//Called when a script is loaded. Increment the progress value and check if all files are loaded
LoadBar.prototype.loaded = function(file) {
	this.loadedFiles++;
	delete this.sources[file];
	var pc = (this.loadedFiles * 100) / this.totalFiles;
	this.setValue(pc);
	this.setAction(file + " loaded");
	//Are all files loaded?
	if(this.loadedFiles == this.totalFiles){
		setTimeout("myBar.hide()",300);
		//load the reset button to try one more time!
		document.getElementById("restart").style.display = "block";
	}
};
//Global var to reference from other scripts
var myBar = new LoadBar();

//Checking resize window to recenter :)
window.onresize = function(){
	myBar.locate();
};
//Called on body load
start = function(){
	myBar.addScript("jquery.min.js");
	myBar.addScript("jquery.cookie.js");
	myBar.addScript("jquery-ui-1.10.4.custom.min.js");
	myBar.addScript("plugins/colorbox/jquery.colorbox-min.js");
	myBar.addScript("bootstrap.min.js");
	myBar.addScript("jquery-ui-1.10.3.custom.min.js");
	myBar.addScript("jquery.slimscroll.min.js");
	myBar.addScript("ace-elements.min.js");
	myBar.addScript("ace.min.js");
	myBar.addScript("bootbox.min.js");
	myBar.addScript("jquery.autosize.min.js");
	myBar.addScript("jquery.easing.1.3.min.js");
	myBar.addScript("jquery.touchSwipe.min.js");
	myBar.addScript("jquery.imagesloaded.min.js");
	myBar.addScript("jquery.scrollTo-1.4.3.1-min.js");
	myBar.addScript("spin.min.js");
	myBar.addScript("portfolio.min.js");
	myBar.addScript("bootstrap-editable.min.js");
	myBar.addScript("main.js");	
	myBar.run();
};
//Called on click reset button
restart = function(){
	window.location.reload();
};