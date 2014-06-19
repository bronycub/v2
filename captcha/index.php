<?php
 session_start();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8">
  <title>Demo captcha</title>
  </head>
  <body>
    <form method="POST" action="">
      <h3>Quel est ce chiffre ?</h3>
      <img src="captcha.php" /><br />
      <input type="text" name="captcha" style="width:70px"/><br />
      <input type="submit" />
    </form>
<?php
 if($_POST['captcha']){
  if($_POST['captcha']==$_SESSION['captcha']) echo '<h3 style="color:green">Bingo !</h3>';
  else echo '<h3 style="color:red">Oups !</h3>';
 }
?>
  </body>
</html>
