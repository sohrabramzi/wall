<?php

$tpl->newBlock('wijzigcomment');
$getcomment = $controller->getcomment($_GET['id']);
$tpl->assign('CONTENT',$getcomment['content']);

	if (isset($_POST['wijzigcomment'])) {
		$controller->wijzigcomment($_POST['wijzigcomment1'],$getcomment['comment_id']);
	}

?>