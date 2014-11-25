<?php
	include("../templatepower/class.TemplatePower.inc.php");
	include_once("model.php");



	$tpl = new TemplatePower("includes/html.tpl");

	$tpl->assignInclude("FORMS", "includes/forms.tpl");	
	$tpl->assignInclude("HOMEPAGE", "includes/home.tpl");
	$tpl->assignInclude("PROFIEL", "includes/profiel.tpl");	
	$tpl->assignInclude("WIJZIGPOST", "includes/wijzigpost.tpl");
	$tpl->assignInclude("WIJZIGCOMMENT", "includes/wijzigcomment.tpl");		


	$tpl->prepare();

		if (!isset($_SESSION['gebruiker'])) {		         
		    include("forms.php");	    		    
		} else {
			include('homepage.php');
		}


		$tpl->printToScreen();

?>
	