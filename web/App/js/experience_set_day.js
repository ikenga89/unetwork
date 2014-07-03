$(document).ready(function(){
	$('#experience_end_month, #experience_end_year').change(function(){
		if($( "#experience_end_month option:selected" ).val() == '' && $( "#experience_end_year option:selected" ).val() == ''){
			var val = '';
		}else{
			var val = 1;
		}
		$("select#experience_end_day").val(val);
	});
});