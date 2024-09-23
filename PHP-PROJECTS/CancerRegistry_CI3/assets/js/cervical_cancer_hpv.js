$(document).ready(function(){
	const radios_to_disable = ['7', '8'];
	disable_radios(radios_to_disable);
	$(document).on("change", '[id*="question_6_"]', function() {
		if($(this).data('have_point')) {
			if($(this).data('point') == 'positive') {
				enable_radio('7');
			} else {
				disable_radios(radios_to_disable);
			}
		}
	});
	$(document).on("change", '[id*="question_7_"]', function() {
		if($(this).data('have_point')) {
			if($(this).data('point') == 'positive') {
				enable_radio('8');
			} else {
				disable_radio('8');
			}
		}
	});
});