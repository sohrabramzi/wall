 <?php

 		function connect(){
		global $db;
		$db = new PDO('mysql:host=localhost;dbname=php-mvc', 'root', '');
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	
			function disconnect(){
			global $db;
		$db = null;
	}
	?>