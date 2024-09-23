const radio_questions=new Array();
function generate_result(question_index){
    var q_index=$(question_index).attr("name");
    var q_value=$(question_index).val();
    radio_questions[q_index]=q_value;
    //console.log(radio_questions);
    //console.log(Object.keys(radio_questions).length);

    if( Object.keys(radio_questions).length == 18) {
        var mark=0;
        var mark_percentage=0;
        Object.keys(radio_questions).forEach(function(key) {
            //console.log(key, radio_questions[key]);
            mark=mark+Number(radio_questions[key]);
        });
        mark_percentage=(mark/72)*50;
        mark_percentage=Math.round(mark_percentage * 100) / 100;
        $(".score").text(mark_percentage)
        if(mark_percentage>0 && mark_percentage<33) {
            $(".literacy_level").text("Limited");
            $(".literacy_level").removeClass("text-warning");
            $(".literacy_level").removeClass("text-success");
            $(".literacy_level").addClass("text-danger");
        } else if(mark_percentage>=33 && mark_percentage<=42){
            $(".literacy_level").text("Sufficient");
            $(".literacy_level").removeClass("text-danger");
            $(".literacy_level").removeClass("text-success");
            $(".literacy_level").addClass("text-warning");
        } else if(mark_percentage>42 && mark_percentage<50) {
            $(".literacy_level").text("Excellent");
            $(".literacy_level").removeClass("text-danger");
            $(".literacy_level").removeClass("text-warning");
            $(".literacy_level").addClass("text-success");
        } else {}
        $(".score_text").show();
    }
}
const select_questions=new Array();
function generate_result_json(question_index){
    var q_index=$(question_index).attr("name");
    var q_value=$(question_index).val();
    select_questions[q_index]=q_value;
    //console.log(radio_questions);
    //console.log(Object.keys(radio_questions).length);
Object.keys(select_questions).forEach(function(key) {
            //console.log(key, radio_questions[key]);
            const obj = JSON.parse(select_questions[key]);
            var values = Object.keys(obj).map(function (k) { return obj[k]; });
          console.log(values);
 
        });

    if( Object.keys(select_questions).length == 11) {
        var mark=0;
        var mark_percentage=0;
        Object.keys(select_questions).forEach(function(key) {
            //console.log(key, radio_questions[key]);

            const obj = JSON.parse(select_questions[key]);
            var values = Object.keys(obj).map(function (k) { return obj[k]; });
            mark=mark+Number(values[0]);
        });
        mark_percentage=(mark/36)*100;
        mark_percentage=Math.round(mark_percentage * 100) / 100;
        $(".score").text(mark_percentage)
       
        $(".score_text").show();
    }
}

function show_image(img_num){
var image_to_show="";
switch(img_num){
    case 1:
        image_to_show=".image_vegetable_intake";
    break;
    case 2:
        image_to_show=".image_whole_grains";
    break;
    case 3:
        image_to_show=".image_alcohol_intake";
    break;
    default:
    break;
}
$(image_to_show).show();
}

function hide_image(img_num){
    var image_to_hide="";
    switch(img_num){
        case 1:
            image_to_hide=".image_vegetable_intake";
        break;
        case 2:
            image_to_hide=".image_whole_grains";
        break;
        case 3:
            image_to_hide=".image_alcohol_intake";
        break;
        default:
        break;
    }
    $(image_to_hide).hide();
}

function show_hide(main_question, show_hide_question, radio_option) {
    for(i=0;i<show_hide_question.length;i++) {
        if( radio_option == 1 ) {
            $( "#qno"+show_hide_question[i]).show();
        } else {
             $( "#qno"+show_hide_question[i]).hide();
        }
    }
}