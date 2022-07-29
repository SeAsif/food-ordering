$(document).ready(function() {
	
	// Expand Panel
	$("#open").click(function(){
		$("div#panel").slideDown("slow");
	
	});	
	
	// Collapse Panel
	$("#close").click(function(){
		$("div#panel").slideUp("slow");	
	});		
	
	// Switch buttons from "Log In | Register" to "Close Panel" on click
	$("#toggle a").click(function () {
		$("#toggle a").toggle();
	});		

	// Expand Search Panel
	$("#open01").click(function(){
		$("div#panel01").slideDown("slow");
	
	});	
	
	// Collapse Panel
	$("#close01").click(function(){
		$("div#panel01").slideUp("slow");	
	});		
	
	// Switch buttons from "Log In | Register" to "Close Panel" on click
	$("#toggle01 a").click(function () {
		$("#toggle01 a").toggle();
	});		

});