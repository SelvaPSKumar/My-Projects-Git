 <script>
    //document.getElementById("doctor-login").style.display = "none";
    // function selfAssesment() {
    //   var x = document.getElementById("flexRadioDefault2").value;
    //   if (x == "1") {
    //     document.getElementById("patient-login").style.display = "block";
    //     document.getElementById("doctor-login").style.display = "none";
    //   }
    // }
    // function ClinicalAssesment() {
    //   var y = document.getElementById("flexRadioDefault1").value;
    //   if (y == "2") {
    //     document.getElementById("patient-login").style.display = "none";
    //     document.getElementById("doctor-login").style.display = "block";
    //   }
    // } 
    $(document).ready(function(){
      function signup(form_data, e) {
        var action_url = e.currentTarget.action;
        $.ajax({
                url: action_url,
                type: 'POST',
                dataType: 'json',
                data: form_data,
                success: function(data) {
                  if (data.success) {
                    $('.signup_success').show().delay(5000).fadeOut();
                  } else {
                    $('.signup_error').show().delay(5000).fadeOut();
                  }
                }
        });
      }
      $("#patient_signup").submit(function(e){
        e.preventDefault();
        var form_data = $('#patient_signup').serialize();
        signup(form_data, e);
      
      });
      $("#medical_practitioner_signup").submit(function(e){
        e.preventDefault();
        var form_data = $('#medical_practitioner_signup').serialize();
        // will validate data later
        signup(form_data, e);
        
      });
    });
  </script>
<!-- colorectal cancer pages js -->
   <script>
        // var oldone = document.getElementById("proceed-risk").style.display = "none";
        // var clicnicalSelection = document.getElementById('formSelectionClinical').style.display = "none";
        // var clonoConnect = document.getElementById('ifobt').style.display = "none";
        // var ifbotoConnect =document.getElementById('clonoscopy').style.display = "none";
        // function onChangeSection(){
        //     var selection = document.getElementById("formSelection");
        //     var value = selection.value;
        //     console.log(value)
        //     if(value == "1"){
        //         document.getElementById('proceed-self').style.display = "block";
        //         document.getElementById('proceed-risk').style.display = "none";
        //         document.getElementById('ifobt').style.display = "none";
        //         document.getElementById('clonoscopy').style.display = "none";
        //     } else if(value == "2") {
        //         document.getElementById('proceed-self').style.display = "none";
        //         document.getElementById('proceed-risk').style.display = "block";
        //         document.getElementById('ifobt').style.display = "none";
        //         document.getElementById('clonoscopy').style.display = "none";
        //     } else{
        //         document.getElementById('proceed-self').style.display = "block";
        //         document.getElementById('ifobt').style.display = "none";
        //         document.getElementById('clonoscopy').style.display = "none";
        //     }
        // }
    // function onchangeClinical(){
    //     var ClinicalSelection = document.getElementById("formSelectionClinical");
    //     var valueClinical = ClinicalSelection.value;
       
    //     if(valueClinical == "3"){
    //         document.getElementById('proceed-self').style.display = "none";
    //         document.getElementById('proceed-risk').style.display = "none";
    //         document.getElementById('ifobt').style.display = "none";
    //         document.getElementById('clonoscopy').style.display = "block";
    //     } else if (valueClinical == "4"){
    //         document.getElementById('proceed-self').style.display = "none";
    //         document.getElementById('proceed-risk').style.display = "none";
    //         document.getElementById('ifobt').style.display = "block";
    //         document.getElementById('clonoscopy').style.display = "none";
    //     } else {
    //         document.getElementById('proceed-self').style.display = "none";
    //         document.getElementById('proceed-risk').style.display = "none";
    //         document.getElementById('ifobt').style.display = "none";
    //         document.getElementById('clonoscopy').style.display = "block";
    //     }
    // }
//         function selfAssesment() {
//         var x = document.getElementById("flexRadioDefault2").value;
//       if(x == "1"){
//     document.getElementById("formSelection").style.display = "block";
//     document.getElementById("formSelectionClinical").style.display = "none";
//   }
// }    
// function ClinicalAssesment() {
//   var y = document.getElementById("flexRadioDefault1").value;
//   if(y == "2"){
//     document.getElementById("formSelectionClinical").style.display = "block";
//     document.getElementById("formSelection").style.display = "none";
//   }
// }  
    </script>
