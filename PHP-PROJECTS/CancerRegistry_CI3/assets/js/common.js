
function disable_radios(radios_to_disable) {
	$.each(radios_to_disable , function(index, val) { 
		$('[id*="question_'+val+'_"]').prop("disabled", true);
		$('[id*="question_'+val+'_"]').prop("checked", false);
	});
}
function enable_radio(radio_button) {
	$('[id*="question_'+radio_button+'_"]').prop("disabled", false);
}
function disable_radio(radio_button) {
	$('[id*="question_'+radio_button+'_"]').prop("disabled", true);
	$('[id*="question_'+radio_button+'_"]').prop("checked", false);
}