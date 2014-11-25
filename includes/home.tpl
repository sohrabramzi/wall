<html>
<head>
  <meta charset="utf-8">
  <title>Login Form</title>
<!-- START BLOCK : home -->
</head>
	 <div class="units-row" id="blauw">
     <div class="unit-50">
      <h1>Welkom</h1>
    </div>
    <div class="unit-50">
    <div class="home">
	 <li><a href="index.php?action=logout">Logout</a></li>
   <li><a href="index.php?action=Profiel">Profiel Wijzigen</a></li>
  <li><a href="index.php?action=pagina">Terug naar home</a></li>
      </form>
      </div>
    </div>
   </div>
<!-- END BLOCK : home -->
<!-- START BLOCK : profiel -->
    <div class="units-row">
    <div class="unit-30">
    <div class="profiel">
    <p class="homepage">{VOLLEDIGNAAM}</p>
    <p class="homepage">{EMAIL}</p>
    <p class="homepage">{GEBOORTEDATUM}</p>
    <p class="homepage">{ADRES}</p>
    <p class="homepage">{POSTCODE}</p>
    <p class="homepage">{WOONPLAATS}</p>
    </div>
    </div>
<!-- END BLOCK : profiel -->

<div class="unit-60">
<div class="post">
    <!-- START BLOCK : post -->
    <form action="" method="post">
      <textarea name="status" class="status" placeholder="Type hier uw post in"></textarea>
        <input type="submit" value="post" name="post" > 

    </form> 
     <!-- END BLOCK : post -->
     <!-- START BLOCK : postblock -->
     <div class="postblock">
    <a href="index.php?action=viewprofiel&id={GID}"><h3 class="post-user">{VOLLEDIGNAAM}</h3></a>
    <!-- START BLOCK : delete -->
    <a class="wijzigpost" onclick="return confirm('Weet u zeker dat u deze post wilt verwijderen?')" href="index.php?action=deletepost&id={ID}"><img src="pic/delete-icon.png"></a>
    <a class="wijzigpost" href="index.php?action=wijzigpost&id={ID}"><img src="pic/potlood.png"></a>
    <!-- END BLOCK : delete -->
     <p class="postblock">{CONTENT}</p>
     <!-- START BLOCK : comment -->
     <h4 class="post-user">{VOLLEDIGNAAM}</h4>
     <!-- START BLOCK : delete_comment -->
        <a class="wijzigpost" onclick="return confirm('Weet u zeker dat u deze comment wilt verwijderen?')" href="index.php?action=deletecom&id={COMMENTID}"><img src="pic/delete-icon.png"></a>
        <a class="wijzigpost" href="index.php?action=wijzigcomment&id={COMMENTID}"><img src="pic/potlood.png"></a>
      <!-- END BLOCK : delete_comment -->
     <p class="comment">{CONTENT}</p>
    <!-- END BLOCK : comment -->
    <form method="post">
      <textarea name="commentieks" class="commentieks" placeholder="Typ hier u Comment in"></textarea>
      <input type="hidden" name="post_id" value="{ID}">

      <input type="submit" value="comment" name="comment" >
    </form> 
     </div>
     <!-- END BLOCK : postblock -->
  </div>
</div>



