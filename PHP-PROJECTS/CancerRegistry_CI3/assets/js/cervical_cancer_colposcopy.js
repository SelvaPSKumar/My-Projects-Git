$(document).ready(function(){
	const radios_to_disable = ['8'];
	disable_radios(radios_to_disable);
	$(document).on("change", '[id*="question_7_"]', function() {
		if($(this).data('have_point')) {
			if($(this).data('point') == 'abnormal') {
				enable_radio('8');
			} else {
				disable_radios(radios_to_disable);
			}
		}
	});
});