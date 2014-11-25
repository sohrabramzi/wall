<?php

$tpl->newBlock('wijzigpost');
$getpost = $controller->getpost($_GET['id']);
$tpl->assign('CONTENT',$getpost['content']);

	if (isset($_POST['wijzigpost'])) {
		$controller->wijzigpost($_POST['wijzigpost1'],$getpost['post_id']);
	}

?>