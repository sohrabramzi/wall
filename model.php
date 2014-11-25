<?php

session_start();

class controller
{
	function __construct()
	{

	$this->pdo = new PDO('mysql:host=localhost;dbname=wall', 'root', '');
	$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}

    function login (){
		         
	    $stmt = $this->pdo->prepare("SELECT * FROM gebruiker where email='" .$_POST['email']. "' AND password='".$_POST['password']."'");  
	   
	    $stmt->execute();
	    $userExists = $stmt->fetchAll();
		if ($userExists) {
	    	$_SESSION['gebruiker'] = $userExists[0]['id'];
	    }

	    header("Location: index.php");

	}

	function register(){
		$stmt = $this->pdo->prepare("
		INSERT INTO `wall`.`persoon` (`voornaam`, `achternaam`, `geboortedatum`, `adres`, `postcode`, `woonplaats`) VALUES ('".$_POST['voornaam']."', '".$_POST['achternaam']."', '".$_POST['geboortedatum']."', '".$_POST['adres']."', '".$_POST['postcode']."', '".$_POST['Woonplaats']."');");
		$stmt->execute();
		$lastInsert = $this->pdo->lastInsertId();

		$stmt = $this->pdo->prepare("
		INSERT INTO `wall`.`gebruiker` (`email`, `password`, `persoon_id`) VALUES ('".$_POST['email']."', '".$_POST['password']."', '".$lastInsert."');");
		$stmt->execute();

			
	}


	public function getProfiel($id){

		$stmt = $this->pdo->prepare("SELECT *, gebruiker.id as gebruiker_id FROM gebruiker JOIN persoon ON gebruiker.persoon_id = persoon.id WHERE gebruiker.id = ".$id."");
		$stmt->execute();
		return $stmt->fetchAll();	

	}

	function wijzigen($persoon_id){
		

		$stmt = $this->pdo->prepare("UPDATE `wall`.`gebruiker` SET `email`='".$_POST['email']."', `password`='".$_POST['password']."' WHERE  `id`='".$_SESSION['gebruiker']."';");
		$stmt->execute();


		$stmt = $this->pdo->prepare("UPDATE `wall`.`persoon` SET `voornaam`='".$_POST['voornaam']."', `achternaam`='".$_POST['achternaam']."', `geboortedatum`='".$_POST['geboortedatum']."', `adres`='".$_POST['adres']."', `postcode`='".$_POST['postcode']."', `woonplaats`='".$_POST['woonplaats']."' WHERE `id`=".$persoon_id.";");
		$stmt->execute();

		header("Location: index.php");
			
	}

		function getUserPost($gebruiker_id){
		$stmt = $this->pdo->prepare("SELECT post.id AS post_id, post.content, post.datum, post.status, post.gebruiker_id as gebruiker_id, persoon.id, persoon.voornaam, persoon.achternaam
			FROM post INNER JOIN gebruiker ON post.gebruiker_id = gebruiker.id  
			INNER JOIN persoon ON gebruiker.persoon_id = persoon.id
			WHERE post.status = 1
			AND post.gebruiker_id = $gebruiker_id"); 
		$stmt->execute();
		$result=$stmt->fetchAll();
		return $result;
	}

	function getallPosts(){
		$stmt = $this->pdo->prepare("SELECT post.id AS post_id, post.content, post.datum, post.status, post.gebruiker_id as gebruiker_id, persoon.id, persoon.voornaam, persoon.achternaam
			FROM post INNER JOIN gebruiker ON post.gebruiker_id = gebruiker.id  
			INNER JOIN persoon ON gebruiker.persoon_id = persoon.id 
			WHERE post.status = 1  AND gebruiker.status = 0
			ORDER BY datum DESC");
		$stmt->execute();
		$result=$stmt->fetchAll();
		return $result;
	}

	function post($content){
		$stmt = $this->pdo->prepare("INSERT INTO `wall`.`post` (`content`,`datum` ,`gebruiker_id`) VALUES ('".$content."','".time()."' ,'".$_SESSION['gebruiker']."')");
		$stmt->execute();
		header("Location: index.php");
	}

	function wijzigpost($content,$post_id){
		$stmt = $this->pdo->prepare("UPDATE `wall`.`post` SET `content`='{$content}' WHERE  `id`={$post_id};");
		$stmt->execute();
		header("Location: index.php");
	}

	function getpost($id){
		$stmt = $this->pdo->prepare("SELECT post.id AS post_id, post.content, post.gebruiker_id, persoon.id, persoon.voornaam, persoon.achternaam
			FROM post INNER JOIN gebruiker ON post.gebruiker_id = gebruiker.id  
			INNER JOIN persoon ON gebruiker.persoon_id = persoon.id 
			WHERE post.status = 1 AND post.id = '".$id."'");
		$stmt->execute();
		return $stmt->fetch();
	}

	function delete($post_id){
		$stmt = $this->pdo->prepare("UPDATE `wall`.`post` SET `status`='0' WHERE  `id`={$post_id};");
		$stmt->execute();

		header("Location: index.php");
	}

	function getAllcomments($post_id){
		$stmt = $this->pdo->prepare("SELECT comment.id AS comment_id, comment.content, comment.datum, comment.post_id, comment.gebruiker_id as gebruiker_id, persoon.id, persoon.voornaam, persoon.achternaam
			FROM comment INNER JOIN gebruiker ON comment.gebruiker_id = gebruiker.id  
			INNER JOIN persoon ON gebruiker.persoon_id = persoon.id
			WHERE post_id = {$post_id}
			AND comment.status = 1");
		$stmt->execute();
		$result=$stmt->fetchAll();
		return $result;
	}

	function comment($content, $post_id){
		$stmt = $this->pdo->prepare("INSERT INTO `wall`.`comment` (`content`,`datum` ,`post_id`, `gebruiker_id`) VALUES ('".$content."','".time()."' ,'".$post_id."','".$_SESSION['gebruiker']."')");
		$stmt->execute();
		header("Location: index.php");
	}

	function wijzigcomment($content,$comment_id){
		$stmt = $this->pdo->prepare("UPDATE `wall`.`comment` SET `content`='{$content}' WHERE  `id`={$comment_id}");
		$stmt->execute();
		header("Location: index.php");
	}

	function getcomment($comment_id){
		$stmt = $this->pdo->prepare("SELECT comment.id AS comment_id, comment.content, comment.datum, comment.post_id, comment.gebruiker_id as gebruiker_id, persoon.id, persoon.voornaam, persoon.achternaam
			FROM comment INNER JOIN gebruiker ON comment.gebruiker_id = gebruiker.id  
			INNER JOIN persoon ON gebruiker.persoon_id = persoon.id
			WHERE comment.id = $comment_id");
		$stmt->execute();
		$result=$stmt->fetch();
		return $result;
	}

		function deletecom($comment_id){
		$stmt = $this->pdo->prepare("UPDATE `wall`.`comment` SET `status`='0' WHERE  `id`={$comment_id};");
		$stmt->execute();

		header("Location: index.php");
	}



}




$controller = new Controller();

