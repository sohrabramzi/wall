<?php

	$tpl->newBlock("login");
	$tpl->newBlock("register");

	if (isset($_POST['login'])) {
		$controller->login();
	} elseif (isset($_POST['register'])) {
		$controller->register();
	}
