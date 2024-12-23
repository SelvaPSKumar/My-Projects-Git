<?php

if (!function_exists('pre')) {
	function pre($data=null){
		echo "<pre>"; print_r($data); echo "</pre>";
	}
}

if (!function_exists('pre_d')) {
	function pre_d($data=null){
		echo "<pre>"; print_r($data); echo "</pre>"; die();
	}
}

if (!function_exists('make_replies_data')) {
	function make_replies_data($data=null){

		if ($data == 'y' || $data == 'n') {
			return $data;
		} else{

			echo "<pre>"; print_r($data); echo "</pre>";
			die('data type invalid, need to handle in helper!');
		}

	}
}

if(!function_exists('sendEmail')){
	function sendEmail($to = null, $from = null, $subject = null, $data = array()) {
		$CI=& get_instance();
		if($to != null || true) {

			$config = Array(   
	            'protocol' => 'smtp',
	            'smtp_host' => 'ssl://smtp.gmail.com',
	            'smtp_port' => 465,
	            'smtp_user' => 'ncsm.official@gmail.com',
	            'smtp_pass' => 'nc$m2023!',
	            'smtp_timeout' => '60',
	            'mailtype'  => 'html', 
	        ); 
	        if($from == null){
	        	$from = 'ncsm.official@gmail.com';
	        }
			$CI->load->library('email');
			 $CI->email->initialize($config);
	        $CI->email->from($from);
	        $CI->email->to("shoaibjakhar11@gmail.com");
	        $CI->email->subject("Testing");
	        $body = isset($data['message']) ? $data['message'] : "Test email";
	        // debug($data);


	        // $body = $CI->load->view('admin/emails/email_templates/action.php',$data,TRUE);
	        $CI->email->message($body);
	        return $CI->email->send();
        }

        return false;
	}
	
	function get_maritial($id)
	{
		$CI = &get_instance();
		$status = '';
		if ($id != null) {
			$data = $CI->common_model->getById('m_maritalstatus', $id);
			$status = isset($data->marital_status) ? $data->marital_status   : '';
		}
		return $status;
	}
	function get_state($id)
	{
		$CI = &get_instance();
		$state = '';
		if ($id != null) {
			$data = $CI->common_model->getById('m_state', $id);
			$state = isset($data->state) ? $data->state : '';
		}
		return $state;
	}	

	function get_country($id)
	{
		$CI = &get_instance();
		$country = '';
		if ($id != null) {
			$data = $CI->common_model->getById('m_country', $id);
			$country = isset($data->country_name) ? $data->country_name   : '';
		}
		return $country;
	}

	function get_blood($id)
	{
		$CI = &get_instance();
		$blood = '';
		if ($id != null) {
			$data = $CI->common_model->getById('m_bloodgroup', $id);
			$blood = isset($data->bloodgroup_name) ? $data->bloodgroup_name   : '';
		}
		return $blood;
	}

	function get_gender($id)
	{
		$CI = &get_instance();
		$gender = '';
		if ($id != null) {
			$data = $CI->common_model->getById('m_gender', $id);
			$gender = isset($data->gender) ? $data->gender   : '';
		}
		return $gender;
	}
	function get_education($id)
	{
		$CI = &get_instance();
		$education = '';
		if ($id != null) {
			$data = $CI->common_model->getById('m_educationlevel', $id);
			$education = isset($data->education_level) ? $data->education_level   : '';
		}
		return $education;
	}

	function get_socioeconomic($id)
	{
		$CI = &get_instance();
		$socio_tips = '';
		if ($id != null) {
			$data = $CI->common_model->getById('m_socioeconomic', $id);
			$socio_tips = isset($data->socio_tips) ? $data->socio_tips   : '';
		}
		return $socio_tips;
	}

	function get_facility_name($id)
	{
		$CI = &get_instance();
		$facility_name = '';
		if ($id != null) {
			$data = $CI->common_model->getById('m_facility', $id);
			$facility_name = isset($data->facility_name) ? $data->facility_name   : '';
		}
		return $facility_name;
	}

	if(!function_exists('json_decode_and_fetch')) {
		function json_decode_and_fetch($inputs_value, $patient_gender) {
			if($inputs_value!=null || !empty($inputs_value)) {
				$json_decoded = json_decode($inputs_value);
				if(isset($json_decoded->male) || isset($json_decoded->female)){
		            if ($patient_gender == 1 ) {
		                $select_values=$json_decoded->male;
		            } elseif( $patient_gender == 2) {
		                $select_values=$json_decoded->female;
		            } else {
		                $select_values=$json_decoded->male;
		            }
		        } else {
		            $select_values=$json_decoded;
		        }
		    } else {
		    	$select_values = $question->input_values;
		    }
		    return $select_values;
		}
	}

	if(!function_exists('json_input_retrieve')) {
		function json_input_retrieve($question, $js_function, $patient_gender ) {
			$normal_value = true;
			$html = '';
			//its common change if needed
			$normal_value_info = '<div class="text-secondary" id="normal_value_question_'.$question->q_no.'_0_"></div>';
			$warning_info ='<div id="warning_info_question_'.$question->q_no.'_0_"></div>';

			//common method for all input to retrive info
			$select_values = json_decode_and_fetch($question->input_values, $patient_gender);

			switch(  $question->input_type ) {
				case 'text':
				break;

				case 'select':
	        		$html ='<select class="form-select" aria-label="Default select example" name="question['.$question->id.'][0]" id="question_'.$question->q_no.'_0_" '.$js_function.'>';
                    $html .= '<option selected value=""> --Select-- </option>';

                    //if found normal value set it true
                    $check_if_normal = false;
                    
                    //only normal value appeared will be bold
                    $normal_value_appeared = false;

                    //store what is normal value
                    $normal_value_value ='';
                    foreach( $select_values as $point => $label ) {
                    	if($point == 'normal_value') {
                    		//normal value option found
                        	$normal_value_appeared = true;
                        	$normal_value_value = trim($label);
                        	$normal_value_info = '<div class="text-secondary" id="normal_value_question_'.$question->q_no.'_0_">(Normal value '.ucfirst(trim($label)).')</div>';

                            //used for answer values
		            		if(isset($question->assessment_questionnaires_value)) {
		            			$is_json = is_string($question->assessment_questionnaires_value) && is_array(json_decode($question->assessment_questionnaires_value, true)) ? true : false;
		            			if($is_json) {
		            				$questionnaire_value = (array)json_decode_and_fetch($question->assessment_questionnaires_value, $patient_gender);
		            				$questionnaire_value = array_keys($questionnaire_value)[0];
		            			} else {
		            				$questionnaire_value = $question->input_values;
		            			}
		            			if(strtolower($questionnaire_value)==strtolower($label)) {
		            				$check_if_normal = true;
		            			}
		            		}
                    	}
                    }

                    foreach($select_values as $point => $label){
                        if($point != 'normal_value')  {
	                        $decoded=json_encode(array($point=>$label), JSON_FORCE_OBJECT);
	                        $html .="<option value='".htmlspecialchars($decoded)."' data-label='".$label."' data-point='".$point."' data-have_point='1' data-normal_value='".$normal_value_value."'>".$label."</option>";
                        }
                    }
                    if($normal_value_appeared){
                    	$normal_value = $check_if_normal;
                	}

                    $html .= '</select>';
				break;

				case 'radio':
					$html ='<div class="input_radio_buttons">';
					$div_wrap[0] = '';
					$div_wrap[1] = '';
					if(count((array)$select_values) > 3) {
						$div_wrap[0] = '<div>';
						$div_wrap[1] = '</div>';
					}
					foreach($select_values as $point => $label){
						$decoded=json_encode(array($point=>$label), JSON_FORCE_OBJECT);
						$html .= $div_wrap[0];
						$html .= '<input class="" type="radio" name="question['.$question->id.'][0]" id="question_'.$question->q_no.'_'.$point.'_" value="'.htmlspecialchars($decoded).'" data-label="'.$label.'" data-point="'.$point.'" data-have_point="1" data-group="'.$question->group.'" '.$js_function.'>
						<label for="question_'.$question->q_no.'_'.$point.'_">'.ucfirst($label).'</label>';
						$html .= $div_wrap[1];
					}
					$html .='</div>';
				break;

				case 'checkbox':
				break;

				case 'number':
				break;

				case 'range_text':
					if(strpos($select_values,"<") !== false) {
	            		$range_values=explode('<', $select_values );
	            		$html .= '<input type="number" class="form-control" id="question_'.$question->q_no.'_0_" name="question['.$question->id.'][0]" value="'.trim($range_values[1]).'" min="0" data-normal_max="'.trim($range_values[1]).'">';
	            		$normal_value_info = '<div class="text-secondary" id="normal_value_question_'.$question->q_no.'_0_">(Normal value above '.trim($range_values[1]).')</div>';

	            		//used for answer values
	            		if(isset($question->assessment_questionnaires_value)) {
	            			if($question->assessment_questionnaires_value>trim($range_values[1])) {
	            				$normal_value = false;
	            			}
	            		}
	            	} elseif(strpos($select_values,">") !== false) {
	            		$range_values=explode('>', $select_values );
	            		$html = '<input type="number" class="form-control" id="question_'.$question->q_no.'_0_" name="question['.$question->id.'][0]" value="'.trim($range_values[1]).'" step="any" min="0" data-normal_min="'.trim($range_values[1]).'">';
	            		$normal_value_info = '<div class="text-secondary" id="normal_value_question_'.$question->q_no.'_0_">(Normal value above '.trim($range_values[1]).')</div>';

	            		//used for answer values
		            	if(isset($question->assessment_questionnaires_value)) {
	            			if($question->assessment_questionnaires_value<trim($range_values[1])) {
	            				$normal_value = false;
	            			}
	            		}
	            	}
	            	
				break;

				case 'textarea':
				break;

				case 'file':
				break;
			}

	    	return array("input_content"=>$html, "normal_value_info_content"=>$normal_value_info, 'warning_info_content'=>$warning_info, 'normal_value' =>$normal_value);
		}
	}
	if(!function_exists('non_json_input_retrieve')) {
		function non_json_input_retrieve($question, $js_function, $patient_gender ) {
			$normal_value = true;
			$html = '';
			//its common change if needed
			$normal_value_info = '<div class="text-secondary" id="normal_value_question_'.$question->q_no.'_0_"></div>';
			$warning_info ='<div id="warning_info_question_'.$question->q_no.'_0_"></div>';
			switch( $question->input_type ) {
				case 'text':
						if($question->input_values==null || empty($question->input_values)) {
						$html = '<input type="text" name="question['.$question->id.'][0]" id="question_'.$question->q_no.'_0_" class="form-control" placeholder="'.$question->placeholder.'" aria-describedby="basic-addon1">';
						}
				break;

				case 'read_only_text':
						if($question->input_values==null || empty($question->input_values)) {
						$html = '<input type="text" name="question['.$question->id.'][0]" id="question_'.$question->q_no.'_0_" class="form-control" placeholder="'.$question->placeholder.'" aria-describedby="basic-addon1" readonly>';
						}
				break;

				case 'select':
					if($question->input_values==null || empty($question->input_values)) {
		                $select_values[0]=0;
		                $select_values[1]=50;
		            } else {
		            	if(strpos($question->input_values,"-") !== false) {
		                	$select_values=explode('-', $question->input_values );
		            	}
		            }
		            $html ='<select class="form-select" aria-label="Default select example" name="question['.$question->id.'][0]" id="question_'.$question->q_no.'_0_" '.$js_function.'>';
		            $html .= '<option selected value=""> --Select-- </option>';
	                for($k=intval($select_values[0]); $k<=intval($select_values[1]);$k++) {
	                    $html .= '<option value="'.$k.'">'.$k. '</option>';
	                }
                    $html .= '</select>';
				break;

				case 'radio':
					$div_wrap[0] = '';
					$div_wrap[1] = '';
					if($question->input_values==null || empty($question->input_values)) {
						$select_values[0] = 'Yes';
						$select_values[1] = 'No';
					} else {
						if(strpos($question->input_values,"|") !== false) {
							$select_values = explode('|', $question->input_values);
						}
					}
					if(isset($select_values) && !empty($select_values) && (count($select_values)>0)) {
						if(count($select_values) > 2) {
							$div_wrap[0] = '<div>';
							$div_wrap[1] = '</div>';
						}
						$html ='<div class="input_radio_buttons">';
						foreach($select_values as $key=>$select_value) {
							$html .= $div_wrap[0];
							$html .= '<input class="" type="radio" name="question['.$question->id.'][0]" id="question_'.$question->q_no.'_'.$key.'_" value="'.ucfirst($select_value).'" '.$js_function.'>
							<label for="question_'.$question->q_no.'_'.$key.'_">'.ucfirst($select_value).'</label>';
							$html .= $div_wrap[1];
						}
						$html .='</div>';
					}
				break;

				case 'checkbox':
					if($question->input_values==null || empty($question->input_values)) {
						//no default value
					} else {
						if(strpos($question->input_values,"|") !== false) {
							$select_values = explode('|', $question->input_values);
						}
					}
					if(isset($select_values) && !empty($select_values) && (count($select_values)>0)) {
						foreach($select_values as $key=>$select_value) {
						$html .='<div class="input_checkboxes">';
							$html .='<input type="checkbox" name="question['.$question->id.']['.$key.']" id="question_'.$question->q_no.'_'.$key.'_" value="'.$select_value.'" '.$js_function.'>
							<label for="question_'.$question->q_no.'_'.$key.'_">'.ucfirst($select_value).'</label>';
						$html .='</div>';
						}
					}
				break;

				case 'number':
					if($question->input_values==null || empty($question->input_values)) {
						//check different input values
		            	$html = '<input type="number" class="form-control" id="question_'.$question->q_no.'_0_" name="question['.$question->id.'][0]" step="any" min="0" placeholder="'.$question->placeholder.'">';
			        } else {
			        	if(strpos($question->input_values,"-") !== false) {
			            	$range_values=explode('-', $question->input_values );

			            	$html = '<input type="number" class="form-control" id="question_'.$question->q_no.'_0_" name="question['.$question->id.'][0]" step="any" min="'.$range_values[0].'" max="'.$range_values[1].'" placeholder="'.$question->placeholder.'">';
			            }
			        }
				break;

				case 'range_text':
					if($question->input_values==null || empty($question->input_values)) {
	            	//if no values
		            } else {
		            	//check different input values
		            	if(strpos($question->input_values,"-") !== false) {
			            	$range_values=explode('-', $question->input_values );

			            	$html = '<input type="number" class="form-control" id="question_'.$question->q_no.'_0_" name="question['.$question->id.'][0]" value="'.trim($range_values[1]).'" step="any" min="0" data-normal_min="'.trim($range_values[0]).'" data-normal_max="'.trim($range_values[1]).'">';
			            	$normal_value_info = '<div class="text-secondary" id="normal_value_question_'.$question->q_no.'_0_">(Normal value between '.trim($range_values[0]).' and '.trim($range_values[1]).')</div>';

			            	//used for answer values
			            	if(isset($question->assessment_questionnaires_value)) {
		            			if($question->assessment_questionnaires_value>trim($range_values[1]) || $question->assessment_questionnaires_value<trim($range_values[0])) {
		            				$normal_value = false;
		            			}
		            		}
			            } elseif(strpos($question->input_values,"<") !== false) {
		            		$range_values=explode('<', $question->input_values );
		            		$html = '<input type="number" class="form-control" id="question_'.$question->q_no.'_0_" name="question['.$question->id.'][0]" value="'.trim($range_values[1]).'" step="any" min="0" data-normal_max="'.trim($range_values[1]).'">';
		            		$normal_value_info = '<div class="text-secondary" id="normal_value_question_'.$question->q_no.'_0_">(Normal value below '.trim($range_values[1]).')</div>';

		            		//used for answer values
			            	if(isset($question->assessment_questionnaires_value)) {
		            			if($question->assessment_questionnaires_value>trim($range_values[1])) {
		            				$normal_value = false;
		            			}
		            		}
		            	} elseif(strpos($question->input_values,">") !== false) {
		            		$range_values=explode('>', $question->input_values );
		            		$html = '<input type="number" class="form-control" id="question_'.$question->q_no.'_0_" name="question['.$question->id.'][0]" value="'.trim($range_values[1]).'" step="any" min="0" data-normal_min="'.trim($range_values[1]).'">';
		            		$normal_value_info = '<div class="text-secondary" id="normal_value_question_'.$question->q_no.'_0_">(Normal value above '.trim($range_values[1]).')</div>';

		            		//used for answer values
			            	if(isset($question->assessment_questionnaires_value)) {
		            			if($question->assessment_questionnaires_value<trim($range_values[1])) {
		            				$normal_value = false;
		            			}
		            		}
		            	} elseif(strpos($question->input_values,"/") !== false) {
			            	$range_values=explode('/', $question->input_values );
			            	$html .= '<div class="divided_range row">
			            			  <div class="divided_range_input_section col-md-5">
			            			  	<input type="hidden" name="question['.$question->id.'][0]" id="question_'.$question->q_no.'_0_" />
			            				<input type="number" class="form-control" id="question_'.$question->q_no.'_0_1" min="0" value="'.trim($range_values[0]).'" step="any" data-normal_min="'.trim($range_values[0]).'" data-normal_max="'.trim($range_values[0]).'" data-co_depend="question_'.$question->q_no.'_0_2" data-main_input="question_'.$question->q_no.'_0_">';
			            	$html .= '</div>
			            			<div class="col-md-2">/</div>
			            			<div class="col-md-5">
			            			<input type="number" class="form-control" id="question_'.$question->q_no.'_0_2" min="0" value="'.trim($range_values[1]).'" step="any" data-normal_min="'.trim($range_values[1]).'" data-normal_max="'.trim($range_values[1]).'"  data-co_depend="question_'.$question->q_no.'_0_1" data-main_input="question_'.$question->q_no.'_0_">';
			            	$html .= '</div>
			            			</div>';
							$normal_value_info = '<div class="text-secondary" id="normal_value_question_'.$question->q_no.'_0_">(Normal value '.trim($range_values[0]).'/'.trim($range_values[1]).')</div>';
							$warning_info ='<div id="warning_info_question_'.$question->q_no.'_0_"></div>';

							//used for answer values
			            	if(isset($question->assessment_questionnaires_value)) {
		            			if($question->assessment_questionnaires_value != (trim($range_values[0]).'/'.trim($range_values[1])) ) {
		            				$normal_value = false;
		            			}
		            		}
			            } else {
			            }
		            }
				break;

				case 'textarea':
					if($question->input_values==null || empty($question->input_values)) {
						$html = '<textarea name="question['.$question->id.'][0]" id="question_'.$question->q_no.'_0_" class="form-control" placeholder="'.$question->placeholder.'" aria-describedby="basic-addon1"></textarea>';
					}
				break;

				case 'file':
					if($question->input_values==null || empty($question->input_values)) {
						$file_formats = get_image_upload_config('dummy');
						$accept_formats = '';
						if(isset($file_formats['allowed_types']) && (strpos($file_formats['allowed_types'],"|") !== false) ) {
							$accept_formats = explode('|', $file_formats['allowed_types']);
							$accept_formats = "." . implode(', .', $accept_formats);
						}
						$html = '<input type="file" class="form-control" name="'.$question->id.'" id="question_'.$question->q_no.'_0_" class="form-control" placeholder="'.$question->placeholder.'" aria-describedby="basic-addon1" required="true" accept="'.$accept_formats.'">
							<div class="text-secondary">Allowed Types are Images and PDF. File size should not exceed 15mb.</div>';
					}

				break;
			}
	        return array("input_content"=>$html, "normal_value_info_content"=>$normal_value_info, 'warning_info_content'=>$warning_info, 'normal_value' => $normal_value);
		}
	}
	if(!function_exists('get_table_title')) {
		function get_table_title($questions) {
			$title_array=null;
			$previous_title=null;
			foreach ($questions as $key => $question) {
				$question = (object) $question;
				if(isset($question->questionnaire_title)) {
					if($question->questionnaire_title!=$previous_title || !isset($previous_title))
					$title_array[$question->q_no] = $question->questionnaire_title;
					$previous_title = $question->questionnaire_title;
				}
			}
			return $title_array;
		}
	}
	if(!function_exists('get_different_inputs')) {
		function get_different_inputs($question, $js_function, $patient_gender ) {
			$CI = &get_instance();
			//check if its json or not
			$is_json = is_string($question->input_values) && is_array(json_decode($question->input_values, true)) ? true : false;
			if($is_json) {
				return json_input_retrieve($question, $js_function, $patient_gender );
			} else {
				return non_json_input_retrieve($question, $js_function, $patient_gender );
			}
		}
	}

	if(!function_exists('get_image_upload_config')) {
		function get_image_upload_config($newfilename) {
			//file validation
			$config['upload_path'] = 'assets/images/';
			$config['allowed_types'] = 'pdf|gif|jpeg|jpg|png|tif|tiff|svg|webp|bmp';
			$config['file_ext_tolower'] = true;
			$config['file_name'] = $newfilename;
			$config['max_size']     = '15360';
			return $config;
		}
	}
	if(!function_exists('get_encrypted_image')) {
		function get_encrypted_image($image) {
			//$mime_type = '';
			$image_src = 'assets/images/'.$image;
			$file_extention = end(explode(".", strtolower($image_src)));
			$other_thumbnail = array('pdf', 'tif', 'tiff');
			if(in_array($file_extention,$other_thumbnail)){
				$image_src = 'assets/img/image_thumbnail.png';
			}
			$read_image = file_get_contents($image_src);
			$mime_type = mime_content_type($image_src);
			$encrypted_path = 'data:'.$mime_type.';base64,'.base64_encode($read_image);
			return $encrypted_path;
		}
	}
}