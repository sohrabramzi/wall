<?php
	$tpl->newBlock('home');

	$action = (isset($_GET['action'])) ? $_GET['action'] : NULL;

	switch ($action) {
		case 'logout':
			session_destroy();
			header("Location: index.php");
			break;

		case 'Profiel':
			include 'profiel.php';
			break;

		case 'pagina':
			header("Location: index.php");
			break;

		case 'wijzigpost':
			include 'wijzigpost.php';
			break;

		case 'wijzigcomment':
			include 'wijzigcomment.php';
			break;


		case 'viewprofiel':
			$tpl->newBlock('profiel');
			$profiel = $controller->getProfiel($_GET['id']);
			if($profiel){
				$tpl->assign('VOLLEDIGNAAM',$profiel[0]['voornaam'].' '.$profiel[0]['achternaam']);
				$tpl->assign('EMAIL',$profiel[0]['email']);
				$tpl->assign('GEBOORTEDATUM',$profiel[0]['geboortedatum']);
				$tpl->assign('ADRES',$profiel[0]['adres']);
				$tpl->assign('POSTCODE',$profiel[0]['postcode']);
				$tpl->assign('WOONPLAATS',$profiel[0]['woonplaats']);

				$tpl->newBlock('post');
				$result=$controller->getUserPost($_GET['id']);
				if($result){
					foreach ($result as $post) {
						$tpl->newBlock('postblock');
						
						$tpl->assign('VOLLEDIGNAAM', $post['voornaam'].' '.$post['achternaam']);
						$tpl->assign('CONTENT', ucfirst($post['content']));	
						$tpl->assign('ID', $post['post_id']);
						$tpl->assign('POSTID', $post['post_id']);
						$tpl->assign('GID', $post['gebruiker_id']);
						if ($post['gebruiker_id'] == $_SESSION['gebruiker']) {
							$tpl->newBlock('delete');
						}

						$result=$controller->getAllcomments($post['post_id']);
						if ($result) {
						foreach ($result as $comment) {
							$tpl->newBlock('comment');
							$tpl->assign('VOLLEDIGNAAM', $comment['voornaam'].' '.$comment['achternaam']);
							$tpl->assign('COMMENTID', $comment['comment_id']);	
							$tpl->assign('CONTENT', ucfirst($comment['content']));	
						}
					
					}
				}
						
			}	

				
						
			}
			break;



		case 'deletepost':
			$delete = $controller->delete($_GET['id']);
			break;

		case 'deletecomment':
			$deletecom = $controller->deletecom($_GET['id']);
			break;
		
		default:
			$tpl->newBlock('profiel');
			$profiel = $controller->getProfiel($_SESSION['gebruiker']);
			$tpl->assign('VOLLEDIGNAAM',$profiel[0]['voornaam'].' '.$profiel[0]['achternaam']);
			$tpl->assign('EMAIL',$profiel[0]['email']);

		

			$tpl->newBlock('post');
			$result=$controller->getallPosts();
			foreach ($result as $post) {
				$tpl->newBlock('postblock');

				$tpl->assign('VOLLEDIGNAAM', $post['voornaam'].' '.$post['achternaam']);
				$tpl->assign('CONTENT', ucfirst($post['content']));	
				$tpl->assign('ID', $post['post_id']);
				$tpl->assign('GID', $post['gebruiker_id']);
				if ($post['gebruiker_id'] == $_SESSION['gebruiker']) {
					$tpl->newBlock('delete');
					$tpl->assign('ID', $post['post_id']);
				}

				$result=$controller->getAllcomments($post['post_id']);

				foreach ($result as $comment) {
					$tpl->newBlock('comment');
	
					$tpl->assign('VOLLEDIGNAAM', $comment['voornaam'].' '.$comment['achternaam']);
					$tpl->assign('COMMENTID', $comment['comment_id']);	
					$tpl->assign('CONTENT', ucfirst($comment['content']));	

					if ($comment['gebruiker_id'] == $_SESSION['gebruiker']) {
						$tpl->newBlock('delete_comment');
						$tpl->assign('COMMENTID', $comment['comment_id']);	
					}
				}

							

				$tpl->assign('ID', $post['post_id']);
						
			}

			if (isset($_POST['comment'])) {
				$controller->comment($_POST['commentieks'], $_POST['post_id']);
			}	
			if (isset($_POST['post'])) {
				$controller->post($_POST['status']);
			}
			break;

	}

?>