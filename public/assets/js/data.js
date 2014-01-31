$(document).ready(function () {
	$("#business_entity").change(function() {
		if ($(this).val() == 'Partnership') {
			$("#number_of_partners").removeAttr('disabled');
			$("#number_of_partners").val(1);
		}
		else {
			$("#number_of_partners").attr('disabled', 'disabled');
		}
		
		disablePartners(1);
	});
	
	$("#number_of_partners").change(function() {
		disablePartners($(this).val());
	});
	
	if ($("#business_entity").val() == 'Partnership') {
		disablePartners($("#number_of_partners").val());
	}
	else {
		$("#number_of_partners").val(1);
		$("#number_of_partners").attr('disabled', 'disabled');
		disablePartners(1);
	}
	
});

function disablePartners(i) {
	for (j = 0; j < i; j++) {
		$("input[name='partners[" + j + "][share]']").removeAttr('disabled');
	}
	
	for (; i < 5; i++) {
		$("input[name='partners[" + i + "][share]']").attr('disabled', 'disabled');
	}
}
