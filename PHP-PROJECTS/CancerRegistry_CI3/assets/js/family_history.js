
$(document).ready(function(){

    var active_id = $(".progress_bar").find("li.active").attr('id');
    var total_page = $("#total_page").val();
    var assessment_tool_id = $("#assessment_tool_id").val();
    var page_number=1;
    var group_number='group_1';
    var prev_number="group_1";
    var next_number="group_2";
    if(active_id == group_number ){
    
        $("#current_page").val(group_number);
    
    }
    if(total_page == 1 || total_page == '') {
        $(".headernode").hide();
        $(".footernode").hide();
    }
        $(".headernode #next,.footernode #next").on('click', function(){
         //$current_page = $("#current_page").val();
        page_number=page_number+1;
        if(page_number>total_page){
            page_number=total_page;
        }
         if(page_number == total_page ){
            group_number="group_"+page_number;
            next_number=group_number;
            prev_number="group_"+(page_number-1);

            $("#previous_page").val(prev_number);
            $current_page = $("#current_page").val("completed");
            $(".headernode #completed").addClass('active');
            $(".footernode #completed").addClass('active');
            $("."+prev_number).hide();
            $("."+group_number).show();

         } else if( page_number == 1 ) {
            group_number="group_"+page_number;
            page_number=page_number+1;
            next_number="group_"+(page_number+1);
            prev_number="group_1";

            $("#previous_page").val(prev_number);
            $current_page = $("#current_page").val(group_number);
            $(".headernode #"+group_number).addClass('active');
            $(".footernode #"+group_number).addClass('active');
            $("."+prev_number).hide();
            $("."+group_number).show();

         } else {
            group_number="group_"+page_number;
            next_number="group_"+(page_number+1);
            prev_number="group_"+(page_number-1);

            $("#previous_page").val(prev_number);
            $current_page = $("#current_page").val(group_number);
            $(".headernode #"+group_number).addClass('active');
            $(".footernode #"+group_number).addClass('active');
            $("."+prev_number).hide();
            $("."+group_number).show();

         }

    
    console.log("active_id = " + page_number);
    console.log("total_page = " + total_page);
    });
    
    $(".headernode  #previous , .footernode #previous").on('click', function(){
        page_number=page_number-1;
        if(page_number<1){
            page_number=1;
        }
        $current_page = $("#previous_page").val();
         if(page_number == (total_page-1) ){
            group_number="group_"+page_number;
            next_number="group_"+(page_number+1);
            prev_number="group_"+(page_number-1);

            $previous_page = $("#previous_page").val(prev_number);
            $("#current_page").val(group_number);
            $(".headernode #completed").removeClass('active');
            $(".footernode #completed").removeClass('active');
            $("."+group_number).show();
            $("."+next_number).hide();
            
         } else if( page_number == 1 ) {
            group_number="group_"+page_number;
            next_number="group_"+(page_number+1);
            prev_number=group_number;

            $previous_page = $("#previous_page").val(prev_number);
             $("#current_page").val(group_number);
            $(".headernode #"+next_number).removeClass('active');
            $(".footernode #"+next_number).removeClass('active');
            $("."+group_number).show();
            $("."+next_number).hide();

         } else {
            group_number="group_"+page_number;
            next_number="group_"+(page_number+1);
            prev_number="group_"+(page_number-1);
            $previous_page = $("#previous_page").val(prev_number);
             $("#current_page").val(group_number);
            $(".headernode #"+next_number).removeClass('active');
            $(".footernode #"+next_number).removeClass('active');
            $("."+group_number).show();
            $("."+next_number).hide();
         }

    
    console.log("active_id = " + page_number);
    });
    console.log("active_id = " + page_number);

    });
    