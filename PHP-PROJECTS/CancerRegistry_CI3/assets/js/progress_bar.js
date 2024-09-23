 $('.next-btn').click(function(){

    var current_page = $('#current_page').val();
    if (current_page == 'left') {
        
        var left_breast_inputs          = $('#left_breast').find('input');
        var left_breast_inputs_checked  = $('#left_breast').find('input[type="radio"]:checked');
        var left_breast_inputs_checkbox_checked  = $('#left_breast').find('input[type="checkbox"]:checked').length;
        if(left_breast_inputs_checkbox_checked>0){
            left_breast_inputs_checkbox_checked = 1;
        }

        var left_breast_inputs_length   = $('#left_breast').find('div.row').length;

        var question1_value = $('input[name="2[]"]:checked').val();
        if(question1_value == 'no' ) {
            $('#left_breast').find('input[type="checkbox"]:checked').removeAttr("checked");
            left_breast_inputs_length-1;
            left_breast_inputs_checkbox_checked = 1;          
        }

        var left_breast_inputs_checked  = left_breast_inputs_checked.length + left_breast_inputs_checkbox_checked;

        console.log( left_breast_inputs_length , left_breast_inputs_checked )

        if ( left_breast_inputs_length != left_breast_inputs_checked) {
            alert("Please answer to all questions to proceed!");
            return false;   
        }

        $('#left_breast').hide();
        $('#right_breast').show();
    
        $('#current_page').val('right');
        $('.right').addClass('active');
    
    } else if (current_page =='right') {
        
        var right_breast_inputs              = $('#right_breast').find('input');
        var right_breast_inputs_checked     = $('#right_breast').find('input[type="radio"]:checked');
        var right_breast_inputs_checkbox_checked  = $('#right_breast').find('input[type="checkbox"]:checked').length;
        if(right_breast_inputs_checkbox_checked>0){
            right_breast_inputs_checkbox_checked = 1;
        }
        var right_breast_inputs_length      = $('#right_breast').find('div.row').length;

        var question12_value = $('input[name="1[]"]:checked').val();
        if(question12_value == 'no' ) {
            $('#right_breast').find('input[type="checkbox"]:checked').removeAttr("checked");
            right_breast_inputs_length-1;
            right_breast_inputs_checkbox_checked = 1;          
        }

        var right_breast_inputs_checked     = right_breast_inputs_checked.length + right_breast_inputs_checkbox_checked;

        console.log( right_breast_inputs_length , right_breast_inputs_checked );

        if ( right_breast_inputs_length != right_breast_inputs_checked) {
            alert("Please answer to all questions to proceed!");
            return false;   
        }

        $('#left_breast').hide();
        $('#right_breast').hide();
        $('#completed_breast').show();

        $('#current_page').val('completed');
        $('.completed').addClass('active');
    }

 }); 
$('.prev-btn').click(function(){
    var current_page = $('#current_page').val();
    if (current_page == 'left') {
        return false;
    } else if (current_page == 'right') {
        $('#left_breast').show();
        $('#right_breast').hide();
        $('#completed_breast').hide();
        $('#current_page').val('left');
        
        $('.left').addClass('active');
        $('.right').removeClass('active');
        $('.completed').removeClass('active');

    } else if (current_page == 'completed') {
        $('#right_breast').show();
        $('#left_breast').hide();
        $('#completed_breast').hide();
        $('#current_page').val('right');

        $('.completed').removeClass('active');
        // $('#right').removeClass('active');
    }
 });
