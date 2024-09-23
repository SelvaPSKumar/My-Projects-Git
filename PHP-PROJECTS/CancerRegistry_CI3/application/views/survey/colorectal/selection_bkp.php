    <div class="container">
        <h1 class="screeningHeader">Colorectal Cancer Screening</h1>
    </div>
    <div class="container mt-2">
        <div class="back-container d-flex">
            <span class="backward-icon"><ion-icon name="chevron-back-outline"></ion-icon></span>
            <a href="../TestResults/ColerectalTestResults.html" class="back-link">
            <p> Back</p>
        </a>
        </div>
    </div>
    <div class="container">
        <div class="screening-info-container">
            <form action="<?php echo base_url('colorectal_questions/one'); ?>" method="POST"> 
                <p>Please click an option below to begin.</p>
                <div class="row">
                <div class="col-md-6">
                        <div class="card mb-5">
                            <div class="card-body mb-4">
                                <div class="row">
                                    <div class="col-2">
                                        <img src="<?php echo base_url('assets/img/selfawareness.svg'); ?>" />
                                    </div>
                                    <div class="col-10">
                                        <h6 class="mt-2 mx-3">Self Assessment</h6>
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer text-center bg-white p-0">
                                <div class="form-check">
                                    <input type="hidden" name="assessment_type" value="1">
                                    <input type="hidden" name="new_test" value="1">
                                    <input class="form-check-input" type="radio" name="assessment_sub_type" id="flexRadioDefault2" value="1" checked onclick="selfAssesment()">
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        Select
                                    </label>
                                  </div>                        
                                </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card mb-5">
                            <div class="card-body mb-4">
                                <div class="row">
                                    <div class="col-2">
                                        <img src="<?php echo base_url('assets/img/Clinic.svg'); ?>" />
                                    </div>
                                    <div class="col-10">
                                        <h6 class="mt-2 mx-3">Clinical Assessment</h6>
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer text-center bg-white p-0">
                                <div class="form-check" >
                                    <input class="form-check-input" type="radio" name="assessment_sub_type" id="flexRadioDefault1" value="2" onclick="ClinicalAssesment()">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                     Select
                                    </label>
                                  </div>
                            </div>
                        </div>
                    </div>
                </div>

               <div>
              <div class="form">
                <p>Select Assessment Tool</p>
                <select class="form-select" name="assessment_tool" aria-label="Default select example" id="formSelection" onchange={onChangeSection()} required="true">
                    <option selected>Select Assessment Tool</option>
                    <option value="1">Symptom Assessment Tool</option>
                    <option value="2">Risk Assessment Tool</option>
                  </select>
                  <select class="form-select" aria-label="Default select example" id="formSelectionClinical" onchange={onchangeClinical()}>
                    <option selected>Select Assessment Tool</option>
                    <option value="3">Colonoscopy</option>
                    <option value="4">iFOBT</option>
                  </select>
                  <p class="mt-5">Please enter date and time Performed</p>
                  <div class="row">
                    <div class="col-md-6">
                        <p>Date</p>
                        <div class="input-outer">
                            <input type="date" id="start" name="date" class="date-input" max="<?php echo date("Y-m-d"); ?>"
                          value="<?php echo date('m-d-Y'); ?>">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <p>Time</p>
                        <div class="input-outer">
                            <input type="time" id="start" name="time" class="date-input"
                          value="">
                        </div>
                    </div>
                  </div>
            
                <div class="screening-btn-selection">
                    <div class="row">
                        <div class="col-6 mb-3">
                            <a href="../ColorectalCancer/ColorectalScreen.html">
                            <button class="btn">
                                Cancel</button></a>
                        </div>
                        <div class="col-6">
                            <!-- <a href="<?php echo base_url('colorectal_questions/one'); ?>"> -->
                              
                            <div id="proceed-self">
                                <!-- <input  class="btn" value="Click to proceed"> -->
                                <button type="submit" class="btn"> Click to proceed </button>
                            </div>
                            <!-- </a> -->
                            
                            <a href="<?php echo base_url('colorectal_cancer/risk_assessment_info'); ?>">
                            <div id="proceed-risk">
                                <button class="btn"> Click to proceed </button>
                            </div>
                            </a>

                            <a href="<?php echo base_url('colorectal_cancer/colonoscopy'); ?>">
                                <div id="clonoscopy">
                                    <button class="btn"> Click to proceed</button>
                                </div>
                                </a>

                                <a href="<?php echo base_url('colorectal_cancer/ifobt'); ?>">
                                    <div id="ifobt">
                                        <button class="btn"> Click to proceed</button>
                                    </div>
                                    </a>
                            
                               
                            
                        </div>
                    </div>
                </div>
            </div>
               </div>
            
            </form>
        </div>
    </div>
   <script>
        var oldone = document.getElementById("proceed-risk").style.display = "none";
        var clicnicalSelection = document.getElementById('formSelectionClinical').style.display = "none";
        var clonoConnect = document.getElementById('ifobt').style.display = "none";
        var ifbotoConnect =document.getElementById('clonoscopy').style.display = "none";

        function onChangeSection(){
            var selection = document.getElementById("formSelection");
            var value = selection.value;
            console.log(value)


            if(value == "1"){
                document.getElementById('proceed-self').style.display = "block";
                document.getElementById('proceed-risk').style.display = "none";
                document.getElementById('ifobt').style.display = "none";
                document.getElementById('clonoscopy').style.display = "none";


            } else if(value == "2") {
                document.getElementById('proceed-self').style.display = "none";
                document.getElementById('proceed-risk').style.display = "block";
                document.getElementById('ifobt').style.display = "none";
                document.getElementById('clonoscopy').style.display = "none";
            } else{
                document.getElementById('proceed-self').style.display = "block";
                document.getElementById('ifobt').style.display = "none";
                document.getElementById('clonoscopy').style.display = "none";
            }
        }

    function onchangeClinical(){
        var ClinicalSelection = document.getElementById("formSelectionClinical");
        var valueClinical = ClinicalSelection.value;
       
        if(valueClinical == "3"){
            document.getElementById('proceed-self').style.display = "none";
            document.getElementById('proceed-risk').style.display = "none";
            document.getElementById('ifobt').style.display = "none";
            document.getElementById('clonoscopy').style.display = "block";
        } else if (valueClinical == "4"){
            document.getElementById('proceed-self').style.display = "none";
            document.getElementById('proceed-risk').style.display = "none";
            document.getElementById('ifobt').style.display = "block";
            document.getElementById('clonoscopy').style.display = "none";
        } else {
            document.getElementById('proceed-self').style.display = "none";
            document.getElementById('proceed-risk').style.display = "none";
            document.getElementById('ifobt').style.display = "none";
            document.getElementById('clonoscopy').style.display = "block";
        }
    }


        function selfAssesment() {
        var x = document.getElementById("flexRadioDefault2").value;
      if(x == "1"){
    document.getElementById("formSelection").style.display = "block";
    document.getElementById("formSelectionClinical").style.display = "none";

  }
}    

function ClinicalAssesment() {
  var y = document.getElementById("flexRadioDefault1").value;
  if(y == "2"){
    document.getElementById("formSelectionClinical").style.display = "block";
    document.getElementById("formSelection").style.display = "none";

  }
}  
    </script>