<?php
session_start();
if (!isset($_SESSION['id'])) {
	header('location:index.php');
}else{
	if(isset($_GET['action'])){
		$action = $_GET['action'];
	}else{
		$action = null;
	}

	include("../templatepower/class.TemplatePower.inc.php");
	include_once("model.php");

	$tpl = new TemplatePower("includes/html.tpl");

	$tpl->prepare();

	connect();

	$user =  getUser($_SESSION['id']);
	$tpl->assign("FULLNAME", $user[0]['voornaam']." ".$user[0]['achternaam']);


switch ($action) {
	default:
			
			if (isset($_GET['user'])) {
				$user = getUser($_GET['user']);
				$tpl->assign("VOLLEDIGNAAM", $user[0]['voornaam']." ".$user[0]['achternaam']);
				$post = getPostsFromUser($_GET['user']);

				}
?>	