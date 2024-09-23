
$(document).ready(function(){


$('.question37 select').on('change', (e) => {
    classname = $('.question37 select').val();
    $('.question37sup').hide();
    if (classname!='') {
        $('.left-'+classname.replaceAll(' ' ,'-').toLowerCase()+'-present').show()
    }     
})   

$('.question42 select').on('change', (e) => {
    classname = $('.question42 select').val();
    $('.question42sup').hide();
    if (classname!='') {
        $('.right-'+classname.replaceAll(' ' ,'-').toLowerCase()+'-present').show()
    }     
})  


$('.question27').on('click', 
    () => {  
        if( $('.question27:checked').val()== 'yes' ) {   
                $('.right-mass-present').show() ; 
        }  else {  
            $('.right-mass-present').hide() ;
        }   
    } 
);

$('.question31').on('click', 
    () => {  
        if( $('.question31:checked').val()== 'yes' )  {   
            $('.left-mass-present').show(); 
        } else {  
            $('.left-mass-present').hide() 
        }   
    } 
);

$('.question35').on('click', 
    () => {  
        if( $('.question35:checked').val()== 'yes' )  {   
            $('.left-calcifications-present').show(); 
        } else {  
            $('.left-calcifications-present').hide() 
            $('.question36 select').val("");
            $('.question37 select').val("");
            $('.question38').hide() ; 
            $('.question39').hide() ;
            $('.question38 select').val(""); 
            $('.question39 select').val("");
        }   
    } 
);
$('.question40').on('click', 
    () => {  
        if( $('.question40:checked').val()== 'yes' )  {   
            $('.question41').show(); 
            $('.question42').show(); 
        } else {  
           $('.question41').hide(); 
           $('.question42').hide();
           $('.question41 select').val("");
           $('.question42 select').val("");
           $('.right-suspicious-present').hide();
           $('.right-typically-benign-present').hide();
           $('.right-suspicious-present select').val("");
           $('.right-typically-benign-present select').val("");
        }   
    } 
);

$(".question8").on("click", function () {
    var val = $(this).val();
    if (val == 'yes') {
    	$(".question9").show();
    	$(".question10").show();
    } else {
    	$(".question9").hide();
    	$(".question10").hide();

    }
});

$(".question11").on("click", function () {
    var val = $(this).val();
    if (val == 'yes') {
    	$(".question12").show();
    } else {
    	$(".question12").hide();

    }
});


$(".question13").on("click", function () {
    var val = $(this).val();
    if (val == 'yes') {
    	$(".question14").show();
    } else {
    	$(".question14").hide();

    }
});

$(".question15").on("change", function () {
    var val = $(this).val();
    if (val == 'postmenopausal') {
    	$(".question16").show();
    } else {
    	$(".question16").hide();

    }
});

$(".question18").on("click", function () {
    var val = $(this).val();
    if (val == 'yes') {
    	$(".question19").show();
    } else {
    	$(".question19").hide();

    }
});


$(".question20").on("click", function () {
    var val = $(this).val();
    if (val == 'yes') {
    	$(".question21").show();
    } else {
    	$(".question21").hide();

    }
});


$(".question22").on("click", function () {
    var val = $(this).val();
    if (val == 'yes') {
    	$(".question23").show();
    	$(".question24").show();
    } else {
    	$(".question23").hide();
    	$(".question24").hide();

    }
});



var active_id = $(".progress_bar").find("li.active").attr('id');
if(active_id == "group_2"){

	$("#current_page").val("group_2");

} else if (active_id == "group_3") {

	$("#current_page").val("group_3");

} else if (active_id == "group_4") {

	$("#current_page").val("group_4");

} else if (active_id == "group_5"){

	$("#current_page").val("group_5");

} else if (active_id == "group_6"){

	$("#current_page").val("group_6");

}

$(".headernode #next,.footernode #next").on('click', function(){

	$current_page = $("#current_page").val();
	if ($current_page == "group_2") {

// 		var unchecked_radio_fields = $('.group_2 input[type=radio]').prop('checked', false).length;
//         console.log($('.group_2 input[type=radio]').prop('checked', false));
//         console.log(unchecked_radio_fields/2);

// 		if (unchecked_radio_fields > 0) {
// 			alert("Fill ALl Fields!");
// 		}

// return false;

		 // var group_2_inputs          = $('.group_2').find('input');
   //      var group_2_inputs_checked  = $('.group_2').find('input:checked');

   //      console.log(group_2_inputs.length);
   //      console.log(group_2_inputs_checked.length);
   //      return false;
        // var left_breast_inputs_length   = left_breast_inputs.length/2;
        // var left_breast_inputs_checked  = left_breast_inputs_checked.length;

        // if (left_breast_inputs_length != left_breast_inputs_checked) {
        //     alert("Please answer to all questions to proceed!");
        //     return false;   
        // }



		$("#previous_page").val("group_2");
		$current_page = $("#current_page").val("group_3");
        $(".headernode #group_3").addClass('active');
		$(".footernode #group_3").addClass('active');
		$(".group_2").hide();
		$(".group_3").show();
	} else if($current_page == "group_3"){

		$("#previous_page").val("group_3");
		$current_page = $("#current_page").val("group_4");
		$(".headernode #group_4").addClass('active');
        $(".footernode #group_4").addClass('active');
		$(".group_3").hide();
		$(".group_4").show(); 
        group4_breast_question();
	} else if($current_page == "group_4"){

		$("#previous_page").val("group_4");
		$current_page = $("#current_page").val("group_5");
        $(".headernode #group_5").addClass('active');
		$(".footernode #group_5").addClass('active');
		$(".group_4").hide();
		$(".group_5").show();
        group5_breast_question();
	} else if($current_page == "group_5"){

		$("#previous_page").val("group_5");
		$current_page = $("#current_page").val("group_6");
        $(".headernode #group_6").addClass('active');
        $(".footernode #group_6").addClass('active'); 
        $('.right-calcifications-present').hide() ;
		$(".group_5").hide();
		$(".group_6").show();
        $('.right-suspicious-present').hide();
        $('.right-typically-benign-present').hide();
	} else if($current_page == "group_6"){

		$("#previous_page").val("group_6");
		$current_page = $("#current_page").val("completed");
        $(".headernode #completed").addClass('active');
        $(".footernode #completed").addClass('active');  
		$(".group_6").hide();
		$(".completed").show();
	}
    var question8_value = $('.question8:checked').val();
    var question11_value = $('.question11:checked').val();
    var question13_value = $('.question13:checked').val();
    var question18_value = $('.question18:checked').val();
    var question20_value = $('.question20:checked').val();
    var question22_value = $('.question22:checked').val();

    if (question8_value == 'no') {
        $(".question9").hide();
    }
    if (question11_value == 'no') {
        $(".question12").hide();
    }

    if (question13_value == 'no') {
        $(".question14").hide();
    }
    if (question18_value == 'no') {
        $(".question19").hide();
    }

    if (question20_value == 'no') {
        $(".question21").hide();
    }
    if (question22_value == 'no') {
        $(".question23").hide();
        $(".question24").hide();
    }

});

$(".headernode  #previous , .footernode #previous").on('click', function(){

	$current_page = $("#previous_page").val();

	if ($current_page == "group_2") {
		$previous_page = $("#previous_page").val("group_1");
		$("#current_page").val("group_2");
        $(".headernode #group_3").removeClass('active');
        $(".footernode #group_3").removeClass('active');
		$(".group_2").show();
		$(".group_3").hide();
	} else if($current_page == "group_3"){

		$previous_page = $("#previous_page").val("group_2");
		$("#current_page").val("group_3");
		$(".headernode #group_4").removeClass('active');
        $(".footernode #group_4").removeClass('active');
		$(".group_3").show();
		$(".group_4").hide();
	} else if($current_page == "group_4"){

		$previous_page = $("#previous_page").val("group_3");
		$("#current_page").val("group_4");
		$(".headernode #group_5").removeClass('active');
        $(".footernode #group_5").removeClass('active');
		$(".group_4").show();        
		$(".group_5").hide();
        group4_breast_question();

	} else if($current_page == "group_5"){

		$previous_page = $("#previous_page").val("group_4");
        $('.right-calcifications-present').hide() ;
		$("#current_page").val("group_5");
		$(".headernode #group_6").removeClass('active');
        $(".footernode #group_6").removeClass('active');
		$(".group_5").show();
		$(".group_6").hide();
        group5_breast_question();
	} else if($current_page == "group_6"){

		$previous_page = $("#previous_page").val("group_5");
		$("#current_page").val("group_6");
		$(".headernode #completed").removeClass('active');
        $(".footernode #completed").removeClass('active');
		$(".group_6").show();
		$(".completed").hide();
        $('.right-suspicious-present').hide();
            $('.right-typically-benign-present').hide();
	} else if($current_page == "completed"){

		$previous_page = $("#previous_page").val("group_6");
		$("#current_page").val("completed");
		$(".headernode #completed").addClass('active');
        $(".footernode #completed").addClass('active');
		$(".group_6").hide();
		$(".completed").show();
	}

    var question8_value = $('.question8:checked').val();
    var question11_value = $('.question11:checked').val();
    var question13_value = $('.question13:checked').val();
    var question18_value = $('.question18:checked').val();
    var question20_value = $('.question20:checked').val();
    var question22_value = $('.question22:checked').val();

    if (question8_value == 'no') {
        $(".question9").hide();
    }
    if (question11_value == 'no') {
        $(".question12").hide();
    }

    if (question13_value == 'no') {
        $(".question14").hide();
    }
    if (question18_value == 'no') {
        $(".question19").hide();
    }

    if (question20_value == 'no') {
        $(".question21").hide();
    }
    if (question22_value == 'no') {
        $(".question23").hide();
        $(".question24").hide();
    }
});

function group4_breast_question(){
   var question27 = $(".question27:checked").val();
        if(question27 == 'yes'){
            $('.right-mass-present').show() ;
        }else{
           $('.right-mass-present').hide() ;
        } 

        var question31= $(".question31:checked").val();
        if(question31 == 'yes'){
            $('.left-mass-present').show() ;
        }else{
           $('.left-mass-present').hide() ;
        } 

        var question35 = $(".question35:checked").val();
        if(question35 == 'yes'){
            $('.question36').show() ; 
            $('.question37').show() ;   
        }else{
            $('.question36').hide() ;
            $('.question37').hide() ; 
            $('.question36').find('option:first').attr('selected', 'selected');
            $('.question37').find('option:first').attr('selected', 'selected');
        } 

        question37 = $('.question37 select').val();
        if(question37 == 'Typically benign'){
            $('.question38').show() ;
            $('.question39').hide() ;   
        }else if(question37 == 'Suspicious'){
            $('.question39').show() ;
            $('.question38').hide() ;
        }else{
            $('.question38').hide() ; 
            $('.question39').hide() ;
        }
        $('.right-suspicious-present').hide();
        $('.right-typically-benign-present').hide(); 
}

function group5_breast_question(){ 
    var question40 = $(".question40:checked").val();
        if(question40 == 'yes'){
            $('.question41').show() ; 
            $('.question42').show() ; 
        }else{
            $('.question41').hide() ;
            $('.question42').hide() ;  
        } 

        var question42 = $('.question42 select').val();
        if(question42 == 'Typically benign'){
            $('.right-typically-benign-present').show(); 
            $('.right-suspicious-present').hide();
        }else if(question42 == 'Suspicious'){
            $('.right-suspicious-present').show();
            $('.right-typically-benign-present').hide(); 
        }else{
            $('.right-suspicious-present').hide();
            $('.right-typically-benign-present').hide(); 
        }
} 
console.log("active_id = " + active_id);

// $("#radio8 radio") // select the radio by its id
//     .change(function(){ // bind a function to the change event
//         if( $(this).is(":checked") ){ // check if the radio is checked
//             var val = $(this).val(); // retrieve the value
//             console.log(val);
//         }
//     });
});
