<?php
$tpl->newBlock('wijzigen');
$wijzigen = $controller->getProfiel($_SESSION['gebruiker']);

if (isset($_POST['wijzigen'])) {
	$controller->wijzigen($wijzigen[0]['persoon_id']);
}


$tpl->assign('EMAIL',$wijzigen[0]['email']);
$tpl->assign('WACHTWOORD',$wijzigen[0]['password']);
$tpl->assign('VOORNAAM',$wijzigen[0]['voornaam']);
$tpl->assign('ACHTERNAAM',$wijzigen[0]['achternaam']);
$tpl->assign('GEBOORTEDATUM',$wijzigen[0]['geboortedatum']);
$tpl->assign('ADRES',$wijzigen[0]['adres']);
$tpl->assign('POSTCODE',$wijzigen[0]['postcode']);
$tpl->assign('WOONPLAATS',$wijzigen[0]['woonplaats']);

?>
