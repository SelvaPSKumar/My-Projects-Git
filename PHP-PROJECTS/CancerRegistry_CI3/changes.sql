INSERT INTO `m_nationality` (`id`, `country_id`, `nationality_name`, `is_obsolete`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
	(1, 1, 'Malaysian', 0, 1, '2023-01-17 18:07:07', NULL, NULL);
	
ALTER TABLE `m_assessment_questionnaires` ADD `input_values` TEXT NULL DEFAULT NULL AFTER `input_type`;

ALTER TABLE `m_assessment_questionnaires` ADD `tip` VARCHAR(1500) NULL DEFAULT NULL AFTER `placeholder`;

ALTER TABLE `assessment_doctor_comment` ADD `comment_author` VARCHAR(50) NULL DEFAULT NULL AFTER `assessment_header_id`;

ALTER TABLE `m_users` ADD `user_type` INT NULL DEFAULT NULL AFTER `password`;

UPDATE `m_maritalstatus` SET `marital_status` = 'Married' WHERE `m_maritalstatus`.`id` = 2;

UPDATE `m_educationlevel` SET `education_level` = 'PhD' WHERE `m_educationlevel`.`id` = 7;

-- SELECT * FROM `m_assessment_questionnaires` WHERE `assessment_types_id` = 6 AND `assessment_tools_id` = 27;

UPDATE `m_assessment_questionnaires` SET `questionnaire` = 'Based on the BCRAT, insert the 5-year patient risk results below.' WHERE `m_assessment_questionnaires`.`q_identifier` = 'BRE_RSK_1';

UPDATE `m_assessment_questionnaires` SET `input_values` = '{\"female\":{\"Less than 80cm\":4, \"80cm - 88cm\":2, \">88cm\":0},\"male\":{\"94cm\":4, \"94cm - 102cm\":2, \">102cm\":0}}' WHERE `m_assessment_questionnaires`.`q_identifier` = 'YHT_CRA_2';

UPDATE `m_assessment_questionnaires` SET `input_values` = '{"Less than 75mins":0, "75mins - 150mins":2, ">150mins":4}' WHERE `m_assessment_questionnaires`.`q_identifier` = 'YHT_CRA_3';

UPDATE `m_assessment_questionnaires` SET `input_values` = '{"Less than 16g":0, "16g - 30g":1, ">30g":2}' WHERE `m_assessment_questionnaires`.`q_identifier` = 'YHT_CRA_5';

UPDATE `m_assessment_questionnaires` SET `input_values` = '{"Less than 200g":0, "200g - 400g":1, ">400g":2}' WHERE `m_assessment_questionnaires`.`q_identifier` = 'YHT_CRA_4';

UPDATE `m_socioeconomic` SET `socio_tips` = 'T20: Combined household of RM10,960 or more' WHERE `m_socioeconomic`.`id` = 3;

UPDATE `m_assessment_questionnaires` SET `questionnaire` = 'For the right breast, any calcifications present?' WHERE `m_assessment_questionnaires`.`q_identifier` = 'BRE_MMG_35';

UPDATE `m_assessment_questionnaires` SET `tip` = 'Fruit and vegetable intake per day (400g= 2 servings of fruits & 3 servings of vegetables)' WHERE `m_assessment_questionnaires`.`q_identifier` = 'YHT_CRA_4';

UPDATE `m_assessment_questionnaires` SET `tip` = 'Whole grains intake per day (1 serving = 16 grams)' WHERE `m_assessment_questionnaires`.`q_identifier` = 'YHT_CRA_5';

UPDATE `m_state` SET `state` = 'Sarawak' WHERE `m_state`.`id` = 16;
