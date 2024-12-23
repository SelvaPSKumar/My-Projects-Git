<?php include('header.php'); ?>

<?php 
	$CI = & get_instance();
	$CI->load->view($content);
	
	if ($is_footer) {
	 	include('footer.php');
	}
	// include('footer_script.php');
?>