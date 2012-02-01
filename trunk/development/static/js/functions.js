$(document).ready(function principal(){
	$('#project').change(function(){
        $('#sbacklog').load('backlog/sprint_backlog/'+$('#project').val());
    });
});