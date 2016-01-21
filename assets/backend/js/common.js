// JavaScript Document
function publish(table, id, status, url){
	url = (url === undefined) ? 'common/publish' : url;
	$.ajax({
		type: "POST",
		url: url,
		data: { table: table, id: id, status: status }
	}).done(function( msg ) {
		window.location.reload(true);
	}).fail(function() { alert("error"); });
}

function expiry(table, id, status, url){
	url = (url === undefined) ? 'common/expiry' : url;
	$.ajax({
		type: "POST",
		url: url,
		data: { table: table, id: id, status: status }
	}).done(function( msg ) {
		window.location.reload(true);
	}).fail(function() { alert("error"); });
}

function submitButton(){
	$("#submitButton").click();
}

function deleteButton(){
	if($('.checkadmin:checkbox').is(':checked')){
		$("#submitButton").click();
	} else {
		alert("Please select a item to delete");
	}
	
}

function sortButton(formName, action){
    $("#"+formName).attr("action", action);
	$("#submitButton").click();
}

$(document).ready(function(){
    $('.checkall:checkbox').change(function(){
       	if($(this).attr("checked")) $('.checkadmin:checkbox').attr('checked','checked');
   		else $('.checkadmin:checkbox').removeAttr('checked');
    })
})