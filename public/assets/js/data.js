var app = angular.module('BvApp',[]);

app.directive('numbersOnly', function() {
   return {
     require: 'ngModel',
     link: function(scope, element, attrs, modelCtrl) {
       modelCtrl.$parsers.push(function (inputValue) {
           if (inputValue == undefined) return '' 
           var transformedInput = inputValue.replace(/[^\.0-9]/g, ''); 
           if (transformedInput!=inputValue) {
              modelCtrl.$setViewValue(transformedInput);
              modelCtrl.$render();
           }         

           return transformedInput;         
       });
     }
   };
});

$(document).ready(function () {
	$("#business_entity").change(function() {
		if ($(this).val() == 'Partnership') {
			$("#number_partners_container").show();
			$('#partner_share_5').val('');
            disablePartners($("#number_of_partners").val());
		}
		else {
			$("#number_partners_container").hide();
			$('#partner_share_5').val('100');
            disablePartners(1);
		}
	}).trigger('change');
	
	$("#number_of_partners").change(function() {
		disablePartners($(this).val());
	});
	
	if ($("#business_entity").val() == 'Partnership') {
        $("#number_partners_container").show();
		disablePartners($("#number_of_partners").val());
	}
	else {
		$("#number_partners_container").hide();
		disablePartners(1);
	}
	

	$('#product_recommendation_modal').modal('show');
});

function disablePartners(i) {
	for (j = 0; j < i; j++) {
		$("input[name='partners[" + j + "][share]']").removeAttr('disabled');
	}
	
	for (; i < 5; i++) {
		$("input[name='partners[" + i + "][share]']").attr('disabled', 'disabled');
	}
}
